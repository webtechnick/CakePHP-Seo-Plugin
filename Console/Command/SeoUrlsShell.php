<?php
class SeoUrlsShell extends Shell {
	var $uses = array('Seo.SeoUrl');
	
	function main(){
		$this->out("SeoUrl Shell");
		$this->hr();
		$this->help();
	}
	
	function help(){
		$this->out(" cake seo_urls import                  Import from the source in config");
		$this->out(" cake seo_urls add <url> <priorty>     Add a url to use as levenshtien");
	}
	
	function import(){
		$this->out("Importing.");
		$count = $this->SeoUrl->import(null, true, true);
		$this->out();
		$this->out("Import finished. $count Imported.");
	}
	
	function add(){
		$url = array_shift($this->args);
		$priority = array_shift($this->args);
		if(!$url){
			$this->errorAndExit("Url not set, please set a url.");
		}
		if(!$priority){
			$this->errorAndExit("Priority not set, please set a priority.\n\n cake seo_urls add $url 1");
		}
		$save_data = array(
			'url' => $url,
			'priority' => $priority
		);
		if($this->SeoUrl->hasAny(array('SeoUrl.url' => $url))){
			$save_data['id'] = $this->SeoUrl->field('id', array('SeoUrl.url' => $url));
		}
		$this->SeoUrl->clear();
		if($this->SeoUrl->save($save_data)){
			$this->out("$url $priority added.");
		}
		else {
			$this->out("Errors");
			print_r($this->SeoUrl->validationErrors);
			$this->out();
		}
	}
	/**
	* Private method to output the error and exit(1)
	* @param string message to output
	* @return void
	* @access private
	*/
	protected function errorAndExit($message) {
		$this->out("Error: $message");
		exit(1);
	}
}
?>