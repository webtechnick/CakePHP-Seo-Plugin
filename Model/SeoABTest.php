<?php
App::uses('SeoAppModel', 'Seo.Model');
/**
 * SeoABTest Model
 *
 * @property SeoUri $SeoUri
 */
class SeoABTest extends SeoAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'seo_uri_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Must be associated to an seo_uri',
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Must have a title.',
			),
		),
		'slug' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Must have a slug (custom Variable for GA)',
			),
			'noquotes' => array(
				'rule' => array('noquotes'),
				'message' => 'The slug cannot contain \' marks.'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This slug already exists.'
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Must have a description of the test.',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SeoUri' => array(
			'className' => 'Seo.SeoUri',
			'foreignKey' => 'seo_uri_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $searchFields = array(
		'SeoUri.uri', 'SeoABTest.title', 'SeoABTest.slug', 'SeoABTest.id'
	);
	
	public $slots = array(
		1 => 1,
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
	);
	
	/**
	* Validate there are no ' marks in the slug
	* @return boolean success
	*/
	function noquotes(){
		if(isset($this->data[$this->alias]['slug']) && strpos($this->data[$this->alias]['slug'],"'") !== false){
			return false;
		}
		return true;
	}
	
	/**
	* Check if SEO already exists, if so, unset it and set the ID then save.
	*/
	public function beforeSave(){
		$this->createOrSetUri();
		return true;
	}
	
	/**
	* Decide if we have a test for this request
	* @param string request (optional will default to REQUEST_URI
	* @return mixed boolean false if no test, otherwise the ABTest will be returned
	*/
	public function findTestByUri($request = null, $debug = false){
		if($request === null){
			$request = env('REQUEST_URI');
		}
		$fields = array(
			"{$this->SeoUri->alias}.uri",
			"{$this->alias}.slug",
			"{$this->alias}.slot",
			"{$this->alias}.id",
		);
		$conditions = array();
		if(!$debug){
			$conditions = array(
				"{$this->alias}.is_active" => true,
			);
		}
		//Test one of one.
		if($test = $this->find('first', array(
			'conditions' => array_merge(array(
				"{$this->SeoUri->alias}.uri" => $request,
				"{$this->SeoUri->alias}.is_approved" => true,
			),$conditions),
			'contain' => array("{$this->SeoUri->alias}.uri"),
			'fields' => $fields
		))){
			return $test;
		}
		
		//Check Many to Many and Many to One
		$cacheEngine = SeoUtil::getConfig('cacheEngine');
		if (!empty($cacheEngine)) {
			$cacheKey = 'seo_ab_tests';
			$tests = Cache::read($cacheKey, $cacheEngine);
		}
		if(!isset($tests) || empty($tests)){
			$tests = $this->find('all', array(
				'conditions' => $conditions,
				'contain' => array("{$this->SeoUri->alias}.uri"),
				'fields' => $fields
			));
			if (!empty($tests) && !empty($cacheEngine)) {
				Cache::write($cacheKey, $tests, $cacheEngine);
			}
		}
		foreach($tests as $test){
			if($this->SeoUri->requestMatch($request, $test[$this->SeoUri->alias]['uri'])){
				return $test;
			}
		}
		return false;
	}
}
