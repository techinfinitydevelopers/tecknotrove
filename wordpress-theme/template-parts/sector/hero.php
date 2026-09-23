<?php
/** @var array $sector */
?>
<section class="relative flex h-[90vh] min-h-[560px] flex-col justify-end overflow-hidden text-white">
	<div class="absolute inset-0">
		<?php if ( $sector['image'] ) : ?>
			<img src="<?php echo esc_url( $sector['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
		<?php endif; ?>
		<div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(9,10,14,0.55) 0%, rgba(9,10,14,0.75) 55%, rgba(9,10,14,0.96) 100%);"></div>
		<div class="absolute inset-0" style="mix-blend-mode: color; background: <?php echo esc_attr( $sector['accent'] ); ?>; opacity: 0.35;"></div>
	</div>

	<div class="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-16 pt-32 sm:px-8 sm:pb-20">
		<span class="mono-label mb-5 inline-flex items-center gap-2 rounded-full border border-white/25 bg-black/20 px-3.5 py-1.5 text-[10.5px] text-white" data-reveal>
			<span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $sector['accent'] ); ?>;"></span>
			<?php echo esc_html( $sector['eyebrow'] ); ?>
		</span>

		<h1 class="max-w-3xl text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl"><?php echo esc_html( $sector['h1'] ); ?></h1>

		<p class="mt-6 max-w-lg text-base text-white/75 sm:text-lg" data-reveal><?php echo esc_html( $sector['subhead'] ); ?></p>

		<div class="mt-9 flex flex-wrap items-center gap-4">
			<?php tecknotrove_the_button( 'Get in Touch', [ 'href' => '#contact', 'variant' => 'solid' ] ); ?>
			<?php tecknotrove_the_button( 'Download Brochure', [ 'href' => '#brochure', 'variant' => 'outline-light' ] ); ?>
		</div>
	</div>
</section>
