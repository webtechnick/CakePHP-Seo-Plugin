<?php
/**
*	Seo Helper, handles title tags and meta tags
* @author Nick Baker <nick@webtechnick.com>
* @since 4.5
* @license MIT
*/
App::uses('SeoUtil', 'Seo.Lib');
App::uses('SeoUri','Seo.Model');
App::uses('AppHelper','View/Helper');
class SeoHelper extends AppHelper {
	var $helpers = array('Html');
	var $SeoMetaTag = null;
	var $SeoTitle = null;
	var $SeoCanonical = null;
	var $SeoABTest = null;
	var $honeyPotId = 1;

	/**
	* Show the meta tags designated for this uri
	* @param array of name => content meta tags to merge with giving priority to SEO meta tags
	* @return string of meta tags to show.
	*/
	function metaTags($metaData = array()) {
		$this->loadModel('SeoMetaTag');
		$request = env('REQUEST_URI');
		$meta_tags = $this->SeoMetaTag->findAllTagsByUri($request);
		$retval = "";

		foreach ($meta_tags as $tag) {
			if (isset($metaData[$tag['SeoMetaTag']['name']])) {
				unset($metaData[$tag['SeoMetaTag']['name']]);
			}
			$data = array();
			if ($tag['SeoMetaTag']['is_http_equiv']) {
				$data['http-equiv'] = $tag['SeoMetaTag']['name'];
			}	else {
				$data['name'] = $tag['SeoMetaTag']['name'];
			}
			$data['content'] = $tag['SeoMetaTag']['content'];
			$retval .= $this->Html->meta($data);
		}

		if (!empty($metaData)) {
			foreach ($metaData as $name => $content) {
				$retval .= $this->Html->meta(array('name' => $name, 'content' => $content));
			}
		}

		return $retval;
	}

	/**
	* Pull in the DNS prefetches if we have any
	* @param array of dns urls to tell the browser to prefetch (default in config)
	* @return null | html tags with dns-prefetch
	*/
	public function dnsPrefetch($prefetches = array()) {
		$prefetches = array_merge(
			SeoUtil::getConfig('dnsPrefetch'),
			(array) $prefetches
		);

		if (empty($prefetches)) {
			return null;
		}
		$retval = '';
		foreach ($prefetches as $dns) {
			$retval .= $this->Html->tag('link', null, array('rel' => 'dns-prefetch', 'href' => $dns));
		}
		return $retval;
	}

	/**
	* Return a canonical link tag for SEO purpolses
	* Utility method
	* @param router friendly URL
	* @param boolean full url or relative (default true)
	* @param boolean overwrite (will always check SeoCanonical first)
	* @return HTMlElement of canonical link or empty string if none found/used
	*/
	function canonical($url = null, $full = true, $overwrite = false) {
		if ($overwrite || $url === null) {
			$this->loadModel('SeoCanonical');
			$request = env('REQUEST_URI');
			$seo_url = $this->SeoCanonical->findByUri($request);
			if (!empty($seo_url)) { //Only overwrite if we have a canonical to overwrite
				$url = $seo_url;
			}
		}

		if ($url) {
			$path = Router::url($url, $full);
			return $this->Html->tag('link', null, array('rel' => 'canonical', 'href' => $path));
		}
		return '';
	}

	/**
	* Show a honeypot link
	* to bait scrappers to click on for autobanning
	* @param string title for link
	* @param array of options
	* @return HtmlLink to honeypot action
	*/
	function honeyPot($title = 'Click Here', $options = array()) {
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
	function title($default = "") {
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
	function loadModel($model = null) {
		if ($model && $this->$model == null) {
			App::import('Model',"Seo.$model");
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}

	/**
	* Return the next Id to show.
	*/
	function nextId() {
		return $this->honeyPotId++;
	}

	/**
	* Return the ABTest GA code on current request
	* @param mixed test to show code for (if null, will check the View for ABTest variable and use that.
	* @param array of options
	*  - varname the variable named of the legacy pageTracker variable (default pageTracker). Only used when legacy is turn on in config
	*  - scriptBlock -- boolean if true will return scriptBlock of javascript (default false)
	* @return string ga script test, or null
	*/
	public function getABTestJS($test = null, $options = array()) {
		if (!$test) {
			if (isset($this->_View->viewVars['ABTest']) && $this->_View->viewVars['ABTest']) {
				$test = $this->_View->viewVars['ABTest'];
			}
		}
		$options = array_merge(array(
			'varname' => 'pageTracker',
			'scriptBlock' => false,
			),(array)$options
		);
		if ($test && isset($test['SeoABTest']['slug'])) {
			$category = SeoUtil::getConfig('abTesting.category');
			$scope = SeoUtil::getConfig('abTesting.scope');
			$slot = SeoUtil::getConfig('abTesting.slot');
			if (SeoUtil::getConfig('abTesting.legacy')) {
				$retval = "{$options['varname']}._setCustomVar($slot,'$category','{$test['SeoABTest']['slug']}',$scope);";
			} else {
				$retval = "_gaq.push(['_setCustomVar',$slot,'$category','{$test['SeoABTest']['slug']}',$scope]);";
			}
			if ($options['scriptBlock']) {
				return $this->Html->scriptBlock($retval);
			}
			return $retval;
		}
		return null;
	}

	/**
	 * This is a custom helper to translate ticket_id's
	 * into a full link into redmine based on a a config url 'abTesting.redmine'
	 * (custom functionality you may not need)
	 *
	 * @param mixed $ticket_id (string or int)
	 * @return string $html
	 */
	public function redmineLink($ticket_id = null) {
		if (empty($ticket_id) || !is_numeric($ticket_id)) {
			return null;
		}
		return $this->Html->link(
			$ticket_id,
			SeoUtil::getConfig('abTesting.redmine') . $ticket_id,
			array('class' => 'btn btn-mini btn-info', 'target' => '_blank')
		);
	}

}
