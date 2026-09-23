<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Renders the site's one recurring button component (the "magnetic"
 * button — a rounded pill with a sweep-fill hover, ported to vanilla JS
 * in assets/js/main.js). Mirrors MagneticButton.tsx's variant/sweep props.
 */
function tecknotrove_button( $label, $args = [] ) {
	$defaults = [
		'href'   => '#',
		'variant'=> 'solid', // solid | outline | outline-light | dark | outline-dark | light
		'sweep'  => 'orange', // orange | blue | dark
		'class'  => '',
		'target' => '',
		'icon'   => '', // raw svg/html, rendered before the label
	];
	$a = wp_parse_args( $args, $defaults );

	$style_map = [
		'solid'        => 'bg-[#15161c] text-white',
		'dark'         => 'bg-[#15161c] text-white',
		'light'        => 'bg-white text-nav-bg',
		'outline'      => 'border border-line-strong bg-transparent text-ink group-hover:border-transparent',
		'outline-light'=> 'border border-white/35 bg-transparent text-white group-hover:border-transparent',
		'outline-dark' => 'border border-[#170800]/35 bg-transparent text-[#170800] group-hover:border-transparent',
	];
	$sweep_bg = [ 'orange' => 'var(--orange)', 'blue' => 'var(--blue-brand)', 'dark' => '#15161c' ][ $a['sweep'] ] ?? 'var(--orange)';
	$sweep_text_class = $a['sweep'] === 'orange' ? 'group-hover:text-[#170800]' : 'group-hover:text-white';

	$classes = 'tt-btn group relative isolate inline-flex items-center justify-center gap-2 overflow-hidden rounded-full px-7 py-3.5 text-sm font-bold tracking-wide whitespace-nowrap transition-colors duration-300 ' . ( $style_map[ $a['variant'] ] ?? $style_map['solid'] ) . ' ' . $a['class'];

	ob_start();
	?>
	<a href="<?php echo esc_url( $a['href'] ); ?>"
		<?php if ( $a['target'] ) : ?>target="<?php echo esc_attr( $a['target'] ); ?>" rel="noopener noreferrer"<?php endif; ?>
		class="<?php echo esc_attr( trim( $classes ) ); ?>">
		<span aria-hidden="true" class="tt-btn-sweep absolute inset-0 origin-left scale-x-0 transition-transform duration-500 ease-[cubic-bezier(0.65,0,0.35,1)] group-hover:scale-x-100" style="background: <?php echo esc_attr( $sweep_bg ); ?>"></span>
		<span class="relative z-10 flex items-center gap-2 transition-colors duration-300 <?php echo esc_attr( $sweep_text_class ); ?>">
			<?php echo $a['icon']; // phpcs:ignore -- trusted inline SVG from theme code only ?>
			<?php echo esc_html( $label ); ?>
		</span>
	</a>
	<?php
	return ob_get_clean();
}

/** Echoes tecknotrove_button() directly — the common case in templates. */
function tecknotrove_the_button( $label, $args = [] ) {
	echo tecknotrove_button( $label, $args ); // phpcs:ignore -- escaped inside
}

/** mono-label eyebrow text, used dozens of times across templates. */
function tecknotrove_eyebrow( $text, $color_class = 'text-blue-500' ) {
	if ( ! $text ) return;
	printf( '<p class="mono-label mb-5 text-[11px] %s">%s</p>', esc_attr( $color_class ), esc_html( $text ) );
}
