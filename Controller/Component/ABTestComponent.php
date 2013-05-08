<?php
App::uses('SeoUtil', 'Seo.Lib');
App::uses('Component', 'Controller');
class ABTestComponent extends Component {
	
	/**
	* The Acutal AB test being tested.
	*/
	public $ABTest = null;
	
	/**
	* Reset the component
	*/
	public function reset(){
		$this->ABTest = null;
	}
	
	/**
	* Find, setup, and get the AB test, if we're using Sessions setup in the config, look at that first.
	* @return mixed array test if found and rolled, or false if no test
	*/
	public function getTest($debug = false){
		$this->loadModel('SeoABTest');
		if($test = $this->SeoABTest->findTestByUri(null, $debug)){
			if(SeoUtil::getConfig('abTesting.session')){
				$ab_tests = CakeSession::check('Seo.ABTests') ? CakeSession::read('Seo.ABTests') : array();
			} else {
				$ab_tests = array();
			}
			if(is_array($ab_tests) && isset($ab_tests[$test['SeoABTest']['id']])) {
				return $ab_tests[$test['SeoABTest']['id']];
			} elseif($debug || $this->SeoABTest->roll($test)) {
				$ab_tests[$test['SeoABTest']['id']] = $test;
				$retval = $test;
			} else {
				$ab_tests[$test['SeoABTest']['id']] = false;
				$retval = false;
			}
			if(SeoUtil::getConfig('abTesting.session')){
				CakeSession::write('Seo.ABTests', $ab_tests);
			}
			$this->ABTest = $retval;
			return $retval;
		}
	}
	
	/**
	* Load a plugin model 
	* @param string modelname
	* @return void
	*/
	private function loadModel($model = null){
		if($model && $this->$model == null){
			$this->$model = ClassRegistry::init("Seo.$model");
		}
	}
}