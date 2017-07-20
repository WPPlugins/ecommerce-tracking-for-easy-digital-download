<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/includes
 * @author     multidots <jaydeep.rami@multidots.in>
 */
class Ecommerce_Tracking_For_Easy_Digital_Download {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ecommerce_Tracking_For_Easy_Digital_Download_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'ecommerce-tracking-for-easy-digital-download';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ecommerce_Tracking_For_Easy_Digital_Download_Loader. Orchestrates the hooks of the plugin.
	 * - Ecommerce_Tracking_For_Easy_Digital_Download_i18n. Defines internationalization functionality.
	 * - Ecommerce_Tracking_For_Easy_Digital_Download_Admin. Defines all hooks for the admin area.
	 * - Ecommerce_Tracking_For_Easy_Digital_Download_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ecommerce-tracking-for-easy-digital-download-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ecommerce-tracking-for-easy-digital-download-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ecommerce-tracking-for-easy-digital-download-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ecommerce-tracking-for-easy-digital-download-public.php';

		$this->loader = new Ecommerce_Tracking_For_Easy_Digital_Download_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ecommerce_Tracking_For_Easy_Digital_Download_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ecommerce_Tracking_For_Easy_Digital_Download_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ecommerce_Tracking_For_Easy_Digital_Download_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'edd_settings_tabs', $plugin_admin, 'custom_edd_settings_tabs',10,1 );
		$this->loader->add_action( 'edd_settings_sections', $plugin_admin, 'custom_edd_settings_sections',20,1 );
		$this->loader->add_action( 'edd_registered_settings', $plugin_admin, 'custom_edd_registered_settings',20,1 ); 
		
		$this->loader->add_action( 'wp_ajax_add_plugin_user_etfedd', $plugin_admin, 'wp_add_plugin_userfn' );
		$this->loader->add_action( 'wp_ajax_hide_subscribe_etfedd', $plugin_admin, 'hide_subscribe_etfeddfn');
		
		
		
		$this->loader->add_action('admin_init', $plugin_admin, 'welcome_easy_digital_download_ecommerce_conversion_tracking_screen_do_activation_redirect');
		$this->loader->add_action('admin_menu', $plugin_admin, 'welcome_pages_screen_easy_digital_download_ecommerce_conversion_tracking');
		
		
		$this->loader->add_action('easy_digital_download_ecommerce_conversion_tracking_other_plugins', $plugin_admin, 'easy_digital_download_ecommerce_conversion_tracking_other_plugins');
		$this->loader->add_action('easy_digital_download_ecommerce_conversion_tracking_about', $plugin_admin, 'easy_digital_download_ecommerce_conversion_tracking_about');
		$this->loader->add_action('admin_print_footer_scripts',  $plugin_admin, 'easy_digital_download_ecommerce_conversion_pointers_footer');
		$this->loader->add_action( 'admin_menu',  $plugin_admin, 'welcome_screen_easy_digital_download_ecommerce_conversion_remove_menus', 999 );
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ecommerce_Tracking_For_Easy_Digital_Download_Public( $this->get_plugin_name(), $this->get_version() );
		
		//Check Facebook Conversion is Enable
		$ecommerce_setting_arr = get_option('edd_settings');

		//Get google conversion is check or not.
		$ecommerce_tracking_settings_enable_google_conversion = !empty( $ecommerce_setting_arr['enable_google_conversion'] ) ? $ecommerce_setting_arr['enable_google_conversion'] : '';
		
		//Get facebook conversion is check or not.
		$ecommerce_tracking_settings_enable_facebook_conversion =  !empty( $ecommerce_setting_arr['enable_facebook_conversion'] ) ? $ecommerce_setting_arr['enable_facebook_conversion'] : '';
		
		//Get Ecommerce tracking is enable or not.
		$ecommerce_tracking_settings_enable =  !empty( $ecommerce_setting_arr['enable_ecommerce_setting'] ) ? $ecommerce_setting_arr['enable_ecommerce_setting'] : '';
		
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		//Check facebook conversion checkbox is check or not.
		if ( !empty($ecommerce_tracking_settings_enable_facebook_conversion) && $ecommerce_tracking_settings_enable_facebook_conversion == '1' ) {
			$this->loader->add_action( 'edd_payment_receipt_after', $plugin_public, 'custom_ecommerce_fb_conversion_tracking',10,1 );
		}
		
		//Check google conversion checkbox is check or not.
		if ( !empty($ecommerce_tracking_settings_enable_google_conversion) && $ecommerce_tracking_settings_enable_google_conversion == '1' ) {
			$this->loader->add_action( 'edd_payment_receipt_after', $plugin_public, 'custom_ecommerce_google_conversion_tracking',10,1 );
		}
		
		//Check ecommerce tracking is enable or not.
		if( !empty( $ecommerce_tracking_settings_enable ) && $ecommerce_tracking_settings_enable == '1'){ 
			$this->loader->add_action( 'edd_payment_receipt_after', $plugin_public, 'custom_ecommerce_tracking',10,1 );
		} 
		$this->loader->add_action('edd_paypal_redirect_args',$plugin_public,'paypal_bn_code_filter', 99, 1);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ecommerce_Tracking_For_Easy_Digital_Download_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
