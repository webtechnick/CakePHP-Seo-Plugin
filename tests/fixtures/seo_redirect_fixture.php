<?php
/* SeoRedirect Fixture generated on: 2010-10-05 18:10:19 : 1286323699 */
class SeoRedirectFixture extends CakeTestFixture {
	var $name = 'SeoRedirect';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'uri' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'redirect' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'callback' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'uri' => '/blah',
			'redirect' => '/',
			'callback' => '',
			'priority' => 10,
			'is_active' => 1,
			'is_approved' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 2,
			'uri' => '/blahblah*',
			'redirect' => '/new',
			'callback' => '',
			'priority' => 5,
			'is_active' => 1,
			'is_approved' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 3,
			'uri' => '/not_active',
			'redirect' => '/',
			'callback' => '',
			'priority' => 1,
			'is_active' => 0,
			'is_approved' => 0,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 4,
			'uri' => '/blahblahblah*',
			'redirect' => '/priority',
			'callback' => '',
			'priority' => 1,
			'is_active' => 1,
			'is_approved' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 5,
			'uri' => '#(.*)\?from\=sb\-tracked\:(.*)#i',
			'redirect' => '$1',
			'callback' => '',
			'priority' => 10,
			'is_active' => 1,
			'is_approved' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 6,
			'uri' => '#(.*)#i',
			'redirect' => '/',
			'callback' => '',
			'priority' => 1,
			'is_active' => 1,
			'is_approved' => 0,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 7,
			'uri' => '#/qas/(.*)#',
			'redirect' => '/questions/$1',
			'callback' => '',
			'priority' => 1,
			'is_active' => 1,
			'is_approved' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 8,
			'uri' => '/uri',
			'redirect' => '/{callback}',
			'callback' => 'SeoRedirect::callbackTest',
			'priority' => 1,
			'is_active' => 1,
			'is_approved' => 1,
			'created' => '2010-10-05 18:08:19'
		),
	);
}
?>