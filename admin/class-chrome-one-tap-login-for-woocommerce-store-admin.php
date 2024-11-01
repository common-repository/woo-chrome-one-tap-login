<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.tatvic.com
 * @since      1.0.0
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/admin
 * @author     Chiranjiv Pathak <analytics2@tatvic.com>
 */
class Chrome_One_Tap_Login_For_Woocommerce_Store_Admin {

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
		 * defined in Chrome_One_Tap_Login_For_Woocommerce_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chrome_One_Tap_Login_For_Woocommerce_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
		if ( $screen->id == 'toplevel_page_chrome-one-tap-login-for-woocommerce-store-admin-display' ||(isset($_GET['page']) && $_GET['page'] == 'chrome-one-tap-login-for-woocommerce-store-admin-display')){
			wp_register_style('font_awesome','//use.fontawesome.com/releases/v5.0.13/css/all.css');
            wp_enqueue_style('font_awesome');
			wp_register_style('tvc_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
			wp_enqueue_style('tvc_bootstrap');
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/chrome-one-tap-login-for-woocommerce-store-admin.css', array(), $this->version, 'all' );
		}

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
		 * defined in Chrome_One_Tap_Login_For_Woocommerce_Store_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Chrome_One_Tap_Login_For_Woocommerce_Store_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$screen = get_current_screen();
		if ( $screen->id == 'toplevel_page_chrome-one-tap-login-for-woocommerce-store-admin-display' ||(isset($_GET['page']) && $_GET['page'] == 'chrome-one-tap-login-for-woocommerce-store-admin-display')){
			wp_register_script('popper_bootstrap', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js');
			wp_enqueue_script('popper_bootstrap');
			wp_register_script('tvc_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');
			wp_enqueue_script('tvc_bootstrap');
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/chrome-one-tap-login-for-woocommerce-store-admin.js', array( 'jquery' ), $this->version, false );
		}

	}
	
	public function display_admin_page(){
		add_menu_page(
				'Chrome One Tap Login',
				'Chrome One Tap Login',
				'manage_options',
				'chrome-one-tap-login-for-woocommerce-store-admin-display',
				array($this, 'showPage'),
				plugin_dir_url(__FILE__) . 'images/tatvic_logo.png',
				26
		);
	}
	
	public function showPage() {
		require_once( 'partials/chrome-one-tap-login-for-woocommerce-store-admin-display.php');
	}

}
