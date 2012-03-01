<?php
class SeoRedirect extends SeoAppModel {

	public $displayField = 'uri';
	public $validate = array(
		'redirect' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
	
	public $belongsTo = array(
		'Seo.SeoUri'
	);
	
	/**
	* Filter fields
	*/
	public $searchFields = array(
		'SeoRedirect.redirect','SeoRedirect.callback','SeoRedirect.id','SeoUri.uri'
	);
	
	/**
	* Check if SEO already exists, if so, unset it and set the ID then save.
	*/
	public function beforeSave() {
		$this->createOrSetUri();
		return true;
	}
	
	/**
	* This is a helper function for testing.
	*/
	public function callbackTest($request) {
		$this->uri_request = $request;
		return 'ran_callback';
	}
	
	/**
	* Named scope to find list of uri -> redirect by order and approved/active
	* @return list of active and approved uri -> redirects ordered by priority
	*/
	public function findRedirectListByPriority() {
		return $this->find('all', array(
			'fields' => array("{$this->SeoUri->alias}.uri","{$this->alias}.redirect","{$this->alias}.id","{$this->alias}.callback"),
			'order' => "{$this->alias}.priority ASC",
			'conditions' => array(
				"{$this->alias}.is_active" => true,
				"{$this->SeoUri->alias}.is_approved" => true,
			)
		));
	}
}

