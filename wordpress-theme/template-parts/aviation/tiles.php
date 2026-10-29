<?php
/** @var array $v  accent, label, heading, intro, columns, dark, tiles[title,desc,url,icon,cta,badge] */
$accent = $v['accent'] ?: '#0091d1';
$cols   = [ '2' => 'sm:grid-cols-2', '3' => 'sm:grid-cols-2 lg:grid-cols-3', '4' => 'sm:grid-cols-2 lg:grid-cols-4' ][ (string) $v['columns'] ] ?? 'sm:grid-cols-2 lg:grid-cols-4';
$dark   = 'yes' === ( $v['dark'] ?? 'no' );
?>
<section class="relative overflow-hidden py-24 sm:py-32 <?php echo $dark ? 'bg-[#0a0d12] text-white' : 'bg-bg-elevated'; ?>" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<?php if ( $dark ) : ?><div class="tt-av-glow pointer-events-none absolute inset-0"></div><div class="tt-av-grid-bg pointer-events-none absolute inset-0"></div><?php endif; ?>
	<div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php include __DIR__ . '/head.php'; ?>
		<div class="mt-14 grid grid-cols-1 gap-4 sm:gap-5 <?php echo esc_attr( $cols ); ?>">
			<?php foreach ( $v['tiles'] as $i => $t ) :
				$tag = ! empty( $t['url'] ) ? 'a' : 'div'; ?>
				<<?php echo $tag; ?> <?php echo 'a' === $tag ? 'href="' . esc_url( $t['url'] ) . '"' : ''; ?> data-reveal class="tt-av-card <?php echo 'div' === $tag ? 'is-lift' : ''; ?> group relative flex flex-col overflow-hidden rounded-2xl border p-7 <?php echo $dark ? 'border-white/10 bg-white/[0.035] hover:bg-white/[0.06]' : 'border-line bg-bg'; ?>">
					<div class="flex items-start justify-between gap-3">
						<div class="flex h-12 w-12 items-center justify-center rounded-xl" style="background: <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.14 ) ); ?>; color: <?php echo esc_attr( $accent ); ?>; box-shadow: inset 0 0 0 1px <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.3 ) ); ?>;">
							<?php tecknotrove_the_icon( $t['icon'] ?: 'Cube', 22 ); ?>
						</div>
						<?php if ( ! empty( $t['badge'] ) ) : ?><span class="mono-label rounded-full border px-2.5 py-1 text-[9.5px] <?php echo $dark ? 'border-white/20 text-white/70' : 'border-line-strong text-ink-dim'; ?>"><?php echo esc_html( $t['badge'] ); ?></span>
						<?php else : ?><span class="mono-label text-[10.5px] <?php echo $dark ? 'text-white/25' : 'text-ink-dim/50'; ?>"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span><?php endif; ?>
					</div>
					<h3 class="mt-7 text-[1.05rem] font-bold leading-snug"><?php echo esc_html( $t['title'] ); ?></h3>
					<?php if ( ! empty( $t['desc'] ) ) : ?><p class="mt-3 text-sm leading-relaxed <?php echo $dark ? 'text-white/55' : 'text-ink-dim'; ?>"><?php echo esc_html( $t['desc'] ); ?></p><?php endif; ?>
					<?php if ( 'a' === $tag ) : ?><span class="mt-auto inline-flex items-center gap-1.5 pt-6 text-sm font-semibold transition-all group-hover:gap-2.5" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( ! empty( $t['cta'] ) ? $t['cta'] : 'View' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
