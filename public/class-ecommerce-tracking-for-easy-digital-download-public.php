<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ecommerce_Tracking_For_Easy_Digital_Download
 * @subpackage Ecommerce_Tracking_For_Easy_Digital_Download/public
 * @author     multidots 
 */
class Ecommerce_Tracking_For_Easy_Digital_Download_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ecommerce-tracking-for-easy-digital-download-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ecommerce-tracking-for-easy-digital-download-public.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Load Facebook Conversion Tracking Code
	 *
	 * @param unknown_type $payment
	 */
	public function custom_ecommerce_fb_conversion_tracking( $payment ) {
		
		global $total,$item_qty, $wpdb;;
		$total = 0;
		$item_qty = 0;
		$currency = edd_get_currency();
		
		$ecommerce_setting_arr = get_option('edd_settings');
		
		//Get facebook conversion tracking code.
		$facebook_traching_id = !empty( $ecommerce_setting_arr['facebook_track_id'] ) ? $ecommerce_setting_arr['facebook_track_id'] : '';
		
		//check facebook tracking id is empty or not.
		if( !empty( $facebook_traching_id ) ) {
			$payment_id = edd_get_payment_number( $payment->ID );
			$total = edd_payment_amount( $payment->ID );
			
			//Get Item quantity and currency.
			$cart = edd_get_payment_meta_cart_details( $payment->ID, true );
			if( $cart ) :
				foreach ( $cart as $key => $item ) :
					$item_qty = $item_qty + $item['quantity'];
				endforeach;
			endif; ?>
			 <!-- Facebook Conversion Code for Checkouts - Wellineux -->
			  <script>(function() {
		      var _fbq = window._fbq || (window._fbq = []);
		      if (!_fbq.loaded) {
		        var fbds = document.createElement('script');
		        fbds.async = true;
		        fbds.src = '//connect.facebook.net/en_US/fbds.js';
		        var s = document.getElementsByTagName('script')[0];
		        s.parentNode.insertBefore(fbds, s);
		        _fbq.loaded = true;
		      }
		    })();
		    window._fbq = window._fbq || [];
		    window._fbq.push(['track', '<?php echo $facebook_traching_id ?>', {'value':'<?php echo $total ?>','currency':'<?php echo $currency ?>'}]);
		    </script>
			<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=<?php echo $facebook_traching_id ?>&amp;cd[value]=<?php echo $total ?>&amp;cd[currency]=<?php echo $currency ?>&amp;noscript=1" /></noscript>
		<?php }
	}
	
	/**
	 * Load Google Conversion Tracking Code
	 * 
	 * @param unknown_type $payment
	 */
	
	public function custom_ecommerce_google_conversion_tracking( $payment ) {
		
		global $total,$item_qty;
		$total = 0;
		$item_qty = 0;
		
		$payment_id = edd_get_payment_number( $payment->ID );
		$total = edd_payment_amount( $payment->ID );
		$currency = edd_get_currency();
		
		//Get Item quantity and currency.
		$cart = edd_get_payment_meta_cart_details( $payment->ID, true );
		if( $cart ) :
			foreach ( $cart as $key => $item ) :
				$item_qty = $item_qty + $item['quantity'];
			endforeach;
		endif;
		
		
		$ecommerce_setting_arr = get_option('edd_settings');
		
		//Get facebook conversion tracking code.
		$google_traching_id = !empty( $ecommerce_setting_arr['google_conversion_id'] ) ? $ecommerce_setting_arr['google_conversion_id'] : '';
		$google_tracking_label = !empty( $ecommerce_setting_arr['google_conversion_label'] ) ? $ecommerce_setting_arr['google_conversion_label'] : '';
		
		//check google tracking label is empty or not.
		if( isset( $google_tracking_label ) && !empty( $google_traching_id ) ) {
			$google_tracking_label = $google_tracking_label;	
		} else {
			$google_tracking_label = 'xxxxxx';
		}
		
		//Check google tracking id is empty or not.
		if( isset( $google_traching_id ) && !empty( $google_traching_id ) ) {
			$google_traching_id = $google_traching_id;
		} else {
			$google_traching_id = 'xxxxxx';
		} ?>
		<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = "<?php echo $google_traching_id ?>";
			var google_conversion_label = "<?php echo $google_tracking_label ?>";
			var google_conversion_value = <?php echo $total?>;
			var google_conversion_currency = "<?php echo $currency?>";
			
			/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
			<noscript>
				<div style="display:inline;">
					<?php echo '<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/'.$google_traching_id.'/?value=' . $total . '&amp;currency_code=' . $currency . '&amp;label=' . $google_tracking_label . '&amp;guid=ON&amp;script=0"/>' ?>
				</div>
			</noscript>
		
	<?php }
	
	/**
	 *  Function for E-commerce tracking 
	 * 
	 */
	
	public function custom_ecommerce_tracking( $payment ) {
            
                $website_url = site_url();
		$server_name = isset($_SERVER['SERVER_NAME']);
		$server_referer = isset($_SERVER['HTTP_REFERER']);
		$website_url = preg_replace('#^https?://#', '', $website_url);
		
		$payment_id = edd_get_payment_number( $payment->ID );
		$total = edd_payment_amount( $payment->ID );
		$currency = edd_get_currency();
		
		//Get Item quantity and currency.
		$cart = edd_get_payment_meta_cart_details( $payment->ID, true );
                $item_qty = 0;
		if( $cart ) :
			foreach ( $cart as $key => $item ) :
				$item_qty = $item_qty + $item['quantity'];
			endforeach;
		endif;
		
		if ( $_SERVER['SERVER_NAME'] == $website_url && !empty( $_SERVER['HTTP_REFERER'] ) ) {
			?>
			<script type="text/javascript">
			ga('require', 'ecommerce', 'ecommerce.js'); // Load The Ecommerce Tracking Plugin
			// Transaction Details
			ga('ecommerce:addTransaction', {
			'id': '<?php echo $payment->id;?>',
			'affiliation': '<?php echo get_option( "blogname" );?>',
			'revenue': '<?php echo $total;?>',
			'tax': '<?php echo edd_format_amount( $payment->tax );?>',
			'currency': '<?php echo $currency;?>'
			});
			//Item Details
			<?php 
			if( sizeof( $cart ) > 0  ) {
				foreach ( $cart as $key => $item ) {
					$item_qty = $item_qty + $item['quantity'];
					 ?>
					ga('ecommerce:addItem', {
					'id': '<?php echo $item['id'];?>',
					'name': '<?php echo $item['name'];?>',
					'price': '<?php echo $item['price'];?>',
					'quantity': '<?php echo $item['quantity'];?>',
					'currency': '<?php echo $item['currency'];?>'
					});
				<?php
				}
			 }
			?>
			ga('ecommerce:send');
			</script>
			<?php 
                        
                
		}
               
	}
	public function  paypal_bn_code_filter ( $paypal_args ) {  
		$paypal_args['bn'] = 'Multidots_SP';
        return $paypal_args;
	}

}