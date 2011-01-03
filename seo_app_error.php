<?php
/**
* This class will take in uri to redirects and 
*/
App::import('Lib','Seo.SeoUtil');
class SeoAppError extends ErrorHandler {
	
	var $SeoRedirect = null;
	
	/**
	* Overload constructor so we can test it properly
	*/
	function __construct($method, $messages, $test = false){
		if(!$test){
			parent::__construct($method, $messages);
		}
	}
	
	function error404($params){
		$this->__uriToRedirect();
		parent::error404($params);
	}
	
	function missingController($params){
		$this->__uriToRedirect();
		parent::missingController($params);
	}
	
	function missingAction($params){
		$this->__uriToRedirect();
		parent::missingAction($params);
	}
	
	function missingView($params){
		$this->__uriToRedirect();
		parent::missingView($params);
	}
	
	/**
	* Helper method for use in the application to catch 404 errors if needed
	* $this->cakeError('catch404');
	*/
	function catch404(){
		$this->__uriToRedirect();
	}
	
	/**
	* Go through the uri to redirect database and see if we've hit a 
	* 301 that we've setup.
	* @return void
	*/
	function __uriToRedirect(){
		$this->__loadSeoRedirect();
		$request = env('REQUEST_URI');
		$seo_redirects = $this->SeoRedirect->findRedirectListByPriority();
		
		$run_redirect = false;
		foreach($seo_redirects as $seo_redirect){
			$uri = $seo_redirect['SeoUri']['uri'];
			$redirect = $seo_redirect['SeoRedirect']['redirect'];
			$callback = $seo_redirect['SeoRedirect']['callback'];
			
			//Many To Many -- Using regular expression
			if($this->SeoRedirect->isRegEx($uri)){
				if(preg_match($uri, $request)){
					$redirect = preg_replace($uri, $redirect, $request);
					$run_redirect = true;
				}
			}
			//Many to One -- Check for * wildcard in uri, if present only match up to the * in the request.
			elseif(strpos($uri, '*') !== false){
				$uri = str_replace('*','',$uri);
				if(strpos($request, $uri) !== false){
					$run_redirect = true;
				}
			}
			//One to One
			elseif(strtolower($uri) == strtolower($request)){
				$run_redirect = true;
			}
			//Run callback if we have one
			if(isset($callback) && $callback){
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
			if($run_redirect && ($redirect != $request)){
				$this->controller->redirect($redirect, 301);
				return;
			}
		}
	}
	
	/**
	* Load the SeoRedirect Model if it's not already loaded.
	* @return void
	*/
	function __loadSeoRedirect(){
		if(!$this->SeoRedirect){
			$this->SeoRedirect = ClassRegistry::init('Seo.SeoRedirect');
		}
	}
}
?>