<?php
/** @var array $v  title, eyebrow, subtitle, image, accent */
$accent = $v['accent'] ?: '#0033a1';
?>
<section class="relative flex min-h-[56vh] flex-col justify-end overflow-hidden bg-blue-950 text-white">
	<div class="absolute inset-0">
		<?php if ( ! empty( $v['image'] ) ) : ?>
			<img src="<?php echo esc_url( $v['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
		<?php endif; ?>
		<div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(9,10,14,0.55) 0%, rgba(9,10,14,0.78) 60%, rgba(9,10,14,0.96) 100%);"></div>
		<div class="absolute inset-0" style="mix-blend-mode: color; background: <?php echo esc_attr( $accent ); ?>; opacity: 0.3;"></div>
	</div>
	<div class="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-14 pt-36 sm:px-8 sm:pb-16">
		<?php if ( ! empty( $v['eyebrow'] ) ) : ?>
			<span class="mono-label mb-5 inline-flex items-center gap-2 rounded-full border border-white/25 bg-black/20 px-3.5 py-1.5 text-[10.5px] text-white" data-reveal>
				<span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
				<?php echo esc_html( $v['eyebrow'] ); ?>
			</span>
		<?php endif; ?>
		<h1 class="max-w-3xl text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl"><?php echo esc_html( $v['title'] ); ?></h1>
		<?php if ( ! empty( $v['subtitle'] ) ) : ?>
			<p class="mt-6 max-w-xl text-base text-white/75 sm:text-lg" data-reveal><?php echo esc_html( $v['subtitle'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
