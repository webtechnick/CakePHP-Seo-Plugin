<?php
App::uses('Shell', 'Console');
App::uses('Set', 'Utility');
class SeoRedirectsShell extends Shell {
	public $uses = array('Seo.SeoUrl', 'Seo.SeoUri', 'Seo.SeoRedirect');

	/**
	 * Default action
	 */
	public function main(){
		$this->help();
	}

	/**
	 * Basic Help
	 */
	public function help(){
		$this->out("{$this->name} Shell");
		$this->hr();
		$this->out(" cake Seo.seo_redirects search <url or redirect>	   Quickly search for an existing redirect");
		$this->out(" cake Seo.seo_redirects add <url> <redirect> (priority:100) (callback:null)");
		$this->out("													Add a new simple redirect");
		$this->out();
		$this->out("examples:");
		$this->out(" cake Seo.seo_redirects add '/mybad/path*' '/my-cleaned-up-path' 50");
		$this->out(" cake Seo.seo_redirects add '/myother-bad/path*' '/my-cleaned-up-path' 60");
		$this->out(" cake Seo.seo_redirects add '/my*' '/my-failover-path' 10");
		$this->out(" cake Seo.seo_redirects add '#/some-old-route-(.*)#i' '/new-route-$1' 10");
		$this->out(" cake Seo.seo_redirects add '#/(admin|moderator)/(.*)#i' '/$2?old-prefix=$1' 10");
		$this->out();
		$this->out("more about SEO Redirects");
		$this->out("  https://github.com/webtechnick/CakePHP-Seo-Plugin/wiki/Seo-Redirects");
		$this->out();
	}
	/**
	 * A quick and dirty search of existing Uri & Redirects
	 */
	public function search() {
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
			$this->out("    {$url['SeoUri']['uri']} --> {$url['SeoRedirect']['redirect']}");
			$this->out("        Uri #{$url['SeoUri']['id']} --> redirect #{$url['SeoRedirect']['id']}");
			$this->out("        (active={$url['SeoRedirect']['is_active']}) (priority={$url['SeoRedirect']['priority']}) (callback={$url['SeoRedirect']['callback']})");
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
			$this->out("    {$redirect['SeoUri']['uri']} --> {$redirect['SeoRedirect']['redirect']}");
			$this->out("        Uri #{$redirect['SeoUri']['id']} --> redirect #{$redirect['SeoRedirect']['id']}");
			$this->out("        (active={$redirect['SeoRedirect']['is_active']}) (priority={$redirect['SeoRedirect']['priority']}) (callback={$redirect['SeoRedirect']['callback']})");
		}
	}
	/**
	 * A means for simply adding redirects
	 */
	public function add(){
		$default = array(
			'url' => null,
			'redirect' => null,
			'priority' => 100,
			'callback' => null,
		);
		$input = array_combine(array_keys($default), $this->args + array_fill(0, count($default), null));
		extract(array_merge($default, Set::filter($input)));
		if (empty($url) || strlen($url) < 3) {
			return $this->errorAndExit("Sorry, bad/missing input <url> = '$url'");
		}
		if (!in_array(substr($url, 0, 1), array('/', '#'))) {
			return $this->errorAndExit("Sorry, the input <url> should start with a '/' or a '#' you put in: '$url'");
		}
		if (empty($redirect) || (strlen($redirect) < 3 && substr($url, 0, 1)!='/'))  {
			return $this->errorAndExit("Sorry, bad/missing input <redirect> = '$redirect'");
		}
		if (substr($redirect, 0, 1) !== '/' && substr($redirect, 0, 5) !== 'http' && strpos($redirect, '{callback}') === false) {
			return $this->errorAndExit("Sorry, the input <redirect> should start with a '/' or a 'http' you put inredirecturl'");
		}
		$save = array(
			'SeoUri' => array('uri' => $url, 'is_approved' => 1),
			'SeoRedirect' => compact('redirect', 'priority', 'callback'),
		);
		$existing = $this->SeoUri->find('first', array(
			'contain' => array('SeoRedirect'),
			'conditions' => array('SeoUri.uri LIKE' => $url.'%')
		));
		if (!empty($existing) && isset($existing['SeoRedirect']['id']) && !empty($existing['SeoRedirect']['id'])) {
			$url = $existing;
			$this->out("Found an existing Uri...");
			$this->out("    {$url['SeoUri']['uri']} --> {$url['SeoRedirect']['redirect']}");
			$this->out("        Uri #{$url['SeoUri']['id']} --> redirect #{$url['SeoRedirect']['id']}");
			$this->out("        (active={$url['SeoRedirect']['is_active']}) (priority={$url['SeoRedirect']['priority']}) (callback={$url['SeoRedirect']['callback']})");
			$this->out();
			return $this->errorAndExit("Want to change it?  you're going to have to do so via the web interface.");
		}
		$this->SeoRedirect->clear();
		if ($this->SeoRedirect->save($save)) {
			$redirect = $this->SeoRedirect->find('first', array(
				'contain' => array('SeoUri'),
				'conditions' => array('SeoRedirect.id' => $this->SeoRedirect->id),
				));
			$this->out("Saved.");
			$this->out("    {$redirect['SeoUri']['uri']} --> {$redirect['SeoRedirect']['redirect']}");
			$this->out("        Uri #{$redirect['SeoUri']['id']} --> redirect #{$redirect['SeoRedirect']['id']}");
			$this->out("	    (active={$redirect['SeoRedirect']['is_active']}) (priority={$redirect['SeoRedirect']['priority']}) (callback={$redirect['SeoRedirect']['callback']})");
		}	else {
			$this->out("Errors");
			print_r($this->SeoUrl->errors);
			print_r($this->SeoUrl->validationErrors);
			print_r($this->SeoRedirect->validationErrors);
			$this->out();
		}
	}
	/**
	 * A simple way to delete SEO Redirects
	 */
	function delete() {
		while (!empty($this->args)) {
			$seo_redirect_id = array_shift($this->args);
			if (empty($seo_redirect_id)) {
				return $this->errorAndExit("Missing or empty SEO Redirect ID -- can not delete it: $seo_redirect_id");
			}
			if ($this->SeoRedirect->delete($seo_redirect_id)) {
				$this->out("deleted SEO redirect id: $seo_redirect_id");
			} else {
				$this->errorAndExit("Unable to delete SEO redirect id: $seo_redirect_id");
			}
		}
	}
	/**
	 * A simple way to delete SEO URIs
	 */
	function delete_uri() {
		while (!empty($this->args)) {
			$id = array_shift($this->args);
			if (empty($id)) {
				return $this->errorAndExit("Missing or empty SEO URI ID -- can not delete it: $id");
			}
			if ($this->SeoUri->delete($id)) {
				$this->out("deleted SEO URI id: $id");
			} else {
				$this->errorAndExit("Unable to delete SEO URI id: $id");
			}
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
