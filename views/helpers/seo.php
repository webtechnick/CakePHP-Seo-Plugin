<?php
App::import('Lib','Seo.SeoUtil');
class SeoHelper extends AppHelper {
	var $helpers = array('Html');
	var $SeoMetaTag = null;
	
	/**
	* Show the meta tags designated for this uri
	* @return string of meta tags to show.
	*/
	function metaTags(){
		$this->loadSeoMetaTag();
		$request = env('REQUEST_URI');
		$meta_tags = $this->SeoMetaTag->findAllTagsByUri($request);
		$retval = "";
		foreach($meta_tags as $tag){
			$data = array('content' => $tag['SeoMetaTag']['content']);
			if($tag['SeoMetaTag']['is_http_equiv']){
				$data['http-equiv'] = $tag['SeoMetaTag']['name'];
			}
			else {
				$data['name'] = $tag['SeoMetaTag']['name'];
			}
			$retval .= $this->Html->meta($data);
		}
		return $retval;
	}
	
	function loadSeoMetaTag(){
		if($this->SeoMetaTag == null){
			App::import('Model','Seo.SeoMetaTag');
			$this->SeoMetaTag = ClassRegistry::init('Seo.SeoMetaTag');
		}
	}
	
}
?>