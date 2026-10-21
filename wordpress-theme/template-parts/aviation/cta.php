<?php
/** @var array $v  heading, body, cta1_label, cta1_url, cta2_label, cta2_url */
?>
<section id="contact" class="relative overflow-hidden bg-orange py-14 text-[#170800] sm:py-16">
	<div class="relative z-10 mx-auto flex max-w-[1400px] flex-col items-start justify-between gap-8 px-5 sm:px-8 lg:flex-row lg:items-center">
		<div class="max-w-2xl">
			<h2 class="text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
			<?php if ( ! empty( $v['body'] ) ) : ?><p class="mt-4 max-w-xl text-base text-[#170800]/75"><?php echo esc_html( $v['body'] ); ?></p><?php endif; ?>
		</div>
		<div class="flex flex-wrap items-center gap-3">
			<?php if ( ! empty( $v['cta1_label'] ) ) tecknotrove_the_button( $v['cta1_label'], [ 'href' => $v['cta1_url'] ?: '/contact/', 'variant' => 'dark', 'sweep' => 'blue' ] ); ?>
			<?php if ( ! empty( $v['cta2_label'] ) ) tecknotrove_the_button( $v['cta2_label'], [ 'href' => $v['cta2_url'] ?: '#', 'variant' => 'outline-dark', 'sweep' => 'blue' ] ); ?>
		</div>
	</div>
</section>
