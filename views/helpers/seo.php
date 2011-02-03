<?php
/**
*	Seo Helper, handles title tags and meta tags
* @author Nick Baker <nick@webtechnick.com>
* @since 4.0
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
	* Show a honeypot link
	* to bait scrappers to click on for autobanning
	* @param string title for link
	* @param array of options
	* @return HtmlLink to honeypot action
	*/
	function honeyPot($title = 'Click Here', $options = array()){
		$options = array_merge(
			array(
				'style' => 'display:none;',
				'rel' => 'nofollow'
			),
			$options
		);
		return $this->Html->link(
			$title,
			SeoUtil::getConfig('honeyPot'),
			$options
		);
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