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
	
	function beforeSave(){
		$this->createOrSetUri();
		return true;
	}
	
	/**
		* Find all the tags by a specific reuqest,
		* This takes in a request URI and finds all matching meta_tags for this URI
		* @param incoming request URI
		* @return array of results
		*/
	function findAllTagsByUri($request = null){
		$retval = $this->find('all', array(
			'conditions' => array(
				"{$this->SeoUri->alias}.uri" => $request,
				"{$this->SeoUri->alias}.is_approved" => true
			),
			'contain' => array("{$this->SeoUri->alias}.uri")
		));
		
		if(!empty($retval)){
			return $retval;
		}
		
		$uri_ids = array();
		$uris = $this->SeoUri->find('all', array(
			'conditions' => array(
				'OR' => array(
					array("{$this->SeoUri->alias}.uri LIKE" => '#%'),
					array("{$this->SeoUri->alias}.uri LIKE" => '%*'),
				),
				"{$this->SeoUri->alias}.is_approved" => true
			),
			'contain' => array(),
			'fields' => array("{$this->SeoUri->alias}.id","{$this->SeoUri->alias}.uri")
		));
		
		foreach($uris as $uri){
			//Wildcard match
			if(strpos($request, str_replace('*','', $uri[$this->SeoUri->alias]['uri'])) !== false){
				$uri_ids[] = $uri[$this->SeoUri->alias]['id'];
			}
			//Regex match
			elseif($this->isRegex($uri[$this->SeoUri->alias]['uri']) && preg_match($uri[$this->SeoUri->alias]['uri'], $request)){
				$uri_ids[] = $uri[$this->SeoUri->alias]['id'];
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