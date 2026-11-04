<?php
/** @var array $v  accent, label, heading, items[q,a]
 *  FAQ flow: vertical rail with a node per question; a line flows down to the open one. One open at a time. */
$accent = $v['accent'] ?: '#0091d1';
$uid    = 'ttfaq' . wp_unique_id();
?>
<section class="tt-av-sheet bg-bg pb-10 pt-16 sm:pb-12 sm:pt-20" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-10 px-5 sm:px-8 lg:grid-cols-[0.8fr_1.5fr] lg:gap-20">
		<div class="lg:sticky lg:top-40 lg:self-start">
			<?php $v['label'] = $v['label'] ?: 'FAQ'; $v['heading'] = $v['heading'] ?: 'Common questions.'; include __DIR__ . '/head.php'; ?>
			<p class="mono-label mt-8 hidden text-[12px] text-ink-dim lg:block"><span data-av-faq-cur class="text-ink">01</span> / <?php echo esc_html( sprintf( '%02d', count( $v['items'] ) ) ); ?></p>
		</div>
		<ol data-av-faq class="tt-av-faq relative">
			<span class="tt-av-faq-track" aria-hidden="true"></span>
			<span data-av-faq-line class="tt-av-faq-line" aria-hidden="true"></span>
			<?php foreach ( $v['items'] as $i => $item ) : $on = 0 === $i; $pid = $uid . '-' . $i; ?>
				<li data-av-faq-item class="tt-av-faq-item<?php echo $on ? ' is-open' : ''; ?>">
					<span class="tt-av-faq-node" aria-hidden="true"></span>
					<h3>
						<button type="button" data-av-faq-q class="tt-av-faq-q" aria-expanded="<?php echo $on ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $pid ); ?>">
							<span class="tt-av-faq-n mono-label"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<span class="tt-av-faq-t"><?php echo esc_html( $item['q'] ); ?></span>
							<span class="tt-av-faq-icon" aria-hidden="true"><?php tecknotrove_the_icon( 'Plus', 16 ); ?></span>
						</button>
					</h3>
					<div id="<?php echo esc_attr( $pid ); ?>" class="tt-av-faq-a" role="region"><div><p><?php echo esc_html( $item['a'] ); ?></p></div></div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
