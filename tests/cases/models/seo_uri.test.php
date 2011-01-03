<?php
/* SeoUri Test cases generated on: 2011-01-03 10:01:08 : 1294074608*/
App::import('Model', 'Seo.SeoUri');
App::import('Component', 'Email');
Mock::generate('EmailComponent');

class SeoUriTestCase extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
	);
	
	function startTest() {
		$this->SeoUri =& ClassRegistry::init('SeoUri');
		$this->SeoUri->Email = new MockEmailComponent();
	}
	
	function testSetApproved(){
	  $this->SeoUri->id = 6;
	  $this->assertFalse($this->SeoUri->field('is_approved'));
	  $this->SeoUri->setApproved();
	  $this->assertTrue($this->SeoUri->field('is_approved'));
	}
	
	function testSendNotification(){
	  $this->SeoUri->id = 6;
	  $this->SeoUri->Email->expectOnce('send');
	  $this->SeoUri->sendNotification();
	  $this->assertEqual('301 Redirect: #(.*)#i to / needs approval', $this->SeoUri->Email->subject);
	  $this->assertEqual('html', $this->SeoUri->Email->sendAs);
	}

	function endTest() {
		unset($this->SeoUri);
		ClassRegistry::flush();
	}

}
?>