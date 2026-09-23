<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
	add_theme_support( 'custom-logo' );

	register_nav_menus( [
		'primary' => 'Primary Navigation',
		'footer'  => 'Footer Navigation',
	] );
}
add_action( 'after_setup_theme', 'tecknotrove_theme_setup' );

function tecknotrove_enqueue_assets() {
	wp_enqueue_style( 'tecknotrove-fonts', 'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=JetBrains+Mono:wght@400;500&display=swap', [], null );
	wp_enqueue_style( 'tecknotrove-style', get_template_directory_uri() . '/assets/css/style.css', [], TECKNOTROVE_VERSION );
	wp_enqueue_script( 'tecknotrove-main', get_template_directory_uri() . '/assets/js/main.js', [], TECKNOTROVE_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'tecknotrove_enqueue_assets' );
