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

$esaf_debug = new WPBP_Debug( __( 'Easy Search And Filter', ESAF_TEXTDOMAIN ) );

/**
 * Log text inside the debugging plugins.
 *
 * @param string $text The text.
 * @return void
 */
function esaf_log( string $text ) {
	global $esaf_debug;
	$esaf_debug->log( $text );
}
