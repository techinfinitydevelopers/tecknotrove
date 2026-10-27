<?php
/** @var array $v  accent, crumbs[label,url], eyebrow, h1, intro, image, cta1_label, cta1_url, cta2_label, cta2_url */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="relative flex min-h-[78vh] flex-col justify-end overflow-hidden text-white">
	<div class="absolute inset-0 bg-[#06090d]">
		<?php if ( ! empty( $v['image'] ) ) : ?>
			<img src="<?php echo esc_url( $v['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
		<?php endif; ?>
		<div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(6,9,13,0.55) 0%, rgba(6,9,13,0.72) 55%, rgba(6,9,13,0.97) 100%);"></div>
		<div class="absolute inset-0" style="mix-blend-mode: color; background: <?php echo esc_attr( $accent ); ?>; opacity: 0.3;"></div>
	</div>
	<div class="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-14 pt-36 sm:px-8 sm:pb-16">
		<?php if ( ! empty( $v['crumbs'] ) ) : ?>
			<p class="mono-label mb-6 flex flex-wrap items-center gap-2 text-[10.5px] text-white/55">
				<?php foreach ( $v['crumbs'] as $i => $c ) : ?>
					<?php if ( $i ) echo '<span>/</span>'; ?>
					<?php if ( ! empty( $c['url'] ) ) : ?><a href="<?php echo esc_url( $c['url'] ); ?>" class="hover:text-white"><?php echo esc_html( $c['label'] ); ?></a>
					<?php else : ?><span style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $c['label'] ); ?></span><?php endif; ?>
				<?php endforeach; ?>
			</p>
		<?php elseif ( ! empty( $v['eyebrow'] ) ) : ?>
			<span class="mono-label mb-5 inline-flex items-center gap-2 rounded-full border border-white/25 bg-black/20 px-3.5 py-1.5 text-[10.5px] text-white">
				<span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>;"></span><?php echo esc_html( $v['eyebrow'] ); ?>
			</span>
		<?php endif; ?>
		<h1 class="max-w-4xl text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl"><?php echo esc_html( $v['h1'] ); ?></h1>
		<?php if ( ! empty( $v['intro'] ) ) : ?>
			<div class="mt-6 max-w-3xl space-y-4 text-base text-white/75 sm:text-lg">
				<?php foreach ( preg_split( '/\R+/', trim( $v['intro'] ) ) as $para ) : ?><p><?php echo esc_html( $para ); ?></p><?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="mt-9 flex flex-wrap items-center gap-4">
			<?php if ( ! empty( $v['cta1_label'] ) ) tecknotrove_the_button( $v['cta1_label'], [ 'href' => $v['cta1_url'] ?: '#contact', 'variant' => 'solid' ] ); ?>
			<?php if ( ! empty( $v['cta2_label'] ) ) tecknotrove_the_button( $v['cta2_label'], [ 'href' => $v['cta2_url'] ?: '#', 'variant' => 'outline-light' ] ); ?>
		</div>
	</div>
</section>
