<?php
/**
 * SeoHoneypotVisitFixture
 *
 */
class SeoHoneypotVisitFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ip' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'ip' => array('column' => 'ip', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 2,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 3,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 4,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 5,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 6,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 7,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 8,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 9,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
		array(
			'id' => 10,
			'ip' => '',
			'created' => '2013-04-19 11:42:25'
		),
	);

}
