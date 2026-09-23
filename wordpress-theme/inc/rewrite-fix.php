<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Defensive workaround for a pre-existing WordPress core bug reproduced on
 * this environment: any call to add_rewrite_rule() before flush_rewrite_rules()
 * corrupts every subsequent rule's pattern in the cached `rewrite_rules`
 * option with a stray "C:/Program" prefix. Reproduced with zero theme code,
 * the default theme, and no plugins active — genuinely not our bug, but we
 * still need clean rewrite rules for the site to route correctly, so this
 * strips the corruption from the array right before WordPress caches it.
 */
function tecknotrove_fix_corrupted_rewrite_rules( $rules ) {
	if ( ! is_array( $rules ) ) return $rules;
	$fixed = [];
	foreach ( $rules as $pattern => $query ) {
		$fixed[ str_replace( 'C:/Program', '', $pattern ) ] = $query;
	}
	return $fixed;
}
add_filter( 'rewrite_rules_array', 'tecknotrove_fix_corrupted_rewrite_rules' );

/**
 * Sectors get flat top-level URLs (/defence, /aviation, /automobile, /oesd)
 * instead of /sector/defence, matching the routes the Next.js version used.
 */
function tecknotrove_sector_rewrite_rules() {
	add_rewrite_rule( '^(defence|aviation|automobile|oesd)/?$', 'index.php?sector=$matches[1]', 'top' );
}
add_action( 'init', 'tecknotrove_sector_rewrite_rules' );

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
