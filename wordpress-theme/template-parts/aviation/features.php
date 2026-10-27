<?php
/** @var array $v  accent, label, heading, groups[title,icon,body,bullets,image] (bullets: one per line) */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg-elevated py-20 sm:py-24" data-av-tabs>
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php if ( ! empty( $v['label'] ) ) : ?><p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ); ?></p><?php endif; ?>
		<h2 class="max-w-3xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $v['heading'] ?: 'Key features.' ); ?></h2>
		<div class="mt-10 grid grid-cols-1 gap-6 lg:grid-cols-[320px_1fr]">
			<div class="flex gap-2 overflow-x-auto lg:flex-col lg:overflow-visible" role="tablist">
				<?php foreach ( $v['groups'] as $i => $g ) : ?>
					<button type="button" role="tab" data-av-tab="<?php echo (int) $i; ?>" aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>" class="tt-av-tab flex shrink-0 items-center gap-3 rounded-xl border border-line bg-bg px-4 py-3.5 text-left text-sm font-bold transition-colors" style="--accent: <?php echo esc_attr( $accent ); ?>;">
						<span class="flex h-9 w-9 items-center justify-center rounded-full" style="background: <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.14 ) ); ?>; color: <?php echo esc_attr( $accent ); ?>;"><?php tecknotrove_the_icon( $g['icon'] ?: 'Cube', 18 ); ?></span>
						<?php echo esc_html( $g['title'] ); ?>
					</button>
				<?php endforeach; ?>
			</div>
			<div>
				<?php foreach ( $v['groups'] as $i => $g ) : ?>
					<div data-av-panel="<?php echo (int) $i; ?>" class="grid grid-cols-1 gap-8 rounded-2xl border border-line bg-bg p-6 sm:p-8 md:grid-cols-2" <?php echo $i ? 'hidden' : ''; ?>>
						<div>
							<h3 class="text-2xl font-black tracking-tight"><?php echo esc_html( $g['title'] ); ?></h3>
							<p class="mt-3 text-sm leading-relaxed text-ink-dim"><?php echo esc_html( $g['body'] ); ?></p>
							<?php if ( '' !== trim( $g['bullets'] ?? '' ) ) : ?><ul class="mt-5 space-y-2.5">
								<?php foreach ( preg_split( '/\r?\n/', trim( $g['bullets'] ) ) as $b ) : if ( '' === trim( $b ) ) continue; ?>
									<li class="flex gap-2.5 text-sm"><span class="mt-0.5 shrink-0" style="color: <?php echo esc_attr( $accent ); ?>;"><?php tecknotrove_the_icon( 'CheckCircle', 17 ); ?></span><?php echo esc_html( $b ); ?></li>
								<?php endforeach; ?>
							</ul><?php endif; ?>
						</div>
						<?php if ( ! empty( $g['image'] ) ) : ?>
							<div class="relative min-h-[220px] overflow-hidden rounded-xl bg-bg-panel"><img src="<?php echo esc_url( $g['image'] ); ?>" alt="<?php echo esc_attr( $g['title'] ); ?>" class="absolute inset-0 h-full w-full object-cover" loading="lazy" /></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
