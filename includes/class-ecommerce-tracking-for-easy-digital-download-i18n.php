<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/includes
 * @author     multidots <jaydeep.rami@multidots.in>
 */
class Ecommerce_Tracking_For_Easy_Digital_Download_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ecommerce-tracking-for-easy-digital-download',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
