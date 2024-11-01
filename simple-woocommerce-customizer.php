<?php
/**
 * Plugin Name: Simple Woocommerce Customizer
 * Plugin URI:	http://burhandodhy.me
 * Description:	Simple plugin to change WooCommerce "Add to Cart" text.
 * Version:     0.1.0
 * Author:      Burhan Nasir
 * Author URI:  https://burahndodhy.me
 * Text Domain: simple-woocommerce-customizer
 * Domain Path: /languages
 *
 * @package PluginScaffold
 */

// Useful global constants.
define( 'SIMPLE_WOOCOMMERCE_CUSTOMIZER_VERSION', '0.1.0' );
define( 'SIMPLE_WOOCOMMERCE_CUSTOMIZER_URL', plugin_dir_url( __FILE__ ) );
define( 'SIMPLE_WOOCOMMERCE_CUSTOMIZER_PATH', plugin_dir_path( __FILE__ ) );
define( 'SIMPLE_WOOCOMMERCE_CUSTOMIZER_INC', SIMPLE_WOOCOMMERCE_CUSTOMIZER_PATH . 'includes/' );


function load_simple_woocommerce_customizer() {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	if ( ! version_compare(PHP_VERSION, '5.4', '>=')  ) {
		add_action( 'admin_notices', 'swc_min_php_version' );
		return;
	}

	include SIMPLE_WOOCOMMERCE_CUSTOMIZER_INC . 'main.php';
}
add_action( 'plugins_loaded', 'load_simple_woocommerce_customizer' );

function swc_min_php_version() {
	$class = 'notice notice-error';
	$message = __( 'Simple WooCommcer Customizer runs on PHP 5.4 or greater.', 'simple-woocommerce-customizer' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
}
