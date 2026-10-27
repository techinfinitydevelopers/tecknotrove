<?php
/** @var array $v  accent, rows[label,text] */
$accent = $v['accent'] ?: '#0091d1';
if ( empty( $v['rows'] ) ) return;
?>
<section class="border-y border-line bg-bg py-10 sm:py-12">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-8 px-5 sm:px-8 lg:grid-cols-2">
		<?php foreach ( $v['rows'] as $r ) : ?>
			<div data-reveal class="border-l-2 pl-5" style="border-color: <?php echo esc_attr( $accent ); ?>;">
				<p class="mono-label text-[10.5px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $r['label'] ); ?></p>
				<p class="mt-2 text-sm leading-relaxed text-ink-dim"><?php echo esc_html( $r['text'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
