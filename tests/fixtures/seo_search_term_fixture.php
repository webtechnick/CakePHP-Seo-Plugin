<?php
/* SeoSearchTerm Fixture generated on: 2011-11-18 23:27:41 : 1321684061 */
class SeoSearchTermFixture extends CakeTestFixture {
	var $name = 'SeoSearchTerm';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'term' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'The term found by Google', 'charset' => 'utf8'),
		'uri' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'The URL this term points to', 'charset' => 'utf8'),
		'count' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'comment' => 'how many times this term has been searched for'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'term' => 'Lorem ipsum',
			'uri' => '/some_url',
			'count' => 1,
			'created' => '2011-11-18 23:27:41'
		),
	);
}
