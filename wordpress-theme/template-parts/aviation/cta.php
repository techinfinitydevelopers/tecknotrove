<?php
/** @var array $v  heading, body, cta1_label, cta1_url, cta2_label, cta2_url */
?>
<section id="contact" class="bg-bg px-5 py-16 sm:px-8 sm:py-24">
	<div class="relative mx-auto max-w-[1400px] overflow-hidden rounded-[2rem] bg-orange px-8 py-14 text-[#170800] sm:px-14 sm:py-20">
		<div class="pointer-events-none absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/20 blur-3xl"></div>
		<div class="pointer-events-none absolute inset-0 opacity-[0.07]" style="background-image: linear-gradient(#000 1px, transparent 1px), linear-gradient(90deg, #000 1px, transparent 1px); background-size: 48px 48px;"></div>
		<div class="relative z-10 flex flex-col items-start justify-between gap-10 lg:flex-row lg:items-end">
			<div class="max-w-3xl">
				<h2 class="text-balance text-3xl font-black leading-[1.04] tracking-tight sm:text-5xl lg:text-6xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
				<?php if ( ! empty( $v['body'] ) ) : ?><p class="mt-6 max-w-xl text-base leading-relaxed text-[#170800]/75 sm:text-lg"><?php echo esc_html( $v['body'] ); ?></p><?php endif; ?>
			</div>
			<div class="flex flex-wrap items-center gap-3">
				<?php if ( ! empty( $v['cta1_label'] ) ) tecknotrove_the_button( $v['cta1_label'], [ 'href' => $v['cta1_url'] ?: '/contact/', 'variant' => 'dark', 'sweep' => 'blue' ] ); ?>
				<?php if ( ! empty( $v['cta2_label'] ) ) tecknotrove_the_button( $v['cta2_label'], [ 'href' => $v['cta2_url'] ?: '#', 'variant' => 'outline-dark', 'sweep' => 'blue' ] ); ?>
			</div>
		</div>
	</div>
</section>
