<?php

/**
 * Easy_Search_And_Filter
 *
 * @package   Easy_Search_And_Filter
 * @author    RK Enthusiast <rkenthusiast@gmail.com>
 * @copyright 2024 RK
 * @license   GPL 2.0+
 * @link      http://rkenthusiast.com
 */

namespace Easy_Search_And_Filter\Integrations;

use Easy_Search_And_Filter\Engine\Base;

/**
 * The various Cron of this plugin
 */
class Cron extends Base {

	/**
	 * Initialize the class.
	 *
	 * @return void|bool
	 */
	public function initialize() {
		/*
		 * Load CronPlus
		 */
		$args = array(
			'recurrence'       => 'hourly',
			'schedule'         => 'schedule',
			'name'             => 'hourly_cron',
			'cb'               => array( $this, 'hourly_cron' ),
			'plugin_root_file' => 'easy-search-and-filter.php',
		);

		$cronplus = new \CronPlus( $args );
		// Schedule the event
		$cronplus->schedule_event();
		// Remove the event by the schedule
		// $cronplus->clear_schedule_by_hook();
		// Jump the scheduled event
		// $cronplus->unschedule_specific_event();
	}

	/**
	 * Cron Hourly example
	 *
	 * @since 1.0.0
	 * @param int $id The ID.
	 * @return void
	 */
	public function hourly_cron( int $id ) {
		echo \esc_html( (string) $id );
	}

}
