<?php
/**
 * Plugin Name: Content Locker for Elementor
 * Plugin URI:  https://master-addons.com/restrict-content-for-elementor/
 * Description: Fast and Easy Elementor way to Restrict your Content. Content Locker for Elementor will give you full independncy over Contents like memebership websites.
 * Version:     1.0.3
 * Author:      Jewel Theme
 * Author URI:  https://jeweltheme.com
 * Text Domain: content-locker-for-elementor
 * Domain Path: languages/
 * License:     GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package content-locker-for-elementor
 */

/*
 * don't call the file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( esc_html__( 'You can\'t access this page', 'content-locker-for-elementor' ) );
}

$jltelcl_plugin_data = get_file_data(
	__FILE__,
	array(
		'Version'     => 'Version',
		'Plugin Name' => 'Plugin Name',
		'Author'      => 'Author',
		'Description' => 'Description',
		'Plugin URI'  => 'Plugin URI',
	),
	false
);

// Define Constants.
if ( ! defined( 'JLTELCL' ) ) {
	define( 'JLTELCL', $jltelcl_plugin_data['Plugin Name'] );
}

if ( ! defined( 'JLTELCL_VER' ) ) {
	define( 'JLTELCL_VER', $jltelcl_plugin_data['Version'] );
}

if ( ! defined( 'JLTELCL_AUTHOR' ) ) {
	define( 'JLTELCL_AUTHOR', $jltelcl_plugin_data['Author'] );
}

if ( ! defined( 'JLTELCL_DESC' ) ) {
	define( 'JLTELCL_DESC', $jltelcl_plugin_data['Author'] );
}

if ( ! defined( 'JLTELCL_URI' ) ) {
	define( 'JLTELCL_URI', $jltelcl_plugin_data['Plugin URI'] );
}

if ( ! defined( 'JLTELCL_DIR' ) ) {
	define( 'JLTELCL_DIR', __DIR__ );
}

if ( ! defined( 'JLTELCL_FILE' ) ) {
	define( 'JLTELCL_FILE', __FILE__ );
}

if ( ! defined( 'JLTELCL_SLUG' ) ) {
	define( 'JLTELCL_SLUG', dirname( plugin_basename( __FILE__ ) ) );
}

if ( ! defined( 'JLTELCL_BASE' ) ) {
	define( 'JLTELCL_BASE', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'JLTELCL_PATH' ) ) {
	define( 'JLTELCL_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'JLTELCL_URL' ) ) {
	define( 'JLTELCL_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
}

if ( ! defined( 'JLTELCL_INC' ) ) {
	define( 'JLTELCL_INC', JLTELCL_PATH . '/Inc/' );
}

if ( ! defined( 'JLTELCL_LIBS' ) ) {
	define( 'JLTELCL_LIBS', JLTELCL_PATH . 'Libs' );
}

if ( ! defined( 'JLTELCL_ASSETS' ) ) {
	define( 'JLTELCL_ASSETS', JLTELCL_URL . 'assets/' );
}

if ( ! defined( 'JLTELCL_IMAGES' ) ) {
	define( 'JLTELCL_IMAGES', JLTELCL_ASSETS . 'images' );
}

if ( ! class_exists( '\\JLTELCL\\JLT_Elementor_Content_Locker' ) ) {
	// Autoload Files.
	include_once JLTELCL_DIR . '/vendor/autoload.php';
	// Instantiate JLT_Elementor_Content_Locker Class.
	include_once JLTELCL_DIR . '/class-content-locker-for-elementor.php';
}