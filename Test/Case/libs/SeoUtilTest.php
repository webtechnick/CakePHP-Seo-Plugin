<?php
App::uses('SeoUtil', 'Seo.Lib');
class SeoUtilTest extends CakeTestCase {
	function testLoad(){
		$this->assertTrue(SeoUtil::loadSeoError());
	}
}
?>