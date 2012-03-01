<?php
App::uses('SeoUtil', 'Seo.Lib');

class SeoUtilTest extends CakeTestCase {
	public function testLoad() {
		$this->assertTrue(SeoUtil::loadSeoError());
	}
}

