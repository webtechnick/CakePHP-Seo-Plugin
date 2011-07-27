<?php
/* SeoBlacklist Fixture generated on: 2011-02-02 11:19:31 : 1296670771 */
class SeoBlacklistFixture extends CakeTestFixture {
	var $name = 'SeoBlacklist';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'ip_range_start' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'index'),
		'ip_range_end' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'index'),
		'note' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ip_range_start' => array('column' => 'ip_range_start', 'unique' => 0), 'ip_range_end' => array('column' => 'ip_range_end', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'ip_range_start' => 2147483000,
			'ip_range_end' => 2147483002,
			'note' => 'This is a note',
			'is_active' => 1,
			'created' => '2011-02-02 11:19:31',
			'modified' => '2011-02-02 11:19:31'
		),
		array(
			'id' => 2,
			'ip_range_start' => 2147483100,
			'ip_range_end' => 2147483100,
			'note' => 'This is a note',
			'is_active' => 0, //not active
			'created' => '2011-02-02 11:19:31',
			'modified' => '2011-02-02 11:19:31'
		),
	);
}
?>