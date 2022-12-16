<?php
// Enable block editor (FSE) for woocommerce product page
// Read more here: https://docs.wpstackable.com/article/485-how-to-use-the-block-editor-in-woocommerce-product-pages
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );

function activate_gutenberg_product( $can_edit, $post_type ) {

	if ( $post_type == 'product' ) {
		$can_edit = true;
	}

	return $can_edit;
}

// enable taxonomy fields for woocommerce with gutenberg on
add_filter( 'woocommerce_taxonomy_args_product_cat', 'enable_taxonomy_rest' );
add_filter( 'woocommerce_taxonomy_args_product_tag', 'enable_taxonomy_rest' );

function enable_taxonomy_rest( $args ) {

	$args['show_in_rest'] = true;

	return $args;
}

// Use product description content as the page builder content
if ( RZ_USE_AS_PAGE_BUILDER )
	add_action( 'woocommerce_before_main_content', 'rz_single_product_use_block_editor' );

function rz_single_product_use_block_editor(){

	if( is_product() ) {

		// Get the content of the product page
		$product_description = get_the_content();

		// if RZ_PRODUCT_PLACEHOLDER_SHORTCODE exists in the content of the product page, split the content and show the two parts before and after the shortcode
		if( strpos($product_description, RZ_PRODUCT_PLACEHOLDER_SHORTCODE) !== false ) {

			// Change the breadcrumb position from before main to before single product summary
			remove_filter('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
			add_filter('woocommerce_before_single_product_summary', 'woocommerce_breadcrumb');

			// Add filter to remove the description tab
			add_filter( 'woocommerce_product_tabs', 'rz_remove_description_tabs', 20 );


			// Use product description as the page builder content
			$product_description = explode( RZ_PRODUCT_PLACEHOLDER_SHORTCODE, $product_description );
			add_filter('woocommerce_before_main_content', function() use ($product_description) {
				echo $product_description[0];
			}, 20);

			add_filter('woocommerce_after_main_content', function() use ($product_description) {
				echo $product_description[1];
			}, 200);
		}
	}
}

// Remove the description tab from the product page
function rz_remove_description_tabs( $tabs ) {
	unset( $tabs['description'] );
	return $tabs;
}
