<?php
App::import('Lib','Seo.SeoUtil');
class SeoHelper extends AppHelper {
	var $helpers = array('Html');
	var $SeoMetaTag = null;
	
	function __construct($model = 'Seo.SeoMetaTag'){
		App::import('Model',$model);
		$this->SeoMetaTag = ClassRegistry::init($model);
	}
	
	/**
	* Show the meta tags designated for this uri
	* @return string of meta tags to show.
	*/
	function metaTags(){
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
	
}
?>