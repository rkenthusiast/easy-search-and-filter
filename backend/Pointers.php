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

use Easy_Search_And_Filter\Engine\Base;

/**
 * All the WP pointers.
 */
class Pointers extends Base {

	/**
	 * Initialize the Pointers.
	 *
	 * @since 1.0.0
	 * @return void|bool
	 */
	public function initialize() {
		parent::initialize();

		new \PointerPlus( array( 'prefix' => ESAF_TEXTDOMAIN ) );
		\add_filter( ESAF_TEXTDOMAIN . '-pointerplus_list', array( $this, 'custom_initial_pointers' ), 10, 2 );
	}

	/**
	 * Add pointers.
	 * Check on https://github.com/wpbp/pointerplus/blob/master/pointerplus.php for examples
	 *
	 * @param array  $pointers The list of pointers.
	 * @param string $prefix   For your pointers.
	 * @since 1.0.0
	 * @return array
	 */
	public function custom_initial_pointers( array $pointers, string $prefix ) {
		return \array_merge(
			$pointers,
			array(
				$prefix . '_contextual_help' => array(
					'selector'   => '.ui-tabs-anchor#ui-id-2',
					'title'      => \__( 'Boilerplate Help', ESAF_TEXTDOMAIN ),
					'text'       => \__( 'A pointer for help tab.<br>Go to Posts, Pages or Users for other pointers.', ESAF_TEXTDOMAIN ),
					'edge'       => 'top',
					'align'      => 'left',
					'icon_class' => 'dashicons-welcome-learn-more',
				),
			)
		);
	}

}
