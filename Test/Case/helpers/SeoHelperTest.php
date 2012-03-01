<?php
App::import('Helper', 'Seo.Seo');
App::import('Model', 'Seo.SeoMetaTag');
App::import('Model', 'Seo.SeoCanonical');
App::import('Helper', 'Html');

class SeoHelperTest extends CakeTestCase {
	public $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_canonical',
	);
	
	public function startTest() {
		$this->Seo = new SeoHelper(new View(null));
		$this->Seo->Html = new HtmlHelper(new View(null));
		$cacheEngine = SeoUtil::getConfig('cacheEngine');
		if (!empty($cacheEngine)) {
			Cache::clear($cacheEngine);
		}
	}
	
	public function testCanonical(){
		$result = $this->Seo->canonical('/example-url');
		$this->assertEquals('<link rel="canonical" href="/example-url">', $result);
		
		$result = $this->Seo->canonical();
		$this->assertEquals('', $result);
		
		$_SERVER['REQUEST_URI'] = '/canonical';
		$result = $this->Seo->canonical();
		$this->assertEquals('<link rel="canonical" href="/new_canonical_link">', $result);
	}
	
	public function testHoneyPot(){
		$result = $this->Seo->honeyPot();
		$this->assertTrue(!empty($result));
	}
	
	public function testmetaTagsTags(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta';
		$results = $this->Seo->metaTags();
		$this->assertEquals('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" />', $results);
		
		$results = $this->Seo->metaTags(array('keywords' => 'ignore me'));
		$this->assertEquals('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" />', $results);
		
		$results = $this->Seo->metaTags(array('no_ignore' => 'showme'));
		$this->assertEquals('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" /><meta name="no_ignore" content="showme" />', $results);
	}
	
	public function testmetaTagsTagsWithHttpEquiv(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_equiv';
		$results = $this->Seo->metaTags();
		$this->assertEquals('<meta http-equiv="content-type" content="text/html" />', $results);
	}
	
	public function testmetaTagsTagsWithOutAny(){
		$_SERVER['REQUEST_URI'] = '/uri_has_not_meta';
		$results = $this->Seo->metaTags();
		$this->assertEquals('', $results);
	}
	
	public function testmetaTagsTagsWithRegEx(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_reg_ex/this_should_match';
		$results = $this->Seo->metaTags();
		$this->assertEquals('<meta name="default" content="content_default" /><meta name="description_default" content="content_default_2" />', $results);
	}
	
	public function testmetaTagsTagsDirectMatchShouldOverwrite(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_reg_ex/this_is_direct_match';
		$results = $this->Seo->metaTags();
		$this->assertEquals('<meta name="direct_match" content="direct_match_content" />', $results);
	}
	
	public function testmetaTagsTagsWithWildCard(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_wild_card/wild_card';
		$results = $this->Seo->metaTags();
		$this->assertEquals('<meta name="wild_card_match" content="wild_card_match_content" />', $results);
	}
	
	public function testTitleForUri(){
		$_SERVER['REQUEST_URI'] = '/blah';
		$results = $this->Seo->title();
		$this->assertEquals('<title>Title</title>', $results);
	}
	
	public function testTitleForUriWithDefault(){
		$_SERVER['REQUEST_URI'] = '/blahNotDefined';
		$results = $this->Seo->title('default');
		$this->assertEquals('<title>default</title>', $results);
	}

	public function endTest() {
		unset($this->SeometaTagsTag);
		ClassRegistry::flush();
	}

}

