<?php
/* SeoUri Fixture generated on: 2011-01-03 10:01:34 : 1294074274 */
class SeoUriFixture extends CakeTestFixture {
	var $name = 'SeoUri';
	
	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'uri' => array('type' => 'string', 'null' => true, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'uri' => array('column' => 'uri', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);


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
		array(
			'id' => 16,
			'uri' => '/canonical',
			'is_approved' => 1,
			'created' => '2011-01-03 10:04:34',
			'modified' => '2011-01-03 10:04:34'
		),
	);
}
?>