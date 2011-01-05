<?php
App::import('Helper', 'Seo.Seo');
App::import('Model', 'Seo.SeoMetaTag');
App::import('Helper', 'Html');

class SeoHelperTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_uri',
	);
	
	function startTest() {
		$this->Seo = new SeoHelper();
		$this->Seo->Html = new HtmlHelper();
	}
	
	function testmetaTagsTags(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta content="content_1" name="keywords" /><meta content="content_2" name="description" />', $results);
	}
	
	function testmetaTagsTagsWithHttpEquiv(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_equiv';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta content="text/html" http-equiv="content-type" />', $results);
	}
	
	function testmetaTagsTagsWithOutAny(){
		$_SERVER['REQUEST_URI'] = '/uri_has_not_meta';
		$results = $this->Seo->metaTags();
		$this->assertEqual('', $results);
	}
	
	function testmetaTagsTagsWithRegEx(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_reg_ex/this_should_match';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta content="content_default" name="default" /><meta content="content_default_2" name="description_default" />', $results);
	}
	
	function testmetaTagsTagsDirectMatchShouldOverwrite(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_reg_ex/this_is_direct_match';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta content="direct_match_content" name="direct_match" />', $results);
	}
	
	function testmetaTagsTagsWithWildCard(){
		$_SERVER['REQUEST_URI'] = '/uri_for_meta_wild_card/wild_card';
		$results = $this->Seo->metaTags();
		$this->assertEqual('<meta content="wild_card_match_content" name="wild_card_match" />', $results);
	}

	function endTest() {
		unset($this->SeometaTagsTag);
		ClassRegistry::flush();
	}

}
?>