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
App::uses('SeoUri','Seo.Model');
class SeoAppError {
	
	var $SeoRedirect = null;
	var $SeoStatusCode = null;
	var $SeoUrl = null;
	var $SeoUri = null;
	
	/**
	* Overload constructor so we can test it properly
	*/
	function __construct($test = false){
		$this->controller = new Controller(null, new CakeResponse);
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
	* Update to levenshtien
	*/
	function runLevenshtein(){
		$this->__uriToLevenshtein();
	}
	
	/**
	* Returns if the incomming request matches the seo_uri defined.
	* @param incomming request
	* @param uri
	* @return boolean
	*/
	function requestMatch($request, $uri){
		return SeoUtil::requestMatch($request, $uri);
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
				if($code == 200){
					echo '<!doctype html> 
					<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
						<head>
							<title>&nbsp;</title>
							<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
							<meta name="robots" content="noindex" />
						</head>
						<body></body>
					</html>';
				}
				$this->executeStatusCode($code);
			}
		}
	}
	
	/**
	* Actually execute the status code.
	*/
	function executeStatusCode($code) {
		Configure::write('debug', 0);
		$this->__loadModel('SeoStatusCode');
		header("Status: $code " . $this->SeoStatusCode->codes[$code], true, $code);
		die($this->SeoStatusCode->codes[$code]);
		if ($code == 410) {
			throw new GoneExecption();
		}
		if ($code == 404) {
			throw new NotFoundException();
		}
		if ($code == 500) {
			throw new InternalErrorException();
		}
	}
	
	/**
	* Go through the uri to redirect database and see if we've hit a 
	* 301 that we've set up.
	* @return void
	*/
	function __uriToRedirect() {
		$this->__loadModel('SeoRedirect');
		$request = env('REQUEST_URI');
		$seo_redirects = $this->SeoRedirect->findRedirectListByPriority();
		if (empty($seo_redirects) || !is_array($seo_redirects)) {
			return;
		}

		foreach ($seo_redirects as $seo_redirect) {
			$uri = $seo_redirect['SeoUri']['uri'];
			$redirect = $seo_redirect['SeoRedirect']['redirect'];
			$callback = $seo_redirect['SeoRedirect']['callback'];
			
			if (!$this->requestMatch($request, $uri)) {
				continue;
			}

			if ($this->SeoRedirect->isRegEx($uri)) {
				$redirect = preg_replace($uri, $redirect, $request);
			}
			
			// Run callback if we have one
			if (!empty($callback)) {
				if (strpos($callback, '::') !== false) {
					list($model, $method) = explode('::',$callback);
				} else {
					$method = $callback;
					$model  = 'SeoRedirect';
				}
				$callback_retval = ClassRegistry::init($model)->$method($request);

				if ($callback_retval === false) {
					// if we have false as the retval, do NOT run the redirect
					return;
				}
				$redirect = str_replace('{callback}', $callback_retval, $redirect);
			}
			
			// Look for loops.
			if ($redirect == $request) {
				if (SeoUtil::getConfig('log')) {
					CakeLog::write('seo_redirects',
						"Redirect loop detected! request:\n $request\n	uri: $uri\n	redirect: $redirect\n	callback: $callback\n"
					);
				}
				return;
			}

			// No loop, run the redirect.
			if (SeoUtil::getConfig('log')) {
				CakeLog::write('seo_redirects',
					"SeoRedirect ID {$seo_redirect['SeoRedirect']['id']} : $request matched $uri redirecting to $redirect"
				);
			}

			if (!empty($seo_redirect['SeoRedirect']['is_nocache'])) {
				$this->controller->response->header(array(
					'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
					'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT',
				));
			}

			$this->controller->redirect($redirect, 301);
			return;
		}
	}
	
	/**
	* Go through the uri to levenshtein url database and find the closest redirect based in sitemap 
	* @return void
	*/
	function __uriToLevenshtein(){
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
	function __loadModel($model){
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
		if($error->code == 404){
			$SeoAppError->catch404();
			$SeoAppError->runLevenshtein();
		}
		
		$text = $message ? $message : $error->message;
		ErrorHandler::handleException($error);
	}
}
/**
* Seo410Gone Exception
*/
class GoneExecption extends HttpException {
	public function __construct($message = null, $code = 410) {
		if (empty($message)) {
			$message = 'Gone';
		}
		parent::__construct($message, $code);
	}
}
