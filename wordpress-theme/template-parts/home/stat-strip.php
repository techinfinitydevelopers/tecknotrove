<?php
$stats = [
	[ 'value' => 35, 'suffix' => '+', 'label' => 'Countries served', 'icon' => 'GlobeHemisphereWest' ],
	[ 'value' => 1500, 'suffix' => '+', 'label' => 'Simulators delivered', 'icon' => 'Wrench' ],
	[ 'value' => 2002, 'suffix' => '', 'label' => 'Established', 'icon' => 'CalendarBlank', 'plain' => true ],
	[ 'value' => 24, 'suffix' => '×7', 'label' => 'Technical support', 'icon' => 'Headset' ],
];
?>
<section class="relative overflow-hidden border-y border-line bg-bg-cream py-10 sm:py-12">
	<div
		class="pointer-events-none absolute inset-0 opacity-[0.35]"
		style="background-image: linear-gradient(rgba(23,8,0,0.06) 1px, transparent 1px), linear-gradient(90deg, rgba(23,8,0,0.06) 1px, transparent 1px); background-size: 56px 56px; mask-image: linear-gradient(to right, black, transparent 85%);"
	></div>

	<div class="relative mx-auto flex max-w-[1400px] flex-col gap-8 px-5 sm:px-8 md:flex-row md:items-center md:justify-between md:gap-10">
		<div class="grid grid-cols-2 gap-x-6 gap-y-9 md:max-w-[1020px] md:flex-1 md:grid-cols-4 md:gap-x-0">
			<?php foreach ( $stats as $i => $s ) : ?>
				<div class="flex flex-col items-center text-center md:px-4 <?php echo $i > 0 ? 'md:border-l md:border-line-strong/70' : ''; ?>">
					<?php tecknotrove_the_icon( $s['icon'], 20, 'mb-3 text-orange-400' ); ?>
					<div class="font-mono text-4xl font-medium tabular-nums text-ink sm:text-5xl">
						<span data-count-to="<?php echo (int) $s['value']; ?>" data-plain="<?php echo ! empty( $s['plain'] ) ? 'true' : 'false'; ?>">0</span>
						<span class="text-orange-400"><?php echo esc_html( $s['suffix'] ); ?></span>
					</div>
					<p class="mt-2 text-sm text-ink-dim"><?php echo esc_html( $s['label'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
		<?php tecknotrove_the_button( 'Know more', [ 'href' => '#why', 'variant' => 'outline', 'sweep' => 'dark', 'class' => 'shrink-0 self-start px-5 py-2.5 text-xs md:self-auto', 'icon' => tecknotrove_icon( 'ArrowUpRight', 14 ) ] ); ?>
	</div>
</section>
