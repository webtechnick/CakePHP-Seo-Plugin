<?php
/* SeoUris Test cases generated on: 2011-01-03 14:01:13 : 1294090633*/
App::import('Controller', 'Seo.SeoUris');

class TestSeoUrisController extends SeoUrisController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeoUrisControllerTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_uri',
    'plugin.seo.seo_redirect',
    'plugin.seo.seo_meta_tag',
  );
	
	function startTest() {
		$this->SeoUris =& new TestSeoUrisController();
	}

	function endTest() {
		unset($this->SeoUris);
		ClassRegistry::flush();
	}

}
?>