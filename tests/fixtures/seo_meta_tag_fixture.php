<?php
/* SeoMetaTag Fixture generated on: 2011-01-03 10:01:07 : 1294074247 */
class SeoMetaTagFixture extends CakeTestFixture {
	var $name = 'SeoMetaTag';
	
	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_http_equiv' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'seo_uri_id' => 9,
			'name' => 'keywords',
			'content' => 'content_1',
			'is_http_equiv' => 0,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
		array(
			'id' => 2,
			'seo_uri_id' => 9,
			'name' => 'description',
			'content' => 'content_2',
			'is_http_equiv' => 0,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
		array(
			'id' =>3,
			'seo_uri_id' => 10,
			'name' => 'content-type',
			'content' => 'text/html',
			'is_http_equiv' => 1,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
		array(
			'id' => 4,
			'seo_uri_id' => 11,
			'name' => 'default',
			'content' => 'content_default',
			'is_http_equiv' => 0,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
		array(
			'id' => 5,
			'seo_uri_id' => 11,
			'name' => 'description_default',
			'content' => 'content_default_2',
			'is_http_equiv' => 0,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
		array(
			'id' => 6,
			'seo_uri_id' => 12,
			'name' => 'direct_match',
			'content' => 'direct_match_content',
			'is_http_equiv' => 0,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
		array(
			'id' => 7,
			'seo_uri_id' => 13,
			'name' => 'wild_card_match',
			'content' => 'wild_card_match_content',
			'is_http_equiv' => 0,
			'created' => '2011-01-03 10:04:07',
			'modified' => '2011-01-03 10:04:07'
		),
	);
}
?>