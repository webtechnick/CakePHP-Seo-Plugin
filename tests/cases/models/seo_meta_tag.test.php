<?php
/* SeoMetaTag Test cases generated on: 2011-01-03 10:01:23 : 1294074563*/
App::import('Model', 'Seo.SeoMetaTag');

class SeoMetaTagTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
	);
	
	function startTest() {
		$this->SeoMetaTag =& ClassRegistry::init('SeoMetaTag');
	}
	
	function testFindAllTagsByUri(){
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta');
		$this->assertEqual(2, count($results));
	}

	function endTest() {
		unset($this->SeoMetaTag);
		ClassRegistry::flush();
	}

}
?>