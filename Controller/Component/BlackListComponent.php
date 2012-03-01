<?php
App::uses('SeoUtil', 'Seo.Lib');
class BlackListComponent extends Component {
	
	/**
	* CakePHP based URL to redirect the banned uesr
	*/
	public $redirect = array('admin' => false, 'plugin' => 'seo', 'controller' => 'seo_blacklists', 'action' => 'banned');
	
	/**
	* CakePHP based URL to the honeypot action setup in config
	*/
	public $honeyPot = null;
	
	/**
	* Error log
	*/
	public $errors = array();
	
	/**
	* Placeholder for the SeoBlacklist Model
	*/
	public $SeoBlacklist = null;
	
	/**
	* Placeholder for the SeoHoneypotVisit Model
	*/
	public $SeoHoneypotVisit = null;
	
	/**
	* Initialize the component, set the settings
	*/
	public function initialize(Controller $controller, $settings = array()) {
		$this->Controller = $controller;
		$this->_set($settings);
		$this->honeyPot = SeoUtil::getConfig('honeyPot');
		
		if (!$this->__isBanned()) {
			$this->__handleIfHoneyPot();
		}
	}
	
	/**
	* Handle the banned user, decide if banned,
	* if so, redirect the user.
	*/
	public function __isBanned() {
		$this->loadModel('SeoBlacklist');
		if ($this->SeoBlacklist->isBanned()) {
			if ($this->Controller->here != Router::url($this->redirect)) {
				$this->Controller->redirect($this->redirect);
			}
			return true;
		}
		return false;
	}
	
	/**
	* Handle if honeypot action.
	*/
	public function __handleIfHoneyPot() {
		if ($this->Controller->here == Router::url($this->honeyPot)) {
			$this->loadModel('SeoHoneypotVisit');
			$this->SeoHoneypotVisit->add();
			if ($this->SeoHoneypotVisit->isTriggered()) {
				$this->SeoBlacklist->addToBanned();
				$this->isBanned();
			} else {
				$this->Controller->redirect('/');
			}
		}
	}
	
	/**
	* Load a plugin model 
	* @param string modelname
	* @return void
	*/
	protected function loadModel($model = null) {
		if ($model && !$this->$model) {
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
}

