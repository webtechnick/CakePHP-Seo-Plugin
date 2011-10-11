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
	}
	
	function import(){
		$this->out("Importing.");
		$count = $this->SeoUrl->import(null, true, true);
		$this->out();
		$this->out("Import finished. $count Imported.");
	}
}
?>