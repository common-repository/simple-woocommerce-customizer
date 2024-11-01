<?php

namespace SimpleWoocommerceCustomizer;

class Customizer {

	function __construct() {
		add_action( 'customize_register', array( $this, 'mytheme_customize_register' ), 20 );
	}

	function mytheme_customize_register( $wp_customize ) {

		$wp_customize->add_panel(
			'simple-woocommerce-customizer',
			array(
				'title'      => 'WooCommerce Customizer',
				'label'      => 'This is panel Description',
				'priority'   => 190,
				'capability' => 'manage_woocommerce',
			)
		);

		$wp_customize->add_section(
			'simple-woocommerce-customizer-shop-loop',
			array(
				'title'    => 'Shop Loop',
				'priority' => 10,
				'panel'    => 'simple-woocommerce-customizer',
			)
		);
		// simple product
		$wp_customize->add_setting(
			'swc_shop_loop[simple_product]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new Text_Control(
				$wp_customize,
				'simple_product_control',
				array(
					'heading'     => 'Add to Cart Button Text',
					'type'        => 'text',
					'label'       => 'Simple Product',
					'section'     => 'simple-woocommerce-customizer-shop-loop',
					'settings'    => 'swc_shop_loop[simple_product]',
					'description' => 'Changes the `add to cart` button text for simple products on all loop pages',
				)
			)
		);

		// variable product
		$wp_customize->add_setting(
			'swc_shop_loop[variable_product]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'variable_product_control',
			array(
				'label'       => 'Variable Porduct',
				'type'        => 'text',
				'section'     => 'simple-woocommerce-customizer-shop-loop',
				'settings'    => 'swc_shop_loop[variable_product]',
				'description' => 'Changes the `add to cart` button text for variable products on all loop pages',
			)
		);
		// grouped product
		$wp_customize->add_setting(
			'swc_shop_loop[grouped_product]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'grouped_product_control',
			array(
				'label'       => 'Grouped Product',
				'type'        => 'text',
				'section'     => 'simple-woocommerce-customizer-shop-loop',
				'settings'    => 'swc_shop_loop[grouped_product]',
				'description' => 'Changes the `add to cart` button text for grouped products on all loop pages',

			)
		);
		// out of stock
		$wp_customize->add_setting(
			'swc_shop_loop[out_of_stock_product]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'out_of_stock_product_control',
			array(
				'label'       => 'Out of Stock Product',
				'type'        => 'text',
				'section'     => 'simple-woocommerce-customizer-shop-loop',
				'settings'    => 'swc_shop_loop[out_of_stock_product]',
				'description' => 'Changes the `add to cart` button text for out of stock products on all loop pages',
			)
		);

		$wp_customize->add_section(
			'simple-woocommerce-customizer-product-page',
			array(
				'title'    => 'Product Page',
				'priority' => 20,
				'panel'    => 'simple-woocommerce-customizer',
			)
		);


		// Product Description
		$wp_customize->add_setting(
			'swc_product_page[add_to_cart]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new Text_Control(
				$wp_customize,
				'add_to_cart_control',
				array(
					'heading'     => 'Add to Cart Button Text ',
					'type'        => 'text',
					'label'       => 'All Product Types ',
					'section'     => 'simple-woocommerce-customizer-product-page',
					'settings'    => 'swc_product_page[add_to_cart]',
					'description' => 'Changes the `add to cart` button text on the single product page for all product type',
				)
			)
		);

		// Product Description
		$wp_customize->add_setting(
			'swc_product_page[out_of_stock]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new Text_Control(
				$wp_customize,
				'out_of_stock_control',
				array(
					'heading'     => 'Out of Stock text',
					'type'        => 'text',
					'section'     => 'simple-woocommerce-customizer-product-page',
					'settings'    => 'swc_product_page[out_of_stock]',
					'description' => 'Changes text for the out of stock on product pages. Default: "Out of stock"',
				)
			)
		);

		$wp_customize->add_setting(
			'swc_product_page[backorder_text]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'backorder_text_control',
			array(
				'type'        => 'text',
				'label'       => 'Backorder text',
				'section'     => 'simple-woocommerce-customizer-product-page',
				'settings'    => 'swc_product_page[backorder_text]',
				'description' => 'Changes text for the out of stock on product pages. Default: "Out of stock"',
			)
		);


		// Product Description
		$wp_customize->add_setting(
			'swc_product_page[product_description_tab]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new Text_Control(
				$wp_customize,
				'product_description_tab_control',
				array(
					'heading'     => 'Tab Titles',
					'type'        => 'text',
					'label'       => 'Product Description',
					'section'     => 'simple-woocommerce-customizer-product-page',
					'settings'    => 'swc_product_page[product_description_tab]',
					'description' => 'Changes the Production Description tab title',
				)
			)
		);

		// Additional Information
		$wp_customize->add_setting(
			'swc_product_page[additional_information_tab]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'additional_information_tab_control',
			array(
				'type'        => 'text',
				'label'       => 'Additional Information',
				'section'     => 'simple-woocommerce-customizer-product-page',
				'settings'    => 'swc_product_page[additional_information_tab]',
				'description' => 'Changes the Additional Information tab title',
			)
		);

		// Product Description
		$wp_customize->add_setting(
			'swc_product_page[product_description]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			new Text_Control(
				$wp_customize,
				'product_description_control',
				array(
					'heading'     => 'Tab Content Headings',
					'type'        => 'text',
					'label'       => 'Product Description',
					'section'     => 'simple-woocommerce-customizer-product-page',
					'settings'    => 'swc_product_page[product_description]',
					'description' => 'Changes the Product Description tab heading',
				)
			)
		);

		// Additional Information
		$wp_customize->add_setting(
			'swc_product_page[additional_information]',
			array(
				'default' => '',
				'type'    => 'option',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			'additional_information_control',
			array(
				'type'        => 'text',
				'label'       => 'Additional Information',
				'section'     => 'simple-woocommerce-customizer-product-page',
				'settings'    => 'swc_product_page[additional_information]',
				'description' => 'Changes the Additional Information tab heading',
			)
		);


	}
}
