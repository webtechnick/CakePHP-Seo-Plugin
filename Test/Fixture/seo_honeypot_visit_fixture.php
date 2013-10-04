<?php
/* SeoHoneypotVisit Fixture generated on: 2011-02-02 19:03:42 : 1296698622 */
class SeoHoneypotVisitFixture extends CakeTestFixture {
	var $name = 'SeoHoneypotVisit';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'ip' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'ip' => 2147483000,
			'created' => '2011-01-01 19:03:42'
		),
	);
}
?>