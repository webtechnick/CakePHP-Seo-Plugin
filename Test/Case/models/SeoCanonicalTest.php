<?php
/* SeoCanonical Test cases generated on: 2011-07-27 11:26:15 : 1311787575*/
App::import('Model', 'seo.SeoCanonical');
App::import('Component', 'Email');
Mock::generate('EmailComponent');
class SeoCanonicalTest extends CakeTestCase {
	/*var $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);*/
	function startTest() {
		$this->SeoCanonical = ClassRegistry::init('SeoCanonical');
		$this->SeoRedirect->SeoUri->Email = new MockEmailComponent();
	}

	function endTest() {
		unset($this->SeoCanonical);
		ClassRegistry::flush();
	}

}
