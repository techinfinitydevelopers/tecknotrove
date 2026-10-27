<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Per-page SEO: title tag + meta description (meta keys tt_seo_title / tt_seo_desc),
 * editable on pages, hubs, products and sectors.
 */
function tecknotrove_seo_meta_box() {
	foreach ( [ 'page', 'hub', 'product', 'sector' ] as $type ) {
		add_meta_box( 'tt_seo', 'SEO (title tag and meta description)', function ( $post ) {
			wp_nonce_field( 'tt_seo', 'tt_seo_nonce' );
			$t = get_post_meta( $post->ID, 'tt_seo_title', true );
			$d = get_post_meta( $post->ID, 'tt_seo_desc', true );
			?>
			<p><label>Title tag (about 50-60 characters)<br>
				<input type="text" name="tt_seo_title" value="<?php echo esc_attr( $t ); ?>" class="widefat" /></label></p>
			<p><label>Meta description (about 120-155 characters)<br>
				<textarea name="tt_seo_desc" rows="3" class="widefat"><?php echo esc_textarea( $d ); ?></textarea></label></p>
			<?php
		}, $type, 'normal' );
	}
}
add_action( 'add_meta_boxes', 'tecknotrove_seo_meta_box' );

function tecknotrove_seo_save( $post_id ) {
	if ( ! isset( $_POST['tt_seo_nonce'] ) || ! wp_verify_nonce( $_POST['tt_seo_nonce'], 'tt_seo' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;
	update_post_meta( $post_id, 'tt_seo_title', sanitize_text_field( wp_unslash( $_POST['tt_seo_title'] ?? '' ) ) );
	update_post_meta( $post_id, 'tt_seo_desc', sanitize_textarea_field( wp_unslash( $_POST['tt_seo_desc'] ?? '' ) ) );
}
add_action( 'save_post', 'tecknotrove_seo_save' );

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( is_singular() ) {
		$t = get_post_meta( get_queried_object_id(), 'tt_seo_title', true );
		if ( $t ) return $t;
	}
	return $title;
} );

add_action( 'wp_head', function () {
	if ( ! is_singular() ) return;
	$d = get_post_meta( get_queried_object_id(), 'tt_seo_desc', true );
	if ( $d ) echo '<meta name="description" content="' . esc_attr( $d ) . '" />' . "\n";
}, 1 );
