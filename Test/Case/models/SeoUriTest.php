<?php
/* SeoUri Test cases generated on: 2011-01-03 10:01:08 : 1294074608*/
App::import('Model', 'Seo.SeoUri');
App::import('Component', 'Email');
Mock::generate('EmailComponent');

class SeoUriTest extends CakeTestCase {
	var $fixtures = array(
		'plugin.seo.seo_uri',
		'plugin.seo.seo_meta_tag',
		'plugin.seo.seo_redirect',
		'plugin.seo.seo_title',
		'plugin.seo.seo_status_code',
		'plugin.seo.seo_canonical',
	);
	
	function startTest() {
		$this->SeoUri = ClassRegistry::init('Seo.SeoUri');
		$this->SeoUri->Email = new MockEmailComponent();
	}
	
	function testUrlEncode(){
		$uri = $this->SeoUri->findById(1);
		$this->assertEqual('/blah', $uri['SeoUri']['uri']);
		$this->assertTrue($this->SeoUri->urlEncode(1));
		$result = $this->SeoUri->findById(1);
		$this->assertEqual('/blah', $result['SeoUri']['uri']);
		
		$uri = $this->SeoUri->findById(14);
		$this->assertEqual('/uri with spaces', $uri['SeoUri']['uri']);
		$this->assertTrue($this->SeoUri->urlEncode(14));
		$result = $this->SeoUri->findById(14);
		$this->assertEqual('/uri%20with%20spaces', $result['SeoUri']['uri']);
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
	
	function testDeleteUriDeletsMeta(){
		$this->assertTrue($this->SeoUri->SeoMetaTag->hasAny(array('id' => 1)));
		$this->assertTrue($this->SeoUri->SeoMetaTag->hasAny(array('id' => 2)));
		$this->SeoUri->delete(9);
		$this->assertFalse($this->SeoUri->SeoMetaTag->hasAny(array('id' => 1)));
		$this->assertFalse($this->SeoUri->SeoMetaTag->hasAny(array('id' => 2)));
	}
	
	function testDeleteUriDeleteRedirect(){
		$this->assertTrue($this->SeoUri->SeoRedirect->hasAny(array('id' => 7)));
		$this->SeoUri->delete(7);
		$this->assertFalse($this->SeoUri->SeoRedirect->hasAny(array('id' => 7)));
	}

	function endTest() {
		unset($this->SeoUri);
		ClassRegistry::flush();
	}

}
?>