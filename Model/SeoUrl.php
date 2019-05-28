<?php
App::uses('SeoUtil', 'Seo.Lib');
class SeoUrl extends SeoAppModel {
	var $name = 'SeoUrl';
	var $displayField = 'url';
	var $validate = array(
		'url' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Must not be empty',
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Url already being used'
			)
		),
	);

	var $searchFields = array('SeoUrl.id','SeoUrl.url');

	/**
	* Configuration settings
	*/
	var $settings = array();

	/**
	* Load the settings
	*/
	function __construct($id = false, $table = null, $ds = null){
		parent::__construct($id, $table, $ds);
		$this->settings = SeoUtil::getConfig('levenshtein');
	}

	/**
	* Import a set of valid URLS from a sitemap
	*
	* @param string path to sitemap we want to parse
	* @param boolean clear the set first, then import.
	* @param boolean verbose
	* @param int count of imported urls
	*/
	function import($sitemap = null, $clear_all = true, $verbose = false){
		$count = 0;
		if($this->settings['active']){
			if($sitemap){
				$this->settings['source'] = $sitemap;
			}
			if($clear_all){
				$this->deleteAll(1);
			}

			$xml = simplexml_load_file($this->getPathToSiteMap());
			foreach($xml->url as $url){
				$this->clear();
				$save_data = array(
					'url' => parse_url((string) $url->loc, PHP_URL_PATH),
					'priority' => (string) $url->priority
				);
				if($this->save($save_data)){
					if($verbose) echo ".";
					$count++;
				}
				elseif($verbose){
					echo "f";
					debug($this->validationErrors);
				}
			}

		}
		return $count;
	}


	/**
	* Use levenshtein's distance to decide what "good" url is most closest to the incomming request
	*
	* @param string request
	* @return array of result
	* - redirect the actually redirect to point to
	* - shortest how close this came
	*/
	function findRedirectByRequest($request){
		if($this->settings['active']){
			$retval = array(
				'redirect' => '/',
				'shortest' => -1
			);

			//Run import if we have no urls to look at.
			if($this->find('count') == 0){
				if($this->import() == 0){
					return $retval;
				}
			}

			$urls = $this->find('all', array(
				'fields' => array('SeoUrl.url'),
				'recursive' => -1,
				'order' => 'SeoUrl.priority ASC'
			));

			foreach($urls as $url){
				//Less efficent to use constants, if they're all the same don't use them
				if($this->settings['cost_add'] == $this->settings['cost_change'] && $this->settings['cost_change'] == $this->settings['cost_delete']){
					$lev = levenshtein($request, $url['SeoUrl']['url']);
				}
				else {
					$lev = levenshtein($request, $url['SeoUrl']['url'], $this->settings['cost_add'], $this->settings['cost_change'], $this->settings['cost_delete']);
				}
				if($lev <= $retval['shortest'] || $retval['shortest'] < 0){
					$retval['redirect'] = $url['SeoUrl']['url'];
					$retval['shortest'] = $lev;
				}
				if($retval['shortest'] < $this->settings['threshold'] || $lev == 0){
					break;
				}
			}
			return $retval;
		}
		return false;
	}

	/**
	* Get the file out of the source config
	*
	* @return string file path to source.
	*/
	private function getPathToSiteMap(){
		if(strpos($this->settings['source'], '/') === 0){
			return WWW_ROOT . substr($this->settings['source'], 1, strlen($this->settings['source']));
		}
		else {
			return $this->settings['source'];
		}
	}
}
