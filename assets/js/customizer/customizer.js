  // IIFE - Immediately Invoked Function Expression
(function($, window, document, api) {
	'use strict';

	// The $ is now locally scoped

	// Listen for the jQuery ready event on the document
	$(function() {

		// show shop page.
    api.section( 'simple-woocommerce-customizer-shop-loop', function( section ) {
         section.expanded.bind( function( isExpanded ) {
             if ( isExpanded ) {
                 var url = swcc.shop_url;
                 api.previewer.previewUrl.set( url );
             }
         } );
     } );

		 // show latest product page.
		 api.section( 'simple-woocommerce-customizer-product-page', function( section ) {
					section.expanded.bind( function( isExpanded ) {
							if ( isExpanded ) {
									var url = swcc.product_url;
									api.previewer.previewUrl.set( url );
							}
					} );
			} );

	});

	$( window ).load(function() {

	});

	// The rest of code goes here!
	console.log('The DOM may not be ready!');

}(window.jQuery, window, document,  wp.customize ));
