<?php
/* SeoMetaTag Test cases generated on: 2011-01-03 10:01:23 : 1294074563*/
App::import('Model', 'Seo.SeoMetaTag');
App::import('Component', 'Email');
Mock::generate('EmailComponent');
		
class SeoMetaTagTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);
	
	function startTest() {
		$this->SeoMetaTag = ClassRegistry::init('SeoMetaTag');
		$this->SeoMetaTag->SeoUri->Email = new MockEmailComponent();
	}
	
	function testFindAllTagsByUri(){
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta');
		$this->assertEqual(2, count($results));
	}
	
	function testFindAllTagsByUriRegEx(){
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta_reg_ex/regex');
		$this->assertEqual(2, count($results));
	}
	
	function testFindAllTagsByUriWildCard(){
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta_wild_card/wild');
		$this->assertEqual(1, count($results));
	}
	
	function testBeforeSaveShouldLinkToExistinUri(){
		$this->SeoMetaTag->data = array(
			'SeoMetaTag' => array(
				'name' => 'New',
				'content' => 'Content'
			),
			'SeoUri' => array(
				'uri' => '/uri_for_meta',
			)
		);
		
		$count = $this->SeoMetaTag->SeoUri->find('count');
		$this->assertTrue($this->SeoMetaTag->save());
		$this->assertEqual($count, $this->SeoMetaTag->SeoUri->find('count'));
		$results = $this->SeoMetaTag->find('last');
		$this->assertEqual('New', $results['SeoMetaTag']['name']);
		$this->assertEqual('Content', $results['SeoMetaTag']['content']);
		$this->assertEqual(9, $results['SeoMetaTag']['seo_uri_id']);
	}
	
	function testBeforeSaveShouldLinkToCreatUri(){
		$this->SeoMetaTag->data = array(
			'SeoMetaTag' => array(
				'name' => 'New',
				'content' => 'Content'
			),
			'SeoUri' => array(
				'uri' => '/uri_for_meta_new',
			)
		);
		
		$count = $this->SeoMetaTag->SeoUri->find('count');
		$this->assertTrue($this->SeoMetaTag->save());
		$this->assertEqual($count + 1, $this->SeoMetaTag->SeoUri->find('count'));
		$results = $this->SeoMetaTag->find('last');
		$this->assertEqual('New', $results['SeoMetaTag']['name']);
		$this->assertEqual('Content', $results['SeoMetaTag']['content']);
	}

	function endTest() {
		unset($this->SeoMetaTag);
		ClassRegistry::flush();
	}

}
?>