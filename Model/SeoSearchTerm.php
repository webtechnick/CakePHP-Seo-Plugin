<?php
/**
* Find search terms from google and save them to the database
* @author Nick Baker
* @version 6.0
*/
App::uses('SeoUtil', 'Seo.Lib');
class SeoSearchTerm extends SeoAppModel {
	var $name = 'SeoSearchTerm';
	var $displayField = 'term';
	var $validate = array(
		'term' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'uri' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

	/**
	* Take the incomming request referrer and decide if we should save this term in our
	* database
	* @param incoming request usually $this->here
	* @return void
	* @access public
	*/
	function parseRequest($request = null){
		if($request){
			$referrer = env('HTTP_REFERER');
			// Check if from google and page 2
			if(strpos($referrer,"google.com")) {
				if(!SeoUtil::getConfig('searchTerms')){
					return;
				}
				//parse the term out.
				if(strpos($referrer, "q=")){
					list($ignore, $term) = explode("q=", $referrer);
					if(strpos($term, "&")){
						list($term, $ignore) = explode("&", $term);
					}
					$term = trim(urldecode($term));
					if($term && strpos($referrer,"start=")){
						//Only proceed if we have a valid term
						if($id = $this->field('id', array('SeoSearchTerm.term' => $term))){
							$this->itterateCount($id);
						}
						else {
							$data = array(
								'SeoSearchTerm' => array(
									'term' => $term,
									'uri' => $request,
									'count' => 1
								)
							);
							$this->save($data);
						}
					}
					elseif($term) {
						//Delete the term if this was found on the first page.
						if($id = $this->field('id', array('SeoSearchTerm.term' => $term))){
							$this->delete($id);
						}
					}
				}
			}
		}
	}

	/**
	* Pull out random terms
	* @param int limit
	* @param array set of results
	*/
	function findRandomTerms($limit = 6){
		return $this->find('all', array(
			'limit' => $limit,
			'order' => 'RAND()'
		));
	}

	/**
	* Find the top terms
	* @param int limit
	* @return array set of results
	*/
	function findTopTerms($limit = 6){
		return $this->find('all', array(
			'limit' => $limit,
			'order' => 'SeoSearchTerm.count DESC'
		));
	}

	/**
	* Itterate the count on a specific term.
	* @param int id (optional)
	* @return boolean success
	*/
	function itterateCount($id = null){
		if($id) $this->id = $id;
		if($this->id){
			return $this->saveField('count', $this->field('count') + 1);
		}
		return false;
	}
}
