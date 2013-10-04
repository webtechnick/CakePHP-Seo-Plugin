<?php
/* SeoUrls Test cases generated on: 2011-11-05 00:46:47 : 1320475607*/
App::import('Controller', 'seo.SeoUrls');

class TestSeoUrlsController extends SeoUrlsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeoUrlsControllerTest extends CakeTestCase {
	function startTest() {
		$this->SeoUrls = new TestSeoUrlsController();
		$this->SeoUrls->constructClasses();
	}

	function endTest() {
		unset($this->SeoUrls);
		ClassRegistry::flush();
	}

}
