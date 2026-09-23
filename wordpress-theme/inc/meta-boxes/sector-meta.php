<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_add_sector_meta_boxes() {
	add_meta_box( 'tt_sector_hero', 'Hero', 'tecknotrove_render_sector_hero_mb', 'sector', 'normal', 'high' );
	add_meta_box( 'tt_sector_stats', 'Stat Strip (4)', 'tecknotrove_render_sector_stats_mb', 'sector', 'normal' );
	add_meta_box( 'tt_sector_benefits', 'Benefits of Simulation (leave blank to hide this section)', 'tecknotrove_render_sector_benefits_mb', 'sector', 'normal' );
	add_meta_box( 'tt_sector_applications', 'Applications', 'tecknotrove_render_sector_applications_mb', 'sector', 'normal' );
	add_meta_box( 'tt_sector_technology', 'Technology', 'tecknotrove_render_sector_technology_mb', 'sector', 'normal' );
	add_meta_box( 'tt_sector_trust', 'Track Record / Trust (leave blank to hide this section)', 'tecknotrove_render_sector_trust_mb', 'sector', 'normal' );
}
add_action( 'add_meta_boxes', 'tecknotrove_add_sector_meta_boxes' );

function tecknotrove_render_sector_hero_mb( $post ) {
	wp_nonce_field( 'tecknotrove_save_sector', 'tecknotrove_sector_nonce' );
	$eyebrow = get_post_meta( $post->ID, 'tt_eyebrow', true );
	$accent  = get_post_meta( $post->ID, 'tt_accent', true ) ?: '#0033a1';
	$h1      = get_post_meta( $post->ID, 'tt_h1', true );
	$subhead = get_post_meta( $post->ID, 'tt_subhead', true );
	$image_id = get_post_meta( $post->ID, 'tt_image_id', true );
	?>
	<p><label>Eyebrow (e.g. "Tecknotrove Defence")<br>
		<input type="text" name="tt_eyebrow" value="<?php echo esc_attr( $eyebrow ); ?>" class="widefat" /></label></p>
	<p><label>Accent colour<br>
		<input type="text" name="tt_accent" value="<?php echo esc_attr( $accent ); ?>" class="tt-color-field" /></label></p>
	<p><label>H1<br>
		<input type="text" name="tt_h1" value="<?php echo esc_attr( $h1 ); ?>" class="widefat" /></label></p>
	<p><label>Subhead<br>
		<textarea name="tt_subhead" rows="2" class="widefat"><?php echo esc_textarea( $subhead ); ?></textarea></label></p>
	<p><label>Hero / background image<br>
		<?php tecknotrove_render_image_field( 'tt_image_id', $image_id ); ?>
	</label></p>
	<?php
}

function tecknotrove_render_image_field( $name, $image_id ) {
	$url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
	?>
	<div class="tt-image-field">
		<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $image_id ); ?>" class="tt-image-id" />
		<img src="<?php echo esc_url( $url ); ?>" style="max-width:200px;display:<?php echo $url ? 'block' : 'none'; ?>;margin-bottom:8px;" class="tt-image-preview" />
		<button type="button" class="button tt-image-select"><?php echo $url ? 'Change image' : 'Select image'; ?></button>
		<button type="button" class="button tt-image-remove" style="display:<?php echo $url ? 'inline-block' : 'none'; ?>;">Remove</button>
	</div>
	<?php
}

function tecknotrove_render_sector_stats_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_stats', [
		[ 'key' => 'value', 'label' => 'Value (e.g. 20+)' ],
		[ 'key' => 'label', 'label' => 'Label (e.g. Years in Defence)' ],
	] );
}

function tecknotrove_render_sector_benefits_mb( $post ) {
	tecknotrove_render_repeater( $post->ID, 'tt_benefits', [
		[ 'key' => 'title', 'label' => 'Title' ],
		[ 'key' => 'desc', 'label' => 'Description', 'type' => 'textarea' ],
	] );
}

function tecknotrove_render_sector_applications_mb( $post ) {
	$label   = get_post_meta( $post->ID, 'tt_applications_label', true );
	$heading = get_post_meta( $post->ID, 'tt_applications_heading', true );
	$body    = get_post_meta( $post->ID, 'tt_applications_body', true );
	?>
	<p><label>Eyebrow label (e.g. "02 / Applications")<br>
		<input type="text" name="tt_applications_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" /></label></p>
	<p><label>Heading<br>
		<input type="text" name="tt_applications_heading" value="<?php echo esc_attr( $heading ); ?>" class="widefat" /></label></p>
	<p><label>Body<br>
		<textarea name="tt_applications_body" rows="2" class="widefat"><?php echo esc_textarea( $body ); ?></textarea></label></p>
	<?php
	tecknotrove_render_repeater( $post->ID, 'tt_applications', [
		[ 'key' => 'title', 'label' => 'Application' ],
	] );
}

function tecknotrove_render_sector_technology_mb( $post ) {
	$label   = get_post_meta( $post->ID, 'tt_technology_label', true );
	$heading = get_post_meta( $post->ID, 'tt_technology_heading', true );
	$body    = get_post_meta( $post->ID, 'tt_technology_body', true );
	?>
	<p><label>Eyebrow label (e.g. "03 / Technology")<br>
		<input type="text" name="tt_technology_label" value="<?php echo esc_attr( $label ); ?>" class="widefat" /></label></p>
	<p><label>Heading<br>
		<input type="text" name="tt_technology_heading" value="<?php echo esc_attr( $heading ); ?>" class="widefat" /></label></p>
	<p><label>Body<br>
		<textarea name="tt_technology_body" rows="2" class="widefat"><?php echo esc_textarea( $body ); ?></textarea></label></p>
	<?php
	tecknotrove_render_repeater( $post->ID, 'tt_technology_bullets', [
		[ 'key' => 'text', 'label' => 'Bullet point' ],
	] );
}

function tecknotrove_render_sector_trust_mb( $post ) {
	$heading = get_post_meta( $post->ID, 'tt_trust_heading', true );
	$body    = get_post_meta( $post->ID, 'tt_trust_body', true );
	?>
	<p><label>Heading<br>
		<input type="text" name="tt_trust_heading" value="<?php echo esc_attr( $heading ); ?>" class="widefat" /></label></p>
	<p><label>Body<br>
		<textarea name="tt_trust_body" rows="2" class="widefat"><?php echo esc_textarea( $body ); ?></textarea></label></p>
	<?php
	tecknotrove_render_repeater( $post->ID, 'tt_trust_stats', [
		[ 'key' => 'value', 'label' => 'Value' ],
		[ 'key' => 'label', 'label' => 'Label' ],
	] );
}

function tecknotrove_save_sector_meta( $post_id ) {
	if ( ! isset( $_POST['tecknotrove_sector_nonce'] ) || ! wp_verify_nonce( $_POST['tecknotrove_sector_nonce'], 'tecknotrove_save_sector' ) ) return;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	$text_fields = [ 'tt_eyebrow', 'tt_accent', 'tt_h1', 'tt_image_id', 'tt_applications_label', 'tt_applications_heading', 'tt_technology_label', 'tt_technology_heading', 'tt_trust_heading' ];
	foreach ( $text_fields as $f ) {
		if ( isset( $_POST[ $f ] ) ) update_post_meta( $post_id, $f, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
	}
	$textarea_fields = [ 'tt_subhead', 'tt_applications_body', 'tt_technology_body', 'tt_trust_body' ];
	foreach ( $textarea_fields as $f ) {
		if ( isset( $_POST[ $f ] ) ) update_post_meta( $post_id, $f, sanitize_textarea_field( wp_unslash( $_POST[ $f ] ) ) );
	}

	tecknotrove_save_repeater( $post_id, 'tt_stats' );
	tecknotrove_save_repeater( $post_id, 'tt_benefits' );
	tecknotrove_save_repeater( $post_id, 'tt_applications' );
	tecknotrove_save_repeater( $post_id, 'tt_technology_bullets' );
	tecknotrove_save_repeater( $post_id, 'tt_trust_stats' );
}
add_action( 'save_post_sector', 'tecknotrove_save_sector_meta' );
