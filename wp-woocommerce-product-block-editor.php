<?php
/*
Plugin Name: Enable block editor in WooCommerce Products
Plugin URI: https://rezahedi.dev/projects/wp-woocommerce-product-block-editor
description: Enabling WordPress block editor (Gutenberg) in WooCommerce Product page to edit product description and use it as a page builder or description tab builder. My plugin do not import any js, css or other assets to your frontend site.
Version: 1.0
Author: Reza Zahedi
Author URI: https://rezahedi.dev
*/
?>
<?php
// TODO: Add a setting page to enable/disable this option
define( 'RZ_USE_AS_PAGE_BUILDER', true );

define( 'RZ_PRODUCT_PLACEHOLDER_SHORTCODE', "[show_product_here]" );

require_once( plugin_dir_path( __FILE__ ) . 'functions.php' );
