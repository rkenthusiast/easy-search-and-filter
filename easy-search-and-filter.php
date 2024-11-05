<?php

/**
 * @package   Easy_Search_And_Filter
 * @author    RK Enthusiast <rkenthusiast@gmail.com>
 * @copyright 2024 RK
 * @license   GPL 2.0+
 * @link      http://rkenthusiast.com
 *
 * Plugin Name:     Easy Search And Filter
 * Plugin URI:      @TODO
 * Description:     @TODO
 * Version:         1.0.0
 * Author:          RK Enthusiast
 * Author URI:      http://rkenthusiast.com
 * Text Domain:     easy-search-and-filter
 * License:         GPL 2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:     /languages
 * Requires PHP:    7.4
 * WordPress-Plugin-Boilerplate-Powered: v3.3.0
 */

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	die( 'We\'re sorry, but you can not directly access this file.' );
}

define( 'ESAF_VERSION', '1.0.0' );
define( 'ESAF_TEXTDOMAIN', 'easy-search-and-filter' );
define( 'ESAF_NAME', 'Easy Search And Filter' );
define( 'ESAF_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'ESAF_PLUGIN_ABSOLUTE', __FILE__ );
define( 'ESAF_MIN_PHP_VERSION', '7.4' );
define( 'ESAF_WP_VERSION', '5.3' );

add_action(
	'init',
	static function () {
		load_plugin_textdomain( ESAF_TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	);


$easy_search_and_filter_libraries = require ESAF_PLUGIN_ROOT . 'vendor/autoload.php'; //phpcs:ignore

require_once ESAF_PLUGIN_ROOT . 'functions/functions.php';
require_once ESAF_PLUGIN_ROOT . 'functions/debug.php';

// Add your new plugin on the wiki: https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate

$requirements = new \Micropackage\Requirements\Requirements(
	'Easy Search And Filter',
	array(
		'php'            => ESAF_MIN_PHP_VERSION,
		'php_extensions' => array( 'mbstring' ),
		'wp'             => ESAF_WP_VERSION,
		// 'plugins'            => array(
		// array( 'file' => 'hello-dolly/hello.php', 'name' => 'Hello Dolly', 'version' => '1.5' )
		// ),
	)
);

if ( ! $requirements->satisfied() ) {
	$requirements->print_notice();

	return;
}


/**
 * Create a helper function for easy SDK access.
 *
 * @global type $esaf_fs
 * @return object
 */
function esaf_fs() {
	global $esaf_fs;

	if ( !isset( $esaf_fs ) ) {
		require_once ESAF_PLUGIN_ROOT . 'vendor/freemius/wordpress-sdk/start.php';
		$esaf_fs = fs_dynamic_init(
			array(
				'id'             => '',
				'slug'           => 'easy-search-and-filter',
				'public_key'     => '',
				'is_live'        => false,
				'is_premium'     => true,
				'has_addons'     => false,
				'has_paid_plans' => true,
				'menu'           => array(
					'slug' => 'easy-search-and-filter',
				),
			)
		);

		if ( $esaf_fs->is_premium() ) {
			$esaf_fs->add_filter(
				'support_forum_url',
				static function ( $wp_org_support_forum_url ) { //phpcs:ignore
					return 'https://your-url.test';
				}
			);
		}
	}

	return $esaf_fs;
}

// esaf_fs();

// Documentation to integrate GitHub, GitLab or BitBucket https://github.com/YahnisElsts/plugin-update-checker/blob/master/README.md
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

PucFactory::buildUpdateChecker( 'https://github.com/user-name/repo-name/', __FILE__, 'unique-plugin-or-theme-slug' );

if ( ! wp_installing() ) {
	register_activation_hook( ESAF_TEXTDOMAIN . '/' . ESAF_TEXTDOMAIN . '.php', array( new \Easy_Search_And_Filter\Backend\ActDeact, 'activate' ) );
	register_deactivation_hook( ESAF_TEXTDOMAIN . '/' . ESAF_TEXTDOMAIN . '.php', array( new \Easy_Search_And_Filter\Backend\ActDeact, 'deactivate' ) );
	add_action(
		'plugins_loaded',
		static function () use ( $easy_search_and_filter_libraries ) {
			new \Easy_Search_And_Filter\Engine\Initialize( $easy_search_and_filter_libraries );
		}
	);
}
