<?php 
class SeoSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $seo_a_b_tests = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'key' => 'index'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'roll' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'int based roll or Model::function callback', 'charset' => 'utf8'),
		'testable' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 200, 'collate' => 'utf8_general_ci', 'comment' => 'model callback or empty', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '999', 'length' => 4, 'key' => 'index', 'comment' => 'lower the priority, the more priority it has over the other tests.'),
		'redmine' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'redmine ticket id'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'start_date' => array('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'if null, we ignore it.'),
		'end_date' => array('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'if null, we ignore it.'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'slug' => array('column' => 'slug', 'unique' => 1),
			'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0),
			'is_active' => array('column' => 'is_active', 'unique' => 0),
			'priority' => array('column' => 'priority', 'unique' => 0),
			'end_date' => array('column' => 'end_date', 'unique' => 0),
			'start_date' => array('column' => 'start_date', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_blacklists = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ip_range_start' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'ip_range_end' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'ip_range_start' => array('column' => 'ip_range_start', 'unique' => 0),
			'ip_range_end' => array('column' => 'ip_range_end', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_canonicals = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'canonical' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0),
			'is_active' => array('column' => 'is_active', 'unique' => 0),
			'created' => array('column' => 'created', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_honeypot_visits = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'ip' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'ip' => array('column' => 'ip', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_meta_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'content' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_http_equiv' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_redirects = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'redirect' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100'),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'callback' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'is_nocache' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_search_terms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'term' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'The term found by Google', 'charset' => 'utf8'),
		'uri' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'The URL this term points to', 'charset' => 'utf8'),
		'count' => array('type' => 'integer', 'null' => false, 'default' => null, 'comment' => 'how many times this term has been searched for'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_status_codes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'seo_uri_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'status_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3),
		'priority' => array('type' => 'integer', 'null' => false, 'default' => '100', 'length' => 4),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'seo_uri_id' => array('column' => 'seo_uri_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	public $seo_titles = array(
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

	public $seo_uris = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'uri' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'is_approved' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'uri' => array('column' => 'uri', 'unique' => 1),
			'is_approved' => array('column' => 'is_approved', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	public $seo_urls = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_bin', 'charset' => 'utf8'),
		'priority' => array('type' => 'float', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'url' => array('column' => 'url', 'unique' => 1),
			'priority' => array('column' => 'priority', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_bin', 'engine' => 'MyISAM')
	);

}
