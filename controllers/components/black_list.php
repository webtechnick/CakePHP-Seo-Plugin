<?php
App::import('Lib','Seo.SeoUtil');
class BlackListComponent extends Object {
	
	/**
		* Store time into sessions
		*/
	var $components = array('Session');
	
	/**
		* CakePHP based URL to redirect the banned uesr
		*/
	var $redirect = array('admin' => false, 'plugin' => 'seo', 'controller' => 'seo_blacklists', 'action' => 'banned');
	
	/**
		* Time between triggers to auto ban in seconds
		*/
	var $timeBetweenTriggers = 86400;
	
	/**
		* How many triggers must be hit before autobanned
		*/
	var $triggerCount = 2;
	
	/**
    * Error log
    */
  var $errors = array();
  
  /**
  	* Placeholder for the SeoBlacklist Model
  	*/
  var $SeoBlacklist = null;
	
	/**
		* Initialize the component, set the settings
		*/
	function initialize(&$controller, $settings = array()){
		$this->Controller = $controller;
		$settings = array_merge(
			array(
				'triggerCount' => SeoUtil::getConfig('triggerCount'),
				'timeBetweenTriggers' => SeoUtil::getConfig('timeBetweenTriggers'),
			),
			$settings
		);
		$this->_set($settings);
		
		//Always load the SeoBlacklist, as we will need direct access to this model
		$this->loadModel('SeoBlacklist');
		
		$this->handleIfBanned();
	}
	
	/**
		* Handle the banned user, decide if banned,
		* if so, redirect the user.
		*/
	private function handleIfBanned(){
		if($this->SeoBlacklist->isBanned()){
			if($this->Controller->here != Router::url($this->redirect)){
				$this->Controller->redirect($this->redirect);
			}
			return;
		}
	}
	
	
	
	/**
		* Load a plugin model 
		* @param string modelname
		* @return void
		*/
	private function loadModel($model = null){
		if($model && $this->$model == null){
			App::import('Model',"Seo.$model");
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
	
	/**
    * Run the callback if it exists
    * @param string callback
    * @param mixed passed in variable (optional)
    * @return mixed result of the callback function
    */ 
  private function __runCallback($callback, $passedIn = null){
    if(is_callable(array($this, $callback))){
      if($passedIn === null){
        return $this->$callback();
      }
      else {
        return $this->$callback($passedIn);
      }
    }
    return false;
  }
  
  /**
    * Handle errors.
    * @param string of error message
    * @return void
    * @access private
    */
  function __error($msg){
    $this->errors[] = __($msg, true);
  }
}
?>