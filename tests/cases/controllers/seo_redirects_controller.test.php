<?php
/* SeoRedirects Test cases generated on: 2011-01-01 14:01:44 : 1293917084*/
App::import('Controller', 'seo.SeoRedirects');

class TestSeoRedirectsController extends SeoRedirectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeoRedirectsControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->SeoRedirects =& new TestSeoRedirectsController();
		$this->SeoRedirects->constructClasses();
	}

	function endTest() {
		unset($this->SeoRedirects);
		ClassRegistry::flush();
	}

}
?>