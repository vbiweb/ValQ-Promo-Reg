<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://visualbi.com
 * @since      1.0.0
 *
 * @package    Valq_Promo_Reg
 * @subpackage Valq_Promo_Reg/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Valq_Promo_Reg
 * @subpackage Valq_Promo_Reg/public
 * @author     K Gopal Krishna <kgkrishna@visualbi.com>
 */
class Valq_Promo_Reg_Public {

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
		 * defined in Valq_Promo_Reg_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Valq_Promo_Reg_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-select2' , "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css", array(), '4.0.7', 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/valq-promo-reg-public.css', array(), $this->version, 'all' );

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
		 * defined in Valq_Promo_Reg_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Valq_Promo_Reg_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name . '-select2', "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.full.min.js", array( 'jquery' ), '4.0.7', false );

		wp_enqueue_script( $this->plugin_name . '-validate', "https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.18.0/jquery.validate.min.js", array( 'jquery' ), '1.18.0', false);

		wp_enqueue_script($this->plugin_name . '-block', "https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js", array( 'jquery' ), '2.70', true);

		$settings = array (
			'ajax_url' => admin_url('admin-ajax.php'),
			'security_token' => wp_create_nonce("valq-promo-reg-form-security"),
			'existing_emails' => $this->get_users_email(),
			'existing_error' => "Account for this ID already exists."
		);
		
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/valq-promo-reg-public.js', array( $this->plugin_name . '-select2', $this->plugin_name . '-validate', $this->plugin_name . '-block' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'PROMO_SETTINGS', $settings );

		wp_enqueue_script( $this->plugin_name );

	}

	/**
	 * Registers the shorcode to be used to render the promo registration form.
	 *
	 * @since    1.0.0
	 */
	public function add_promo_registration_form_shortcode() {

		add_shortcode( 'valq_promo_reg' , array ( $this, 'valq_promo_reg_shortcode_callback' ) );

	}

	/**
	 * Callback to the shortcode registered in the above function
	 *
	 * @since    1.0.0
	 * @param    array    $atts       Contains the array of attributes passed to the shortcode.
	 */
	public function valq_promo_reg_shortcode_callback( $atts ) {

		global $post, $wpdb, $woocommerce; 

		$atts = shortcode_atts(
	        array(
	            'product_id' => '',
	            'promo_code' => ''
	        ), $atts, 'valq_promo_reg' );

		$product_id = $atts[ 'product_id' ];
		$promo_code = $atts[ 'promo_code' ];

		if( $product_id == '' ) {
			$output = "Attribute - [product_id] is mandatory";
			return $output;
		}

		if( $promo_code == '' ) {
			$output = "Attribute - [promo_code] is mandatory";
			return $output;
		}

		ob_start();

		if( ! empty( $_GET[ 'promo-code' ] ) && $_GET[ 'promo-code' ] == $promo_code ) {

			$product = new WC_Product( $product_id );

			$results = $wpdb->get_results( "select * from wp_woocommerce_product_meta where product_id = " . $product_id, ARRAY_A );
			$trial_days = $results[0][ 'product_hardstop_days' ];
			
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/valq-promo-reg-form-display.php';

		} else {

			$wrong_promo = false;

			if( ! empty( $_GET[ 'promo-code' ] ) && $_GET[ 'promo-code' ] != $promo_code ) {

				$wrong_promo = true;

			}

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/valq-promo-reg-no-code-display.php';

		}

		$output = ob_get_clean();

		return $output;

	}

	/**
	 * Ajax callback to the create order action triggered from the jQuery form submission event.
	 *
	 * @since    1.0.0
	 */
	public function valq_promo_reg_create_order() {

		global $wpdb;

		check_ajax_referer( 'valq-promo-reg-form-security', 'security' );

		$first_name = $_POST['fname'];
		$last_name 	= $_POST['lname'];
		$email 		= $_POST['email'];
		$phone 		= $_POST['phone'];
		$company 	= $_POST['company'];
		$country 	= $_POST['country'];
		$size  		= $_POST['size'];
		$industry  	= $_POST['industry'];

		$product_id = $_POST['product_id'];
		$promo_code = $_POST['promo_code'];

		$page_url 	= $_POST['pageurl'];
		$page_name 	= $_POST['pagename'];
		$hubspotutk = $_POST['hubspotutk'];
		$ip_addr    = $_POST['ipaddr'];
		$user_agent = $_POST['useragent'];

		$hs_context = array(
		    'hutk' 		=> $hubspotutk,
		    'ipAddress' => $ip_addr,
		    'pageUrl' 	=> $page_url,
		    'pageName' 	=> $page_name
		);

		$hs_context_json = json_encode($hs_context);

	    $password = wp_generate_password(12, true);
	    $user_id = wp_create_user($email, $password, $email);
	    
	    update_user_meta($user_id, 'first_name', $first_name);
	    update_user_meta($user_id, 'last_name', $last_name);
	    update_user_meta($user_id, '_customer_pw', $password);
	    update_user_meta($user_id, '_tried', "yes");
	    
	    $user = new WP_User($user_id);
	    $user->set_role('customer');

		$args = array('order_id' => 0, 'customer_id' => $user_id);
		$order = wc_create_order($args);

		$product = new WC_Product($product_id);
		$product_title = $product->get_title();

		$order->add_product($product,1);

        $order->set_order_key(apply_filters('woocommerce_generate_order_key', uniqid('order_')));
        $order->set_billing_first_name($first_name);
        $order->set_billing_last_name($last_name);
        $order->set_billing_company($company);
        $order->set_billing_country($country);
        $order->set_billing_email($email);
        $order->set_billing_phone($phone);
        $order->set_customer_ip_address($ip_addr);
		$order->set_customer_user_agent($user_agent);
		
		update_post_meta($order->get_id(), '_product_title', $product_title);
        update_post_meta($order->get_id(), '_product_id', $product_id);

		update_post_meta($order->get_id(), '__trial', "yes");
		update_post_meta($order->get_id(), '__plan', "enterprise");

		$results = $wpdb->get_results("select * from wp_woocommerce_api_manager_license_meta where product_id = ".$product_id, ARRAY_A);
        foreach ($results as $result) {
            update_post_meta($order->get_id(),'__'.$result['meta_name'], $result['meta_default_trial']);
        }

		$results = $wpdb->get_results("select * from wp_woocommerce_product_meta where product_id = ".$product_id, ARRAY_A);

		$version = $results[0]['product_version'];
		$hardstop_days = $results[0]['product_hardstop_days'];
		$hardstop_date = date('Y-m-d',strtotime( "+".$hardstop_days." days" ));
	    
	    update_post_meta($order->get_id(), '__hardstopdate', $hardstop_date);
	    update_post_meta($order->get_id(), '__version', $version);

	    $order->update_status('completed');

	    /**********************************
	    		Auto Activation Code
	    **********************************/

	    $license_key = get_post_meta($order->get_id(),'_api_license_key_0',true);

	    $build_parameters = array(
	    	'build_parameters' => array(
	    		'order_id' => $order->get_id(),
	    		'email' => $email,
	    		'plan' => 'enterprise',
	    		'trial' => 'yes',
	    		'expInDate' => $hardstop_date,
	    		'user' => $first_name.' '.$last_name,
	    		'license_key' => $license_key,
	    		'instance' => time().substr($license_key,-9),
	    		'version' => $version,
	    		'ip_address' => $ip_addr 
	    	)
	    );

	    $build_parameters = json_encode($build_parameters);

	    $endpoint = "https://api.visualbi.com/valq/auto-activate/";

	    //$build_response = $this->api_request($endpoint, "POST", $build_parameters , "application/json");

	    /**********************************
	    		Tenant Creation Code
	    **********************************/

	    /*$license_key = get_post_meta($order->get_id(),'_api_license_key_0',true);

	    $tenant_data = array(
	    	'name' => $workspace,
	    	'domain' => explode("@", $email)[1],
	    	'adminEmail' => $email,
	    	'licenseMeta' => array(
	    		'order_id' => $order->get_id(),
	    		'email' => $email,
	    		'plan' => 'enterprise',
	    		'trial' => 'yes',
	    		'expInDate' => $hardstop_date,
	    		'user' => $first_name.' '.$last_name,
	    		'license_key' => $license_key,
	    		'instance' => time().substr($license_key,-9),
	    		'version' => $version,
	    		'ip_address' => $ip_addr 
	    	),
	    	'fullName' => $first_name.' '.$last_name
	    );

	    $tenant_data = json_encode($tenant_data);

	    $endpoint = "https://api.visualbi.com/valq/saas/create-tenant/";

	    $tenant_response = $this->api_request($endpoint, "POST", $tenant_data , "application/json");

	    $tenant_response = json_decode($tenant_response, true);

	    if($tenant_response['statusCode'] == 200) {
	    	update_user_meta( $user_id, '_wp_wc_am_tenant_details', $tenant_response['payload']['resetTokenUrl'] );
	    }*/

	    /**********************************
	    		Submit to HubSpot
	    **********************************/

	    $str_post = "firstname=" . urlencode($first_name) 
	        . "&lastname=" . urlencode($last_name) 
	        . "&email=" . urlencode($email)
	        . "&shop_country=" . urlencode($country)
	        . "&valq_trial_start_date=" . urlencode(date('Y-m-d'))
	        . "&valq_trial_end_date=" . urlencode($hardstop_date) 
	        . "&phone=" . urlencode($phone)
	        . "&valq_promo_code=". urlencode($promo_code)
	        . "&hs_context=" . urlencode($hs_context_json);

	    $endpoint = 'https://forms.hubspot.com/uploads/form/v2/2857966/53683928-9354-4824-b77e-b9bc6af0df5c';

	    $hubspot_response = $this->api_request($endpoint, "POST", $str_post , "application/x-www-form-urlencoded");

		wp_send_json(array(
			"message" 	=> "completed",
			"code" 		=> "200",
			"promo_code" => $promo_code
		));

	}

	/**
	 * Helper function to get list of emails of already registered users.
	 *
	 * @since    1.0.0
	 */
	public function get_users_email(){
		$emails = array();
		$users = get_users();
		foreach ($users as $user) {
			$emails[] = $user->user_email;
		}

		return implode(", ", $emails);
	}

	/**
	 * Helper function to send api requests to remote URL.
	 *
	 * @since    1.0.0
	 */
	public function api_request($endpoint, $method="GET", $data=NULL, $content_type=NULL){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $endpoint);

		if(strtolower($method) == 'post')
			curl_setopt($ch, CURLOPT_POST, true);

		if(strtolower($method) != 'post' || strtolower($method) != 'get')
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

		if($data != '' || $data != NULL)
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		if($content_type != '' || $content_type != NULL)
			curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: $content_type" ));
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response    = curl_exec($ch); 
		$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

		$response = json_decode($response,true);
		$response['http_status_code'] = $status_code;
		$response = json_encode($response);
		
		curl_close($ch);

		return $response;
	}

}
