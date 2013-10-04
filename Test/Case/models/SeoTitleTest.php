<?php
/* SeoTitle Test cases generated on: 2011-01-05 18:01:14 : 1294276514*/
App::import('Model', 'Seo.SeoTitle');

class SeoTitleTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_title',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);

	function startTest() {
		$this->SeoTitle = ClassRegistry::init('SeoTitle');
	}

	function endTest() {
		unset($this->SeoTitle);
		ClassRegistry::flush();
	}

}
?>