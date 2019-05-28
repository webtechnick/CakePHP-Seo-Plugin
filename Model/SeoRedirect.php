<?php
class SeoRedirect extends SeoAppModel {
	var $name = 'SeoRedirect';
	var $displayField = 'uri';
	var $validate = array(
		'redirect' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Redirect must not be empty',
			),
		),
		'priority' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Priorty must be an integer number',
			),
		),
	);

	var $belongsTo = array(
		'Seo.SeoUri'
	);

	/**
	* Filter fields
	*/
	var $searchFields = array(
		'SeoRedirect.redirect','SeoRedirect.callback','SeoRedirect.id','SeoUri.uri'
	);

	/**
	* Check if SEO already exists, if so, unset it and set the ID then save.
	*/
	function beforeSave($options = array()){
		$this->createOrSetUri();
		return true;
	}

	/**
	* This is a helper function for testing.
	*/
	function callbackTest($request){
		$this->uri_request = $request;
		return 'ran_callback';
	}

	/**
	* Named scope to find list of uri -> redirect by order and approved/active
	* @return list of active and approved uri -> redirects ordered by priority
	*/
	function findRedirectListByPriority(){
		return $this->find('all', array(
			'contain' => array($this->SeoUri->alias => 'uri'),
			'fields' => array(
				"{$this->alias}.redirect",
				"{$this->alias}.id",
				"{$this->alias}.callback",
				"{$this->alias}.is_nocache",
			),
			'order' => array("{$this->alias}.priority" => 'ASC'),
			'conditions' => array(
				"{$this->alias}.is_active" => true,
				"{$this->SeoUri->alias}.is_approved" => true,
			)
		));
	}
}
