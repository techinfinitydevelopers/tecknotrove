<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Support for the Framer "Modern Carousel" component as an Elementor widget
 * (tt_framer_carousel). Framer components are React modules, so the page gets an
 * import map pointing React / framer-motion at esm.sh and "framer" at a tiny local stub.
 */

function tecknotrove_page_uses_framer_carousel() {
	if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->preview->is_preview_mode() ) return true;
	$id = get_queried_object_id();
	return $id && false !== strpos( (string) get_post_meta( $id, '_elementor_data', true ), 'tt_framer_carousel' );
}

add_action( 'wp_head', function () {
	if ( ! tecknotrove_page_uses_framer_carousel() ) return;
	$map = [ 'imports' => [
		'react'              => 'https://esm.sh/react@18.3.1',
		'react/jsx-runtime'  => 'https://esm.sh/react@18.3.1/jsx-runtime',
		'react-dom/client'   => 'https://esm.sh/react-dom@18.3.1/client?external=react',
		'framer-motion'      => 'https://esm.sh/framer-motion@11.18.2?external=react,react-dom',
		'framer'             => get_template_directory_uri() . '/assets/js/framer-stub.js',
	] ];
	echo '<script type="importmap">' . wp_json_encode( $map, JSON_UNESCAPED_SLASHES ) . "</script>\n";
}, 1 );

add_action( 'wp_enqueue_scripts', function () {
	if ( ! tecknotrove_page_uses_framer_carousel() ) return;
	$file = get_template_directory() . '/assets/js/framer-carousel.js';
	wp_enqueue_script( 'tecknotrove-framer-carousel', get_template_directory_uri() . '/assets/js/framer-carousel.js', [], filemtime( $file ), true );
} );
