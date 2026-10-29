<?php
/** @var array $v  accent, rows[label,text] */
$accent = $v['accent'] ?: '#0091d1';
if ( empty( $v['rows'] ) ) return;
?>
<section class="bg-bg py-12 sm:py-16" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-4 px-5 sm:px-8 lg:grid-cols-2">
		<?php foreach ( $v['rows'] as $r ) : ?>
			<div data-reveal class="relative overflow-hidden rounded-2xl border border-line bg-bg-elevated p-7 sm:p-8">
				<span class="absolute inset-y-0 left-0 w-1" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
				<p class="mono-label text-[10.5px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $r['label'] ); ?></p>
				<p class="mt-3 text-[15px] leading-relaxed text-ink-dim"><?php echo esc_html( $r['text'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
