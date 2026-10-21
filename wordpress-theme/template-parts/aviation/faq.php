<?php
/** @var array $v  accent, label, heading, items[q,a] */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg py-20 sm:py-24">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-10 px-5 sm:px-8 lg:grid-cols-[0.8fr_1.4fr] lg:gap-16">
		<div>
			<p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ?: 'FAQ' ); ?></p>
			<h2 class="text-3xl font-black leading-[1.05] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $v['heading'] ?: 'Common questions.' ); ?></h2>
		</div>
		<div class="divide-y divide-line border-y border-line">
			<?php foreach ( $v['items'] as $item ) : ?>
				<div class="tt-faq-item">
					<button class="tt-faq-q flex w-full items-center justify-between gap-6 py-6 text-left">
						<span class="text-base font-bold sm:text-lg"><?php echo esc_html( $item['q'] ); ?></span>
						<span class="tt-faq-icon shrink-0 text-ink-dim"><?php tecknotrove_the_icon( 'Plus', 20 ); ?></span>
					</button>
					<div class="tt-faq-a"><div><p class="max-w-2xl pb-6 text-sm leading-relaxed text-ink-dim"><?php echo esc_html( $item['a'] ); ?></p></div></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
