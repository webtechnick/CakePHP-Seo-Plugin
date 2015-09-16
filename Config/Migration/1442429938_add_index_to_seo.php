<?php
class AddIndexToSeo extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'seo_redirects' => array(
					'indexes' => array(
						'is_active' => array('column' => 'is_active', 'unique' => 0),
						'priority' => array('column' => 'priority', 'unique' => 0),
					),
				),
				'seo_status_codes' => array(
					'indexes' => array(
						'is_active' => array('column' => 'is_active', 'unique' => 0),
						'priority' => array('column' => 'priority', 'unique' => 0),
					),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'seo_redirects' => array(
					'indexes' => array(
						'is_active',
						'priority',
					),
				),
				'seo_status_codes' => array(
					'indexes' => array(
						'is_active',
						'priority',
					),
				),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 */
	public function after($direction) {
		return true;
	}
}
