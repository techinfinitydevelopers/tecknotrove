<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_register_cpts() {
	register_post_type( 'sector', [
		'labels' => [
			'name'          => 'Sectors',
			'singular_name' => 'Sector',
			'add_new_item'  => 'Add New Sector',
			'edit_item'     => 'Edit Sector',
		],
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-shield',
		'supports'     => [ 'title' ],
		// Its own default rewrite is disabled — flat URLs (/defence, not
		// /sector/defence) are registered separately in inc/rewrite-fix.php.
		'rewrite'      => false,
	] );

	register_post_type( 'product', [
		'labels' => [
			'name'          => 'Products',
			'singular_name' => 'Product',
			'add_new_item'  => 'Add New Product',
			'edit_item'     => 'Edit Product',
		],
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-admin-tools',
		'supports'     => [ 'title' ],
		'rewrite'      => [ 'slug' => 'products' ],
	] );
}
add_action( 'init', 'tecknotrove_register_cpts' );
