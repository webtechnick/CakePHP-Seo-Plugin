<?php
App::import('Core', 'Controller');
App::import('Component', 'Seo.BlackList');
App::import('Model', 'Seo.SeoHoneypotVisit');


class TestBlacklist extends CakeTestModel {
  var $name = 'Blacklist';
  var $data = null;
  var $useDbConfig = 'test_suite';
  var $useTable = false;
  
  function isBanned(){
  	return true;
  }
}

class TestHoneyPotVisit extends CakeTestModel {
  var $name = 'HoneypotVisit';
  var $data = null;
  var $useDbConfig = 'test_suite';
  var $useTable = false;
  
  function isTriggered(){
  	return true;
  }
}

class BlackListTest extends CakeTestCase {
	var $BlackList = null;
	
	function startTest(){
		Mock::generate('Controller');
		Mock::generate('SeoHoneypotVisit');
		$this->BlackList = new BlackListComponent();
		$this->BlackList->Controller = new MockController();
		$this->BlackList->SeoBlacklist = new TestBlacklist();
		$this->BlackList->SeoHoneypotVisit = new TestHoneyPotVisit();
	}
	
	function testIsBannedRedirect(){
		$this->BlackList->Controller->here = '/';
		$this->BlackList->Controller->expectOnce('redirect');
		$this->assertTrue($this->BlackList->__isBanned());
	}
	
	function testIsBannedOnBannedPage(){
		$this->BlackList->Controller->here = '/seo/seo_blacklists/banned';
		$this->BlackList->Controller->expectNever('redirect');
		$this->assertTrue($this->BlackList->__isBanned());
	}
	
	function testHandleHoneyPot(){
		$this->BlackList->Controller->here = '/seo/seo_blacklists/honeypot';
		$this->BlackList->Controller->expectOnce('redirect');
		$this->assertTrue($this->BlackList->__isBanned());
	}
	
	function endTest(){
		unset($this->BlackList);
	}
}
?>