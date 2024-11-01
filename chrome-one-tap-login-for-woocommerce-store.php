<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.tatvic.com
 * @since             1.0.0
 * @package           Chrome_One_Tap_Login_For_Woocommerce_Store
 *
 * @wordpress-plugin
 * Plugin Name:       Chrome One Tap Login for Woocommerce
 * Description:       Chrome One Tap Login for WooCommerce allows the customers to log in automatically into a website without having to enter passwords each time.
 * Version:           1.0.0
 * Author:            Tatvic
 * Author URI:        https://www.tatvic.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       chrome-one-tap-login-for-woocommerce-store
 * Domain Path:       /languages
 * WC requires at least: 2.5.0
 * WC tested up to: 3.6.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CHROME_ONE_TAP_LOGIN_FOR_WOOCOMMERCE_STORE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-chrome-one-tap-login-for-woocommerce-store-activator.php
 */
function activate_chrome_one_tap_login_for_woocommerce_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-chrome-one-tap-login-for-woocommerce-store-activator.php';
	Chrome_One_Tap_Login_For_Woocommerce_Store_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-chrome-one-tap-login-for-woocommerce-store-deactivator.php
 */
function deactivate_chrome_one_tap_login_for_woocommerce_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-chrome-one-tap-login-for-woocommerce-store-deactivator.php';
	Chrome_One_Tap_Login_For_Woocommerce_Store_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_chrome_one_tap_login_for_woocommerce_store' );
register_deactivation_hook( __FILE__, 'deactivate_chrome_one_tap_login_for_woocommerce_store' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-chrome-one-tap-login-for-woocommerce-store.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_chrome_one_tap_login_for_woocommerce_store() {

	$plugin = new Chrome_One_Tap_Login_For_Woocommerce_Store();
	$plugin->run();

}
run_chrome_one_tap_login_for_woocommerce_store();
