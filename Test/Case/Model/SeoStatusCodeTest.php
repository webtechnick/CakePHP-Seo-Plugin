<?php
/* SeoStatusCode Test cases generated on: 2011-07-25 17:06:33 : 1311635193*/
App::import('Model', 'seo.SeoStatusCode');
App::import('Component', 'Email');
Mock::generate('EmailComponent');

class SeoStatusCodeTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);

	function startTest() {
		$this->SeoStatusCode = ClassRegistry::init('SeoStatusCode');
		$this->SeoRedirect->SeoUri->Email = new MockEmailComponent();
	}
	
	

	function endTest() {
		unset($this->SeoStatusCode);
		ClassRegistry::flush();
	}

}
