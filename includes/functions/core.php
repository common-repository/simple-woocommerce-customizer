<?php
/**
 * Core plugin functionality.
 *
 * @package PluginScaffold
 */

namespace SimpleWoocommerceCustomizer\Core;

use \WP_Error as WP_Error;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'i18n' ) );
	add_action( 'init', $n( 'init' ) );
	// add_action( 'admin_enqueue_scripts', $n( 'admin_scripts' ) );
	add_action( 'customize_controls_enqueue_scripts', $n( 'customizer_control_scripts' ) );

	// Hook to allow async or defer on asset loading.
	add_filter( 'script_loader_tag', $n( 'script_loader_tag' ), 10, 2 );

	do_action( 'simple_woocommerce_customizer_loaded' );
}

/**
 * Registers the default textdomain.
 *
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'simple-woocommerce-customizer' );
	load_textdomain( 'simple-woocommerce-customizer', WP_LANG_DIR . '/simple-woocommerce-customizer/simple-woocommerce-customizer-' . $locale . '.mo' );
	load_plugin_textdomain( 'simple-woocommerce-customizer', false, plugin_basename( SIMPLE_WOOCOMMERCE_CUSTOMIZER_PATH ) . '/languages/' );
}

/**
 * Initializes the plugin and fires an action other plugins can hook into.
 *
 * @return void
 */
function init() {
	do_action( 'simple_woocommerce_customizer_init' );
}

/**
 * Activate the plugin
 *
 * @return void
 */
function activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	init();
	flush_rewrite_rules();
}

/**
 * Deactivate the plugin
 *
 * Uninstall routines should be in uninstall.php
 *
 * @return void
 */
function deactivate() {

}


/**
 * The list of knows contexts for enqueuing scripts/styles.
 *
 * @return array
 */
function get_enqueue_contexts() {
	return array( 'admin', 'customizer' );
}

/**
 * Generate an URL to a script, taking into account whether SCRIPT_DEBUG is enabled.
 *
 * @param string $script Script file name (no .js extension)
 * @param string $context Context for the script ('admin', 'frontend', or 'shared')
 *
 * @return string|WP_Error URL
 */
function script_url( $script, $context ) {

	if ( ! in_array( $context, get_enqueue_contexts(), true ) ) {
		return new WP_Error( 'invalid_enqueue_context', 'Invalid $context specified in SimpleWoocommerceCustomizer script loader.' );
	}

	return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ?
		SIMPLE_WOOCOMMERCE_CUSTOMIZER_URL . "assets/js/${context}/{$script}.js" :
		SIMPLE_WOOCOMMERCE_CUSTOMIZER_URL . "dist/js/${script}.min.js";

}

/**
 * Generate an URL to a stylesheet, taking into account whether SCRIPT_DEBUG is enabled.
 *
 * @param string $stylesheet Stylesheet file name (no .css extension)
 * @param string $context Context for the script ('admin', 'frontend', or 'shared')
 *
 * @return string URL
 */
function style_url( $stylesheet, $context ) {

	if ( ! in_array( $context, get_enqueue_contexts(), true ) ) {
		return new WP_Error( 'invalid_enqueue_context', 'Invalid $context specified in SimpleWoocommerceCustomizer stylesheet loader.' );
	}

	return ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ?
		SIMPLE_WOOCOMMERCE_CUSTOMIZER_URL . "assets/css/${context}/{$stylesheet}.css" :
		SIMPLE_WOOCOMMERCE_CUSTOMIZER_URL . "dist/css/${stylesheet}.min.css";

}

/**
 * Enqueue scripts for admin.
 *
 * @return void
 */
function admin_scripts() {


	wp_enqueue_script(
		'simple_woocommerce_customizer_admin',
		script_url( 'admin', 'admin' ),
		array(),
		SIMPLE_WOOCOMMERCE_CUSTOMIZER_VERSION,
		true
	);

}

/**
 * Enqueue styles for front-end.
 *
 * @return void
 */
function styles() {


}


/**
 * Add async/defer attributes to enqueued scripts that have the specified script_execution flag.
 *
 * @link https://core.trac.wordpress.org/ticket/12009
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function script_loader_tag( $tag, $handle ) {
	$script_execution = wp_scripts()->get_data( $handle, 'script_execution' );

	if ( ! $script_execution ) {
		return $tag;
	}

	if ( 'async' !== $script_execution && 'defer' !== $script_execution ) {
		return $tag; // _doing_it_wrong()?
	}

	// Abort adding async/defer for scripts that have this script as a dependency. _doing_it_wrong()?
	foreach ( wp_scripts()->registered as $script ) {
		if ( in_array( $handle, $script->deps, true ) ) {
			return $tag;
		}
	}

	// Add the attribute if it hasn't already been added.
	if ( ! preg_match( ":\s$script_execution(=|>|\s):", $tag ) ) {
		$tag = preg_replace( ':(?=></script>):', " $script_execution", $tag, 1 );
	}

	return $tag;
}

/**
 * Enqueue Customizer Control Script.
 */
function customizer_control_scripts() {
	wp_enqueue_script(
		'simple_woocommerce_customizer_control',
		script_url( 'customizer', 'customizer' ),
		array( 'jquery', 'customize-controls' ),
		SIMPLE_WOOCOMMERCE_CUSTOMIZER_VERSION,
		true
	);

	$woo_products = wc_get_products( array( 'posts_per_page' => 1 ) );

	// if woocommerce product exist.
	$prdocut_id = $woo_products[0] instanceof WC_Product ? $woo_products[0]->get_id() : 0;

	wp_localize_script(
		'simple_woocommerce_customizer_control',
		'swcc',
		array(
			'shop_url'    => get_permalink( wc_get_page_id( 'shop' ) ),
			'product_url' => get_permalink( $prdocut_id ),
		)
	);
}
