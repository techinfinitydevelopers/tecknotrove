<?php
/** @var array $v  accent, heading, hubs[title,intro,url,link_label,image,products] (products: one "Name | one-liner | url" per line)
 *  Showcase accordion: one hub open (large image + info card), the rest are slim strips. Autoplays, pauses on hover/focus, stops after a click. */
$accent = $v['accent'] ?: '#0091d1';
$hubs   = array_values( $v['hubs'] );
$prods  = fn( $h ) => array_values( array_filter( array_map( fn( $l ) => array_map( 'trim', explode( '|', $l ) ), preg_split( '/\r?\n/', trim( $h['products'] ?? '' ) ) ), fn( $p ) => '' !== $p[0] ) );
$uid    = 'ttacc' . wp_unique_id();
?>
<section class="tt-av-sheet bg-bg-elevated pb-16 pt-14 sm:pb-20 sm:pt-16 lg:flex lg:min-h-svh lg:flex-col lg:justify-center lg:pb-12 lg:pt-28" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto w-full max-w-[1400px] px-5 sm:px-8">
		<div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between lg:gap-12">
			<div>
				<p class="mono-label tt-av-eyebrow mb-4 text-[13px] font-semibold" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ?? 'Aviation hubs' ); ?></p>
				<?php if ( ! empty( $v['heading'] ) ) : ?><h2 data-hl class="tt-av-h2 text-balance text-[2.1rem] sm:text-[3rem] lg:text-[3.3rem]"><?php echo tecknotrove_av_heading( $v['heading'] ); // phpcs:ignore -- escaped inside ?></h2><?php endif; ?>
			</div>
			<?php if ( ! empty( $v['intro'] ) ) : ?><p class="max-w-sm text-[15px] leading-relaxed text-ink-dim lg:pb-1 lg:text-right"><?php echo esc_html( $v['intro'] ); ?></p><?php endif; ?>
		</div>

		<?php if ( $hubs ) : ?>
			<div data-av-acc data-autoplay="6000" class="tt-av-acc mt-8" role="group" aria-label="Aviation hubs">
				<?php foreach ( $hubs as $i => $h ) : $hp = $prods( $h ); $on = 0 === $i; $pid = $uid . '-' . $i; ?>
					<article data-av-acc-item class="tt-av-acc-item<?php echo $on ? ' is-open' : ''; ?>">
						<div class="tt-av-acc-media absolute inset-0 bg-[#06090d]">
							<?php if ( ! empty( $h['image'] ) ) : ?>
								<img src="<?php echo esc_url( $h['image'] ); ?>" alt="" loading="lazy" class="tt-av-acc-img h-full w-full object-cover" />
							<?php else : ?>
								<span class="block h-full w-full" style="background: linear-gradient(135deg, <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.45 ) ); ?>, rgba(6,9,13,0.9));"></span>
							<?php endif; ?>
							<span class="tt-av-acc-shade absolute inset-0"></span>
						</div>

						<button type="button" data-av-acc-btn class="tt-av-acc-hit absolute inset-0 z-20 cursor-pointer" aria-expanded="<?php echo $on ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $pid ); ?>">
							<span class="screen-reader-text"><?php echo esc_html( $h['title'] ); ?></span>
						</button>

						<div class="tt-av-acc-strip pointer-events-none absolute z-10 text-white" aria-hidden="true">
							<span class="tt-av-acc-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<span class="tt-av-acc-vtitle"><?php echo esc_html( $h['title'] ); ?></span>
						</div>

						<div id="<?php echo esc_attr( $pid ); ?>" class="tt-av-acc-card z-30">
							<span class="mono-label text-[10px] text-ink-dim">Hub <?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<h3 class="mt-3 text-xl font-black leading-tight tracking-tight sm:text-2xl"><?php echo esc_html( $h['title'] ); ?></h3>
							<p class="mt-2.5 text-[13.5px] leading-relaxed text-ink-dim"><?php echo esc_html( $h['intro'] ); ?></p>
							<?php if ( $hp ) : ?>
								<div class="mt-4 flex flex-wrap gap-1.5">
									<?php foreach ( $hp as $p ) : $href = $p[2] ?? ''; $tag = $href ? 'a' : 'span'; ?>
										<<?php echo $tag; ?> <?php echo $href ? 'href="' . esc_url( $href ) . '"' : ''; ?> <?php echo ! empty( $p[1] ) ? 'title="' . esc_attr( $p[1] ) . '"' : ''; ?> class="rounded-full border border-line-strong px-2.5 py-1 text-[11.5px] font-semibold text-ink-dim <?php echo $href ? 'transition-colors hover:border-[var(--accent)] hover:text-[var(--accent)]' : ''; ?>"><?php echo esc_html( $p[0] ); ?></<?php echo $tag; ?>>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<a href="<?php echo esc_url( $h['url'] ); ?>" class="mt-5 inline-flex items-center gap-2 text-sm font-bold transition-all hover:gap-3" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $h['link_label'] ?: 'Explore hub' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></a>
						</div>

						<span class="tt-av-acc-bar pointer-events-none absolute inset-x-0 bottom-0 z-40 h-[3px] bg-white/20" aria-hidden="true"><span data-av-acc-fill class="block h-full origin-left" style="background: <?php echo esc_attr( $accent ); ?>; transform: scaleX(0);"></span></span>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
