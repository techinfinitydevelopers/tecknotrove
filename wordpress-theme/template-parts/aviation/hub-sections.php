<?php
/** @var array $v  accent, heading, hubs[title,intro,url,link_label,products] (products: one "Name | one-liner | url" per line) */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php $v['label'] = $v['label'] ?? 'Aviation hubs'; include __DIR__ . '/head.php'; ?>
		<div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-2">
			<?php foreach ( $v['hubs'] as $n => $h ) : ?>
				<div data-reveal class="tt-av-card is-lift group relative flex flex-col overflow-hidden rounded-3xl border border-line bg-bg-elevated p-8 sm:p-10">
					<div class="tt-av-glow pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-500 group-hover:opacity-100"></div>
					<span class="mono-label relative text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( sprintf( '%02d', $n + 1 ) ); ?></span>
					<h3 class="relative mt-3 text-2xl font-black leading-tight tracking-tight sm:text-[1.75rem]"><a href="<?php echo esc_url( $h['url'] ); ?>"><?php echo esc_html( $h['title'] ); ?></a></h3>
					<p class="relative mt-4 text-[15px] leading-relaxed text-ink-dim"><?php echo esc_html( $h['intro'] ); ?></p>
					<ul class="relative mt-8 space-y-2">
						<?php foreach ( preg_split( '/\r?\n/', trim( $h['products'] ) ) as $line ) :
							if ( '' === trim( $line ) ) continue;
							$p    = array_map( 'trim', explode( '|', $line ) );
							$href = $p[2] ?? '';
							$tag  = $href ? 'a' : 'div'; ?>
							<li>
								<<?php echo $tag; ?> <?php echo $href ? 'href="' . esc_url( $href ) . '"' : ''; ?> class="group/row flex items-center justify-between gap-4 rounded-xl border border-line bg-bg/60 px-4 py-3.5 transition-colors <?php echo $href ? 'hover:border-line-strong hover:bg-bg' : ''; ?>">
									<span class="min-w-0"><span class="block text-sm font-bold"><?php echo esc_html( $p[0] ); ?></span><?php if ( ! empty( $p[1] ) ) : ?><span class="mt-0.5 block text-[13px] leading-snug text-ink-dim"><?php echo esc_html( $p[1] ); ?></span><?php endif; ?></span>
									<?php if ( $href ) : ?><span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-line text-ink-dim transition-colors group-hover/row:border-transparent group-hover/row:text-white group-hover/row:bg-[var(--accent)]"><?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
								</<?php echo $tag; ?>>
							</li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo esc_url( $h['url'] ); ?>" class="relative mt-auto inline-flex items-center gap-2 pt-8 text-sm font-bold" style="color: <?php echo esc_attr( $accent ); ?>;">
						<?php echo esc_html( $h['link_label'] ?: 'Explore hub' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
