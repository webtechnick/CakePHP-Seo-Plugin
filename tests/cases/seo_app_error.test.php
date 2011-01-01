<?php 
App::import('Core',array('ErrorHandler','Controller'));
include_once(APP.'plugins'.DS.'seo'.DS.'seo_app_error.php');

class AppErrorTestCase extends CakeTestCase {
  
  var $fixtures = array(
    'plugin.seo.seo_redirect',
  );
  
  function startTest() {
		$this->AppError = new SeoAppError('ignore', 'ignore', /* test */ true);
		Mock::generate('Controller');
		$this->AppError->controller = new MockController();
	}
	
	function testUriToRedirectWithCallbackFull(){
	  $_SERVER['REQUEST_URI'] = '/uri';
	  $this->AppError->controller->expectOnce('redirect', array('/ran_callback', 301));
	  $this->AppError->__uriToRedirect();
	}
	
	function testUriToRedirectWithRegEx(){
	  $_SERVER['REQUEST_URI'] = '/hearing-aids/558-virginia-beach-virginia-va-23454-virginia-audiology?from=sb-tracked:23457';
	  $this->AppError->controller->expectOnce('redirect', array('/hearing-aids/558-virginia-beach-virginia-va-23454-virginia-audiology', 301));
	  $this->AppError->__uriToRedirect();
	}
	
	function testUriToRedirectWithRegExTwo(){
	  $_SERVER['REQUEST_URI'] = '/some_url_to?from=sb-tracked:2345';
	  $this->AppError->controller->expectOnce('redirect', array('/some_url_to', 301));
	  $this->AppError->__uriToRedirect();
	}
	
	function testUriToRedirectWithRegExThree(){
	  $_SERVER['REQUEST_URI'] = '/qas/32074-i-told-hearing-aids';
	  $this->AppError->controller->expectOnce('redirect', array('/questions/32074-i-told-hearing-aids', 301));
	  $this->AppError->__uriToRedirect();
	}
	
	function testUriToRedirect(){
	  $_SERVER['REQUEST_URI'] = '/blah';
	  $this->AppError->controller->expectOnce('redirect', array('/', 301));
	  $this->AppError->__uriToRedirect();
	}
	
	function testUriToRedirectWildCard(){
	  $_SERVER['REQUEST_URI'] = '/blahblahtest'; // /blahblah* will catch this one
	  $this->AppError->controller->expectOnce('redirect', array('/new', 301));
	  $this->AppError->__uriToRedirect();
	}
	
	function testUriToRedirectNotActive(){
	  $_SERVER['REQUEST_URI'] = '/not_active';
	  $this->AppError->controller->expectNever('redirect');
	  $this->AppError->__uriToRedirect();
	}
	
	function testPriority(){
	  $_SERVER['REQUEST_URI'] = '/blahblahblah';
	  $this->AppError->controller->expectOnce('redirect', array('/priority', 301));
	  $this->AppError->__uriToRedirect();
	}
	
}
?>
