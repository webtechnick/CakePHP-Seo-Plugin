<?php
class SeoBlacklist extends SeoAppModel {
	var $name = 'SeoBlacklist';
	var $displayField = 'note';
	var $validate = array(
		'ip_range_start' => array(
			'numeric' => array(
				'rule' => array('isIp'),
				'message' => 'Please specify a valid IP start range',
			),
		),
		'ip_range_end' => array(
			'numeric' => array(
				'rule' => array('isIp'),
				'message' => 'Please specify a valid IP end range',
			),
		),
	);
	
	/**
		* Fields to IP
		*/
	var $fieldsToLong = array(
		'ip_range_start',
		'ip_range_end'
	);
	
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
		* Add the IP to the banned list.
		* @param string ip to ban
		* @param string note to add to this ban
		* @return boolean success of save
		*/
	function addToBanned($ip = null, $note = "AutoBanned"){
		if(!$ip){
			$ip = $this->getIpFromServer();
		}
		
		return $this->save(array(
			$this->alias => array(
				'ip_range_start' => $ip,
				'ip_range_end' => $ip,
				'note' => $note
			)
		));
	}
	
	/**
		* Return true depending on the incomming IP
		* @param string $ip to check if banned
		* @return boolean true or false
		*/
	function isBanned($ip = null){
		if(!$ip){
			$ip = $this->getIpFromServer();
		}
		$ip_query = is_numeric($ip) ? $ip : ip2long($ip);
				
		//Check if exists in blacklist
		return $this->hasAny(array(
			"{$this->alias}.ip_range_start <=" => $ip_query,
			"{$this->alias}.ip_range_end >=" => $ip_query,
		));
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