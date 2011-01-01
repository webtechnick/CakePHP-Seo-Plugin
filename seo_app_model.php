<?php
App::import('Lib','Seo.SeoUtil');
class SeoAppModel extends AppModel {
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
}
?>