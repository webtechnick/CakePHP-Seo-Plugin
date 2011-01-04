<?php
App::import('Lib','Seo.SeoUtil');
class SeoAppModel extends AppModel {
	var $actsAs = array('Containable');
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
}
?>