<?php
/* SeoUrl Test cases generated on: 2011-10-10 16:42:55 : 1318286575*/
App::import('Model', 'seo.SeoUrl');

class SeoUrlTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_url'
	);
	function startTest() {
		$this->SeoUrl =& ClassRegistry::init('SeoUrl');
	}
	
	function test_findRedirectByRequest(){
		$result = $this->SeoUrl->findRedirectByRequest("/some_url");
		$this->assertEqual($result, array('redirect' => '/some', 'shortest' => 4));
		$result = $this->SeoUrl->findRedirectByRequest("/some_other_blah");
		$this->assertEqual($result, array('redirect' => '/some_other_url', 'shortest' => 4));
		$result = $this->SeoUrl->findRedirectByRequest("/some_other");
		$this->assertEqual($result, array('redirect' => '/some_other', 'shortest' => 0));
	}
	
	function test_import(){
		$result = $this->SeoUrl->import("/custom-sitemap.xml");
		$this->assertEqual('269', $result);
	}

	function endTest() {
		unset($this->SeoUrl);
		ClassRegistry::flush();
	}

}
