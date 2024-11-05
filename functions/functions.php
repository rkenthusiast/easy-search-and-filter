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

/**
 * Get the settings of the plugin in a filterable way
 *
 * @since 1.0.0
 * @return array
 */
function esaf_get_settings() {
	return apply_filters( 'esaf_get_settings', get_option( ESAF_TEXTDOMAIN . '-settings' ) );
}
