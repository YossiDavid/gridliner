<?php
if (!defined('ABSPATH')) exit;

/**
 * Plugin Name: Gridliner
 * Author: Yossi David
 * Author URI: https://shos.digital
 * Version: 1.0.1
 * Description: Add the Styliner grid system to Elementor editor, and enable it on the Elementor system preferences
 * Text Domain: gridliner
 */

add_filter( 'plugin_row_meta' , function ( $links_array, $plugin_file_name, $plugin_data, $status ) {
	if ( strpos( $plugin_file_name, basename( __FILE__ ) ) ) {

		// You can still use `array_unshift()` to add links at the beginning.
		$links_array[] = '<a href="https://schooliner.com/" target="_blank">סקוליינר</a>';
		$links_array[] = '<a href="https://schooliner.com/links/" target="_blank">הצטרפו לקבוצת הוואטסאפ</a>';
		$links_array[] = '<a href="https://wa.me/972559983109/" target="_blank">פיתוח תוספים לוורדפרס</a>';
	}

	return $links_array;
}, 10, 4 );

// this adds scripts to the preview iframe of the editor
add_action('elementor/preview/enqueue_scripts', function () {
	$handle = 'gridliner';
	// jquery is a needed dependency for elementor events
	wp_register_script( $handle, plugins_url( 'src/index.js', __FILE__ ), [ 'jquery' ] );
	wp_enqueue_script( $handle );
});

// this adds scripts to the editor panel
add_action('elementor/editor/after_enqueue_scripts', function () {
	$handle = 'gridliner_panel';
	// jquery is a needed dependency for elementor events
	wp_register_script( $handle, plugins_url( 'src/editor.js', __FILE__ ), [ 'jquery' ] );
	wp_enqueue_script( $handle );
});

add_action('elementor/preview/enqueue_styles', function () {
	wp_register_style( 'gridliner', plugins_url( 'src/index.css', __FILE__ ) );
	wp_enqueue_style( 'gridliner' );
});

add_action('elementor/editor/init', function () {
	require_once plugin_dir_path( __FILE__ ) . '/grid-settings.php';
});

//Update Manager
require plugin_dir_path( __FILE__ ) . 'plugin-update-checker-master/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/YossiDavid/gridliner',
	__FILE__, //Full path to the main plugin file or functions.php.
	'gridliner'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
