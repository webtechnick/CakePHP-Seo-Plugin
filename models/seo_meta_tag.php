<?php
class SeoMetaTag extends SeoAppModel {
	var $name = 'SeoMetaTag';
	var $displayField = 'name';
	var $validate = array(
		'uri_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'must be numeric',
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Name must be present.',
			),
		),
		'content' => array(
			'notempty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Content must be present.',
			),
		),
		'is_http_equiv' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Must be true or false',
			),
		),
	);
	var $belongsTo = array(
		'Seo.SeoUri'
	);
	
	/**
		* TODO
		* @param incoming request URI
		* @return array of results
		*/
	function findAllTagsByUri($request = null){
		$retval = $this->find('all', array(
			'conditions' => array(
				"{$this->SeoUri->alias}.uri" => $request
			),
			'contain' => array("{$this->SeoUri->alias}.uri")
		));
		
		if(!empty($retval)){
			return $retval;
		}
		
		$uri_ids = array();
		$uris = $this->SeoUri->find('all', array(
			'conditions' => array(
				'SeoUri.uri LIKE' => '#%'
			),
			'contain' => array()
		));
		
		foreach($uris as $uri){
			if(preg_match($uri['SeoUri']['uri'], $request)){
				$uri_ids[] = $uri['SeoUri']['id'];
			}
		}
		
		if(empty($uri_ids)){
			return array();
		}
		
		$retval = $this->find('all', array(
			'conditions' => array(
				"{$this->alias}.seo_uri_id" => $uri_ids
			),
			'contain' => array()
		));
		
		return $retval;
	}
}
?>