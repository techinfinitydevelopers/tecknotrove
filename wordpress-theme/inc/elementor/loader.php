<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Elementor integration: one custom widget per theme section, so every page
 * (home, sectors, product, about, careers, news, contact, header, footer) is
 * built and edited visually in Elementor while keeping the theme's design.
 * Widgets are declared as data in definitions.php and turned into classes here.
 */
if ( ! did_action( 'elementor/loaded' ) ) return;

require_once __DIR__ . '/framer-carousel.php';

add_action( 'elementor/elements/categories_registered', function ( $manager ) {
	$manager->add_category( 'tecknotrove', [ 'title' => 'Tecknotrove', 'icon' => 'eicon-folder' ] );
} );

add_action( 'elementor/widgets/register', function ( $widgets ) {
	require_once __DIR__ . '/base-widget.php';
	foreach ( array_keys( tecknotrove_el_defs() ) as $name ) {
		if ( ! preg_match( '/^[a-z0-9_]+$/', $name ) ) continue;
		$class = 'TT_El_' . $name;
		if ( ! class_exists( $class ) ) {
			// $name is a fixed identifier from definitions.php, never user input.
			eval( "class {$class} extends TT_Widget { const NAME = '{$name}'; }" );
		}
		$widgets->register( new $class() );
	}
} );

/** Inside the editor, show scroll-reveal content immediately. */
add_action( 'wp_head', function () {
	if ( class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
		echo '<style>[data-reveal]{opacity:1!important;transform:none!important;filter:none!important}</style>';
	}
} );

function tecknotrove_el_defs() {
	static $defs = null;
	if ( null === $defs ) {
		$defs = require __DIR__ . '/definitions.php';
	}
	return $defs;
}

/** Render a theme partial with option overrides + variables in scope. */
function tecknotrove_el_render_part( $slug, $overrides = [], $vars = [] ) {
	$GLOBALS['tt_override'] = $overrides;
	extract( $vars, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract
	include get_template_directory() . '/template-parts/' . $slug . '.php';
	unset( $GLOBALS['tt_override'] );
}

/**
 * Elementor's stylesheets are un-layered, which would beat Tailwind's layered
 * utilities (e.g. `.elementor img { height:auto }` vs `h-7`). Load Elementor's
 * CSS inside a cascade layer that sits below Tailwind's layers.
 */
add_action( 'wp_head', function () {
	echo '<style id="tt-layer-order">@layer elementor, theme, base, components, utilities;</style>' . "\n";
}, 0 );

add_filter( 'style_loader_tag', function ( $tag, $handle, $href ) {
	if ( is_admin() ) return $tag;
	if ( 0 === strpos( $handle, 'elementor' ) || 0 === strpos( $handle, 'e-' ) || 0 === strpos( $handle, 'widget-' ) || 'swiper' === $handle ) {
		return sprintf( "<style id=\"%s-css\">@import url(\"%s\") layer(elementor);</style>\n", esc_attr( $handle ), esc_url( $href ) );
	}
	return $tag;
}, 10, 3 );
