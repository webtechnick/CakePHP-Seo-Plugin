<?php
/**
 * SeoRedirectFixture
 *
 */
class SeoRedirectFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'redirect' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'callback' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'is_nocache' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)
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
			'seo_uri_id' => 1,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 1,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 2,
			'seo_uri_id' => 2,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 2,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 3,
			'seo_uri_id' => 3,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 3,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 4,
			'seo_uri_id' => 4,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 4,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 5,
			'seo_uri_id' => 5,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 5,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 6,
			'seo_uri_id' => 6,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 6,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 7,
			'seo_uri_id' => 7,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 7,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 8,
			'seo_uri_id' => 8,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 8,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 9,
			'seo_uri_id' => 9,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 9,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
		array(
			'id' => 10,
			'seo_uri_id' => 10,
			'redirect' => 'Lorem ipsum dolor sit amet',
			'priority' => 10,
			'is_active' => 1,
			'callback' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:42:46',
			'modified' => '2013-04-19 11:42:46',
			'is_nocache' => 0
		),
	);

}
