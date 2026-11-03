<?php
/** @var array $v  accent, heading, hubs[title,intro,url,link_label,image,products] (products: one "Name | one-liner | url" per line)
 *  Layout: first hub = featured card (image left, text right); the rest = image cards in a row. */
$accent = $v['accent'] ?: '#0091d1';
$hubs   = array_values( $v['hubs'] );
$first  = $hubs[0] ?? null;
$rest   = array_slice( $hubs, 1 );
$gc     = [ 1 => 'lg:grid-cols-1', 2 => 'lg:grid-cols-2', 3 => 'lg:grid-cols-3' ][ count( $rest ) ] ?? 'lg:grid-cols-4';
$prods  = fn( $h ) => array_values( array_filter( array_map( fn( $l ) => array_map( 'trim', explode( '|', $l ) ), preg_split( '/\r?\n/', trim( $h['products'] ?? '' ) ) ), fn( $p ) => '' !== $p[0] ) );
$media  = function ( $h, $class = '' ) use ( $accent ) {
	if ( ! empty( $h['image'] ) ) {
		echo '<img src="' . esc_url( $h['image'] ) . '" alt="" loading="lazy" class="' . esc_attr( $class ) . ' h-full w-full object-cover" />';
		return;
	}
	echo '<span class="block h-full w-full" style="background: linear-gradient(135deg, ' . esc_attr( tecknotrove_hex_to_rgba( $accent, 0.25 ) ) . ', ' . esc_attr( tecknotrove_hex_to_rgba( $accent, 0.05 ) ) . ');"></span>';
};
?>
<section class="tt-av-sheet bg-bg-elevated py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php $v['label'] = $v['label'] ?? 'Aviation hubs'; include __DIR__ . '/head.php'; ?>

		<?php if ( $first ) : $fp = $prods( $first ); ?>
			<div data-reveal class="tt-av-card group mt-14 grid grid-cols-1 overflow-hidden rounded-[1.75rem] border border-line bg-bg p-3 shadow-[0_30px_60px_-40px_rgba(0,0,0,0.25)] lg:grid-cols-[1.05fr_1fr]">
				<a href="<?php echo esc_url( $first['url'] ); ?>" class="tt-av-clip relative block min-h-[280px] overflow-hidden rounded-[1.25rem] bg-[#06090d] lg:min-h-[420px]" tabindex="-1" aria-hidden="true">
					<?php $media( $first, 'tt-av-clip-img absolute inset-0' ); ?>
					<span class="absolute inset-0" style="background: linear-gradient(180deg, rgba(6,9,13,0) 45%, rgba(6,9,13,0.55) 100%);"></span>
					<span class="absolute bottom-3 left-5 text-6xl font-black leading-none sm:text-7xl" style="-webkit-text-stroke: 1px rgba(255,255,255,.7); color: transparent;">01</span>
				</a>
				<div class="flex flex-col justify-between gap-8 p-6 sm:p-9">
					<div>
						<span class="mono-label rounded-full border border-line-strong px-3 py-1 text-[10px] text-ink-dim">Hub 01</span>
						<h3 class="mt-6 text-2xl font-black leading-tight tracking-tight sm:text-4xl"><a href="<?php echo esc_url( $first['url'] ); ?>"><?php echo esc_html( $first['title'] ); ?></a></h3>
						<p class="mt-4 text-[15px] leading-relaxed text-ink-dim"><?php echo esc_html( $first['intro'] ); ?></p>
						<?php if ( $fp ) : ?>
							<ul class="mt-6 divide-y divide-line border-y border-line">
								<?php foreach ( $fp as $p ) : $href = $p[2] ?? ''; $tag = $href ? 'a' : 'div'; ?>
									<li><<?php echo $tag; ?> <?php echo $href ? 'href="' . esc_url( $href ) . '"' : ''; ?> class="group/row flex items-center justify-between gap-4 py-3 <?php echo $href ? 'transition-colors hover:text-[var(--accent)]' : ''; ?>">
										<span class="min-w-0"><span class="block text-sm font-bold"><?php echo esc_html( $p[0] ); ?></span><?php if ( ! empty( $p[1] ) ) : ?><span class="mt-0.5 block text-[12.5px] leading-snug text-ink-dim"><?php echo esc_html( $p[1] ); ?></span><?php endif; ?></span>
										<?php if ( $href ) : ?><span class="shrink-0 text-ink-dim transition-transform group-hover/row:translate-x-0.5"><?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
									</<?php echo $tag; ?>></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
					<a href="<?php echo esc_url( $first['url'] ); ?>" class="inline-flex items-center gap-2 text-sm font-bold transition-all hover:gap-3" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $first['link_label'] ?: 'Explore hub' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></a>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $rest ) : ?>
			<div data-stagger class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 <?php echo esc_attr( $gc ); ?>">
				<?php foreach ( $rest as $n => $h ) : $hp = $prods( $h ); ?>
					<div data-reveal class="tt-av-card is-lift group flex flex-col overflow-hidden rounded-[1.5rem] border border-line bg-bg p-3">
						<a href="<?php echo esc_url( $h['url'] ); ?>" class="tt-av-clip relative block aspect-[4/3] overflow-hidden rounded-[1.1rem] bg-[#06090d]" tabindex="-1" aria-hidden="true">
							<?php $media( $h, 'tt-av-clip-img absolute inset-0' ); ?>
							<span class="mono-label absolute right-3 top-3 rounded-full bg-bg/90 px-2.5 py-1 text-[9.5px] text-ink-dim backdrop-blur">Hub <?php echo esc_html( sprintf( '%02d', $n + 2 ) ); ?></span>
						</a>
						<div class="flex flex-1 flex-col p-4 pb-3">
							<h3 class="text-lg font-bold leading-snug"><a href="<?php echo esc_url( $h['url'] ); ?>"><?php echo esc_html( $h['title'] ); ?></a></h3>
							<p class="mt-2 text-[13.5px] leading-relaxed text-ink-dim"><?php echo esc_html( $h['intro'] ); ?></p>
							<?php if ( $hp ) : ?>
								<div class="mt-4 flex flex-wrap gap-1.5">
									<?php foreach ( $hp as $p ) : $href = $p[2] ?? ''; $tag = $href ? 'a' : 'span'; ?>
										<<?php echo $tag; ?> <?php echo $href ? 'href="' . esc_url( $href ) . '"' : ''; ?> <?php echo ! empty( $p[1] ) ? 'title="' . esc_attr( $p[1] ) . '"' : ''; ?> class="rounded-full border border-line px-2.5 py-1 text-[11.5px] font-semibold text-ink-dim <?php echo $href ? 'transition-colors hover:border-[var(--accent)] hover:text-[var(--accent)]' : ''; ?>"><?php echo esc_html( $p[0] ); ?></<?php echo $tag; ?>>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							<a href="<?php echo esc_url( $h['url'] ); ?>" class="mt-auto inline-flex items-center gap-2 pt-5 text-sm font-bold transition-all hover:gap-3" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $h['link_label'] ?: 'Explore hub' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></a>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
