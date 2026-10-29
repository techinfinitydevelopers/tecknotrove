<?php
/** @var array $v  accent, label, heading, items[q,a] */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[0.75fr_1.4fr] lg:gap-20">
		<div class="lg:sticky lg:top-40 lg:self-start">
			<?php $v['label'] = $v['label'] ?: 'FAQ'; $v['heading'] = $v['heading'] ?: 'Common questions.'; include __DIR__ . '/head.php'; ?>
		</div>
		<div data-stagger class="space-y-3">
			<?php foreach ( $v['items'] as $i => $item ) : ?>
				<div class="tt-faq-item rounded-2xl border border-line bg-bg-elevated px-6 transition-colors hover:border-line-strong sm:px-8">
					<button class="tt-faq-q flex w-full items-center justify-between gap-6 py-6 text-left">
						<span class="flex items-baseline gap-4"><span class="mono-label hidden text-[11px] sm:inline" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span><span class="text-base font-bold leading-snug sm:text-lg"><?php echo esc_html( $item['q'] ); ?></span></span>
						<span class="tt-faq-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-line text-ink-dim"><?php tecknotrove_the_icon( 'Plus', 16 ); ?></span>
					</button>
					<div class="tt-faq-a"><div><p class="max-w-2xl pb-7 text-[15px] leading-relaxed text-ink-dim sm:pl-9"><?php echo esc_html( $item['a'] ); ?></p></div></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
