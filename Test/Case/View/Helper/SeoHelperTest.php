<?php
App::import('Helper', 'Seo.Seo');
App::import('Model', 'Seo.SeoMetaTag');
App::import('Model', 'Seo.SeoCanonical');
App::import('Helper', 'Html');

class SeoHelperTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
		'plugin.seo.seo_canonical',
		'plugin.seo.seo_a_b_test',
	);

	function startTest() {
		$View = new View();
		$this->Seo = new SeoHelper($View);
		$this->Seo->Html = new HtmlHelper($View);
		$cacheEngine = SeoUtil::getConfig('cacheEngine');
		if (!empty($cacheEngine)) {
			Cache::clear($cacheEngine);
		}
	}

	function testGetABTestJS(){
		$result = $this->Seo->getABTestJS();

	}

	function test_dnsPrefetch() {
		//With Default DNS
		$result = $this->Seo->dnsPrefetch();
		$this->assertEqual(null, $result);

		$result = $this->Seo->dnsPrefetch(array(
			'//www.facebook.com',
			'//use.typekit.net'
		));
		$this->assertEual($result, '<link rel="dns-prefetch" href="//www.facebook.com"><link rel="dns-prefetch" href="//use.typekit.net">');
	}

	function testCanonical(){
		$result = $this->Seo->canonical('/example-url');
		$this->assertEqual('<link rel="canonical" href="http://localhost/example-url">', $result);

		$result = $this->Seo->canonical();
		$this->assertEqual('', $result);

		$_SERVER['REQUEST_URI'] = '/canonical';
		$result = $this->Seo->canonical();
		$this->assertEqual('<link rel="canonical" href="http://localhost/new_canonical_link">', $result);
	}

	function testHoneyPot(){
		$result = $this->Seo->honeyPot();
		$this->assertTrue(!empty($result));
	}

	function testmetaTagsTags(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" />', $results);

		$results = $this->Seo->metaTags(array('keywords' => 'ignore me'));
		$this->assertEqual('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" />', $results);

		$results = $this->Seo->metaTags(array('no_ignore' => 'showme'));
		$this->assertEqual('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" /><meta name="no_ignore" content="showme" />', $results);
	}

	function testmetaTagsTagsWithHttpEquiv(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_equiv';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta http-equiv="content-type" content="text/html" />', $results);
	}

	function testmetaTagsTagsWithOutAny(){
		$_SERVER['REQUEST_URI'] = '/uri_has_not_meta';
		$results = $this->Seo->metaTags();
		$this->assertEqual('', $results);
	}

	function testmetaTagsTagsWithRegEx(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_reg_ex/this_should_match';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta name="default" content="content_default" /><meta name="description_default" content="content_default_2" />', $results);
	}

	function testmetaTagsTagsDirectMatchShouldOverwrite(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_reg_ex/this_is_direct_match';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta name="direct_match" content="direct_match_content" />', $results);
	}

	function testmetaTagsTagsWithWildCard(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_wild_card/wild_card';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta name="wild_card_match" content="wild_card_match_content" />', $results);
	}

	function testTitleForUri(){
		$_SERVER['REQUEST_URI'] = '/blah';
		$results = $this->Seo->title();
		$this->assertEqual('<title>Title</title>', $results);
	}

	function testTitleForUriWithDefault(){
		$_SERVER['REQUEST_URI'] = '/blahNotDefined';
		$results = $this->Seo->title('default');
		$this->assertEqual('<title>default</title>', $results);
	}

	function endTest() {
		unset($this->SeometaTagsTag);
		ClassRegistry::flush();
	}

}
?>