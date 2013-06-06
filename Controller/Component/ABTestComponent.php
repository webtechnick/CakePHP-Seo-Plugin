<?php
App::uses('SeoUtil', 'Seo.Lib');
App::uses('Component', 'Controller');
class ABTestComponent extends Component {
	
	/**
	* The Acutal AB test being tested.
	*/
	public $test = null;
	
	/**
	* Reset the component
	*/
	public function reset(){
		$this->ABTest = null;
		CakeSession::delete('Seo.ABTests');
	}
	
	/**
	* Find, setup, and get the AB test, if we're using Sessions setup in the config, look at that first.
	* @param array of options
	* - debug (if true, will always return the test even if it's not active, and regardless of roll)
	* - return (test|roll|both) default test.
	* - refresh (will preform the search as normal without the cached test result) default false
	* @return mixed array test if found and rolled, or boolean depending on return option.
	*/
	public function getTest($options = array()){
		$options = array_merge(array(
			'debug' => false,
			'return' => 'test',
			'refresh' => false,
		), (array) $options);

		$retval = array(
			'test' => false,
			'roll' => false,
		);
		
		if(!$options['refresh'] && $this->test){
			return $this->test;
		}

		$this->loadModel('SeoABTest');
		if($test = $this->SeoABTest->findTestByUri(null, $options['debug'])){
			if($this->SeoABTest->isTestable($test)){
				$retval['test'] = $test;
				if(SeoUtil::getConfig('abTesting.session')){
					$ab_tests = CakeSession::check('Seo.ABTests') ? CakeSession::read('Seo.ABTests') : array();
				} else {
					$ab_tests = array();
				}
				if(is_array($ab_tests) && isset($ab_tests[$test['SeoABTest']['id']])) {
					$retval['roll'] = !!($ab_tests[$test['SeoABTest']['id']]);
				} elseif($options['debug'] || $this->SeoABTest->roll($test)) {
					$ab_tests[$test['SeoABTest']['id']] = $test;
					$retval['roll'] = true;
				} else {
					$ab_tests[$test['SeoABTest']['id']] = false;
					$retval['roll'] = false;
				}
				if(SeoUtil::getConfig('abTesting.session')){
					CakeSession::write('Seo.ABTests', $ab_tests);
				}
				$this->test = $retval;
			}
		}

		switch($options['return']){
			case 'test' : return $retval['test'];
			case 'roll' : return $retval['roll'];
			default     : return $retval;
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