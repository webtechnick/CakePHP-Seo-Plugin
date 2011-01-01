<?php
class SeoRedirect extends SeoAppModel {
	var $name = 'SeoRedirect';
	var $displayField = 'uri';
	var $validate = array(
		'uri' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Incoming URI must not be empty',
			),
			'unqiue' => array(
				'rule' => array('isUnique'),
				'message' => 'This URI is already in the database.  URI must be unique',
			),
		),
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
	
	/**
	* Filter fields
	*/
	var $searchFields = array(
		'SeoRedirect.uri',
		'SeoRedirect.redirect',
	);
	
	/**
	* Return if the incoming URI is a regular expression
	* @param string
	* @return boolean if is regular expression (as two # marks)
	*/
	function isRegEx($uri){
		return preg_match('/^#(.*)#(.*)/', $uri);
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
			$this->Email->subject = "301 Redirect: {$this->data[$this->alias]['uri']} to {$this->data[$this->alias]['redirect']} needs approval";
			$this->Email->sendAs = 'html';
			$this->Email->send("A new regular expression 301 redirect needs to be approved.<br /><br/>
				
				URI: {$this->data[$this->alias]['uri']}<br />
				REDIRECT: {$this->data[$this->alias]['redirect']}<br />
				PRIORITY: {$this->data[$this->alias]['priority']}<br /><br />
				
				Link to approve:<br />
				". SeoUtil::getConfig('parentDomain') ."/admin/seo_redirects/approve/{$this->data[$this->alias]['id']}<br /><br />
				");
		}
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
			'fields' => array('uri','redirect','callback'),
			'order' => "{$this->alias}.priority ASC",
			'conditions' => array(
				"{$this->alias}.is_active" => true,
				"{$this->alias}.is_approved" => true,
			)
		));
	}
}
?>