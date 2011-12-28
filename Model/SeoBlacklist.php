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
	
	var $searchFields = array('SeoBlacklist.note');
	
	/**
	* Add the IP to the banned list.
	* @param string ip to ban
	* @param string note to add to this ban
	* @return boolean success of save
	*/
	function addToBanned($ip = null, $note = "AutoBanned", $is_active = null){
		if(!$ip){
			$ip = $this->getIpFromServer();
		}
		
		if($is_active === null){
			$is_active = SeoUtil::getConfig('aggressive');
		}
		
		return $this->save(array(
			$this->alias => array(
				'ip_range_start' => $ip,
				'ip_range_end' => $ip,
				'note' => $note,
				'is_active' => $is_active
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
			"{$this->alias}.is_active" => true
		));
	}
	
}
?>