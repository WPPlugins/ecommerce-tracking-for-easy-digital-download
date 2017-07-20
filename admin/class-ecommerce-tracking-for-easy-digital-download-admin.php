<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/admin
 * @author     multidots <jaydeep.rami@multidots.in>
 */
class Ecommerce_Tracking_For_Easy_Digital_Download_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ecommerce_Tracking_For_Easy_Digital_Download_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ecommerce_Tracking_For_Easy_Digital_Download_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'wp-pointer' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ecommerce-tracking-for-easy-digital-download-admin.css', array('wp-jquery-ui-dialog'), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ecommerce_Tracking_For_Easy_Digital_Download_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ecommerce_Tracking_For_Easy_Digital_Download_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( 'wp-pointer' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ecommerce-tracking-for-easy-digital-download-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function custom_edd_settings_tabs( $tabs ) {
		
		$custom_tabs['ecommerce_tracking_settings'] = __( 'Ecommerce Tracking Settings', 'ecommerce-tracking-for-easy-digital-download' );
		
		$tabs = array_merge($tabs,$custom_tabs);
		
		return $tabs;
	}
	
	public function custom_edd_settings_sections( $sections ) {
		
		$custom_sections = array('ecommerce_tracking_settings' => array('main' => __('Ecommerce Tracking & Conversion Code Settings', 'ecommerce-tracking-for-easy-digital-download')));
		
		$sections = array_merge($sections,$custom_sections);
		
		return $sections;
	}
	
	public function custom_edd_registered_settings( $edd_settings ) {
		global $wpdb;
		$current_user = wp_get_current_user();
		if (!get_option('etfedd_plugin_notice_shown')) { 
			$subscrtion_script = '<div id="etfedd_dialog" title="Basic dialog"><p>Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free! </p> <p><input type="text" id="txt_user_sub_etfedd" class="regular-text" name="txt_user_sub_etfedd" value="'.$current_user->user_email.'"></p></div>';
		}
		else { 
			$subscrtion_script = '';
		}
		$edd_custom_settings = array(
			/* Ecommerce Tracking and Conversion Code Setting */
			'ecommerce_tracking_settings' => array( 
				'main' => array(  
					'ecommerce_tracking_settings' => array(
						'id'   => 'ecommerce_tracking_settings3',
						'name' => '<h3>' . __( 'Ecommerce Tracking & Conversion Code Settings', 'ecommerce-tracking-for-easy-digital-download' ) . '</h3>',
						'type' => 'header',
					),	
					'enable_ecommerce_setting' => array(
						'id'            => 'enable_ecommerce_setting',
						'name'          => __( 'Enable Ecommerce Tracking', 'ecommerce-tracking-for-easy-digital-download' ),
						'desc'          => __( 'Enable Ecommerce Tracking on Thank you Page', 'ecommerce-tracking-for-easy-digital-download' ),
						'type'          => 'checkbox',
					),
					'enable_facebook_conversion' => array(
						'id'            => 'enable_facebook_conversion',
						'name'          => __( 'Enable Facebook Conversion', 'ecommerce-tracking-for-easy-digital-download' ),
						'desc'          => __( 'Enable Facebook Conversion', 'ecommerce-tracking-for-easy-digital-download' ),
						'type'          => 'checkbox',
					),
					'enable_google_conversion' => array(
						'id'            => 'enable_google_conversion',
						'name'          => __( 'Enable Google Conversion', 'ecommerce-tracking-for-easy-digital-download' ),
						'desc'          => __( 'Enable Google Conversion', 'ecommerce-tracking-for-easy-digital-download' ),
						'type'          => 'checkbox',
					),
					'facebook_track_id' => array(
						'id'            => 'facebook_track_id',
						'name'          => __( 'Facebook Track ID', 'ecommerce-tracking-for-easy-digital-download' ),
						'desc'          => __( 'Enter Facebook Track ID', 'ecommerce-tracking-for-easy-digital-download' ),
						'type'          => 'text',
					),
					'google_conversion_id' => array(
						'id'            => 'google_conversion_id',
						'name'          => __( 'Google Conversion ID', 'ecommerce-tracking-for-easy-digital-download' ),
						'desc'          => __( 'Google Conversion ID', 'ecommerce-tracking-for-easy-digital-download' ),
						'type'          => 'text',
					),
					'google_conversion_label' => array(
						'id'            => 'google_conversion_label',
						'name'          => __( 'Google Conversion Label', 'ecommerce-tracking-for-easy-digital-download' ),
						'desc'          => __( 'Google Conversion Label', 'ecommerce-tracking-for-easy-digital-download' ),
						'type'          => 'text',
					),
					'ecommerce_tracking_script' => array(
						'id'   => 'ecommerce_subscription_script',
						'name' => $subscrtion_script,
						'type' => 'header',
					),
				)
			)
		);
		$edd_settings = array_merge($edd_settings,$edd_custom_settings);
		return $edd_settings;
	}
	
	public function wp_add_plugin_userfn() {
		$email_id= $_POST['email_id'];
		$log_url = $_SERVER['HTTP_HOST'];
		$cur_date = date('Y-m-d');
		$url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/wp-add-plugin-users.php';
		
		$response = wp_remote_post( $url, array('method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => array('user'=>array('user_email'=>$email_id,'plugin_site' => $log_url,'status' => 1,'plugin_id' => '29','activation_date'=>$cur_date)),
			'cookies' => array()));
		
		update_option('etfedd_plugin_notice_shown', 'true');
	}
	public function hide_subscribe_etfeddfn() {
		$email_id= $_POST['email_id'];
		update_option('etfedd_plugin_notice_shown', 'true');
	} 
	
	// function for add welcome screen page 
	
	public function welcome_easy_digital_download_ecommerce_conversion_tracking_screen_do_activation_redirect () { 
	
		if (!get_transient('_easy_digital_download_ecommerce_conversion_tracking_welcome_screen')) {
			return;
		}
		
		// Delete the redirect transient
		delete_transient('_easy_digital_download_ecommerce_conversion_tracking_welcome_screen');

		// if activating from network, or bulk
		if (is_network_admin() || isset($_GET['activate-multi'])) {
			return;
		}
		// Redirect to extra cost welcome  page
		wp_safe_redirect(add_query_arg(array('page' => 'easy-digital-download-ecommerce-conversion-tracking&tab=about'), admin_url('index.php')));
	} 
	
	 public function welcome_pages_screen_easy_digital_download_ecommerce_conversion_tracking ( ){ 
    	add_dashboard_page(
		'Easy Digital Download Ecommerce Conversion Tracking Dashboard', 'Easy Digital Download Ecommerce Conversion Tracking Dashboard', 'read', 'easy-digital-download-ecommerce-conversion-tracking',  array( $this,'welcome_screen_content_eas_digital_download_ecommerce_conversion_tracking' ) );
    } 
    
    public function  welcome_screen_easy_digital_download_ecommerce_conversion_remove_menus ( ){ 
    	remove_submenu_page( 'index.php', 'easy-digital-download-ecommerce-conversion-tracking' );
    } 
    
    // function for welcome page for content 
    
    public function welcome_screen_content_eas_digital_download_ecommerce_conversion_tracking ( ) { 
    		global $wpdb;
			$current_user = wp_get_current_user();
			if (!get_option('etfedd_plugin_notice_shown')) { 
				echo '<div id="etfedd_dialog" title="Basic dialog"><p>Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free! </p> <p><input type="text" id="txt_user_sub_etfedd" class="regular-text" name="txt_user_sub_etfedd" value="'.$current_user->user_email.'"></p></div>';
			}
    	 ?>
    	 <style type="text/css">.ui-widget-overlay.ui-front {display: none;}</style>
    	<div class="wrap about-wrap">
            <h1 style="font-size: 2.1em;"><?php printf(__('Welcome to Easy Digital Download Ecommerce Conversion Tracking', 'ecommerce-tracking-for-easy-digital-download')); ?></h1>

            <div class="about-text woocommerce-about-text">
        <?php
        $message = '';
        printf(__('%s Easy Digital Download Ecommerce Conversion Tracking plugin is tracking order using Ecommerce tracking and boost your Marketing.', 'ecommerce-tracking-for-easy-digital-download'), $message);
        ?>
                <img class="version_logo_img" src="<?php echo plugin_dir_url(__FILE__) . 'images/ecommerce-tracking-for-easy-digital-download.png'; ?>">
            </div>

        <?php
        $setting_tabs_wc = apply_filters('ecommerce_tracking_for_easy_digital_download_setting_tab', array("about" => "Overview", "other_plugins" => "Checkout our other plugins" ));
        $current_tab_wc = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';
        $aboutpage = isset($_GET['page'])
        ?>
            <h2 id="woo-extra-cost-tab-wrapper" class="nav-tab-wrapper">
            <?php
            foreach ($setting_tabs_wc as $name => $label)
            echo '<a  href="' . home_url('wp-admin/index.php?page=easy-digital-download-ecommerce-conversion-tracking&tab=' . $name) . '" class="nav-tab ' . ( $current_tab_wc == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
            ?>
            </h2>
                <?php
                foreach ($setting_tabs_wc as $setting_tabkey_wc => $setting_tabvalue) {
                	switch ($setting_tabkey_wc) {
                		case $current_tab_wc:
                			do_action('easy_digital_download_ecommerce_conversion_tracking_' . $current_tab_wc);
                			break;
                	}
                }
                ?>
            <hr />
            <div class="return-to-dashboard">
                <a href="<?php echo home_url('/wp-admin/edit.php?post_type=download&page=edd-settings&tab=ecommerce_tracking_settings'); ?>"><?php _e('Go to Easy Digital Download Ecommerce Conversion Tracking Settings', 'ecommerce-tracking-for-easy-digital-download'); ?></a>
            </div>
        </div>
    	<?php 
    	
        
     } 
    
    // function for welcome screen abouts tag 
    
    public function easy_digital_download_ecommerce_conversion_tracking_about ( ) { ?> 
    
	    <div class="changelog">
	            </br>
	           	<style type="text/css">
					p.easy_digital_download_ecommerce_conversion_tracking_overview {max-width: 100% !important;margin-left: auto;margin-right: auto;font-size: 15px;line-height: 1.5;}.easy_digital_download_ecommerce_conversion_tracking_content_ul ul li {margin-left: 3%;list-style: initial;line-height: 23px;}
				</style>  
	            <div class="changelog about-integrations">
	                <div class="wc-feature feature-section col three-col">
	                    <div>
	                        <p class="easy_digital_download_ecommerce_conversion_tracking_overview"><?php _e('Easy Digital Download Ecommerce Conversion Tracking plugin is for these who wants to use Ecommerce tracking, Facebook Conversion, Google Conversion into your Easy Digital Download plugin site. This plugin will boost your business and Enhance your marketing.', 'ecommerce-tracking-for-easy-digital-download'); ?></p>
	                        <p class="easy_digital_download_ecommerce_conversion_tracking_overview"><?php _e('This plugin will add settings tab (Ecommerce Tracking Settings) in Easy Digital Download setting section. This plugin will give you an option to track your order in Google using Ecommerce tracking code.', 'ecommerce-tracking-for-easy-digital-download'); ?></p>
	                    </div>
	                        <p class="easy_digital_download_ecommerce_conversion_tracking_overview"><strong>Features of Plugin:</strong></p>
	                    	<div class="easy_digital_download_ecommerce_conversion_tracking_content_ul"> 
	                    		<ul>
	                    			<li>Easy Digital Download Ecommerce tracking functionlity.</li>
	                    			<li>Google Conversion tracking functionlity.</li>
	                    			<li>Facebook Conversion tracking functionlity.</li>
	                    		</ul>
	                    	</div>
	                </div>
	            </div>
	        </div>	
    	
    <?php }
	
    public function easy_digital_download_ecommerce_conversion_tracking_other_plugins ( ) { 
		 global $wpdb;
         $url = 'http://www.multidots.com/store/wp-content/themes/business-hub-child/API/checkout_other_plugin.php';
    	 $response = wp_remote_post( $url, array('method' => 'POST',
    	'timeout' => 45,
    	'redirection' => 5,
    	'httpversion' => '1.0',
    	'blocking' => true,
    	'headers' => array(),
    	'body' => array('plugin' => 'advance-flat-rate-shipping-method-for-woocommerce'),
    	'cookies' => array()));
    	
    	$response_new = array();
    	$response_new = json_decode($response['body']);
		$get_other_plugin = maybe_unserialize($response_new);
		
		$paid_arr = array();
		?>

        <div class="plug-containter">
        	<div class="paid_plugin">
        	<h3>Paid Plugins</h3>
	        	<?php foreach ($get_other_plugin as $key=>$val) { 
	        		if ($val['plugindesc'] =='paid') {?>
	        			
	        			
	        		   <div class="contain-section">
	                <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
	                <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl'];?>"><?php echo $key;?></a></div>
	            </div>	
	        			
	        			
	        		<?php }else {
	        			
	        			$paid_arry[$key]['plugindesc']= $val['plugindesc'];
	        			$paid_arry[$key]['pluginimage']= $val['pluginimage'];
	        			$paid_arry[$key]['pluginurl']= $val['pluginurl'];
	        			$paid_arry[$key]['pluginname']= $val['pluginname'];
	        		
	        	?>
	        	
	         
	            <?php } }?>
           </div>
           <?php if (isset($paid_arry) && !empty($paid_arry)) {?>
           <div class="free_plugin">
           	<h3>Free Plugins</h3>
                <?php foreach ($paid_arry as $key=>$val) { ?>  	
	            <div class="contain-section">
	                <div class="contain-img"><img src="<?php echo $val['pluginimage']; ?>"></div>
	                <div class="contain-title"><a target="_blank" href="<?php echo $val['pluginurl'];?>"><?php echo $key;?></a></div>
	            </div>
	            <?php } }?>
           </div>
          
        </div>

    <?php    
    	
    } 
    
    public function easy_digital_download_ecommerce_conversion_pointers_footer ( ) { 
    	$admin_pointers = easy_digital_download_ecommerce_conversion_admin_pointers();
	    ?>
	    <script type="text/javascript">
	        /* <![CDATA[ */
	        ( function($) {
	            <?php
	            foreach ( $admin_pointers as $pointer => $array ) {
	               if ( $array['active'] ) {
	                  ?>
	            $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
	                content: '<?php echo $array['content']; ?>',
	                position: {
	                    edge: '<?php echo $array['edge']; ?>',
	                    align: '<?php echo $array['align']; ?>'
	                },
	                close: function() {
	                    $.post( ajaxurl, {
	                        pointer: '<?php echo $pointer; ?>',
	                        action: 'dismiss-wp-pointer'
	                    } );
	                }
	            } ).pointer( 'open' );
	            <?php
	         }
	      }
	      ?>
	        } )(jQuery);
	        /* ]]> */
	    </script>
	<?php	
    
    } 
}

function easy_digital_download_ecommerce_conversion_admin_pointers ( ) { 
		
		$dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
	    $version = '1_0'; // replace all periods in 1.0 with an underscore
	    $prefix = 'easy_digital_download_ecommerce_conversion_admin_pointers' . $version . '_';
	
	    $new_pointer_content = '<h3>' . __( 'Welcome to Easy Digital Download Ecommerce Conversion Tracking' ) . '</h3>';
	    $new_pointer_content .= '<p>' . __( 'Easy Digital Download Ecommerce Conversion Tracking plugin is tracking order using Ecommerce tracking and boost your Marketing.' ) . '</p>';
	
	    return array(
	        $prefix . 'easy_digital_download_ecommerce_conversion_admin_pointers' => array(
	            'content' => $new_pointer_content,
	            'anchor_id' => '#menu-posts-download',
	            'edge' => 'left',
	            'align' => 'left',
	            'active' => ( ! in_array( $prefix . 'easy_digital_download_ecommerce_conversion_admin_pointers', $dismissed ) )
	        )
	    );
}