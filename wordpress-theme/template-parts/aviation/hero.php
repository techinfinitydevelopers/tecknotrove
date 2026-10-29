<?php
/** @var array $v  accent, crumbs[label,url], eyebrow, h1, intro, image, cta1_label, cta1_url, cta2_label, cta2_url */
$accent = $v['accent'] ?: '#0091d1';
$paras  = ! empty( $v['intro'] ) ? preg_split( '/\R+/', trim( $v['intro'] ) ) : [];
?>
<section class="relative flex min-h-[86vh] flex-col justify-end overflow-hidden text-white" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="absolute inset-0 bg-[#06090d]">
		<?php if ( ! empty( $v['image'] ) ) : ?>
			<img src="<?php echo esc_url( $v['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full scale-105 object-cover" />
		<?php endif; ?>
		<div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(6,9,13,0.92) 0%, rgba(6,9,13,0.55) 55%, rgba(6,9,13,0.25) 100%), linear-gradient(180deg, rgba(6,9,13,0.35) 0%, rgba(6,9,13,0) 40%, rgba(6,9,13,0.95) 100%);"></div>
		<div class="tt-av-glow absolute inset-0"></div>
	</div>
	<div class="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-16 pt-40 sm:px-8 sm:pb-20">
		<?php if ( ! empty( $v['crumbs'] ) ) : ?>
			<p class="mono-label mb-7 inline-flex flex-wrap items-center gap-2.5 rounded-full border border-white/15 bg-white/[0.06] px-4 py-2 text-[10.5px] text-white/60 backdrop-blur">
				<?php foreach ( $v['crumbs'] as $i => $c ) : ?>
					<?php if ( $i ) echo '<span class="opacity-40">/</span>'; ?>
					<?php if ( ! empty( $c['url'] ) ) : ?><a href="<?php echo esc_url( $c['url'] ); ?>" class="transition-colors hover:text-white"><?php echo esc_html( $c['label'] ); ?></a>
					<?php else : ?><span class="text-white"><?php echo esc_html( $c['label'] ); ?></span><?php endif; ?>
				<?php endforeach; ?>
			</p>
		<?php elseif ( ! empty( $v['eyebrow'] ) ) : ?>
			<span class="mono-label mb-7 inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/[0.06] px-4 py-2 text-[10.5px] text-white backdrop-blur">
				<span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>; box-shadow: 0 0 12px <?php echo esc_attr( $accent ); ?>;"></span><?php echo esc_html( $v['eyebrow'] ); ?>
			</span>
		<?php endif; ?>
		<h1 class="max-w-4xl text-balance text-[2.5rem] font-black leading-[1.02] tracking-[-0.02em] sm:text-6xl lg:text-7xl"><?php echo esc_html( $v['h1'] ); ?></h1>
		<?php if ( $paras ) : ?>
			<div class="mt-8 max-w-2xl space-y-4">
				<?php foreach ( $paras as $i => $para ) : ?><p class="<?php echo 0 === $i ? 'text-lg leading-relaxed text-white/85 sm:text-xl' : 'text-sm leading-relaxed text-white/55 sm:text-base'; ?>"><?php echo esc_html( $para ); ?></p><?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="mt-10 flex flex-wrap items-center gap-4">
			<?php if ( ! empty( $v['cta1_label'] ) ) tecknotrove_the_button( $v['cta1_label'], [ 'href' => $v['cta1_url'] ?: '#contact', 'variant' => 'solid' ] ); ?>
			<?php if ( ! empty( $v['cta2_label'] ) ) tecknotrove_the_button( $v['cta2_label'], [ 'href' => $v['cta2_url'] ?: '#', 'variant' => 'outline-light' ] ); ?>
		</div>
	</div>
</section>
