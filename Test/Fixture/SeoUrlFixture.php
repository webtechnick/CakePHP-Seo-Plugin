<?php
/**
 * SeoUrlFixture
 *
 */
class SeoUrlFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'priority' => array('type' => 'float', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'url' => array('column' => 'url', 'unique' => 1),
			'priority' => array('column' => 'priority', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 1,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 2,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 2,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 3,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 3,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 4,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 4,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 5,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 5,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 6,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 6,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 7,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 7,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 8,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 8,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 9,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 9,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
		array(
			'id' => 10,
			'url' => 'Lorem ipsum dolor sit amet',
			'priority' => 10,
			'created' => '2013-04-19 11:43:35',
			'modified' => '2013-04-19 11:43:35'
		),
	);

}
