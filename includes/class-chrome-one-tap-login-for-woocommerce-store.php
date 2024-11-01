<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.tatvic.com
 * @since      1.0.0
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/includes
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
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/includes
 * @author     Chiranjiv Pathak <analytics2@tatvic.com>
 */
class Chrome_One_Tap_Login_For_Woocommerce_Store {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Chrome_One_Tap_Login_For_Woocommerce_Store_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'CHROME_ONE_TAP_LOGIN_FOR_WOOCOMMERCE_STORE_VERSION' ) ) {
			$this->version = CHROME_ONE_TAP_LOGIN_FOR_WOOCOMMERCE_STORE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'chrome-one-tap-login-for-woocommerce-store';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		add_filter( 'plugin_action_links_' .plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' ), array($this,'tvc_plugin_action_links'),10 );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Chrome_One_Tap_Login_For_Woocommerce_Store_Loader. Orchestrates the hooks of the plugin.
	 * - Chrome_One_Tap_Login_For_Woocommerce_Store_i18n. Defines internationalization functionality.
	 * - Chrome_One_Tap_Login_For_Woocommerce_Store_Admin. Defines all hooks for the admin area.
	 * - Chrome_One_Tap_Login_For_Woocommerce_Store_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-chrome-one-tap-login-for-woocommerce-store-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-chrome-one-tap-login-for-woocommerce-store-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-chrome-one-tap-login-for-woocommerce-store-settings.php';
		
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-chrome-one-tap-login-for-woocommerce-store-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-chrome-one-tap-login-for-woocommerce-store-public.php';

		$this->loader = new Chrome_One_Tap_Login_For_Woocommerce_Store_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Chrome_One_Tap_Login_For_Woocommerce_Store_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Chrome_One_Tap_Login_For_Woocommerce_Store_i18n();

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

		$plugin_admin = new Chrome_One_Tap_Login_For_Woocommerce_Store_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'display_admin_page' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Chrome_One_Tap_Login_For_Woocommerce_Store_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_tvc_user_logged_in', $plugin_public, 'tvc_user_logged_in' );
		$this->loader->add_action( 'wp_ajax_nopriv_tvc_user_logged_in',$plugin_public, 'tvc_user_logged_in' );
		$this->loader->add_action( 'wp_ajax_tvc_user_one_tap_login', $plugin_public, 'tvc_user_one_tap_login' );
		$this->loader->add_action( 'wp_ajax_nopriv_tvc_user_one_tap_login', $plugin_public, 'tvc_user_one_tap_login' );
		$this->loader->add_filter( 'nav_menu_css_class', $plugin_public, 'tvc_smart_login_class', 10, 2 );
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
	 * @return    Chrome_One_Tap_Login_For_Woocommerce_Store_Loader    Orchestrates the hooks of the plugin.
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
	
	public function tvc_plugin_action_links($links) {
		$setting_url = 'admin.php?page=chrome-one-tap-login-for-woocommerce-store-admin-display';
		$doc_link='http://plugins.tatvic.com/downloads/Chrome-One-Tap-Login-for-Woocommerce-Installation-Instructions.pdf';
		$links[] = '<a href="' . get_admin_url(null, $setting_url) . '">Settings</a>';
		$links[] = '<a href="' . $doc_link . '" target="_blank">Documentation</a>';
		return $links;
	}

}
