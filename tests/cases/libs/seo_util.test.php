<?php
App::import('Lib','Seo.SeoUtil');
class SeoUtilTestCase extends CakeTestCase {
	function testLoad(){
		$this->assertTrue(SeoUtil::loadSeoError());
	}
}
?>