<?php
/** @var array $v  accent, label, heading, intro, columns, dark, tiles[title,desc,url,icon,cta,badge] */
$accent = $v['accent'] ?: '#0091d1';
$cols   = [ '2' => 'sm:grid-cols-2', '3' => 'sm:grid-cols-2 lg:grid-cols-3', '4' => 'sm:grid-cols-2 lg:grid-cols-4' ][ (string) $v['columns'] ] ?? 'sm:grid-cols-2 lg:grid-cols-4';
$dark   = 'yes' === ( $v['dark'] ?? 'no' );
?>
<section class="py-20 sm:py-24 <?php echo $dark ? 'bg-[#0a0d12] text-white' : 'bg-bg-elevated'; ?>">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php if ( ! empty( $v['label'] ) ) : ?><p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ); ?></p><?php endif; ?>
		<?php if ( ! empty( $v['heading'] ) ) : ?><h2 class="max-w-3xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2><?php endif; ?>
		<?php if ( ! empty( $v['intro'] ) ) : ?><p class="mt-5 max-w-2xl text-base <?php echo $dark ? 'text-white/65' : 'text-ink-dim'; ?>"><?php echo esc_html( $v['intro'] ); ?></p><?php endif; ?>
		<div class="mt-12 grid grid-cols-1 gap-5 <?php echo esc_attr( $cols ); ?>">
			<?php foreach ( $v['tiles'] as $t ) :
				$tag = ! empty( $t['url'] ) ? 'a' : 'div'; ?>
				<<?php echo $tag; ?> <?php echo 'a' === $tag ? 'href="' . esc_url( $t['url'] ) . '"' : ''; ?> data-reveal class="group flex flex-col rounded-2xl border p-6 transition-colors <?php echo $dark ? 'border-white/10 bg-white/[0.04] hover:bg-white/[0.07]' : 'border-line bg-bg hover:border-line-strong'; ?>">
					<div class="flex items-start justify-between gap-3">
						<div class="flex h-11 w-11 items-center justify-center rounded-full" style="background: <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.16 ) ); ?>; color: <?php echo esc_attr( $accent ); ?>;">
							<?php tecknotrove_the_icon( $t['icon'] ?: 'Cube', 20 ); ?>
						</div>
						<?php if ( ! empty( $t['badge'] ) ) : ?><span class="mono-label rounded-full border px-2.5 py-1 text-[9.5px] <?php echo $dark ? 'border-white/25 text-white/70' : 'border-line-strong text-ink-dim'; ?>"><?php echo esc_html( $t['badge'] ); ?></span><?php endif; ?>
					</div>
					<h3 class="mt-5 text-lg font-bold leading-snug"><?php echo esc_html( $t['title'] ); ?></h3>
					<?php if ( ! empty( $t['desc'] ) ) : ?><p class="mt-2 text-sm <?php echo $dark ? 'text-white/60' : 'text-ink-dim'; ?>"><?php echo esc_html( $t['desc'] ); ?></p><?php endif; ?>
					<?php if ( 'a' === $tag ) : ?><span class="mt-auto inline-flex items-center gap-1.5 pt-4 text-sm font-semibold" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( ! empty( $t['cta'] ) ? $t['cta'] : 'View' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
