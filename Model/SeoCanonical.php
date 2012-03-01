<?php
class SeoCanonical extends SeoAppModel {

	public $displayField = 'canonical';
	public $validate = array(
		'seo_uri_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Uri Must be present',
			),
		),
		'canonical' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'A canonical link must be entered',
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				'message' => 'Your custom message here',
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
		'SeoCanonical.id','SeoCanonical.canonical','SeoUri.uri'
	);
	
	/**
	 * Assign or create the url.
	 */
	public function beforeSave() {
		$this->createOrSetUri();
		return true;
	}
	
	/**
	 * Find the first canonical link that matches this requesting URI
	 * @param string incoming reuqest uri
	 * @return the first canonical link to match
	 */
	public function findByUri($request = null) {
		return $this->field('canonical', array(
			"{$this->SeoUri->alias}.uri" => $request,
			"{$this->SeoUri->alias}.is_approved" => true,
			"{$this->alias}.is_active" => true,
		));
	}
}