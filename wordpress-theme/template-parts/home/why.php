<section id="why" class="relative overflow-hidden py-28 sm:py-40">
	<div id="tt-why-parallax-img" class="absolute inset-0" style="transform: scale(1.25) translateY(-6%);">
		<img
			src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/why-simulator.jpg' ); ?>"
			alt="Engineers assembling a full-motion training simulator platform"
			class="h-full w-full object-cover"
		/>
	</div>
	<div class="absolute inset-0 bg-white/88"></div>
	<div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-blue-brand/10"></div>

	<div class="relative z-10 mx-auto max-w-[1400px] px-5 sm:px-8">
		<div class="max-w-2xl">
			<h2 class="text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl" data-reveal>
				<?php echo esc_html( tecknotrove_home_why_line1() ); ?><br /><?php echo esc_html( tecknotrove_home_why_line2() ); ?>
			</h2>
			<div data-reveal>
				<p class="mt-6 max-w-lg text-base text-ink-dim sm:text-lg">
					<?php echo esc_html( tecknotrove_home_why_body() ); ?>
				</p>
				<div class="mt-9">
					<?php tecknotrove_the_button( 'Our Technology', [ 'href' => '#simulation', 'variant' => 'outline' ] ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
