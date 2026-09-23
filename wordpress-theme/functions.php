<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TECKNOTROVE_VERSION', '1.0.0' );

require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/repeater-field.php';
require get_template_directory() . '/inc/cpts.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/icons.php';
require get_template_directory() . '/inc/admin-assets.php';
require get_template_directory() . '/inc/meta-boxes/sector-meta.php';
require get_template_directory() . '/inc/meta-boxes/product-meta.php';

/**
 * The sector rewrite rule (see inc/cpts.php) sets a `sector` query var for
 * URLs like /defence — route those to page-sector.php instead of 404ing.
 */
function tecknotrove_sector_query_vars( $vars ) {
	$vars[] = 'sector';
	return $vars;
}
add_filter( 'query_vars', 'tecknotrove_sector_query_vars' );

function tecknotrove_sector_template( $template ) {
	$sector_key = get_query_var( 'sector' );
	if ( $sector_key ) {
		$found = locate_template( 'page-sector.php' );
		if ( $found ) return $found;
	}
	return $template;
}
add_filter( 'template_include', 'tecknotrove_sector_template' );
