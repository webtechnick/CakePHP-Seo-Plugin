<?php
/* SeoRedirects Test cases generated on: 2011-01-03 14:01:32 : 1294090592*/
App::import('Controller', 'seo.SeoRedirects');

class TestSeoRedirectsController extends SeoRedirectsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeoRedirectsControllerTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_redirect', 
		'plugin.seo.seo_uri', 
		'plugin.seo.seo_meta_tag'
	);

	function startTest() {
		$this->SeoRedirects =& new TestSeoRedirectsController();
	}

	function endTest() {
		unset($this->SeoRedirects);
		ClassRegistry::flush();
	}

	function testAdminIndex() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

	function testAdminApprove() {

	}

	function testUpdate() {

	}

}
?>