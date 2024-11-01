<?php


namespace SimpleWoocommerceCustomizer;

	class Front {

	protected $options;
	protected $porduct_options;

	function __construct() {

		add_action( 'wp_head', array( $this, 'load_options' ) );
		add_action( 'woocommerce_product_add_to_cart_text', array( $this, 'customize_add_to_cart_text' ), 100, 2 );

		add_filter( 'woocommerce_product_tabs', array( $this, 'woo_remove_product_tabs' ), 100 );
		add_filter( 'woocommerce_product_description_heading', array( $this, 'woocommerce_product_description_heading' ), 100 );
		add_filter( 'woocommerce_product_additional_information_heading', array( $this, 'woocommerce_product_additional_information_heading' ), 100 );

		add_filter( 'woocommerce_product_single_add_to_cart_text', array( $this, 'woocommerce_product_single_add_to_cart_text' ) );

		add_filter( 'woocommerce_get_availability_text', array( $this, 'woocommerce_get_availability_text' ), 10, 2 );
	}

	// load all options.
	function load_options() {
		$this->options         = get_option( 'swc_shop_loop' );
		$this->porduct_options = get_option( 'swc_product_page' );
	}

	// change add to cart text on the shop page.
	function customize_add_to_cart_text( $text, $product ) {

		// out of stock.
		if ( isset( $this->options['out_of_stock_product'] ) && trim( $this->options['out_of_stock_product'] ) && ! $product->is_in_stock() ) {
			return $this->options['out_of_stock_product'];
		}

		if ( isset( $this->options['simple_product'] ) && trim( $this->options['simple_product'] ) && $product->is_type( 'simple' ) ) {
			// simple product.
			return $this->options['simple_product'];
		} elseif ( isset( $this->options['variable_product'] ) && trim( $this->options['variable_product'] ) && $product->is_type( 'variable' ) ) {
			// variable products.
			return $this->options['variable_product'];
		} elseif ( isset( $this->options['grouped_product'] ) && trim( $this->options['grouped_product'] ) && $product->is_type( 'grouped' ) ) {
			// variable products.
			return $this->options['grouped_product'];
		}

		return $text;
	}



	function woo_remove_product_tabs( $tabs ) {

		if ( isset( $this->porduct_options['product_description_tab'] ) && ! empty( $this->porduct_options['product_description_tab'] ) ) {
			$tabs['description']['title'] = $this->porduct_options['product_description_tab'];
		}

		if ( isset( $tabs['additional_information'] ) && isset( $this->porduct_options['additional_information_tab'] ) && ! empty( $this->porduct_options['additional_information_tab'] ) ) {
			$tabs['additional_information']['title'] = $this->porduct_options['additional_information_tab'];
		}

		return $tabs;
	}

	function woocommerce_product_description_heading( $description ) {

		if ( isset( $this->porduct_options['product_description'] ) && ! empty( $this->porduct_options['product_description'] ) ) {
			$description = $this->porduct_options['product_description'];
		}

		return $description;
	}


	function woocommerce_product_additional_information_heading( $description ) {

		if ( isset( $this->porduct_options['additional_information'] ) && ! empty( $this->porduct_options['additional_information'] ) ) {
			$description = $this->porduct_options['additional_information'];
		}

		return $description;
	}


	function woocommerce_product_single_add_to_cart_text( $text ) {

		if ( isset( $this->porduct_options['add_to_cart'] ) && ! empty( $this->porduct_options['add_to_cart'] ) ) {
			$text = $this->porduct_options['add_to_cart'];
		}

		return $text;
	}

	function woocommerce_get_availability_text( $text, $product ) {

		if ( ! $product->is_in_stock() && isset( $this->porduct_options['out_of_stock'] ) && ! empty( $this->porduct_options['out_of_stock'] ) ) {
			return $this->porduct_options['out_of_stock'];
		}

		if ( $product->managing_stock() && $product->is_on_backorder( 1 ) && isset( $this->porduct_options['backorder_text'] ) && ! empty( $this->porduct_options['backorder_text'] ) ) {
			return $this->porduct_options['backorder_text'];
		}

		return $text;
	}

}
