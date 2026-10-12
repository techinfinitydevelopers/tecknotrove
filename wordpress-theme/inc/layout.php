<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Header / footer layouts. If a published "Layout" post (CPT tt_layout) of the
 * right type exists and is built with Elementor, that is rendered; otherwise
 * the theme's PHP defaults below are used.
 */

function tecknotrove_navbar_defaults() {
	return [
		'logo'        => get_template_directory_uri() . '/assets/images/logo-white.png',
		'links'       => [
			[ 'label' => 'Home', 'url' => home_url( '/' ) ],
			[ 'label' => 'Simulation', 'url' => home_url( '/#simulation' ) ],
			[ 'label' => 'Software', 'url' => home_url( '/#software' ) ],
			[ 'label' => 'Company', 'url' => home_url( '/about/' ) ],
		],
		'cta_label'   => 'Get in Touch',
		'cta_url'     => home_url( '/contact/' ),
		'menu_groups' => [
			[ 'title' => 'Simulation', 'links' => [
				[ 'label' => 'Defence', 'url' => home_url( '/defence/' ) ],
				[ 'label' => 'Aviation', 'url' => home_url( '/aviation/' ) ],
				[ 'label' => 'Automobile', 'url' => home_url( '/automobile/' ) ],
				[ 'label' => 'OESD', 'url' => home_url( '/oesd/' ) ],
			] ],
			[ 'title' => 'Software', 'links' => [
				[ 'label' => 'Training Management System', 'url' => home_url( '/#software' ) ],
			] ],
			[ 'title' => 'Company', 'links' => [
				[ 'label' => 'About Us', 'url' => home_url( '/about/' ) ],
				[ 'label' => 'Careers', 'url' => home_url( '/careers/' ) ],
				[ 'label' => 'News', 'url' => home_url( '/news/' ) ],
				[ 'label' => 'Contact', 'url' => home_url( '/contact/' ) ],
			] ],
		],
		'address'     => '505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059',
	];
}

function tecknotrove_footer_defaults() {
	return [
		'wordmark'  => 'Tecknotrove',
		'copyright' => 'Tecknotrove Systems India Pvt Ltd. All rights reserved.',
		'explore'   => [
			[ 'label' => 'Simulation', 'url' => home_url( '/#simulation' ) ],
			[ 'label' => 'Software', 'url' => home_url( '/#software' ) ],
			[ 'label' => 'About', 'url' => home_url( '/about/' ) ],
			[ 'label' => 'Careers', 'url' => home_url( '/careers/' ) ],
			[ 'label' => 'Contact', 'url' => home_url( '/contact/' ) ],
		],
		'follow'    => [
			[ 'label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/' ],
			[ 'label' => 'YouTube', 'url' => 'https://youtu.be/hb-hqyMnMLw' ],
			[ 'label' => 'X', 'url' => '#' ],
		],
		'tagline'   => 'Precise today. Perfect tomorrow.',
	];
}

function tecknotrove_register_layout_cpt() {
	register_post_type( 'tt_layout', [
		'label'               => 'Header / Footer',
		'labels'              => [ 'name' => 'Header / Footer', 'singular_name' => 'Layout', 'add_new_item' => 'Add New Layout' ],
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'show_in_nav_menus'   => false,
		'has_archive'         => false,
		'rewrite'             => false,
		'menu_icon'           => 'dashicons-layout',
		'supports'            => [ 'title', 'editor', 'elementor' ],
	] );
}
add_action( 'init', 'tecknotrove_register_layout_cpt' );

/** Make Elementor available on pages, products, sectors and layouts. */
function tecknotrove_elementor_cpt_support() {
	$want = [ 'page', 'product', 'sector', 'tt_layout' ];
	$have = get_option( 'elementor_cpt_support', [ 'page', 'post' ] );
	if ( array_diff( $want, (array) $have ) ) {
		update_option( 'elementor_cpt_support', array_values( array_unique( array_merge( (array) $have, $want ) ) ) );
	}
}
add_action( 'admin_init', 'tecknotrove_elementor_cpt_support' );

function tecknotrove_get_layout_id( $type ) {
	$posts = get_posts( [
		'post_type'      => 'tt_layout',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'meta_key'       => '_tt_layout_type',
		'meta_value'     => $type,
		'fields'         => 'ids',
	] );
	return $posts ? (int) $posts[0] : 0;
}

function tecknotrove_the_layout( $type ) {
	$id = tecknotrove_get_layout_id( $type );
	if ( $id && class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->documents->get( $id ) ) {
		echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $id ); // phpcs:ignore WordPress.Security.EscapeOutput
		return;
	}
	get_template_part( 'template-parts/layout/' . ( 'header' === $type ? 'navbar' : 'footer' ) );
}

/** Layout posts have no public design of their own: show only their content. */
function tecknotrove_layout_template( $template ) {
	if ( is_singular( 'tt_layout' ) ) {
		return get_template_directory() . '/single-tt_layout.php';
	}
	return $template;
}
add_filter( 'template_include', 'tecknotrove_layout_template', 99 );
