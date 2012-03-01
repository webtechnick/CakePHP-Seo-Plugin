<?php
class SeoTitle extends SeoAppModel {

	public $displayField = 'title';
	public $validate = array(
		'seo_uri_id' => array(
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Only one title tag per URI allowed'
			)
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title must be present',
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'SeoUri' => array(
			'className' => 'Seo.SeoUri',
			'foreignKey' => 'seo_uri_id',
		)
	);
	
	/**
	* Filter fields
	*/
	public $searchFields = array(
		'SeoTitle.id','SeoTitle.title','SeoTitle.id','SeoUri.uri'
	);
	
	/**
	* Assign or create the url.
	*/
	public function beforeSave(){
		$this->createOrSetUri();
		return true;
	}
	
	/**
	* Find the first title tag that matches this URI
	* @param string incoming reuqest uri
	* @return the first title tag to match
	*/
	public function findTitleByUri($request = null){
		return $this->find('first', array(
			'conditions' => array(
				"{$this->SeoUri->alias}.uri" => $request,
				"{$this->SeoUri->alias}.is_approved" => true
			),
			'contain' => array("{$this->SeoUri->alias}.uri"),
			'fields' => array("{$this->alias}.title")
		));
	}
}

