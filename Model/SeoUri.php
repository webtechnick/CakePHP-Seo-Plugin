<?php
App::uses('SeoAppModel','Seo.Model');
class SeoUri extends SeoAppModel {

	/**
	 * Model Name/Alias
	 *
	 * @var string
	 */
	public $name = 'SeoUri';

	/**
	 * Model Display Field
	 *
	 * @var string
	 */
	public $displayField = 'uri';

	/**
	 * Has Many Association
	 *
	 * @var array
	 */
	public $hasMany = array(
		'SeoMetaTag' => array(
			'className' => 'Seo.SeoMetaTag',
			'foreignKey' => 'seo_uri_id',
			'dependent' => true,
		),
		'SeoABTest' => array(
			'className' => 'Seo.SeoABTest',
			'foreignKey' => 'seo_uri_id',
			'dependent' => true,
		)
	);

	/**
	 * Has One Association
	 *
	 * @var array
	 */
	public $hasOne = array(
		'SeoRedirect' => array(
			'className' => 'Seo.SeoRedirect',
			'foreignKey' => 'seo_uri_id',
			'dependent' => true,
		),
		'SeoTitle' => array(
			'className' => 'Seo.SeoTitle',
			'foreignKey' => 'seo_uri_id',
			'dependant' => true
		),
		'SeoCanonical' => array(
			'className' => 'Seo.SeoCanonical',
			'foreignKey' => 'seo_uri_id',
			'dependant' => true
		),
		'SeoStatusCode' => array(
			'className' => 'Seo.SeoStatusCode',
			'foreignKey' => 'seo_uri_id',
			'dependant' => true
		)
	);


	/**
	 * Validation Rules
	 *
	 * @var array
	 */
	public $validate = array(
		'uri' => array(
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Must be a unique url'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Uri Must be present'
			)
		)
	);

	/**
	 * Filter fields
	 *
	 * @var array
	 */
	public $searchFields = array(
		'SeoUri.id','SeoUri.uri'
	);

	/**
	 * If saving a regular expression, make sure to mark not approved unless
	 * is_approved is specifically being sent in.
	 *
	 * @param array $options
	 * @return true
	 */
	public function beforeSave($options = array()) {
		//url encode the uri, but only once.
		if (!empty($this->data[$this->alias]['uri']) && $this->isRegEx($this->data[$this->alias]['uri'])) {
			if (empty($this->data[$this->alias]['is_approved'])) {
				$this->data[$this->alias]['is_approved'] = false;
			}
		} else {
			$this->data[$this->alias]['is_approved'] = true;
		}
		return parent::beforeSave($options);
	}

	/**
	 * Send need approval email if we need it.
	 *
	 * @param boolean $created
	 * @return boolean
	 */
	public function afterSave($created, $options = array()) {
		if ($created) {
			//Maybe URI
		}
		if (isset($this->data[$this->alias]['is_approved']) && !$this->data[$this->alias]['is_approved']) {
			//Email IT about needing approval... currently me.
			$this->sendNotification();
		}
		return parent::afterSave($created, $options);
	}

	/**
	 * Url encode the uri
	 *
	 * @param int id
	 * @return boolean success
	 */
	public function urlEncode($id = null) {
		if($id) {
			$this->id = $id;
		}
		$uri = $this->field('uri');
		$uri = rawurlencode($uri);
		$uri = str_replace('%2F','/', $uri);
		return $this->saveField('uri', $uri);
	}

	/**
	 * Named scope to find for view
	 *
	 * @param int id
	 * @return result of find.
	 */
	public function findForViewById($id) {
		return $this->find('first', array(
			'conditions' => array('SeoUri.id' => $id),
			'contain' => array('SeoRedirect','SeoTitle','SeoMetaTag','SeoStatusCode')
		));
	}

	/**
	 * Find the URI id by uri
	 *
	 * @param string uri
	 * @return mixed id
	 */
	public function findIdByUri($uri = null) {
		return $this->field('id', array("{$this->alias}.uri" => $uri));
	}

	/**
	* This is a simple function to return all possible RegEx URIs from the DB
	* (it has to return all of them, since we can't know which it's going to match)
	* So we've wrapped the DB request in a simple cache request,
	*   configured by setting the config key cacheEngine
	*
	* @return array $uris array(id => uri)
	*/
	public function findAllRegexUris() {
		$cacheEngine = SeoUtil::getConfig('cacheEngine');
		if (!empty($cacheEngine)) {
			$cacheKey = 'seo_findallregexuris';
			$uris = Cache::read($cacheKey, $cacheEngine);
		}
		if (!isset($uris) || empty($uris)) {
			$uris = $this->find('all', array(
				'conditions' => array(
					'OR' => array(
						array("{$this->alias}.uri LIKE" => '#%'),
						array("{$this->alias}.uri LIKE" => '%*'),
						),
					"{$this->alias}.is_approved" => true
					),
				'contain' => array(),
				'fields' => array("{$this->alias}.id","{$this->alias}.uri")
				));
			if (!empty($uris) && !empty($cacheEngine)) {
				Cache::write($cacheKey, $uris, $cacheEngine);
			}
		}
		if (!is_array($uris)) {
			return array();
		}
		return $uris;
	}

	/**
	 * Checks an input $request against regex urls
	 *
	 * @param string $request
	 * @return array $uri_ids array(id)
	 */
	public function findRegexUri($request = null) {
		$uri_ids = array();
		$uris = $this->findAllRegexUris();
		foreach ($uris as $uri) {
			//Wildcard match
			if (strpos($request, str_replace('*','', $uri[$this->alias]['uri'])) !== false) {
				$uri_ids[] = $uri[$this->alias]['id'];
			} elseif ($this->isRegex($uri[$this->alias]['uri']) && preg_match($uri[$this->alias]['uri'], $request)) {
				//Regex match
				$uri_ids[] = $uri[$this->alias]['id'];
			}
		}
		return $uri_ids;
	}

	/**
	 * Set as approved
	 *
	 * @param int id of seo redirect to approve
	 * @return boolean result of save
	 */
	public function setApproved($id = null) {
		if ($id) {
			$this->id = $id;
		}
		return $this->saveField('is_approved', true);
	}

	/**
	 * Send the notification of a regular expression that needs approval.
	 *
	 * @param int id
	 * @return void
	 */
	public function sendNotification($id = null) {
		if ($id) {
			$this->id = $id;
		}
		$this->read();
		if (!empty($this->data)) {
			if (!isset($this->Email)) {
				App::uses('CakeEmail', 'Network/Email');
				$this->Email = new CakeEmail();
				if ($email_config = SeoUtil::getConfig('emailConfig')) {
					$this->Email->config($email_config);
				}
			}
			$this->Email->to(SeoUtil::getConfig('approverEmail'));
			$this->Email->from(SeoUtil::getConfig('replyEmail'));
			$this->Email->subject("301 Redirect: {$this->data[$this->alias]['uri']} to {$this->data[$this->SeoRedirect->alias]['redirect']} needs approval");
			$this->Email->send("A new regular expression 301 redirect needs to be approved.<br /><br/>

				URI: {$this->data[$this->alias]['uri']}<br />
				REDIRECT: {$this->data[$this->SeoRedirect->alias]['redirect']}<br />
				PRIORITY: {$this->data[$this->SeoRedirect->alias]['priority']}<br /><br />

				Link to approve:<br />
				". SeoUtil::getConfig('parentDomain') ."/admin/seo/seo_redirects/approve/{$this->data[$this->SeoRedirect->alias]['id']}<br /><br />
				");
		}
	}

	/**
	 * Given a request, see if the uri matches.
	 * @param string request
	 * @param mixed string uri or uri_id to look up
	 * @return boolean if request matches the URI given
	 */
	public function requestMatch($request, $uri = null){
		if(is_int($uri)){
			$uri = $this->field('uri', array('SeoUri.id' => $uri));
		}
		return SeoUtil::requestMatch($request, $uri);
	}
}
