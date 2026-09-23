<?php /** @var array $sector */ ?>
<section class="border-b border-line bg-bg-elevated py-8 sm:py-10">
	<div class="mx-auto grid max-w-[1400px] grid-cols-2 gap-x-6 gap-y-8 px-5 sm:px-8 md:grid-cols-4">
		<?php foreach ( $sector['stats'] as $i => $s ) : ?>
			<div class="flex flex-col items-center text-center <?php echo $i > 0 ? 'md:border-l md:border-line-strong/70' : ''; ?>">
				<p class="font-mono text-3xl font-medium tabular-nums sm:text-4xl" style="color: <?php echo esc_attr( $sector['accent'] ); ?>;"><?php echo esc_html( $s['value'] ); ?></p>
				<p class="mt-1.5 text-sm text-ink-dim"><?php echo esc_html( $s['label'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
