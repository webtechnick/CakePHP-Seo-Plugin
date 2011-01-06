<?php
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
	
	/**
		* Find the title tag related to this request and output the result.
		* @return string title for requested uri
		*/
	function title(){
		$this->loadModel('SeoTitle');
		$request = env('REQUEST_URI');
		$title = $this->SeoTitle->findTitleByUri($request);
		return $title ? $title['SeoTitle']['title'] : "";
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