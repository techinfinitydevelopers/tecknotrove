<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_admin_assets( $hook ) {
	global $post_type;
	if ( ! in_array( $post_type, [ 'sector', 'product' ], true ) ) return;
	if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) return;

	wp_enqueue_media();
	wp_enqueue_script( 'tecknotrove-admin-repeater', get_template_directory_uri() . '/assets/js/admin-repeater.js', [], TECKNOTROVE_VERSION, true );
	wp_enqueue_script( 'tecknotrove-admin-media', get_template_directory_uri() . '/assets/js/admin-media.js', [ 'jquery' ], TECKNOTROVE_VERSION, true );
	wp_enqueue_style( 'tecknotrove-admin', get_template_directory_uri() . '/assets/css/admin.css', [], TECKNOTROVE_VERSION );
}
add_action( 'admin_enqueue_scripts', 'tecknotrove_admin_assets' );
