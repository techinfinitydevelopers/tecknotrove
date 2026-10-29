<?php
/** @var array $v  accent, items (one per line) */
$accent = $v['accent'] ?: '#0091d1';
$items  = array_values( array_filter( array_map( 'trim', preg_split( '/\R/', (string) ( $v['items'] ?? '' ) ) ) ) );
if ( ! $items ) return;
?>
<section class="tt-av-marquee relative overflow-hidden border-y border-line bg-bg py-6" aria-hidden="true" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="tt-av-marquee-track flex w-max items-center">
		<?php for ( $copy = 0; $copy < 2; $copy++ ) : ?>
			<ul class="flex shrink-0 items-center">
				<?php foreach ( $items as $it ) : ?>
					<li class="flex items-center whitespace-nowrap text-xl font-black tracking-tight text-ink-dim/70 sm:text-3xl">
						<span class="px-6 sm:px-10"><?php echo esc_html( $it ); ?></span>
						<span class="h-2 w-2 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endfor; ?>
	</div>
</section>
