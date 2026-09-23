<?php /** @var array $sector */ ?>
<section class="bg-bg py-20 sm:py-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<div class="grid grid-cols-1 gap-10 lg:grid-cols-[1fr_1fr] lg:gap-16">
			<div>
				<p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $sector['accent'] ); ?>;"><?php echo esc_html( $sector['applications_label'] ); ?></p>
				<h2 class="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $sector['applications_heading'] ); ?></h2>
				<p class="mt-6 max-w-md text-base text-ink-dim"><?php echo esc_html( $sector['applications_body'] ); ?></p>
			</div>
			<div class="grid grid-cols-2 gap-3 sm:grid-cols-2">
				<?php foreach ( $sector['applications'] as $a ) : ?>
					<div data-reveal class="rounded-xl border border-line bg-bg-elevated px-5 py-4 text-sm font-semibold text-ink"><?php echo esc_html( $a['title'] ); ?></div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
