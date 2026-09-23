<?php
/** @var array $sector */
if ( empty( $sector['benefits'] ) ) return;
$benefit_icons = [ 'ShieldCheck', 'Lightning', 'ChartLineUp', 'Coins' ];
?>
<section class="bg-bg py-20 sm:py-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $sector['accent'] ); ?>;">01 / Benefits of Simulation</p>
		<h2 class="max-w-xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal>Better training.<br />Better outcomes.</h2>

		<div class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
			<?php foreach ( $sector['benefits'] as $i => $b ) : ?>
				<div data-reveal class="rounded-2xl border border-line bg-bg-elevated p-6">
					<div class="flex h-11 w-11 items-center justify-center rounded-full" style="background: <?php echo esc_attr( $sector['accent_soft'] ); ?>; color: <?php echo esc_attr( $sector['accent'] ); ?>;">
						<?php tecknotrove_the_icon( $benefit_icons[ $i % count( $benefit_icons ) ], 20 ); ?>
					</div>
					<h3 class="mt-5 text-lg font-bold"><?php echo esc_html( $b['title'] ); ?></h3>
					<p class="mt-2 text-sm text-ink-dim"><?php echo esc_html( $b['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
