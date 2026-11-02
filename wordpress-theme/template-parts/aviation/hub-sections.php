<?php
/** @var array $v  accent, heading, hubs[title,intro,url,link_label,image,products] (products: one "Name | one-liner | url" per line) */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="tt-av-sheet bg-bg py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php $v['label'] = $v['label'] ?? 'Aviation hubs'; include __DIR__ . '/head.php'; ?>
		<div data-stagger class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2">
			<?php foreach ( $v['hubs'] as $n => $h ) : ?>
				<div data-reveal class="tt-av-card is-lift group relative flex flex-col overflow-hidden rounded-3xl border border-line bg-bg-elevated">
					<?php if ( ! empty( $h['image'] ) ) : ?>
						<a href="<?php echo esc_url( $h['url'] ); ?>" class="tt-av-clip relative block aspect-[16/8] overflow-hidden bg-[#06090d]" tabindex="-1" aria-hidden="true">
							<img src="<?php echo esc_url( $h['image'] ); ?>" alt="" loading="lazy" class="tt-av-clip-img absolute inset-0 h-full w-full object-cover" />
							<span class="absolute inset-0" style="background: linear-gradient(180deg, rgba(6,9,13,0.15) 0%, rgba(6,9,13,0.85) 100%);"></span>
							<span class="absolute inset-0 mix-blend-color" style="background: <?php echo esc_attr( $accent ); ?>; opacity: .25;"></span>
							<span class="absolute bottom-3 left-6 text-6xl font-black leading-none sm:text-7xl" style="-webkit-text-stroke: 1px rgba(255,255,255,.55); color: transparent;"><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></span>
						</a>
					<?php endif; ?>
					<div class="relative flex flex-1 flex-col p-8 sm:p-10">
						<?php if ( empty( $h['image'] ) ) : ?><span class="mono-label mb-3 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></span><?php endif; ?>
						<h3 class="text-2xl font-black leading-tight tracking-tight sm:text-[1.75rem]"><a href="<?php echo esc_url( $h['url'] ); ?>"><?php echo esc_html( $h['title'] ); ?></a></h3>
						<p class="mt-4 text-[15px] leading-relaxed text-ink-dim"><?php echo esc_html( $h['intro'] ); ?></p>
						<ul class="mt-8 space-y-2">
							<?php foreach ( preg_split( '/\r?\n/', trim( $h['products'] ) ) as $line ) :
								if ( '' === trim( $line ) ) continue;
								$p    = array_map( 'trim', explode( '|', $line ) );
								$href = $p[2] ?? '';
								$tag  = $href ? 'a' : 'div'; ?>
								<li>
									<<?php echo $tag; ?> <?php echo $href ? 'href="' . esc_url( $href ) . '"' : ''; ?> class="group/row flex items-center justify-between gap-4 rounded-xl border border-line bg-bg/60 px-4 py-3.5 transition-colors <?php echo $href ? 'hover:border-line-strong hover:bg-bg' : ''; ?>">
										<span class="min-w-0"><span class="block text-sm font-bold"><?php echo esc_html( $p[0] ); ?></span><?php if ( ! empty( $p[1] ) ) : ?><span class="mt-0.5 block text-[12.5px] leading-snug text-ink-dim"><?php echo esc_html( $p[1] ); ?></span><?php endif; ?></span>
										<?php if ( $href ) : ?><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-line text-ink-dim transition-colors group-hover/row:border-transparent group-hover/row:bg-[var(--accent)] group-hover/row:text-white"><?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
									</<?php echo $tag; ?>>
								</li>
							<?php endforeach; ?>
						</ul>
						<a href="<?php echo esc_url( $h['url'] ); ?>" class="mt-auto inline-flex items-center gap-2 pt-8 text-sm font-bold transition-all hover:gap-3" style="color: <?php echo esc_attr( $accent ); ?>;">
							<?php echo esc_html( $h['link_label'] ?: 'Explore hub' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
