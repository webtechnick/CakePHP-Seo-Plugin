<?php
/* SeoSearchTerm Test cases generated on: 2011-11-18 23:27:59 : 1321684079*/
App::import('Model', 'Seo.SeoSearchTerm');

class SeoSearchTermTest extends CakeTestCase {
	public $fixtures = array('plugin.seo.seo_search_term');

	public function startTest() {
		$this->SeoSearchTerm = ClassRegistry::init('SeoSearchTerm');
	}
	
	public function testParseRequest(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/#q=Some+search&hl=en&safe=off&prmd=imvns&ei=mUrHTuWSJo73sQLl5ZQ8&start=10&sa=N&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=5e5b3f07d49aeae4&biw=1397&bih=907';
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->find('last');
		$this->assertEquals('Some search', $result['SeoSearchTerm']['term']);
		$this->assertEquals('/some_url', $result['SeoSearchTerm']['uri']);
		$this->assertEquals(1, $result['SeoSearchTerm']['count']);
	}
	
	public function testParseRequestCount(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/#q=Lorem+ipsum&hl=en&safe=off&prmd=imvns&ei=mUrHTuWSJo73sQLl5ZQ8&start=10&sa=N&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=5e5b3f07d49aeae4&biw=1397&bih=907';
		$count = $this->SeoSearchTerm->find('count');
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->findById(1);
		$this->assertEquals($count, $this->SeoSearchTerm->find('count'));
		$this->assertEquals('Lorem ipsum', $result['SeoSearchTerm']['term']);
		$this->assertEquals('/some_url', $result['SeoSearchTerm']['uri']);
		$this->assertEquals(2, $result['SeoSearchTerm']['count']);
	}
	
	public function testParseRequestIgnore(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/';
		$count = $this->SeoSearchTerm->find('count');
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->findById(1);
		$this->assertEquals($count, $this->SeoSearchTerm->find('count'));
		$this->assertEquals(1, $result['SeoSearchTerm']['count']);
	}
	
	public function testParseRequestDelete(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/#q=Lorem+ipsum&hl=en&safe=off&prmd=imvns&ei=mUrHTuWSJo73sQLl5ZQ8&sa=N&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=5e5b3f07d49aeae4&biw=1397&bih=907';
		$count = $this->SeoSearchTerm->find('count');
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->findById(1);
		$this->assertTrue(empty($result));
		$this->assertEquals($count - 1, $this->SeoSearchTerm->find('count'));
	}

	public function endTest() {
		unset($this->SeoSearchTerm);
		ClassRegistry::flush();
	}

}