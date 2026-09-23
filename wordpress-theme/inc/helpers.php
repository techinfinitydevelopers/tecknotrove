<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/** #rrggbb -> "rgba(r,g,b,alpha)" */
function tecknotrove_hex_to_rgba( $hex, $alpha = 1 ) {
	$hex = ltrim( $hex ?: '#0033a1', '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );
	return "rgba({$r}, {$g}, {$b}, {$alpha})";
}

function tecknotrove_get_sector_by_key( $key ) {
	$posts = get_posts( [
		'post_type'      => 'sector',
		'name'           => $key,
		'posts_per_page' => 1,
	] );
	return $posts ? $posts[0] : null;
}

/**
 * Normalizes a `sector` post into the flat array every sector template
 * partial expects, so template-parts never call get_post_meta directly.
 */
function tecknotrove_get_sector_data( $post ) {
	$id = $post->ID;
	$accent = get_post_meta( $id, 'tt_accent', true ) ?: '#0033a1';

	return [
		'id'                    => $id,
		'key'                   => $post->post_name,
		'name'                  => $post->post_title,
		'eyebrow'               => get_post_meta( $id, 'tt_eyebrow', true ),
		'accent'                => $accent,
		'accent_soft'           => tecknotrove_hex_to_rgba( $accent, 0.16 ),
		'h1'                    => get_post_meta( $id, 'tt_h1', true ),
		'subhead'               => get_post_meta( $id, 'tt_subhead', true ),
		'image'                 => wp_get_attachment_image_url( get_post_meta( $id, 'tt_image_id', true ), 'full' ),
		'stats'                 => get_post_meta( $id, 'tt_stats', true ) ?: [],
		'benefits'              => get_post_meta( $id, 'tt_benefits', true ) ?: [],
		'applications_label'    => get_post_meta( $id, 'tt_applications_label', true ),
		'applications_heading'  => get_post_meta( $id, 'tt_applications_heading', true ),
		'applications_body'     => get_post_meta( $id, 'tt_applications_body', true ),
		'applications'          => get_post_meta( $id, 'tt_applications', true ) ?: [],
		'technology_label'      => get_post_meta( $id, 'tt_technology_label', true ),
		'technology_heading'    => get_post_meta( $id, 'tt_technology_heading', true ),
		'technology_body'       => get_post_meta( $id, 'tt_technology_body', true ),
		'technology_bullets'    => get_post_meta( $id, 'tt_technology_bullets', true ) ?: [],
		'trust_heading'         => get_post_meta( $id, 'tt_trust_heading', true ),
		'trust_body'            => get_post_meta( $id, 'tt_trust_body', true ),
		'trust_stats'           => get_post_meta( $id, 'tt_trust_stats', true ) ?: [],
	];
}

function tecknotrove_get_product_data( $post ) {
	$id        = $post->ID;
	$sector_id = get_post_meta( $id, 'tt_sector_id', true );
	$sector    = $sector_id ? get_post( $sector_id ) : null;

	return [
		'id'                    => $id,
		'slug'                  => $post->post_name,
		'name'                  => $post->post_title,
		'sector_id'             => $sector_id,
		'sector_key'            => $sector ? $sector->post_name : '',
		'sector_name'           => $sector ? $sector->post_title : '',
		'code'                  => get_post_meta( $id, 'tt_code', true ),
		'h1'                    => get_post_meta( $id, 'tt_h1', true ),
		'subhead'               => get_post_meta( $id, 'tt_subhead', true ),
		'image'                 => wp_get_attachment_image_url( get_post_meta( $id, 'tt_image_id', true ), 'full' ),
		'quick_specs'           => get_post_meta( $id, 'tt_quick_specs', true ) ?: [],
		'overview_label'        => get_post_meta( $id, 'tt_overview_label', true ),
		'overview_heading'      => get_post_meta( $id, 'tt_overview_heading', true ),
		'overview_paragraphs'   => get_post_meta( $id, 'tt_overview_paragraphs', true ) ?: [],
		'features'              => get_post_meta( $id, 'tt_features', true ) ?: [],
		'applications'          => get_post_meta( $id, 'tt_applications', true ) ?: [],
		'convertible_label'     => get_post_meta( $id, 'tt_convertible_label', true ),
		'convertible_heading'   => get_post_meta( $id, 'tt_convertible_heading', true ),
		'convertible_tags'      => get_post_meta( $id, 'tt_convertible_tags', true ) ?: [],
		'convertible_stat'      => get_post_meta( $id, 'tt_convertible_stat', true ),
		'convertible_stat_label'=> get_post_meta( $id, 'tt_convertible_stat_label', true ),
		'specs'                 => get_post_meta( $id, 'tt_specs', true ) ?: [],
		'faq'                   => get_post_meta( $id, 'tt_faq', true ) ?: [],
	];
}

/** Up to 3 other products in the same sector, for the "related" section. */
function tecknotrove_get_related_products( $product_data, $limit = 3 ) {
	if ( ! $product_data['sector_id'] ) return [];
	$posts = get_posts( [
		'post_type'      => 'product',
		'posts_per_page' => $limit,
		'post__not_in'   => [ $product_data['id'] ],
		'meta_query'     => [
			[ 'key' => 'tt_sector_id', 'value' => $product_data['sector_id'] ],
		],
	] );
	return array_map( 'tecknotrove_get_product_data', $posts );
}
