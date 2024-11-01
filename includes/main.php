<?php
use SimpleWoocommerceCustomizer\Customizer  as Customizer;
use SimpleWoocommerceCustomizer\Front  as Front;


// Include files.
require_once SIMPLE_WOOCOMMERCE_CUSTOMIZER_INC . 'functions/core.php';

// Activation/Deactivation.
register_activation_hook( __FILE__, '\SimpleWoocommerceCustomizer\Core\activate' );
register_deactivation_hook( __FILE__, '\SimpleWoocommerceCustomizer\Core\deactivate' );

// Bootstrap.
SimpleWoocommerceCustomizer\Core\setup();


// Require Composer autoloader if it exists.
if ( file_exists( SIMPLE_WOOCOMMERCE_CUSTOMIZER_PATH . '/vendor/autoload.php' ) ) {
  require_once SIMPLE_WOOCOMMERCE_CUSTOMIZER_PATH . 'vendor/autoload.php';
}

add_action( 'customize_register', function() {
  $customizer = new Customizer();
}, 10, 1 );

new Front();



?>
