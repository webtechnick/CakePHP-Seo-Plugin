<?php
class SeoRedirectsShell extends Shell {
	var $uses = array('Seo.SeoUrl', 'Seo.SeoUri', 'Seo.SeoRedirect');

	/**
	 * Default action
	 */
	function main(){
		$this->help();
	}

	/**
	 * Basic Help
	 */
	function help(){
		$this->out("{$this->shell} Shell");
		$this->hr();
		$this->out(" cake {$this->shell} search <url or redirect>	   Quickly search for an existing redirect");
		$this->out(" cake {$this->shell} add <url> <redirect> (priority:100) (callback:null)");
		$this->out("													Add a new simple redirect");
		$this->out();
		$this->out("examples:");
		$this->out(" cake {$this->shell} add '/mybad/path*' '/my-cleaned-up-path' 50");
		$this->out(" cake {$this->shell} add '/myother-bad/path*' '/my-cleaned-up-path' 60");
		$this->out(" cake {$this->shell} add '/my*' '/my-failover-path' 10");
		$this->out();
	}
	/**
	 * A quick and dirty search of existing Uri & Redirects
	 */
	function search() {
		$term = array_shift($this->args);
		$this->out("Searching URIs.");
		$urls = $this->SeoUri->find('all', array(
			'contain' => array('SeoRedirect'),
			'conditions' => array('SeoUri.uri LIKE' => $term.'%')
			));
		if (empty($urls)) {
			$urls = $this->SeoUri->find('all', array(
				'contain' => array('SeoRedirect'),
				'conditions' => array('SeoUri.uri LIKE' => '%'.$term.'%')
				));
		}
		$this->out();
		$this->out("Found ".count($urls)." URIs");
		foreach ($urls as $url) {
			$this->out("Uri #{$url['SeoUri']['id']}: {$url['SeoUri']['uri']}");
			$this->out("	redirect #{$url['SeoRedirect']['id']}: {$url['SeoRedirect']['redirect']}");
			$this->out("			   (active={$url['SeoRedirect']['is_active']}) (priority={$url['SeoRedirect']['priority']}) (callback={$url['SeoRedirect']['callback']})");
		}
		$this->out("Searching Redirects.");
		$redirects = $this->SeoRedirect->find('all', array(
			'contain' => array('SeoUri'),
			'conditions' => array('SeoRedirect.redirect LIKE' => $term.'%')
			));
		if (empty($redirects)) {
			$redirects = $this->SeoRedirect->find('all', array(
				'contain' => array('SeoUri'),
				'conditions' => array('SeoRedirect.redirect LIKE' => '%'.$term.'%')
				));
		}
		$this->out();
		$this->out("Found ".count($redirects)." Redirects");
		foreach ($redirects as $redirect) {
			$this->out("Uri #{$redirect['SeoUri']['id']}: {$redirect['SeoUri']['uri']}");
			$this->out("	redirect #{$redirect['SeoRedirect']['id']}: {$redirect['SeoRedirect']['redirect']}");
			$this->out("			   (active={$redirect['SeoRedirect']['is_active']}) (priority={$redirect['SeoRedirect']['priority']}) (callback={$redirect['SeoRedirect']['callback']})");
		}
	}

	/**
	 * A means for simply adding redirects
	 */
	function add(){
		$default = array(
			'url' => null,
			'redirect' => null,
			'priority' => 100,
			'callback' => null,
			);
		$input = array_combine(array_keys($default), $this->args + array_fill(0, count($default), null));
		extract(array_merge($default, set::filter($input)));
		if (empty($url) || strlen($url) < 3) {
			return $this->errorAndExit("Sorry, bad/missing input <url> = '$url'");
		}
		if (substr($url, 0, 1) !== '/') {
			return $this->errorAndExit("Sorry, the input <url> should start with a '/' you put in: '$url'");
		}
		if (empty($redirect) || strlen($redirect) < 3) {
			return $this->errorAndExit("Sorry, bad/missing input <redirect> = '$redirect'");
		}
		if (substr($redirect, 0, 1) !== '/' && substr($redirect, 0, 5) !== 'http') {
			return $this->errorAndExit("Sorry, the input <redirect> should start with a '/' or a 'http' you put inredirecturl'");
		}
		$save = array(
			'SeoUri' => array('uri' => $url),
			'SeoRedirect' => compact('redirect', 'priority', 'callback'),
			);
		$existing = $this->SeoUri->find('first', array(
			'contain' => array('SeoRedirect'),
			'conditions' => array('SeoUri.uri LIKE' => $url.'%')
			));
		if (!empty($existing)) {
			$url = $existing;
			$this->out("Found an existing Uri...");
			$this->out("Uri #{$url['SeoUri']['id']}: {$url['SeoUri']['uri']}");
			$this->out("	redirect #{$url['SeoRedirect']['id']}: {$url['SeoRedirect']['redirect']}");
			$this->out("			   (active={$url['SeoRedirect']['is_active']}) (priority={$url['SeoRedirect']['priority']}) (callback={$url['SeoRedirect']['callback']})");
			$this->out();
			return $this->errorAndExit("you're going to have to do this via the web interface.");
		}
		$this->SeoRedirect->create();
		if ($this->SeoRedirect->saveAll($save)) {
			$redirect = $this->SeoRedirect->find('first', array(
				'contain' => array('SeoUri'),
				'conditions' => array('SeoRedirect.id' => $this->SeoRedirect->id),
				));
			$this->out("Saved.");
			$this->out("Uri #{$redirect['SeoUri']['id']}: {$redirect['SeoUri']['uri']}");
			$this->out("	redirect #{$redirect['SeoRedirect']['id']}: {$redirect['SeoRedirect']['redirect']}");
			$this->out("			   (active={$redirect['SeoRedirect']['is_active']}) (priority={$redirect['SeoRedirect']['priority']}) (callback={$redirect['SeoRedirect']['callback']})");
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