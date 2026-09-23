<?php
$sector_order = [ 'defence', 'aviation', 'automobile', 'oesd' ];
$sector_icons = [
	'defence'    => 'ShieldChevron',
	'aviation'   => 'AirplaneTilt',
	'automobile' => 'SteeringWheel',
	'oesd'       => 'Factory',
];
$sectors_for_grid = [];
foreach ( $sector_order as $key ) {
	$p = tecknotrove_get_sector_by_key( $key );
	if ( $p ) $sectors_for_grid[] = tecknotrove_get_sector_data( $p );
}
?>
<section id="simulation" class="relative z-10 -mt-px overflow-hidden rounded-t-[2.5rem] bg-bg-elevated pb-12 pt-20 sm:rounded-t-[3rem] sm:pb-36 sm:pt-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<p class="mono-label mb-5 text-[11px] text-blue-500">Simulation Solutions</p>
		<div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
			<h2 class="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal>
				Built for the world's most demanding industries.
			</h2>
			<a href="#simulation" class="group flex shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400">
				View all simulation solutions
				<?php tecknotrove_the_icon( 'ArrowUpRight', 16, 'transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ); ?>
			</a>
		</div>

		<div id="tt-sector-list" class="mt-14 flex flex-col gap-2 sm:flex-row sm:gap-0" data-reveal>
			<?php foreach ( $sectors_for_grid as $i => $s ) : ?>
				<div data-card class="relative h-[320px] sm:-ml-3 sm:h-[430px] sm:flex-1 lg:h-[480px] first:sm:ml-0" style="z-index: <?php echo (int) $i; ?>;">
					<a href="/<?php echo esc_attr( $s['key'] ); ?>" data-card-face class="group relative block h-full overflow-hidden rounded-2xl border border-line bg-bg-panel p-5 shadow-[0_20px_45px_-24px_rgba(15,18,30,0.35)] lg:p-7">
						<div class="pointer-events-none absolute inset-0">
							<?php if ( $s['image'] ) : ?>
								<img src="<?php echo esc_url( $s['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
							<?php endif; ?>
							<div class="absolute inset-0" style="background: linear-gradient(to top, rgb(233,238,251) 0%, rgb(233,238,251) 30%, rgba(233,238,251,0) 58%);"></div>
						</div>
						<div class="relative z-10 flex h-full flex-col">
							<div class="flex h-11 w-11 items-center justify-center rounded-full border border-line-strong bg-bg/60 text-orange-400">
								<?php tecknotrove_the_icon( $sector_icons[ $s['key'] ] ?? 'Factory', 20 ); ?>
							</div>
							<div class="mt-auto pt-10">
								<p class="mono-label mb-2 text-[10.5px] text-ink-faint"><?php echo esc_html( $s['name'] ); ?></p>
								<h3 class="text-lg font-bold leading-snug lg:text-2xl"><?php echo esc_html( $s['h1'] ?: $s['name'] ); ?></h3>
								<p class="mt-2 hidden max-w-sm text-sm text-ink-dim lg:block"><?php echo esc_html( $s['subhead'] ); ?></p>
								<span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-ink">
									Discover
									<?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?>
								</span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
