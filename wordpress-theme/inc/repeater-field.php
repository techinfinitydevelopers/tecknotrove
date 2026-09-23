<?php
/**
 * Minimal dependency-free "repeater" field for post meta boxes.
 * WordPress core has no repeater UI; this avoids requiring a paid ACF PRO
 * license just to let editors add/remove rows (stats, features, FAQ, etc).
 *
 * Usage inside a meta box render callback:
 *   tecknotrove_render_repeater( $post->ID, 'tt_stats', [
 *     [ 'key' => 'value', 'label' => 'Value', 'type' => 'text' ],
 *     [ 'key' => 'label', 'label' => 'Label', 'type' => 'text' ],
 *   ] );
 *
 * Saved as an indexed array of assoc arrays under postmeta key `tt_stats`.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function tecknotrove_render_repeater( $post_id, $meta_key, $fields ) {
	$rows = get_post_meta( $post_id, $meta_key, true );
	if ( ! is_array( $rows ) ) $rows = [];
	if ( empty( $rows ) ) $rows = [ [] ]; // always show at least one blank row
	?>
	<div class="tt-repeater" data-key="<?php echo esc_attr( $meta_key ); ?>">
		<table class="tt-repeater-table widefat">
			<thead>
				<tr>
					<?php foreach ( $fields as $f ) : ?>
						<th><?php echo esc_html( $f['label'] ); ?></th>
					<?php endforeach; ?>
					<th style="width:40px"></th>
				</tr>
			</thead>
			<tbody class="tt-repeater-rows">
				<?php foreach ( $rows as $i => $row ) : ?>
					<?php tecknotrove_render_repeater_row( $meta_key, $fields, $i, $row ); ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<button type="button" class="button tt-repeater-add"><?php esc_html_e( '+ Add row', 'tecknotrove' ); ?></button>
	</div>

	<script type="text/template" class="tt-repeater-template">
		<?php tecknotrove_render_repeater_row( $meta_key, $fields, '__INDEX__', [] ); ?>
	</script>
	<?php
}

function tecknotrove_render_repeater_row( $meta_key, $fields, $index, $row ) {
	?>
	<tr class="tt-repeater-row">
		<?php foreach ( $fields as $f ) :
			$name = "{$meta_key}[{$index}][{$f['key']}]";
			$val  = isset( $row[ $f['key'] ] ) ? $row[ $f['key'] ] : '';
			?>
			<td>
				<?php if ( ( $f['type'] ?? 'text' ) === 'textarea' ) : ?>
					<textarea name="<?php echo esc_attr( $name ); ?>" rows="2" class="widefat"><?php echo esc_textarea( $val ); ?></textarea>
				<?php else : ?>
					<input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $val ); ?>" class="widefat" />
				<?php endif; ?>
			</td>
		<?php endforeach; ?>
		<td><button type="button" class="button-link tt-repeater-remove" aria-label="Remove row">&times;</button></td>
	</tr>
	<?php
}

/**
 * Sanitizes and saves a repeater field from $_POST into postmeta.
 * Drops fully-empty rows.
 */
function tecknotrove_save_repeater( $post_id, $meta_key ) {
	if ( ! isset( $_POST[ $meta_key ] ) || ! is_array( $_POST[ $meta_key ] ) ) {
		delete_post_meta( $post_id, $meta_key );
		return;
	}
	$clean = [];
	foreach ( $_POST[ $meta_key ] as $row ) {
		if ( ! is_array( $row ) ) continue;
		$row = array_map( 'sanitize_text_field', wp_unslash( $row ) );
		if ( count( array_filter( $row, fn( $v ) => trim( $v ) !== '' ) ) === 0 ) continue;
		$clean[] = $row;
	}
	if ( empty( $clean ) ) {
		delete_post_meta( $post_id, $meta_key );
	} else {
		update_post_meta( $post_id, $meta_key, $clean );
	}
}
