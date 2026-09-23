<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_admin_assets( $hook ) {
	global $post_type;
	$is_cpt_edit_screen = in_array( $post_type, [ 'sector', 'product' ], true ) && in_array( $hook, [ 'post.php', 'post-new.php' ], true );
	$is_homepage_screen = 'toplevel_page_tecknotrove-homepage' === $hook;
	if ( ! $is_cpt_edit_screen && ! $is_homepage_screen ) return;

	wp_enqueue_media();
	wp_enqueue_script( 'tecknotrove-admin-repeater', get_template_directory_uri() . '/assets/js/admin-repeater.js', [], TECKNOTROVE_VERSION, true );
	wp_enqueue_script( 'tecknotrove-admin-media', get_template_directory_uri() . '/assets/js/admin-media.js', [ 'jquery' ], TECKNOTROVE_VERSION, true );
	wp_enqueue_style( 'tecknotrove-admin', get_template_directory_uri() . '/assets/css/admin.css', [], TECKNOTROVE_VERSION );
}
add_action( 'admin_enqueue_scripts', 'tecknotrove_admin_assets' );
