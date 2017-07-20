<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/includes
 * @author     multidots <jaydeep.rami@multidots.in>
 */
class Ecommerce_Tracking_For_Easy_Digital_Download_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() { 
		
		if( !in_array( 'easy-digital-downloads/easy-digital-downloads.php',apply_filters('active_plugins',get_option('active_plugins'))) && !is_plugin_active_for_network( 'easy-digital-downloads/easy-digital-downloads.php' )   ) { 
			wp_die( "<strong>Easy Digital Download Ecommerce Conversion Tracking</strong> Plugin requires <strong>Easy Digital Download</strong> <a href='".get_admin_url(null, 'plugins.php')."'>Plugins page</a>." );
		}
		global $wpdb,$woocommerce;
		set_transient( '_easy_digital_download_ecommerce_conversion_tracking_welcome_screen', true, 30 );
	}

}
