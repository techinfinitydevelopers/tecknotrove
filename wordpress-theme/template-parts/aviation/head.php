<?php
/** @var array $v  accent, label, heading, intro, dark(bool) -- shared section header */
$accent = $v['accent'] ?: '#0091d1';
$dark   = ! empty( $dark );
if ( empty( $v['label'] ) && empty( $v['heading'] ) ) return;
?>
<div class="max-w-3xl">
	<?php if ( ! empty( $v['label'] ) ) : ?><p class="mono-label tt-av-eyebrow mb-6 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ); ?></p><?php endif; ?>
	<?php if ( ! empty( $v['heading'] ) ) : ?><h2 class="text-balance text-3xl font-black leading-[1.05] tracking-tight sm:text-[3.25rem]" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2><?php endif; ?>
	<?php if ( ! empty( $v['intro'] ) ) : ?><p class="mt-6 max-w-2xl text-base leading-relaxed sm:text-lg <?php echo $dark ? 'text-white/60' : 'text-ink-dim'; ?>"><?php echo esc_html( $v['intro'] ); ?></p><?php endif; ?>
</div>
