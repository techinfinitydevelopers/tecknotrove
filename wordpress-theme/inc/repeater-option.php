<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Same repeater UI as repeater-field.php, but backed by a wp_options row
 * instead of postmeta — used by the Homepage Content settings page, which
 * has no single post of its own to attach meta to.
 */
function tecknotrove_render_repeater_option( $option_key, $fields ) {
	$rows = get_option( $option_key );
	if ( ! is_array( $rows ) ) $rows = [];
	if ( empty( $rows ) ) $rows = [ [] ];
	?>
	<div class="tt-repeater" data-key="<?php echo esc_attr( $option_key ); ?>">
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
					<?php tecknotrove_render_repeater_row( $option_key, $fields, $i, $row ); ?>
				<?php endforeach; ?>
			</tbody>
		</table>
		<button type="button" class="button tt-repeater-add"><?php esc_html_e( '+ Add row', 'tecknotrove' ); ?></button>
	</div>
	<script type="text/template" class="tt-repeater-template">
		<?php tecknotrove_render_repeater_row( $option_key, $fields, '__INDEX__', [] ); ?>
	</script>
	<?php
}

function tecknotrove_save_repeater_option( $option_key ) {
	if ( ! isset( $_POST[ $option_key ] ) || ! is_array( $_POST[ $option_key ] ) ) {
		delete_option( $option_key );
		return;
	}
	$clean = [];
	foreach ( $_POST[ $option_key ] as $row ) {
		if ( ! is_array( $row ) ) continue;
		$row = array_map( 'sanitize_text_field', wp_unslash( $row ) );
		if ( count( array_filter( $row, fn( $v ) => trim( $v ) !== '' ) ) === 0 ) continue;
		$clean[] = $row;
	}
	if ( empty( $clean ) ) {
		delete_option( $option_key );
	} else {
		update_option( $option_key, $clean );
	}
}
