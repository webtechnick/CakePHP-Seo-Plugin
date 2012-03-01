<?php
/**
* This class will take in uri to redirects and
* @since 6.0
* @license MIT
* @author Nick Baker (nick@webtechnick.com)
*/
App::uses('SeoUtil', 'Seo.Lib');
App::uses('CakeLog', 'Log');
App::uses('Controller', 'Controller');
App::uses('CakeResponse', 'Network');
class SeoAppError {
	
	public $SeoRedirect = null;
	public $SeoStatusCode = null;
	public $SeoUrl = null;
	
	/**
	* Overload constructor so we can test it properly
	*/
	public function __construct($test = false){
		$this->controller = new Controller(null, new CakeResponse);
	}
	
	/**
	* Helper method for use in the application to catch 404 errors if needed
	* $this->cakeError('catch404');
	*/
	public function catch404(){
		$this->__uriToStatusCode();
		$this->__uriToRedirect();
	}
	
	/**
	* Update to levenshtien
	*/
	public function runLevenshtein(){
		$this->__uriToLevenshtein();
	}
	
	/**
	* Returns if the incomming request matches the seo_uri defined.
	* @param incomming request
	* @param uri
	* @return boolean
	*/
	public function requestMatch($request, $uri){
		$this->__loadModel('SeoStatusCode');
		//Many To Many -- Using regular expression
		if($this->SeoStatusCode->isRegEx($uri)){
			if(preg_match($uri, $request)){
				return true;
			}
		}
		//Many to One -- Check for * wildcard in uri, if present only match up to the * in the request.
		elseif(strpos($uri, '*') !== false){
			$uri = str_replace('*','',$uri);
			if(strpos($request, $uri) === 0){
				return true;
			}
		}
		//One to One
		elseif(strtolower($uri) == strtolower($request)){
			return true;
		}
		
		return false;
	}
	
	/**
	* Go through the uri to StatusCode database and see if we've hit a match that we've setup
	* @param if testing, return the status code instead of setting it.
	* @return mixed void normally, status code in testing mode
	*/
	public function __uriToStatusCode($test = false){
		$this->__loadModel('SeoStatusCode');
		$request = env('REQUEST_URI');
		$seo_status_codes = $this->SeoStatusCode->findStatusCodeListByPriority();
		if (empty($seo_status_codes) || !is_array($seo_status_codes)) {
			return;
		}
		foreach($seo_status_codes as $status_code){
			$code = $status_code['SeoStatusCode']['status_code'];
			$uri = $status_code['SeoUri']['uri'];
			$update_header = $this->requestMatch($request, $uri);

			//Update the status code and exit
			if($update_header){
				if($test){
					return $code;
				}
				Configure::write('debug', 0);
				header("Status: $code " . $this->SeoStatusCode->codes[$code], true, $code);
				die();
			}
		}
	}
	
	/**
	* Go through the uri to redirect database and see if we've hit a 
	* 301 that we've setup.
	* @return void
	*/
	public function __uriToRedirect(){
		$this->__loadModel('SeoRedirect');
		$request = env('REQUEST_URI');
		$seo_redirects = $this->SeoRedirect->findRedirectListByPriority();
		if (empty($seo_redirects) || !is_array($seo_redirects)) {
			return;
		}
		$run_redirect = false;
		foreach($seo_redirects as $seo_redirect){
			$uri = $seo_redirect['SeoUri']['uri'];
			$redirect = $seo_redirect['SeoRedirect']['redirect'];
			$callback = $seo_redirect['SeoRedirect']['callback'];
			
			if($this->requestMatch($request, $uri)){
				$run_redirect = true;
				if($this->SeoRedirect->isRegEx($uri)){
					$redirect = preg_replace($uri, $redirect, $request);
				}
			}
			
			//Run callback if we have one
			if($run_redirect && isset($callback) && $callback){
				if(strpos($callback, '::') !== false){
					list($model, $method) = explode('::',$callback);
				}
				else {
					$method = $callback;
					$model = 'SeoRedirect';
				}
				$callback_retval = ClassRegistry::init($model)->$method($request);
				if($callback_retval !== false){
					$redirect = str_replace('{callback}',$callback_retval,$redirect);
				}
				else { //if we have false as the retval, do NOT run the redirect
					$run_redirect = false;
				}
			}
			
			//Run the redirect if we have one, and its not the same as it was coming in.
			if($run_redirect){
				if($redirect != $request){
					if(SeoUtil::getConfig('log')){
						CakeLog::write('seo_redirects', "SeoRedirect ID {$seo_redirect['SeoRedirect']['id']} : $request matched $uri redirecting to $redirect");
					}
					$this->controller->redirect($redirect, 301);
				}
				else {
					if(SeoUtil::getConfig('log')){
						CakeLog::write('seo_redirects', "Redirect loop detected! request:\n $request\n	uri: $uri\n	redirect: $redirect\n	callback: $callback\n");
					}
				}
				return;
			}
		}
	}
	
	/**
	* Go through the uri to levenshtein url database and find the closest redirect based in sitemap 
	* @return void
	*/
	public function __uriToLevenshtein(){
		$levconfig = SeoUtil::getConfig('levenshtein');
		if(!$levconfig['active']){
			return;
		}
		
		$this->__loadModel('SeoUrl');
		$request = env('REQUEST_URI');
		$redirect = $this->SeoUrl->findRedirectByRequest($request);
		if($redirect['redirect'] != $request){
			if(SeoUtil::getConfig('log')){
				CakeLog::write('seo_levenshtein', "Levenshtein Redirect $request to {$redirect['redirect']} score {$redirect['shortest']}");
			}
			$this->controller->redirect($redirect['redirect'], 301);
		}
		return;
	}
	
	/**
	* Load the SeoRedirect Model if it's not already loaded.
	* @return void
	*/
	public function __loadModel(Model $model){
		if(!$this->$model){
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
}

/**
* SeoExceptionHandler
* @version 6.0
* @author Nick Baker
*/
class SeoExceptionHandler extends HttpException {
	public static function handle($error, $message = null){
		$SeoAppError = new SeoAppError();
		$SeoAppError->catch404();
		if($error->code == 404){
			$SeoAppError->runLevenshtein();
		}
		
		$text = $message ? $message : $error->message;
		CakeLog::write('error' . $error->code, $text . '\n\r' . $error->getTraceAsString());
		ErrorHandler::handleException($error);
	}
}

