<?php
/* SeoTitle Fixture generated on: 2011-01-05 18:01:00 : 1294276500 */
class SeoTitleFixture extends CakeTestFixture {
	var $name = 'SeoTitle';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'seo_uri_id' => 1,
			'title' => 'Title',
			'created' => '2011-01-05 18:15:00',
			'modified' => '2011-01-05 18:15:00'
		),
	);
}
?>