<?php
App::import('Lib','Seo.SeoUtil');
class SeoUtilTest extends CakeTestCase {
	function testLoad(){
		$this->assertTrue(SeoUtil::loadSeoError());
	}
}
?>