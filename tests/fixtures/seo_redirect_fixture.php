<?php
/* SeoRedirect Fixture generated on: 2010-10-05 18:10:19 : 1286323699 */
class SeoRedirectFixture extends CakeTestFixture {
	var $name = 'SeoRedirect';

	var $import = array('model' => 'SeoRedirect');

	var $records = array(
		array(
			'id' => 1,
			'seo_uri_id' => 1,
			'redirect' => '/',
			'callback' => '',
			'priority' => 10,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 2,
			'seo_uri_id' => 2,
			'redirect' => '/new',
			'callback' => '',
			'priority' => 5,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 3,
			'seo_uri_id' => 3,
			'redirect' => '/',
			'callback' => '',
			'priority' => 1,
			'is_active' => 0,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 4,
			'seo_uri_id' => 4,
			'redirect' => '/priority',
			'callback' => '',
			'priority' => 1,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 5,
			'seo_uri_id' => 5,
			'redirect' => '$1',
			'callback' => '',
			'priority' => 10,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 6,
			'seo_uri_id' => 6,
			'redirect' => '/',
			'callback' => '',
			'priority' => 1,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 7,
			'seo_uri_id' => 7,
			'redirect' => '/questions/$1',
			'callback' => '',
			'priority' => 1,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
		array(
			'id' => 8,
			'seo_uri_id' => 8,
			'redirect' => '/{callback}',
			'callback' => 'SeoRedirect::callbackTest',
			'priority' => 1,
			'is_active' => 1,
			'created' => '2010-10-05 18:08:19'
		),
	);
}
?>