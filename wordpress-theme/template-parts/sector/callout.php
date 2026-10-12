<?php
/** @var array $sector */
$c = wp_parse_args( $sector['callout'] ?? [], [
	'heading' => 'Ready to see it in action?', 'btn1_label' => 'Get in Touch', 'btn1_url' => 'tel:+912261513002',
	'btn2_label' => 'Download Brochure', 'btn2_url' => '#brochure', 'footer_text' => 'Explore other industries.',
] );
?>
<section id="contact" class="relative overflow-hidden bg-orange py-20 text-[#170800] sm:py-24">
	<div class="relative z-10 mx-auto max-w-[1400px] px-5 text-center sm:px-8">
		<h2 class="mx-auto max-w-2xl text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl" data-reveal><?php echo esc_html( $c['heading'] ); ?></h2>
		<div data-reveal class="mt-9 flex flex-wrap items-center justify-center gap-4">
			<?php tecknotrove_the_button( $c['btn1_label'], [ 'href' => $c['btn1_url'], 'variant' => 'dark', 'sweep' => 'blue' ] ); ?>
			<?php tecknotrove_the_button( $c['btn2_label'], [ 'href' => $c['btn2_url'], 'variant' => 'outline-dark', 'sweep' => 'blue' ] ); ?>
		</div>
	</div>

	<div class="relative z-10 mx-auto mt-16 flex max-w-[1400px] flex-col items-center gap-4 border-t border-[#170800]/15 px-5 pt-10 text-center sm:px-8">
		<p class="text-sm text-[#170800]/70"><?php echo esc_html( $c['footer_text'] ); ?></p>
		<a href="/#simulation" class="group inline-flex items-center gap-2 text-sm font-semibold text-[#170800]">
			All Simulation Solutions
			<?php tecknotrove_the_icon( 'ArrowUpRight', 15, 'transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ); ?>
		</a>
	</div>
</section>
