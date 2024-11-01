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
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
 
class Chrome_One_Tap_Login_For_Woocommerce_Store_Settings {

	public static function add_update_settings($settings) {
		if ( !get_option($settings)) {
			$tvc_options = array();
			foreach ($_POST as $key => $value) {
				if(!isset($_POST[$key])){
					$_POST[$key] = '';
				}
				if(isset($_POST[$key])) {
					$tvc_options[$key] = $_POST[$key];
				}
			}
				add_option( $settings, serialize( $tvc_options ) );
		}
		else {
				$get_one_tap_settings = unserialize(get_option($settings));
				if(is_array($get_one_tap_settings)) {
					foreach ($get_one_tap_settings as $key => $value) {
						if(!isset($_POST[$key])){
							$_POST[$key] = '';
						}
						if( $_POST[$key] != $value ) {
							$get_one_tap_settings[$key] =  $_POST[$key];
						}
						
					}
				}
				if(is_array($_POST)) {
					foreach($_POST as $key=>$value){
						if(!array_key_exists($key,$get_one_tap_settings)){
							$get_one_tap_settings[$key] =  $value;
						}
					}
				}
					update_option($settings, serialize( $get_one_tap_settings ));
		}
		self::admin_notice__success();
	}
	private static function admin_notice__success() {
		$class = 'notice notice-success';
		$message = __( 'Your settings have been saved.', 'sample-text-domain' );
		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
		
	}

}