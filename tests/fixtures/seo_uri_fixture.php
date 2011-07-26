<?php
/* SeoUri Fixture generated on: 2011-01-03 10:01:34 : 1294074274 */
class SeoUriFixture extends CakeTestFixture {
	var $name = 'SeoUri';
	var $import = array('model' => 'SeoUri');


	var $records = array(
		array(
			'id' => 1,
			'uri' => '/blah',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 2,
			'uri' => '/blahblah*',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 3,
			'uri' => '/not_active',
			'is_approved' => 0,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 4,
			'uri' => '/blahblahblah*',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 5,
			'uri' => '#(.*)\?from\=sb\-tracked\:(.*)#i',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 6,
			'uri' => '#(.*)#i',
			'is_approved' => 0,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 7,
			'uri' => '#/qas/(.*)#',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 8,
			'uri' => '/uri',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 9,
			'uri' => '/uri_for_meta',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 10,
			'uri' => '/uri_for_meta_equiv',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 11,
			'uri' => '#/uri_for_meta_reg_ex/(.*)#',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 12,
			'uri' => '/uri_for_meta_reg_ex/this_is_direct_match',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 13,
			'uri' => '/uri_for_meta_wild_card/*',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 14,
			'uri' => '/uri with spaces',
			'is_approved' => 0,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
		array(
			'id' => 15,
			'uri' => '/status_gone',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
	);
}
?>