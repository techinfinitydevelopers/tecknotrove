<?php
/** @var array $v  accent, label, heading, intro, dark(bool) -- shared section header */
$accent = $v['accent'] ?: '#0091d1';
$dark   = ! empty( $dark );
if ( empty( $v['label'] ) && empty( $v['heading'] ) ) return;
?>
<div class="max-w-3xl">
	<?php if ( ! empty( $v['label'] ) ) : ?><p class="mono-label tt-av-eyebrow mb-5 text-[13px] font-semibold" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ); ?></p><?php endif; ?>
	<?php if ( ! empty( $v['heading'] ) ) : ?><h2 data-hl class="tt-av-h2 text-balance text-[2.2rem] sm:text-[3.4rem] lg:text-[3.9rem]"><?php echo tecknotrove_av_heading( $v['heading'] ); // phpcs:ignore -- escaped inside ?></h2><?php endif; ?>
	<?php if ( ! empty( $v['intro'] ) ) : ?><p class="mt-6 max-w-2xl text-base leading-relaxed sm:text-lg <?php echo $dark ? 'text-white/60' : 'text-ink-dim'; ?>"><?php echo esc_html( $v['intro'] ); ?></p><?php endif; ?>
</div>
