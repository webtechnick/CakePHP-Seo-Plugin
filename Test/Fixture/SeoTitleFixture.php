<?php
/**
 * SeoTitleFixture
 *
 */
class SeoTitleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 2,
			'seo_uri_id' => 2,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 3,
			'seo_uri_id' => 3,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 4,
			'seo_uri_id' => 4,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 5,
			'seo_uri_id' => 5,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 6,
			'seo_uri_id' => 6,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 7,
			'seo_uri_id' => 7,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 8,
			'seo_uri_id' => 8,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 9,
			'seo_uri_id' => 9,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
		array(
			'id' => 10,
			'seo_uri_id' => 10,
			'title' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-04-19 11:41:34',
			'modified' => '2013-04-19 11:41:34'
		),
	);

}
