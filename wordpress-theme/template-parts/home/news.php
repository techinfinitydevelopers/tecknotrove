<?php
$panel_path = 'M0,116 A16,16 0 0 1 16,100 L146,100 Q154,100 159,109 L177,131 Q182,140 190,140 L384,140 A16,16 0 0 1 400,156 L400,500 L0,500 Z';
// Visual treatment (dark/frame/surface) cycles per card position — content
// (title/meta/image) comes from wp-admin > Homepage, see inc/homepage-options.php.
$styles = [
	[ 'dark' => true, 'frame' => '#0a1440', 'surface' => '#101c52' ],
	[ 'dark' => false, 'frame' => '#d5dae4', 'surface' => '#eef0f5' ],
	[ 'dark' => true, 'frame' => '#08080a', 'surface' => '#141417' ],
];
$articles = array_map(
	fn( $a, $i ) => array_merge( $a, $styles[ $i % count( $styles ) ] ),
	tecknotrove_home_news(),
	array_keys( tecknotrove_home_news() )
);
?>
<section class="border-t border-line bg-bg-elevated py-14 sm:py-16">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php tecknotrove_eyebrow( 'Media' ); ?>
		<div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
			<h2 class="text-3xl font-black tracking-tight sm:text-4xl" data-reveal>Latest News &amp; Insights</h2>
			<a href="#news" class="group hidden shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400 sm:flex">
				View all
				<?php tecknotrove_the_icon( 'ArrowUpRight', 16, 'transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ); ?>
			</a>
		</div>

		<div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-3">
			<?php foreach ( $articles as $i => $a ) :
				$title_color = $a['dark'] ? '#ffffff' : '#14161c';
				$body_color  = $a['dark'] ? 'rgba(255,255,255,0.62)' : 'rgba(20,22,28,0.62)';
				$arrow_color = $a['dark'] ? 'rgba(255,255,255,0.8)' : 'rgba(20,22,28,0.7)';
				?>
				<a href="#news" data-reveal class="tt-folder-card group relative block aspect-[4/3.1] rounded-[30px] p-[7px] shadow-[0_22px_48px_-26px_rgba(15,18,30,0.5)] transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] hover:-translate-y-1.5" style="background: <?php echo esc_attr( $a['frame'] ); ?>;">
					<div class="relative h-full w-full overflow-hidden rounded-[24px]" style="background: <?php echo esc_attr( $a['surface'] ); ?>;">
						<img src="<?php echo esc_url( $a['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover transition-transform duration-[650ms] ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-[1.05]" />

						<div class="tt-folder-panel absolute inset-0 transition-transform duration-[650ms] ease-[cubic-bezier(0.22,1,0.36,1)]">
							<svg viewBox="0 0 400 500" preserveAspectRatio="none" aria-hidden="true" class="absolute inset-0 h-full w-full">
								<path d="<?php echo esc_attr( $panel_path ); ?>" fill="<?php echo esc_attr( $a['surface'] ); ?>"></path>
							</svg>
							<div class="absolute inset-x-0 flex items-center justify-between px-7 pt-3.5" style="top: 28%;">
								<span class="text-5xl font-medium leading-none tracking-tight" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<span style="color: <?php echo esc_attr( $arrow_color ); ?>;"><?php tecknotrove_the_icon( 'ArrowUpRight', 22 ); ?></span>
							</div>
						</div>

						<div class="absolute inset-x-0 bottom-0 z-10 px-7 pb-7">
							<h3 class="text-[15px] font-bold leading-snug" style="color: <?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $a['title'] ); ?></h3>
							<p class="mt-1.5 text-[13px] leading-relaxed" style="color: <?php echo esc_attr( $body_color ); ?>;"><?php echo esc_html( $a['meta'] ); ?></p>
						</div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
