<?php
/* SeoStatusCode Fixture generated on: 2011-07-25 17:06:20 : 1311635180 */
class SeoStatusCodeFixture extends CakeTestFixture {
	var $name = 'SeoStatusCode';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'status_code' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 3),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100', 'length' => 4),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'seo_uri_id' => 15,
			'status_code' => 410,
			'priority' => 100,
			'is_active' => 1,
			'created' => '2011-07-25 17:06:20',
			'modified' => '2011-07-25 17:06:20'
		),
	);
}
