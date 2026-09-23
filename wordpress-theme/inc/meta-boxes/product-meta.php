<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_add_product_meta_boxes() {
	add_meta_box( 'tt_product_hero', 'Hero', 'tecknotrove_render_product_hero_mb', 'product', 'normal', 'high' );
	add_meta_box( 'tt_product_specs', 'Quick Specs Band (5)', 'tecknotrove_render_product_specs_mb', 'product', 'normal' );
	add_meta_box( 'tt_product_overview', 'Overview', 'tecknotrove_render_product_overview_mb', 'product', 'normal' );
	add_meta_box( 'tt_product_features', 'Key Features', 'tecknotrove_render_product_features_mb', 'product', 'normal' );
	add_meta_box( 'tt_product_applications', 'Applications', 'tecknotrove_render_product_applications_mb', 'product', 'normal' );
	add_meta_box( 'tt_product_convertible', 'Convertible Kits Band', 'tecknotrove_render_product_convertible_mb', 'product', 'normal' );
	add_meta_box( 'tt_product_speclist', 'Key Specifications Table', 'tecknotrove_render_product_speclist_mb', 'product', 'normal' );
	add_meta_box( 'tt_product_faq', 'FAQ', 'tecknotrove_render_product_faq_mb', 'product', 'normal' );
}
add_action( 'add_meta_boxes', 'tecknotrove_add_product_meta_boxes' );

function tecknotrove_render_product_hero_mb( $post ) {
	wp_nonce_field( 'tecknotrove_save_product', 'tecknotrove_product_nonce' );

	$sector_id = get_post_meta( $post->ID, 'tt_sector_id', true );
	$sectors   = get_posts( [ 'post_type' => 'sector', 'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC' ] );

	$code    = get_post_meta( $post->ID, 'tt_code', true );
	$h1      = get_post_meta( $post->ID, 'tt_h1', true );
	$subhead = get_post_meta( $post->ID, 'tt_subhead', true );
	$image_id = get_post_meta( $post->ID, 'tt_image_id', true );
	?>
	<p><label>Sector<br>
		<select name="tt_sector_id" class="widefat">
			<option value="">— Select —</option>
			<?php foreach ( $sectors as $s ) : ?>
				<option value="<?php echo esc_attr( $s->ID ); ?>" <?php selected( $sector_id, $s->ID ); ?>><?php echo esc_html( $s->post_title ); ?></option>
			<?php endforeach; ?>
		</select></label></p>
	<p><label>Product code (e.g. TDS-6F)<br>
		<input type="text" name="tt_code" value="<?php echo esc_attr( $code ); ?>" class="widefat" /></label></p>
	<p><label>H1<br>
		<input type="text" name="tt_h1" value="<?php echo esc_attr( $h1 ); ?>" class="widefat" /></label></p>
	<p><label>Subhead<br>
		<textarea name="tt_subhead" rows="2" class="widefat"><?php echo esc_textarea( $subhead ); ?></textarea></label></p>
	<p><label>Hero / overview image<br>
		<?php tecknotrove_render_image_field( 'tt_image_id', $image_id ); ?>
	</label></p>
	<?php
}

function tecknotrove_render_product_specs_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_quick_specs', [
		[ 'key' => 'label', 'label' => 'Label' ],
		[ 'key' => 'value', 'label' => 'Value' ],
	] );
}

function tecknotrove_render_product_overview_mb( $post ) {
	$label   = get_post_meta( $post->ID, 'tt_overview_label', true );
	$heading = get_post_meta( $post->ID, 'tt_overview_heading', true );
	?>
	<p><label>Eyebrow label (e.g. "Introduction")<br>
		<input type="text" name="tt_overview_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" /></label></p>
	<p><label>Heading<br>
		<input type="text" name="tt_overview_heading" value="<?php echo esc_attr( $heading ); ?>" class="widefat" /></label></p>
	<?php
	tecknotrove_render_repeater( $post->ID, 'tt_overview_paragraphs', [
		[ 'key' => 'text', 'label' => 'Paragraph', 'type' => 'textarea' ],
	] );
}

function tecknotrove_render_product_features_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_features', [
		[ 'key' => 'title', 'label' => 'Title' ],
		[ 'key' => 'desc', 'label' => 'Description', 'type' => 'textarea' ],
	] );
}

function tecknotrove_render_product_applications_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_applications', [
		[ 'key' => 'category', 'label' => 'Category (e.g. Foundational)' ],
		[ 'key' => 'title', 'label' => 'Title' ],
	] );
}

function tecknotrove_render_product_convertible_mb( $post ) {
	$label   = get_post_meta( $post->ID, 'tt_convertible_label', true );
	$heading = get_post_meta( $post->ID, 'tt_convertible_heading', true );
	$stat    = get_post_meta( $post->ID, 'tt_convertible_stat', true );
	$stat_label = get_post_meta( $post->ID, 'tt_convertible_stat_label', true );
	?>
	<p><label>Eyebrow label (e.g. "Supported Platforms")<br>
		<input type="text" name="tt_convertible_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" /></label></p>
	<p><label>Heading<br>
		<input type="text" name="tt_convertible_heading" value="<?php echo esc_attr( $heading ); ?>" class="widefat" /></label></p>
	<?php
	tecknotrove_render_repeater( $post->ID, 'tt_convertible_tags', [
		[ 'key' => 'text', 'label' => 'Tag (e.g. T-72)' ],
	] );
	?>
	<p><label>Big stat (e.g. "&lt;20 minutes")<br>
		<input type="text" name="tt_convertible_stat" value="<?php echo esc_attr( $stat ); ?>" class="widefat" /></label></p>
	<p><label>Stat caption<br>
		<input type="text" name="tt_convertible_stat_label" value="<?php echo esc_attr( $stat_label ); ?>" class="widefat" /></label></p>
	<?php
}

function tecknotrove_render_product_speclist_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_specs', [
		[ 'key' => 'label', 'label' => 'Label' ],
		[ 'key' => 'value', 'label' => 'Value' ],
	] );
}

function tecknotrove_render_product_faq_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_faq', [
		[ 'key' => 'q', 'label' => 'Question' ],
		[ 'key' => 'a', 'label' => 'Answer', 'type' => 'textarea' ],
	] );
}

function tecknotrove_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['tecknotrove_product_nonce'] ) || ! wp_verify_nonce( $_POST['tecknotrove_product_nonce'], 'tecknotrove_save_product' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$text_fields = [ 'tt_sector_id', 'tt_code', 'tt_h1', 'tt_image_id', 'tt_overview_label', 'tt_overview_heading', 'tt_convertible_label', 'tt_convertible_heading', 'tt_convertible_stat', 'tt_convertible_stat_label' ];
	foreach ( $text_fields as $f ) {
		if ( isset( $_POST[ $f ] ) ) update_post_meta( $post_id, $f, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
	}
	if ( isset( $_POST['tt_subhead'] ) ) update_post_meta( $post_id, 'tt_subhead', sanitize_textarea_field( wp_unslash( $_POST['tt_subhead'] ) ) );

	tecknotrove_save_repeater( $post_id, 'tt_quick_specs' );
	tecknotrove_save_repeater( $post_id, 'tt_overview_paragraphs' );
	tecknotrove_save_repeater( $post_id, 'tt_features' );
	tecknotrove_save_repeater( $post_id, 'tt_applications' );
	tecknotrove_save_repeater( $post_id, 'tt_convertible_tags' );
	tecknotrove_save_repeater( $post_id, 'tt_specs' );
	tecknotrove_save_repeater( $post_id, 'tt_faq' );
}
add_action( 'save_post_product', 'tecknotrove_save_product_meta' );
