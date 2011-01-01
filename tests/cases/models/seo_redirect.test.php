<?php
/* SeoRedirect Test cases generated on: 2010-10-05 18:10:19 : 1286323699*/
App::import('Model', 'SeoRedirect');
App::import('Component', 'Email');
Mock::generate('EmailComponent');

class SeoRedirectTestCase extends CakeTestCase {
	var $fixtures = array('plugin.seo.seo_redirect');

	function startTest() {
		$this->SeoRedirect = ClassRegistry::init('Seo.SeoRedirect');
		$this->SeoRedirect->Email = new MockEmailComponent();
	}
	
	function testSendNotification(){
	  $this->SeoRedirect->id = 6;
	  $this->SeoRedirect->Email->expectOnce('send');
	  $this->SeoRedirect->sendNotification();
	  $this->assertEqual('301 Redirect: #(.*)#i to / needs approval', $this->SeoRedirect->Email->subject);
	  $this->assertEqual('html', $this->SeoRedirect->Email->sendAs);
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
	      'uri' => '/newuri',
	      'redirect' => '/',
	      'priority' => '5',
	      'is_active' => 1,
	    )
	  );
	  $this->assertTrue($this->SeoRedirect->save());
	  $result = $this->SeoRedirect->find('last');
	  $this->assertTrue($result['SeoRedirect']['is_approved']);
	}
	
	function testBeforeSaveShouldNotSetApprovedOnRegEx(){
	  $this->SeoRedirect->data = array(
	    'SeoRedirect' => array(
	      'uri' => '#(somenewregex)#i',
	      'redirect' => '/',
	      'priority' => '5',
	      'is_active' => 1,
	    )
	  );
	  $this->SeoRedirect->Email->expectOnce('send');
	  $this->assertTrue($this->SeoRedirect->save());
	  $result = $this->SeoRedirect->find('last');
	  $this->assertFalse($result['SeoRedirect']['is_approved']);
	}
	
	function testSetApproved(){
	  $this->SeoRedirect->id = 6;
	  $this->assertFalse($this->SeoRedirect->field('is_approved'));
	  $this->SeoRedirect->setApproved();
	  $this->assertTrue($this->SeoRedirect->field('is_approved'));
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