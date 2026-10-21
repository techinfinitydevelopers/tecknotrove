<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Aviation hub structure (client doc "Aviation Hub Menu Layout"):
 * industry page (/aviation/) -> hub pages (/aviation/gse-simulators/) -> product pages (/products/cargo-loader-simulator/).
 * Hubs are a CPT; a product belongs to a hub through the `tt_hub_id` meta. Pages are built with Elementor widgets.
 */
function tecknotrove_register_hub_cpt() {
	register_post_type( 'hub', [
		'labels' => [
			'name'          => 'Hubs',
			'singular_name' => 'Hub',
			'add_new_item'  => 'Add New Hub',
			'edit_item'     => 'Edit Hub',
		],
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'menu_icon'    => 'dashicons-networking',
		'supports'     => [ 'title', 'page-attributes' ],
		'rewrite'      => [ 'slug' => 'aviation', 'with_front' => false ],
	] );
}
add_action( 'init', 'tecknotrove_register_hub_cpt' );

/** Product -> hub link (select box on the product edit screen). */
function tecknotrove_hub_product_meta_box() {
	add_meta_box( 'tt_product_hub', 'Hub', function ( $post ) {
		wp_nonce_field( 'tt_product_hub', 'tt_product_hub_nonce' );
		$cur = (int) get_post_meta( $post->ID, 'tt_hub_id', true );
		echo '<select name="tt_hub_id" class="widefat"><option value="">None</option>';
		foreach ( get_posts( [ 'post_type' => 'hub', 'numberposts' => -1, 'orderby' => 'menu_order title', 'order' => 'ASC' ] ) as $h ) {
			printf( '<option value="%d"%s>%s</option>', $h->ID, selected( $cur, $h->ID, false ), esc_html( $h->post_title ) );
		}
		echo '</select>';
	}, 'product', 'side' );
}
add_action( 'add_meta_boxes', 'tecknotrove_hub_product_meta_box' );

add_action( 'save_post_product', function ( $post_id ) {
	if ( ! isset( $_POST['tt_product_hub_nonce'] ) || ! wp_verify_nonce( $_POST['tt_product_hub_nonce'], 'tt_product_hub' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	update_post_meta( $post_id, 'tt_hub_id', (int) ( $_POST['tt_hub_id'] ?? 0 ) );
} );

/** Hubs in menu order. */
function tecknotrove_av_hubs() {
	return get_posts( [ 'post_type' => 'hub', 'numberposts' => -1, 'post_status' => 'publish', 'orderby' => 'menu_order title', 'order' => 'ASC' ] );
}

function tecknotrove_av_hub_products( $hub_id ) {
	return get_posts( [
		'post_type' => 'product', 'numberposts' => -1, 'post_status' => 'publish',
		'meta_key' => 'tt_hub_id', 'meta_value' => (int) $hub_id, 'orderby' => 'menu_order title', 'order' => 'ASC',
	] );
}

/** Menu data for the Aviation sub-navigation: [ [hub post, [product posts]] ]. */
function tecknotrove_av_menu() {
	$out = [];
	foreach ( tecknotrove_av_hubs() as $h ) {
		$out[] = [ 'hub' => $h, 'products' => tecknotrove_av_hub_products( $h->ID ) ];
	}
	return $out;
}

add_action( 'init', function () {
	$s = get_option( 'elementor_cpt_support', [] );
	if ( is_array( $s ) && ! in_array( 'hub', $s, true ) ) { $s[] = 'hub'; update_option( 'elementor_cpt_support', $s ); }
}, 20 );
