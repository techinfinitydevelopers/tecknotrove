<?php
$stats = [
	[ 'value' => 35, 'suffix' => '+', 'label' => 'Countries served', 'icon' => 'GlobeHemisphereWest' ],
	[ 'value' => 1500, 'suffix' => '+', 'label' => 'Simulators delivered', 'icon' => 'Wrench' ],
	[ 'value' => 2002, 'suffix' => '', 'label' => 'Established', 'icon' => 'CalendarBlank', 'plain' => true ],
	[ 'value' => 24, 'suffix' => '×7', 'label' => 'Technical support', 'icon' => 'Headset' ],
];
?>
<section id="why" class="tt-why grid lg:min-h-[88vh] lg:grid-cols-[minmax(0,52fr)_minmax(0,48fr)]">
	<div class="tt-why-grid flex flex-col justify-between gap-12 border-b border-line px-5 py-14 sm:px-10 sm:py-16 lg:border-b-0 lg:border-r lg:px-14 lg:py-16 xl:px-16">
		<div class="my-auto">
			<h2 class="tt-why-title text-[clamp(2.25rem,9vw,3.25rem)] lg:text-[clamp(2.75rem,3.9vw,3.75rem)] font-black text-ink" data-split-title>
				<?php echo esc_html( tecknotrove_home_why_line1() ); ?><br /><?php echo esc_html( tecknotrove_home_why_line2() ); ?>
			</h2>
			<div>
				<p class="mt-6 max-w-md text-base leading-[1.6] text-ink-dim" data-split-lines>
					<?php echo esc_html( tecknotrove_home_why_body() ); ?>
				</p>
				<div class="mt-8" data-anim-up>
					<?php tecknotrove_the_button( 'Our Technology', [ 'href' => '#simulation', 'variant' => 'outline' ] ); ?>
				</div>
			</div>
		</div>

		<div class="border-t border-line pt-8">
			<div class="mb-5 flex items-center justify-between">
				<span class="mono-label text-[11px] text-ink-dim">Our track record</span>
				<a href="#why" class="group inline-flex items-center gap-1.5 text-xs font-semibold text-ink transition-colors hover:text-orange-400">
					Know more
					<span class="transition-transform duration-200 group-hover:-translate-y-0.5 group-hover:translate-x-0.5"><?php tecknotrove_the_icon( 'ArrowUpRight', 14 ); ?></span>
				</a>
			</div>
			<div class="grid grid-cols-2 gap-x-5 gap-y-7 rounded-2xl border border-line bg-white/60 p-5 sm:grid-cols-4 sm:gap-x-3">
				<?php foreach ( $stats as $s ) : ?>
					<div>
						<?php tecknotrove_the_icon( $s['icon'], 16, 'mb-3 text-orange-400' ); ?>
						<div class="tt-why-stat text-2xl font-black tabular-nums text-ink sm:text-[1.65rem]">
							<span data-count-to="<?php echo (int) $s['value']; ?>" data-plain="<?php echo ! empty( $s['plain'] ) ? 'true' : 'false'; ?>">0</span><span class="text-orange-400"><?php echo esc_html( $s['suffix'] ); ?></span>
						</div>
						<p class="mt-2 text-xs font-medium text-ink-dim"><?php echo esc_html( $s['label'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="flex items-center justify-center bg-bg-elevated p-5 sm:p-10 lg:p-12 xl:p-14">
		<figure class="relative h-[420px] w-full overflow-hidden rounded-3xl border border-line bg-white shadow-[0_24px_50px_-20px_rgba(20,22,24,0.18)] sm:h-[560px] lg:h-full lg:max-h-[880px]">
			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/why-simulator.jpg' ); ?>"
				alt="Engineers assembling a full-motion training simulator platform"
				class="h-full w-full object-cover object-[70%_center]"
				loading="lazy"
			/>
		</figure>
	</div>
</section>
