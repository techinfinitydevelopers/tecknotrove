<?php
/** @var array $v  label, heading, body (html), image, reverse, bullets[text], cta_label, cta_url, accent */
$accent = $v['accent'] ?: '#0033a1';
$rev    = ! empty( $v['reverse'] ) && 'yes' === $v['reverse'];
?>
<section class="bg-bg py-20 sm:py-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-16">
			<div class="<?php echo $rev ? 'lg:order-2' : ''; ?>">
				<?php if ( ! empty( $v['label'] ) ) : ?>
					<p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ); ?></p>
				<?php endif; ?>
				<h2 class="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
				<div class="mt-6 max-w-lg space-y-4 text-base text-ink-dim"><?php echo wp_kses_post( $v['body'] ); ?></div>
				<?php if ( ! empty( $v['bullets'] ) ) : ?>
					<ul class="mt-8 space-y-4">
						<?php foreach ( $v['bullets'] as $b ) : ?>
							<li class="flex items-start gap-3 text-sm text-ink">
								<span class="mt-0.5 shrink-0" style="color: <?php echo esc_attr( $accent ); ?>;"><?php tecknotrove_the_icon( 'Check', 16 ); ?></span>
								<?php echo esc_html( $b['text'] ); ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				<?php if ( ! empty( $v['cta_label'] ) ) : ?>
					<div class="mt-9"><?php tecknotrove_the_button( $v['cta_label'], [ 'href' => $v['cta_url'] ?: '#', 'variant' => 'outline' ] ); ?></div>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $v['image'] ) ) : ?>
				<div data-reveal class="relative aspect-[4/3] overflow-hidden rounded-2xl <?php echo $rev ? 'lg:order-1' : ''; ?>">
					<img src="<?php echo esc_url( $v['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
