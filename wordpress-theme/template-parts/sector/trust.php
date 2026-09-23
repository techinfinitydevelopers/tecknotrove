<?php
/** @var array $sector */
if ( empty( $sector['trust_heading'] ) ) return;
?>
<section class="bg-blue-950 py-20 text-white sm:py-24">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<p class="mono-label mb-5 text-[11px] text-orange-300">04 / Track Record</p>
		<h2 class="max-w-2xl text-3xl font-black leading-[1.08] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $sector['trust_heading'] ); ?></h2>
		<p class="mt-6 max-w-lg text-base text-white/65"><?php echo esc_html( $sector['trust_body'] ); ?></p>

		<div class="mt-14 grid grid-cols-2 gap-x-6 gap-y-8 md:grid-cols-4">
			<?php foreach ( $sector['trust_stats'] as $i => $s ) : ?>
				<div data-reveal class="flex flex-col items-center text-center <?php echo $i > 0 ? 'md:border-l md:border-white/10' : ''; ?>">
					<p class="font-mono text-3xl font-medium text-white sm:text-4xl"><?php echo esc_html( $s['value'] ); ?></p>
					<p class="mt-1.5 text-sm text-white/55"><?php echo esc_html( $s['label'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
