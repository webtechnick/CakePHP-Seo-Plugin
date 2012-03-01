<?php
/* SeoBlacklists Test cases generated on: 2011-02-02 11:20:27 : 1296670827*/
App::uses('SeoBlacklistsController', 'Seo.Controller');

class TestSeoBlacklistsController extends SeoBlacklistsController {
	public $autoRender = false;

	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeoBlacklistsControllerTest extends CakeTestCase {
	public function startTest() {
		$this->SeoBlacklists = new TestSeoBlacklistsController();
		$this->SeoBlacklists->constructClasses();
	}

	public function endTest() {
		unset($this->SeoBlacklists);
		ClassRegistry::flush();
	}

}
