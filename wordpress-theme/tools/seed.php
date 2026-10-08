<?php
/**
 * One-off content seeder. Run: wp eval-file wp-content/themes/tecknotrove/tools/seed.php
 * Env TT_IMAGES = absolute path to the folder holding sector-*.jpg
 */
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$data = json_decode( file_get_contents( __DIR__ . '/seed-data.json' ), true );
$imgdir = getenv( 'TT_IMAGES' );

function tt_seed_image( $imgdir, $file ) {
	$src = $imgdir . '/' . basename( $file );
	if ( ! file_exists( $src ) ) return 0;
	$tmp = wp_tempnam( $src ); copy( $src, $tmp );
	$id = media_handle_sideload( [ 'name' => basename( $src ), 'tmp_name' => $tmp ], 0 );
	return is_wp_error( $id ) ? 0 : $id;
}
function tt_rows( $arr, $key ) { return array_map( fn( $v ) => is_array( $v ) ? $v : [ $key => $v ], $arr ?: [] ); }
function tt_upsert( $type, $slug, $title ) {
	$ex = get_posts( [ 'post_type' => $type, 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'any' ] );
	$args = [ 'post_type' => $type, 'post_name' => $slug, 'post_title' => $title, 'post_status' => 'publish' ];
	if ( $ex ) { $args['ID'] = $ex[0]->ID; return wp_update_post( $args ); }
	return wp_insert_post( $args );
}

$sector_ids = [];
foreach ( $data['sectors'] as $s ) {
	$id = tt_upsert( 'sector', $s['key'], $s['name'] );
	$sector_ids[ $s['key'] ] = $id;
	$m = [
		'tt_eyebrow' => $s['eyebrow'], 'tt_accent' => $s['accent'], 'tt_h1' => $s['h1'], 'tt_subhead' => $s['subhead'],
		'tt_stats' => $s['stats'], 'tt_benefits' => $s['benefits'],
		'tt_applications_label' => $s['applicationsLabel'], 'tt_applications_heading' => $s['applicationsHeading'], 'tt_applications_body' => $s['applicationsBody'],
		'tt_applications' => tt_rows( $s['applications'], 'title' ),
		'tt_technology_label' => $s['technologyLabel'], 'tt_technology_heading' => $s['technologyHeading'], 'tt_technology_body' => $s['technologyBody'],
		'tt_technology_bullets' => tt_rows( $s['technologyBullets'], 'text' ),
	];
	if ( ! empty( $s['trust'] ) ) {
		$m['tt_trust_heading'] = $s['trust']['heading']; $m['tt_trust_body'] = $s['trust']['body']; $m['tt_trust_stats'] = $s['trust']['stats'];
	}
	if ( $imgdir && ! get_post_meta( $id, 'tt_image_id', true ) ) { $img = tt_seed_image( $imgdir, $s['image'] ); if ( $img ) $m['tt_image_id'] = $img; }
	foreach ( $m as $k => $v ) update_post_meta( $id, $k, $v );
	echo "sector {$s['key']} #$id\n";
}
foreach ( $data['products'] as $p ) {
	$id = tt_upsert( 'product', $p['slug'], $p['name'] );
	$m = [
		'tt_sector_id' => $sector_ids[ $p['sectorKey'] ] ?? 0, 'tt_code' => $p['code'], 'tt_h1' => $p['h1'], 'tt_subhead' => $p['subhead'],
		'tt_quick_specs' => $p['quickSpecs'], 'tt_overview_label' => $p['overviewLabel'], 'tt_overview_heading' => $p['overviewHeading'],
		'tt_overview_paragraphs' => tt_rows( $p['overviewParagraphs'], 'text' ), 'tt_features' => $p['features'], 'tt_applications' => $p['applications'],
		'tt_convertible_label' => $p['convertible']['label'], 'tt_convertible_heading' => $p['convertible']['heading'],
		'tt_convertible_tags' => tt_rows( $p['convertible']['tags'], 'text' ), 'tt_convertible_stat' => $p['convertible']['stat'],
		'tt_convertible_stat_label' => $p['convertible']['statLabel'], 'tt_specs' => $p['specs'], 'tt_faq' => $p['faq'],
	];
	if ( $imgdir && ! get_post_meta( $id, 'tt_image_id', true ) ) { $img = tt_seed_image( $imgdir, $p['image'] ); if ( $img ) $m['tt_image_id'] = $img; }
	foreach ( $m as $k => $v ) update_post_meta( $id, $k, $v );
	echo "product {$p['slug']} #$id\n";
}
flush_rewrite_rules();
