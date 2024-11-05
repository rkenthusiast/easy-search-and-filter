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

namespace Easy_Search_And_Filter\Backend;

use I18n_Notice_WordPressOrg;
use Easy_Search_And_Filter\Engine\Base;

/**
 * Everything that involves notification on the WordPress dashboard
 */
class Notices extends Base {

	/**
	 * Initialize the class
	 *
	 * @return void|bool
	 */
	public function initialize() {
		if ( !parent::initialize() ) {
			return;
		}

		\wpdesk_wp_notice( \__( 'Updated Messages', ESAF_TEXTDOMAIN ), 'updated' );

		$builder = new \Page_Madness_Detector(); // phpcs:ignore

		if ( $builder->has_entropy() ) {
			\wpdesk_wp_notice( \__( 'A Page Builder/Visual Composer was found on this website!', ESAF_TEXTDOMAIN ), 'error', true );
		}

		/*
		 * Review plugin notice.
		 */
		new \WP_Review_Me(
			array(
				'days_after' => 15,
				'type'       => 'plugin',
				'slug'       => ESAF_TEXTDOMAIN,
				'rating'     => 5,
				'message'    => \__( 'Review me!', ESAF_TEXTDOMAIN ),
				'link_label' => \__( 'Click here to review', ESAF_TEXTDOMAIN ),
			)
		);

		/*
		 * Alert after few days to suggest to contribute to the localization if it is incomplete
		 * on translate.wordpress.org, the filter enables to remove globally.
		 */
		if ( \apply_filters( 'easy_search_and_filter_alert_localization', true ) ) {
			new I18n_Notice_WordPressOrg(
			array(
				'textdomain'  => ESAF_TEXTDOMAIN,
				'easy_search_and_filter' => ESAF_NAME,
				'hook'        => 'admin_notices',
			),
			true
			);
		}

	}

}
