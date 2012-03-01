<?php
/* SeoMetaTag Test cases generated on: 2011-01-03 10:01:23 : 1294074563*/
App::import('Model', 'Seo.SeoMetaTag');
App::import('Component', 'Email');
Mock::generate('EmailComponent');
		
class SeoMetaTagTest extends CakeTestCase {
	public $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);
	
	public function startTest() {
		$this->SeoMetaTag = ClassRegistry::init('SeoMetaTag');
		$this->SeoMetaTag->SeoUri->Email = new MockEmailComponent();
	}
	
	public function testFindAllTagsByUri() {
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta');
		$this->assertEquals(2, count($results));
	}
	
	public function testFindAllTagsByUriRegEx() {
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta_reg_ex/regex');
		$this->assertEquals(2, count($results));
	}
	
	public function testFindAllTagsByUriWildCard() {
		$results = $this->SeoMetaTag->findAllTagsByUri('/uri_for_meta_wild_card/wild');
		$this->assertEquals(1, count($results));
	}
	
	public function testBeforeSaveShouldLinkToExistinUri() {
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
		$this->assertEquals($count, $this->SeoMetaTag->SeoUri->find('count'));
		$results = $this->SeoMetaTag->find('last');
		$this->assertEquals('New', $results['SeoMetaTag']['name']);
		$this->assertEquals('Content', $results['SeoMetaTag']['content']);
		$this->assertEquals(9, $results['SeoMetaTag']['seo_uri_id']);
	}
	
	public function testBeforeSaveShouldLinkToCreatUri() {
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
		$this->assertEquals($count + 1, $this->SeoMetaTag->SeoUri->find('count'));
		$results = $this->SeoMetaTag->find('last');
		$this->assertEquals('New', $results['SeoMetaTag']['name']);
		$this->assertEquals('Content', $results['SeoMetaTag']['content']);
	}

	public function endTest() {
		unset($this->SeoMetaTag);
		ClassRegistry::flush();
	}

}

