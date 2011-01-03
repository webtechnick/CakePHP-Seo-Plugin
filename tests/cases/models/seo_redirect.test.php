<?php
/* SeoRedirect Test cases generated on: 2010-10-05 18:10:19 : 1286323699*/
App::import('Model', 'Seo.SeoRedirect');
App::import('Component', 'Email');
Mock::generate('EmailComponent');

class SeoRedirectTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
	);

	function startTest() {
		$this->SeoRedirect = ClassRegistry::init('Seo.SeoRedirect');
	}
	
	function testIsRegEx(){
	  $this->assertTrue($this->SeoRedirect->isRegEx('#(.*)\?from\=sb\-tracked\:(.*)#i'));
	  $this->assertTrue($this->SeoRedirect->isRegEx('#(.*)#'));
	  $this->assertFalse($this->SeoRedirect->isRegEx('/blah'));
	  $this->assertFalse($this->SeoRedirect->isRegEx('/blah#anchor'));
	}
	
	function testBeforeSaveShouldSetApproved(){
	  $this->SeoRedirect->data = array(
	    'SeoRedirect' => array(
	      'redirect' => '/',
	      'priority' => '5',
	      'is_active' => 1,
	    ),
	    'SeoUri' => array(
	    	'uri' => '/newuri'
	    )
	  );
	  $this->assertTrue($this->SeoRedirect->saveAll());
	  $result = $this->SeoRedirect->find('last');
	  $this->assertTrue($result['SeoUri']['is_approved']);
	}
	
	function testBeforeSaveShouldNotSetApprovedOnRegEx(){
	  $this->SeoRedirect->data = array(
	    'SeoRedirect' => array(
	      'redirect' => '/',
	      'priority' => '5',
	      'is_active' => 1,
	    ),
	    'SeoUri' => array(
	    	'uri' => '#(somenewregex)#i',
	    )
	  );
	  $this->assertTrue($this->SeoRedirect->saveAll());
	  $result = $this->SeoRedirect->find('last');
	  $this->assertFalse($result['SeoUri']['is_approved']);
	}
	
	function testFindRedirectListByPriority(){
	  $results = $this->SeoRedirect->findRedirectListByPriority();
	  $this->assertEqual(6, count($results));
	}

	function endTest() {
		unset($this->SeoRedirect);
		ClassRegistry::flush();
	}

}
?>