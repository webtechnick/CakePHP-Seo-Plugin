<?php
/* SeoMetaTags Test cases generated on: 2011-01-03 14:01:32 : 1294090652*/
App::import('Controller', 'Seo.SeoMetaTags');

class TestSeoMetaTagsController extends SeoMetaTagsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeoMetaTagsControllerTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_meta_tag',
    'plugin.seo.seo_redirect',
    'plugin.seo.seo_uri',
  );
	
	function startTest() {
		$this->SeoMetaTags =& new TestSeoMetaTagsController();
	}

	function endTest() {
		unset($this->SeoMetaTags);
		ClassRegistry::flush();
	}

}
?>