<?php
/* SeoUrl Test cases generated on: 2011-10-10 16:42:55 : 1318286575*/
App::import('Model', 'seo.SeoUrl');

class SeoUrlTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_url'
	);
	function startTest() {
		$this->SeoUrl = ClassRegistry::init('SeoUrl');
	}
	
	function test_findRedirectByRequest(){
		$this->SeoUrl->settings['cost_add'] = 1;
		$this->SeoUrl->settings['cost_change'] = 1;
		$this->SeoUrl->settings['cost_delete'] = 1;
		$result = $this->SeoUrl->findRedirectByRequest("/some_url");
		$this->assertEqual($result, array('redirect' => '/some', 'shortest' => 4));
		$result = $this->SeoUrl->findRedirectByRequest("/some_other_blah");
		$this->assertEqual($result, array('redirect' => '/some_other_url', 'shortest' => 4));
		$result = $this->SeoUrl->findRedirectByRequest("/some_other");
		$this->assertEqual($result, array('redirect' => '/some_other', 'shortest' => 0));
	}
	
	function test_levenshtien(){
		$request = "/content/Hearing-loss/Treatment";
		$add = 1;
		$change = 2;
		$delete = 3;
		$lev = levenshtein($request,"/content/Hearing-loss/Treatments", $add, $change, $delete);
		$this->assertEqual(1, $lev);
		
		$lev = levenshtein($request,"/content/articles/Hearing-loss/Protection/30207-Attention-couch-potatoes-time", $add, $change, $delete);
		$this->assertEqual(52, $lev);
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
