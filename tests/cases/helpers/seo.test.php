<?php
App::import('Helper', 'Seo.Seo');
App::import('Model', 'Seo.SeoMetaTag');
App::import('Helper', 'Html');

class SeoHelperTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
		'plugin.seo.seo_title',
	);
	
	function startTest() {
		$this->Seo = new SeoHelper();
		$this->Seo->Html = new HtmlHelper();
	}
	
	function testHoneyPot(){
		$result = $this->Seo->honeyPot();
		$this->assertTrue(!empty($result));
	}
	
	function testmetaTagsTags(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta name="keywords" content="content_1" /><meta name="description" content="content_2" />', $results);
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