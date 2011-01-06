<?php
class SeoUri extends SeoAppModel {
	var $name = 'SeoUri';
	var $displayField = 'uri';
	var $hasMany = array(
		'SeoMetaTag' => array(
			'className' => 'Seo.SeoMetaTag',
			'foreignKey' => 'seo_uri_id',
			'dependent' => true,
		),
	);
	var $hasOne = array(
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
	);
	
	var $validate = array(
		'uri' => array(
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Must be a unique url'
			)
		)
	);
	
	/**
	* If saving a regular expression, make sure to mark not approved unless
	* is_approved is specifically being sent in.
	* @return true
	*/
	function beforeSave(){
		if(!empty($this->data[$this->alias]['uri']) && $this->isRegEx($this->data[$this->alias]['uri'])){
			if(empty($this->data[$this->alias]['is_approved'])){
				$this->data[$this->alias]['is_approved'] = false;
			}
		}
		else {
			$this->data[$this->alias]['is_approved'] = true;
		}
		return true;
	}
	
	/**
	* Send need approval email if we need it.
	*/
	function afterSave(){
		if(isset($this->data[$this->alias]['is_approved']) && !$this->data[$this->alias]['is_approved']){
			$this->sendNotification(); //Email IT about needing approval... currently me.
		}  
	}
	
	/**
		* Find the URI id by uri
		* @param string uri
		* @return mixed id
		*/
	function findIdByUri($uri = null){
		return $this->field('id', array("{$this->alias}.uri" => $uri));
	}
	
	/**
	* Set as approved
	* @param int id of seo redirect to approve
	* @return boolean result of save
	*/
	function setApproved($id = null){
		if($id) $this->id = $id;
		return $this->saveField('is_approved', true);
	}
	
	/**
	* Send the notification of a regular expression that needs approval.
	* @param int id
	* @return void
	*/
	function sendNotification($id = null){
		if($id) $this->id = $id;
		$this->read();
		
		if(!empty($this->data)){
			if(!isset($this->Email)){
				App::import('Component','Email');
				$this->Email = new EmailComponent();
			}
			$this->Email->to = SeoUtil::getConfig('approverEmail');
			$this->Email->from = SeoUtil::getConfig('replyEmail');
			$this->Email->subject = "301 Redirect: {$this->data[$this->alias]['uri']} to {$this->data[$this->SeoRedirect->alias]['redirect']} needs approval";
			$this->Email->sendAs = 'html';
			$this->Email->send("A new regular expression 301 redirect needs to be approved.<br /><br/>
				
				URI: {$this->data[$this->alias]['uri']}<br />
				REDIRECT: {$this->data[$this->SeoRedirect->alias]['redirect']}<br />
				PRIORITY: {$this->data[$this->SeoRedirect->alias]['priority']}<br /><br />
				
				Link to approve:<br />
				". SeoUtil::getConfig('parentDomain') ."/admin/seo/seo_redirects/approve/{$this->data[$this->SeoRedirect->alias]['id']}<br /><br />
				");
		}
	}
	
}
?>