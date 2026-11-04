<?php
/** @var array $v  accent, label, heading, rows[title,desc,url,image] */
$accent = $v['accent'] ?: '#0091d1';
$rows   = array_values( $v['rows'] ?? [] );
if ( ! $rows ) return;
?>
<section class="tt-av-sheet relative overflow-hidden bg-bg py-24 sm:py-32" data-av-index style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php include __DIR__ . '/head.php'; ?>
		<ul class="mt-14 border-t border-line">
			<?php foreach ( $rows as $i => $r ) : ?>
				<li class="border-b border-line">
					<a href="<?php echo esc_url( $r['url'] ?: '#' ); ?>" data-av-irow="<?php echo (int) $i; ?>" class="tt-av-irow group relative grid grid-cols-[auto_1fr_auto] items-center gap-x-5 gap-y-1 py-7 sm:gap-x-10 sm:py-9">
						<span class="mono-label text-[11px] text-ink-dim"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
						<span class="min-w-0">
							<span class="tt-av-ititle block text-3xl font-black leading-[1.05] tracking-[-0.03em] sm:text-5xl lg:text-[4.25rem]"><?php echo esc_html( $r['title'] ); ?></span>
							<?php if ( ! empty( $r['desc'] ) ) : ?><span class="mt-2 block max-w-xl text-[15px] text-ink-dim"><?php echo esc_html( $r['desc'] ); ?></span><?php endif; ?>
						</span>
						<span class="tt-av-iarrow flex h-12 w-12 items-center justify-center rounded-full border border-line-strong text-ink-dim sm:h-16 sm:w-16"><?php tecknotrove_the_icon( 'ArrowUpRight', 22 ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div data-av-ipv aria-hidden="true" class="pointer-events-none fixed left-0 top-0 z-40 hidden h-[15rem] w-[20rem] overflow-hidden rounded-2xl border border-white/20 bg-[#06090d] opacity-0 shadow-[0_30px_70px_-20px_rgba(0,0,0,0.6)] lg:block">
		<?php foreach ( $rows as $i => $r ) : ?>
			<div data-av-ipv-img="<?php echo (int) $i; ?>" class="tt-av-showimg absolute inset-0">
				<?php if ( ! empty( $r['image'] ) ) : ?><img src="<?php echo esc_url( $r['image'] ); ?>" alt="" class="h-full w-full object-cover" /><?php else : ?><span class="block h-full w-full" style="background: linear-gradient(135deg, <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.5 ) ); ?>, #06090d);"></span><?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
