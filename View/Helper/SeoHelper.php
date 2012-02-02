<?php
/**
*	Seo Helper, handles title tags and meta tags
* @author Nick Baker <nick@webtechnick.com>
* @since 4.5
* @license MIT
*/
App::uses('SeoUtil', 'Seo.Lib');
class SeoHelper extends AppHelper {
	public $helpers = array('Html');
	public $SeoMetaTag = null;
	public $SeoTitle = null;
	public $SeoCanonical = null;
	public $honeyPotId = 1;
	
	/**
	* Show the meta tags designated for this uri
	* @param array of name => content meta tags to merge with giving priority to SEO meta tags
	* @return string of meta tags to show.
	*/
	function metaTags($metaData = array()){
		$this->loadModel('SeoMetaTag');
		$request = env('REQUEST_URI');
		$meta_tags = $this->SeoMetaTag->findAllTagsByUri($request);
		$retval = "";
		
		foreach($meta_tags as $tag){
			if(isset($metaData[$tag['SeoMetaTag']['name']])){
				unset($metaData[$tag['SeoMetaTag']['name']]);
			}
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
		
		if(!empty($metaData)){
			foreach($metaData as $name => $content){
				$retval .= $this->Html->meta(array('name' => $name, 'content' => $content));
			}
		}
		
		return $retval;
	}
	
	/**
	* Return a canonical link tag for SEO purpolses
	* Utility method
	* @param router friendly URL
	* @param boolean full url or relative (default true)
	* @return HTMlElement of canonical link or empty string if none found/used
	*/
	function canonical($url = null, $full = true){
		if($url === null){
			$this->loadModel('SeoCanonical');
			$request = env('REQUEST_URI');
			$url = $this->SeoCanonical->findByUri($request);
		}
		
		if($url){
			$path = Router::url($url, $full);
			return $this->Html->tag('link', null, array('rel' => 'canonical', 'href' => $path));
		}
		return "";
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
				'rel' => 'nofollow',
				'id' => 'honeypot-' . $this->nextId()
			),
			$options
		);
		
		$link = $this->Html->link(
			$title,
			SeoUtil::getConfig('honeyPot'),
			$options
		);
		
		$javascript = $this->Html->scriptBlock("
			document.getElementById('{$options['id']}').style.display = 'none';
			document.getElementById('{$options['id']}').style.zIndex = -1;
		");
		
		return $link . $javascript; 
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
	
	/**
	* Return the next Id to show.
	*/
	function nextId(){
		return $this->honeyPotId++;
	}
	
}

