<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.tatvic.com
 * @since      1.0.0
 *
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Chrome_One_Tap_Login_For_Woocommerce_Store
 * @subpackage Chrome_One_Tap_Login_For_Woocommerce_Store/includes
 * @author     Chiranjiv Pathak <analytics2@tatvic.com>
 */
class Chrome_One_Tap_Login_For_Woocommerce_Store_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'chrome-one-tap-login-for-woocommerce-store',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
