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
		'rewrite'      => [ 'slug' => 'sector' ],
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

/**
 * Sectors have a small, fixed set of URL slugs the rest of the site links
 * to directly (/defence, /aviation, /automobile, /oesd) rather than
 * /sector/defence, matching the routes the Next.js version already used.
 */
function tecknotrove_sector_rewrite_rules() {
	add_rewrite_rule( '^(defence|aviation|automobile|oesd)/?$', 'index.php?sector=$matches[1]', 'top' );
}
add_action( 'init', 'tecknotrove_sector_rewrite_rules' );
