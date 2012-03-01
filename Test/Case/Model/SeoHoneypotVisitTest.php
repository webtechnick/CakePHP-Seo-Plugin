<?php
/* SeoHoneypotVisit Test cases generated on: 2011-02-02 19:03:49 : 1296698629*/
App::import('Model', 'Seo.SeoHoneypotVisit');

class SeoHoneypotVisitTest extends CakeTestCase {
	public $fixtures = array('plugin.seo.seo_honeypot_visit');
	public function startTest() {
		$this->SeoHoneypotVisit = ClassRegistry::init('SeoHoneypotVisit');
	}
	
	public function testAdd(){
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
	}
	
	public function testClear(){
		$this->assertEquals(1, $this->SeoHoneypotVisit->find('count'));
		$this->assertTrue($this->SeoHoneypotVisit->clear());
		$this->assertEquals(0, $this->SeoHoneypotVisit->find('count'));
	}
	
	public function testClearAfterAdding(){
		$this->assertEquals(1, $this->SeoHoneypotVisit->find('count'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->clear());
		$this->assertEquals(2, $this->SeoHoneypotVisit->find('count'));
	}
	
	public function testIsTriggered(){
		$this->assertFalse($this->SeoHoneypotVisit->isTriggered('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->add('127.255.253.120'));
		$this->assertTrue($this->SeoHoneypotVisit->isTriggered('127.255.253.120'));
	}

	public function endTest() {
		unset($this->SeoHoneypotVisit);
		ClassRegistry::flush();
	}

}
