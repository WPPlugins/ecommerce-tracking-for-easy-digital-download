<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.multidots.com/
 * @since             1.0.0
 * @package           Ecommerce_Tracking_For_Easy_Digital_Download
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Digital Download Ecommerce Conversion Tracking
 * Plugin URI:        multidots.com
 * Description:       Easy Digital Download Ecommerce Conversion Tracking plugin is for these who wants to use Ecommerce tracking, Facebook Conversion, Google Conversion into your Easy Digital Download plugin site. This plugin will boost your business and Enhance your marketing.
 * Version:           1.0.2
 * Author:            multidots
 * Author URI:        http://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ecommerce-tracking-for-easy-digital-download
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ecommerce-tracking-for-easy-digital-download-activator.php
 */
function activate_ecommerce_tracking_for_easy_digital_download() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ecommerce-tracking-for-easy-digital-download-activator.php';
	Ecommerce_Tracking_For_Easy_Digital_Download_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ecommerce-tracking-for-easy-digital-download-deactivator.php
 */
function deactivate_ecommerce_tracking_for_easy_digital_download() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ecommerce-tracking-for-easy-digital-download-deactivator.php';
	Ecommerce_Tracking_For_Easy_Digital_Download_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ecommerce_tracking_for_easy_digital_download' );
register_deactivation_hook( __FILE__, 'deactivate_ecommerce_tracking_for_easy_digital_download' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ecommerce-tracking-for-easy-digital-download.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ecommerce_tracking_for_easy_digital_download() {

	$plugin = new Ecommerce_Tracking_For_Easy_Digital_Download();
	$plugin->run();

}
run_ecommerce_tracking_for_easy_digital_download();
