<?php
/** @var array $v  accent, crumbs[label,url], eyebrow, h1, intro, image, cta1_label, cta1_url, cta2_label, cta2_url */
$accent = $v['accent'] ?: '#0091d1';
$paras  = ! empty( $v['intro'] ) ? preg_split( '/\R+/', trim( $v['intro'] ) ) : [];
?>
<section class="relative flex min-h-[100svh] flex-col justify-end overflow-hidden text-white" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="absolute inset-0 bg-[#06090d]">
		<?php if ( ! empty( $v['image'] ) ) : ?>
			<img src="<?php echo esc_url( $v['image'] ); ?>" alt="" data-av-parallax class="absolute inset-x-0 -top-[5%] h-[110%] w-full object-cover will-change-transform" />
		<?php endif; ?>
		<div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(6,9,13,0.85) 0%, rgba(6,9,13,0.35) 50%, rgba(6,9,13,0.15) 100%), linear-gradient(180deg, rgba(6,9,13,0.55) 0%, rgba(6,9,13,0) 30%, rgba(6,9,13,0.9) 100%);"></div>
		<div class="tt-av-glow absolute inset-0"></div>
	</div>
	<div data-av-hero-copy class="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-14 pt-32 sm:px-8 sm:pb-16">
		<?php if ( ! empty( $v['crumbs'] ) ) : ?>
			<p style="--d:.05s" class="tt-av-in mono-label mb-6 inline-flex flex-wrap items-center gap-2.5 rounded-full border border-white/15 bg-white/[0.06] px-4 py-2 text-[10.5px] text-white/60 backdrop-blur">
				<?php foreach ( $v['crumbs'] as $i => $c ) : ?>
					<?php if ( $i ) echo '<span class="opacity-40">/</span>'; ?>
					<?php if ( ! empty( $c['url'] ) ) : ?><a href="<?php echo esc_url( $c['url'] ); ?>" class="transition-colors hover:text-white"><?php echo esc_html( $c['label'] ); ?></a>
					<?php else : ?><span class="text-white"><?php echo esc_html( $c['label'] ); ?></span><?php endif; ?>
				<?php endforeach; ?>
			</p>
		<?php elseif ( ! empty( $v['eyebrow'] ) ) : ?>
			<span style="--d:.05s" class="tt-av-in mono-label mb-6 inline-flex items-center gap-2.5 rounded-full border border-white/15 bg-white/[0.06] px-4 py-2 text-[10.5px] text-white backdrop-blur">
				<span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>; box-shadow: 0 0 12px <?php echo esc_attr( $accent ); ?>;"></span><?php echo esc_html( $v['eyebrow'] ); ?>
			</span>
		<?php endif; ?>
		<div class="grid grid-cols-1 items-end gap-10 lg:grid-cols-[1.3fr_0.9fr] lg:gap-16">
			<div>
				<h1 style="--d:.15s" class="tt-av-in text-balance text-[2.25rem] font-black leading-[1.04] tracking-[-0.02em] sm:text-5xl lg:text-[3.6rem]"><?php echo esc_html( $v['h1'] ); ?></h1>
				<div style="--d:.45s" class="tt-av-in mt-9 flex flex-wrap items-center gap-4">
					<?php if ( ! empty( $v['cta1_label'] ) ) tecknotrove_the_button( $v['cta1_label'], [ 'href' => $v['cta1_url'] ?: '#contact', 'variant' => 'solid' ] ); ?>
					<?php if ( ! empty( $v['cta2_label'] ) ) tecknotrove_the_button( $v['cta2_label'], [ 'href' => $v['cta2_url'] ?: '#', 'variant' => 'outline-light' ] ); ?>
				</div>
			</div>
			<?php if ( $paras ) : ?>
				<div style="--d:.3s" class="tt-av-in rounded-3xl border border-white/12 bg-[#06090d]/55 p-6 backdrop-blur-xl sm:p-7">
					<?php foreach ( $paras as $i => $para ) : ?>
						<p class="<?php echo 0 === $i ? 'text-[15px] leading-relaxed text-white/90' : 'mt-4 border-t border-white/10 pt-4 text-[13px] leading-relaxed text-white/70'; ?>"><?php echo esc_html( $para ); ?></p>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
