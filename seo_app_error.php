<?php
/**
* This class will take in uri to redirects and
* @since 4.4.0
* @license MIT
* @author Nick Baker (nick@webtechnick.com)
*/
App::import('Lib','Seo.SeoUtil');
class SeoAppError extends ErrorHandler {
	
	var $SeoRedirect = null;
	var $SeoStatusCode = null;
	
	/**
	* Overload constructor so we can test it properly
	*/
	function __construct($method, $messages, $test = false){
		if(!$test){
			parent::__construct($method, $messages);
		}
	}
	
	function error404($params){
		$this->catch404();
		parent::error404($params);
	}
	
	function missingController($params){
		$this->catch404();
		parent::missingController($params);
	}
	
	function missingAction($params){
		$this->catch404();
		parent::missingAction($params);
	}
	
	function missingView($params){
		$this->catch404();
		parent::missingView($params);
	}
	
	/**
	* Helper method for use in the application to catch 404 errors if needed
	* $this->cakeError('catch404');
	*/
	function catch404(){
		$this->__uriToStatusCode();
		$this->__uriToRedirect();
	}
	
	/**
	* Returns if the incomming request matches the seo_uri defined.
	* @param incomming request
	* @param uri
	* @return boolean
	*/
	function requestMatch($request, $uri){
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
			if(strpos($request, $uri) !== false){
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
	function __uriToStatusCode($test = false){
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
	function __uriToRedirect(){
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
						$this->log("SeoRedirect ID {$seo_redirect['SeoRedirect']['id']} : $request matched $uri redirecting to $redirect", 'seo_redirects');
					}
					$this->controller->redirect($redirect, 301);
				}
				else {
					if(SeoUtil::getConfig('log')){
						$this->log("Redirect loop detected! request:\n $request\n	uri: $uri\n	redirect: $redirect\n	callback: $callback\n",'seo_redirects'
						);
					}
				}
				return;
			}
		}
	}
	
	/**
	* Load the SeoRedirect Model if it's not already loaded.
	* @return void
	*/
	function __loadModel($model){
		if(!$this->$model){
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
}
?>