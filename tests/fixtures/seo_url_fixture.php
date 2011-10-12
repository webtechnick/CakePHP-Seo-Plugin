<?php
/* SeoUrl Fixture generated on: 2011-10-10 17:54:18 : 1318290858 */
class SeoUrlFixture extends CakeTestFixture {
	var $name = 'SeoUrl';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'priority' => array('type' => 'float', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'url' => array('column' => 'url', 'unique' => 1), 'priority' => array('column' => 'priority', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'url' => '/some_other_url',
			'priority' => .5,
			'created' => '2011-10-10 16:42:47',
			'modified' => '2011-10-10 16:42:47'
		),
		array(
			'id' => 2,
			'url' => '/some_other',
			'priority' => .5,
			'created' => '2011-10-10 16:42:47',
			'modified' => '2011-10-10 16:42:47'
		),
		array(
			'id' => 3,
			'url' => '/some',
			'priority' => .5,
			'created' => '2011-10-10 16:42:47',
			'modified' => '2011-10-10 16:42:47'
		),
		array(
			'id' => 4,
			'url' => '/',
			'priority' => 1,
			'created' => '2011-10-10 16:42:47',
			'modified' => '2011-10-10 16:42:47'
		),
		array(
			'id' => 5,
			'url' => '/content/Hearing-loss/Treatments',
			'priority' => 1,
			'created' => '2011-10-10 16:42:47',
			'modified' => '2011-10-10 16:42:47'
		),
		array(
			'id' => 6,
			'url' => '/content/articles/Hearing-loss/Protection/30207-Attention-couch-potatoes-time',
			'priority' => 1,
			'created' => '2011-10-10 16:42:47',
			'modified' => '2011-10-10 16:42:47'
		),
	);
}
