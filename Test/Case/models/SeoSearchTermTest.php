<?php
/* SeoSearchTerm Test cases generated on: 2011-11-18 23:27:59 : 1321684079*/
App::import('Model', 'seo.SeoSearchTerm');

class SeoSearchTermTest extends CakeTestCase {
	var $fixtures = array('plugin.seo.seo_search_term');

	function startTest() {
		$this->SeoSearchTerm = ClassRegistry::init('SeoSearchTerm');
	}
	
	function testParseRequest(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/#q=Some+search&hl=en&safe=off&prmd=imvns&ei=mUrHTuWSJo73sQLl5ZQ8&start=10&sa=N&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=5e5b3f07d49aeae4&biw=1397&bih=907';
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->find('last');
		$this->assertEqual('Some search', $result['SeoSearchTerm']['term']);
		$this->assertEqual('/some_url', $result['SeoSearchTerm']['uri']);
		$this->assertEqual(1, $result['SeoSearchTerm']['count']);
	}
	
	function testParseRequestCount(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/#q=Lorem+ipsum&hl=en&safe=off&prmd=imvns&ei=mUrHTuWSJo73sQLl5ZQ8&start=10&sa=N&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=5e5b3f07d49aeae4&biw=1397&bih=907';
		$count = $this->SeoSearchTerm->find('count');
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->findById(1);
		$this->assertEqual($count, $this->SeoSearchTerm->find('count'));
		$this->assertEqual('Lorem ipsum', $result['SeoSearchTerm']['term']);
		$this->assertEqual('/some_url', $result['SeoSearchTerm']['uri']);
		$this->assertEqual(2, $result['SeoSearchTerm']['count']);
	}
	
	function testParseRequestIgnore(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/';
		$count = $this->SeoSearchTerm->find('count');
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->findById(1);
		$this->assertEqual($count, $this->SeoSearchTerm->find('count'));
		$this->assertEqual(1, $result['SeoSearchTerm']['count']);
	}
	
	function testParseRequestDelete(){
		$_SERVER['HTTP_REFERER'] = 'https://www.google.com/#q=Lorem+ipsum&hl=en&safe=off&prmd=imvns&ei=mUrHTuWSJo73sQLl5ZQ8&sa=N&bav=on.2,or.r_gc.r_pw.r_cp.,cf.osb&fp=5e5b3f07d49aeae4&biw=1397&bih=907';
		$count = $this->SeoSearchTerm->find('count');
		$this->SeoSearchTerm->parseRequest("/some_url");
		$result = $this->SeoSearchTerm->findById(1);
		$this->assertTrue(empty($result));
		$this->assertEqual($count - 1, $this->SeoSearchTerm->find('count'));
	}

	function endTest() {
		unset($this->SeoSearchTerm);
		ClassRegistry::flush();
	}

}
