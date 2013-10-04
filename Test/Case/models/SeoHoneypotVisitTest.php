<?php
/* SeoHoneypotVisit Test cases generated on: 2011-02-02 19:03:49 : 1296698629*/
App::import('Model', 'seo.SeoHoneypotVisit');

class SeoHoneypotVisitTest extends CakeTestCase {
	var $fixtures = array('plugin.seo.seo_honeypot_visit');
	function startTest() {
		$this->SeoHoneypotVisit = ClassRegistry::init('SeoHoneypotVisit');
	}
	
	function testAdd(){
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
	}
	
	function testClear(){
		$this->assertEqual(1, $this->SeoHoneypotVisit->find('count'));
		$this->assertTrue($this->SeoHoneypotVisit->clear());
		$this->assertEqual(0, $this->SeoHoneypotVisit->find('count'));
	}
	
	function testClearAfterAdding(){
		$this->assertEqual(1, $this->SeoHoneypotVisit->find('count'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->clear());
		$this->assertEqual(2, $this->SeoHoneypotVisit->find('count'));
	}
	
	function testIsTriggered(){
		$this->assertFalse($this->SeoHoneypotVisit->isTriggered('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->isTriggered('127.255.253.120'));
	}

	function endTest() {
		unset($this->SeoHoneypotVisit);
		ClassRegistry::flush();
	}

}
?>