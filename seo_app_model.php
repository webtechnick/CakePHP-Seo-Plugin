<?php
App::import('Lib','Seo.SeoUtil');
class SeoAppModel extends AppModel {
	var $actsAs = array('Containable');
	var $recursive = 0;
	
	/**
	* Overwritable IP fields for database saving
	*/
	var $fieldsToLong = array();
	
	/**
	* Filter fields
	*/
	var $searchFields = array();
	
	/**
	* Custom validation.
	* Using CakePHP IP validation would be nice, but
	* since we're storing ips as longs in our database
	* we need a custom validation.
	* @param field to check
	* @return boolean
	*/
	function isIp($check = null){
		$ip_to_check = array_shift($check);
		return (ip2long($ip_to_check));
	}
	
	/**
	* Save string IPs as longs
	* @return true
	*/
	function beforeSave(){
		foreach($this->fieldsToLong as $field){
			if(isset($this->data[$this->alias][$field]) && !is_numeric($this->data[$this->alias][$field])){
				$this->data[$this->alias][$field] = ip2long($this->data[$this->alias][$field]);
			}
		}
		return true;
	}
	
	/**
	* Show the IPs back out.
	* @return formatted results
	*/
	function afterFind($results){
		if (!is_array($results)) {
			return $results;
		}
		foreach($results as $key => $val){
			foreach($this->fieldsToLong as $field){
				if(isset($val[$this->alias][$field]) && is_numeric($val[$this->alias][$field])){
					$results[$key][$this->alias][$field] = long2ip($val[$this->alias][$field]);
				}
			}
		}
		return $results;
	}
	
	/**
	* Overwrite find so I can do some nice things with it.
	* @param string find type
	* - last : find last record by created date
	* @param array of options
	*/
	function find($type, $options = array()){
		switch($type){
		case 'last':
			$options = array_merge(
				$options,
				array('order' => "{$this->alias}.{$this->primaryKey} DESC")
				);
			return parent::find('first', $options);    
		default: 
			return parent::find($type, $options);
		}
	}
	
	/**
	* Set or create the model, this is useful to find the URI
	*/
	function createOrSetUri($model = 'SeoUri', $field = 'uri'){
		$ModelName = Inflector::camelize($model);
		$model_underscore = Inflector::underscore($model);
		
		if(isset($this->data[$ModelName][$field])){
			$this->$ModelName->contain();
			$this->$ModelName->recursive = -1;
			//Find the Model, and set the id.
			if($associated_id = $this->$ModelName->field('id', array($field => $this->data[$ModelName][$field]))){
				$this->data[$this->alias][$model_underscore . '_id'] = $associated_id;
			}
			else {
				$save = array();
				$save[$ModelName][$field] = $this->data[$ModelName][$field];
				$this->$ModelName->create();
				$this->$ModelName->save($save);
				$this->data[$this->alias][$model_underscore . '_id'] = $this->$ModelName->id;
			}
		}
	}
	
	/**
	* Return if the incoming URI is a regular expression
	* @param string
	* @return boolean if is regular expression (as two # marks)
	*/
	function isRegEx($uri){
		return preg_match('/^#(.*)#(.*)/', $uri);
	}
	
	/**
	* return conditions based on searchable fields and filter
	* @param string filter
	* @return conditions array
	*/
	function generateFilterConditions($filter = null){
		$retval = array();
		if($filter){
			foreach($this->searchFields as $field){
				$retval['OR']["$field LIKE"] =  '%' . $filter . '%'; 
			}
		}
		return $retval;
	}
	
	/**
	* Returns the server IP
	* @return string of incoming IP
	*/
	function getIpFromServer(){
		$check_order = array(
			'HTTP_CLIENT_IP', //shared client
			'HTTP_X_FORWARDED_FOR', //proxy address
			'REMOTE_ADDR', //fail safe
			);
		
		foreach($check_order as $key){
			if(isset($_SERVER[$key]) && !empty($_SERVER[$key])){
				return $_SERVER[$key];
			}
		}
	}
}
?>