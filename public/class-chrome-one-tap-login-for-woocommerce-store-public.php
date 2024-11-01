<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.tatvic.com
 * @since      1.0.0
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/public
 * @author     Chiranjiv Pathak <analytics2@tatvic.com>
 */
class Chrome_One_Tap_Login_For_Woocommerce_Store_Public {

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
	
	public $clientID;
	
	protected $redirect_val;
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
		$this->enableLogin  = $this->get_option('enable_login');
		$this->clientID     = $this->get_option('tvc_clientid');
		
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
		 * defined in Chrome_One_Tap_Login_For_Woocommerce_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chrome_One_Tap_Login_For_Woocommerce_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/chrome-one-tap-login-for-woocommerce-store-public.css', array(), $this->version, 'all' );

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
		 * defined in Chrome_One_Tap_Login_For_Woocommerce_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chrome_One_Tap_Login_For_Woocommerce_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if( $this->enableLogin == 'on' ) {
			wp_enqueue_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/chrome-one-tap-login-for-woocommerce-store-public.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( 'smart-login-frontend', '//smartlock.google.com/client' );
			wp_enqueue_script( 'jquery' );
			$this->redirect_val = wc_get_page_permalink( 'myaccount' );
			wp_localize_script( $this->plugin_name, 'tvc_ajax', array( 'url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ajaxnonce' ), 'tvc_client_id' =>$this->clientID , 'redirect_val' => $this->redirect_val ) );
		}
		

	}
	
	public function tvc_user_one_tap_login() {
		$tvc_username = sanitize_text_field($_POST['username']);
		$tvc_password = sanitize_text_field($_POST['password']);
		
		if(isset($tvc_username) && isset($tvc_password)) {
			$tvc_creds = array(
				'user_login'    => trim( $tvc_username ),
				'user_password' => $tvc_password,
			);
			$this->redirect_val = wc_get_page_permalink( 'myaccount' );
			$tvc_user_login     = wp_signon( apply_filters( 'woocommerce_login_credentials', $tvc_creds ), is_ssl() );
			
			if ( is_wp_error($tvc_user_login) ){
				echo $tvc_user_login->get_error_message();
			}
			else{
			  echo $this->redirect_val;
			}
			die;
		}
		
	}
	
	public function tvc_user_logged_in() {
		$tvc_redirect = wc_get_page_permalink('myaccount');
		
		echo is_user_logged_in() ? $tvc_redirect : 'false';
		
		die();
	}
	
	public function tvc_smart_login_class($classes, $item) {
		if ( strpos($item->url, 'my-account') == true) {
			$classes['chrome-login-class'] = 'tvc-chrome-login';
		}
		return $classes;
    }
	
	public function get_option($key)
	{
	    $tvc_admin_settings = array();
	  	
	    if (!empty(unserialize(get_option('tvc_one_tap_options')))) {
			$tvc_admin_settings = unserialize(get_option('tvc_one_tap_options'));
	    }
	   
		if (isset($tvc_admin_settings[$key])) {
			return $tvc_admin_settings[$key];
		}
	}
}
