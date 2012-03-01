<?php
/* SeoBlacklist Test cases generated on: 2011-02-02 11:19:50 : 1296670790*/
App::import('Model', 'Seo.SeoBlacklist');

class SeoBlacklistTest extends CakeTestCase {
	public $fixtures = array('plugin.seo.seo_blacklist');

	public function startTest() {
		$this->SeoBlacklist = ClassRegistry::init('SeoBlacklist');
	}
	
	public function testIpValidCheck(){
		$this->assertTrue($this->SeoBlacklist->isIp(array('192.168.1.100')));
		$this->assertFalse($this->SeoBlacklist->isIp(array('100')));
	}
	
	public function testSaveShouldLongTheIP(){
		$this->SeoBlacklist->data = array(
			'SeoBlacklist' => array(
				'ip_range_start' => '127.255.253.220',
				'ip_range_end' => '127.255.253.222',
			)
		);
		
		$count = $this->SeoBlacklist->find('count');
		$this->assertTrue($this->SeoBlacklist->save());
		$result = $this->SeoBlacklist->find('last');
		$this->assertEquals($count + 1, $this->SeoBlacklist->find('count'));
		$this->assertEquals('127.255.253.220', $result['SeoBlacklist']['ip_range_start']);
		$this->assertEquals('127.255.253.222', $result['SeoBlacklist']['ip_range_end']);
	}
	
	public function testIsBannedByIp(){
		$this->assertTrue($this->SeoBlacklist->isBanned('127.255.253.120'));
		$this->assertTrue($this->SeoBlacklist->isBanned('127.255.253.121'));
		$this->assertTrue($this->SeoBlacklist->isBanned('127.255.253.122'));
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.123'));
	}
	
	public function testIsBannedByInt(){
		$this->assertTrue($this->SeoBlacklist->isBanned(2147483000));
		$this->assertTrue($this->SeoBlacklist->isBanned(2147483001));
		$this->assertTrue($this->SeoBlacklist->isBanned(2147483002));
		$this->assertFalse($this->SeoBlacklist->isBanned(2147483003));
		$this->assertFalse($this->SeoBlacklist->isBanned(2147483100));
	}
	
	public function testAddSingleIp(){
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.125'));
		$this->assertTrue($this->SeoBlacklist->addToBanned('127.255.253.125', "note", true));
		$this->assertTrue($this->SeoBlacklist->isBanned('127.255.253.125'));
	}
	
	public function testAddSingleIpIfNotAggressive(){
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.125'));
		$this->assertTrue($this->SeoBlacklist->addToBanned('127.255.253.125', "note", false));
		$this->assertFalse($this->SeoBlacklist->isBanned('127.255.253.125'));
	}
	
	public function testGetIpFromServer(){
		$_SERVER['HTTP_CLIENT_IP'] = 'client';
		$_SERVER['HTTP_X_FORWARDED_FOR'] = 'forwarded';
		$_SERVER['REMOTE_ADDR'] = 'remote';
		
		$this->assertEquals('client', $this->SeoBlacklist->getIpFromServer());
		unset($_SERVER['HTTP_CLIENT_IP']);
		$this->assertEquals('forwarded', $this->SeoBlacklist->getIpFromServer());
		unset($_SERVER['HTTP_X_FORWARDED_FOR']);
		$this->assertEquals('remote', $this->SeoBlacklist->getIpFromServer());
	}

	public function endTest() {
		unset($this->SeoBlacklist);
		ClassRegistry::flush();
	}

}
