<?php
/**
*	Seo Helper, handles title tags and meta tags
* @author Nick Baker <nick@webtechnick.com>
* @since 3.2
* @license MIT
*/
App::import('Lib','Seo.SeoUtil');
class SeoHelper extends AppHelper {
	var $helpers = array('Html');
	var $SeoMetaTag = null;
	var $SeoTitle = null;
	
	/**
	* Show the meta tags designated for this uri
	* @return string of meta tags to show.
	*/
	function metaTags(){
		$this->loadModel('SeoMetaTag');
		$request = env('REQUEST_URI');
		$meta_tags = $this->SeoMetaTag->findAllTagsByUri($request);
		$retval = "";
		foreach($meta_tags as $tag){
			$data = array();
			if($tag['SeoMetaTag']['is_http_equiv']){
				$data['http-equiv'] = $tag['SeoMetaTag']['name'];
			}
			else {
				$data['name'] = $tag['SeoMetaTag']['name'];
			}
			$data['content'] = $tag['SeoMetaTag']['content'];
			$retval .= $this->Html->meta($data);
		}
		return $retval;
	}
	
	/**
		* Find the title tag related to this request and output the result.
		* @param string default title tag
		* @return string title for requested uri
		*/
	function title($default = ""){
		$this->loadModel('SeoTitle');
		$request = env('REQUEST_URI');
		$seo_title = $this->SeoTitle->findTitleByUri($request);
		$title = $seo_title ? $seo_title['SeoTitle']['title'] : $default;
		return $this->Html->tag('title', $title);
	}
	
	
	/**
		* Load a plugin model 
		* @param string modelname
		* @return void
		*/
	function loadModel($model = null){
		if($model && $this->$model == null){
			App::import('Model',"Seo.$model");
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
	
}
?>