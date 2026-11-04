<?php
/** @var array $v  accent, crumbs[label,url], eyebrow, h1, intro, image, cta1_label, cta1_url, cta2_label, cta2_url
 *  Cutout hero: image in a rounded frame; page-coloured notches are cut out of the bottom corners for the buttons and the lead text. */
$accent = $v['accent'] ?: '#0091d1';
$paras  = ! empty( $v['intro'] ) ? preg_split( '/\R+/', trim( $v['intro'] ) ) : [];
$lead   = '';
$more   = [];
if ( $paras ) {
	// Lead = first sentence; the rest of the client copy sits behind "Read more".
	$first = preg_split( '/(?<=[.!?])\s+/', $paras[0], 2 );
	$lead  = $first[0];
	$more  = array_values( array_filter( array_merge( [ $first[1] ?? '' ], array_slice( $paras, 1 ) ) ) );
}
?>
<section class="tt-av-hero-cut relative bg-bg p-2.5 pb-14 sm:p-3 sm:pb-14" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="tt-av-hero-frame relative flex h-[calc(100svh-1.25rem)] min-h-[620px] flex-col justify-end overflow-hidden rounded-[2rem] rounded-bl-none bg-[#06090d] text-white sm:h-[calc(100svh-1.5rem)] lg:rounded-br-none">
		<div class="absolute inset-0">
			<?php if ( ! empty( $v['image'] ) ) : ?>
				<div class="tt-av-kb absolute inset-0"><img src="<?php echo esc_url( $v['image'] ); ?>" alt="" data-av-parallax class="absolute inset-x-0 -top-[5%] h-[110%] w-full object-cover will-change-transform" /></div>
			<?php endif; ?>
			<div class="absolute inset-0" style="background: linear-gradient(90deg, rgba(4,22,40,0.78) 0%, rgba(4,22,40,0.25) 50%, rgba(4,22,40,0) 100%), linear-gradient(180deg, rgba(4,22,40,0.55) 0%, rgba(4,22,40,0) 25%, rgba(4,22,40,0) 60%, rgba(4,22,40,0.55) 100%);"></div>
		</div>

		<div data-av-hero-copy class="relative z-10 px-5 pb-[10.5rem] pt-28 sm:px-8 sm:pb-[8.5rem] lg:px-12 lg:pb-[9rem]">
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
			<?php $h = preg_split( '/\s+(?=for\s)/i', (string) $v['h1'], 2 ); ?>
			<h1 data-hl class="tt-av-h1 max-w-[22ch] text-[2.4rem] font-black leading-[1.04] tracking-[-0.045em] sm:text-6xl lg:text-[4rem]">
				<span class="block overflow-hidden pb-[0.06em]"><span style="--d:.15s" class="tt-av-rise block"><?php echo esc_html( $h[0] ); ?></span></span>
				<?php if ( ! empty( $h[1] ) ) : ?><span style="--d:.35s" class="tt-av-in mt-1 block"><span class="tt-hl tt-hl-hero"><?php echo esc_html( $h[1] ); ?></span></span><?php endif; ?>
			</h1>
			<?php if ( $lead ) : ?><p style="--d:.3s" class="tt-av-in mt-5 max-w-md text-[15px] leading-relaxed text-white/80 lg:hidden"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
		</div>

		<?php if ( ! empty( $v['cta1_label'] ) || ! empty( $v['cta2_label'] ) ) : ?>
			<div style="--d:.45s" class="tt-av-in tt-av-cut tt-av-cut-l absolute bottom-0 left-0 z-20 bg-bg pr-4 pt-4 sm:pr-5 sm:pt-5">
				<div class="flex flex-wrap items-center gap-3">
					<?php if ( ! empty( $v['cta1_label'] ) ) tecknotrove_the_button( $v['cta1_label'], [ 'href' => $v['cta1_url'] ?: '#contact', 'variant' => 'solid' ] ); ?>
					<?php if ( ! empty( $v['cta2_label'] ) ) tecknotrove_the_button( $v['cta2_label'], [ 'href' => $v['cta2_url'] ?: '#', 'variant' => 'outline' ] ); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $lead ) : ?>
			<div style="--d:.6s" class="tt-av-in tt-av-cut tt-av-cut-r absolute bottom-0 right-0 z-20 hidden w-[min(500px,42%)] bg-bg pl-6 pt-6 text-ink lg:block">
				<div class="flex items-start gap-4">
					<span class="tt-av-thumbs relative block h-[84px] w-[112px] shrink-0 overflow-hidden rounded-xl bg-[#b6dce6]" aria-hidden="true">
						<?php foreach ( [ 'terrain-1.jpg', 'cargo-sim-view.jpg', 'training-module.jpg' ] as $k => $f ) : ?><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/aviation/' . $f ); ?>" alt="" loading="lazy" class="absolute inset-0 h-full w-full object-cover" style="--k: <?php echo (int) $k; ?>;" /><?php endforeach; ?>
						<span class="mono-label absolute bottom-1.5 left-1.5 rounded-full bg-[#062440] px-2 py-0.5 text-[8.5px] text-white"><span class="tt-av-live mr-1 inline-block h-1.5 w-1.5 rounded-full bg-[#ff5a4e] align-middle"></span>Sim view</span>
					</span>
					<p class="text-[15px] leading-relaxed"><?php echo esc_html( $lead ); ?></p>
				</div>
				<?php if ( $more ) : ?>
					<details class="tt-av-more mt-4 border-t border-line pt-3">
						<summary class="flex cursor-pointer list-none items-center gap-2 text-[13px] font-semibold" style="color: <?php echo esc_attr( $accent ); ?>;"><span class="tt-av-more-open">Read more</span><span class="tt-av-more-close">Show less</span><?php tecknotrove_the_icon( 'Plus', 14 ); ?></summary>
						<div class="mt-3 max-h-[38svh] space-y-3 overflow-y-auto pr-2 text-[13px] leading-relaxed text-ink-dim">
							<?php foreach ( $more as $para ) : ?><p><?php echo esc_html( $para ); ?></p><?php endforeach; ?>
						</div>
					</details>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
