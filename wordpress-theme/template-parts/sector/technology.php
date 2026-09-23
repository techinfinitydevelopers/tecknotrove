<?php /** @var array $sector */ ?>
<section class="bg-bg-elevated py-20 sm:py-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-16">
			<div>
				<p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $sector['accent'] ); ?>;"><?php echo esc_html( $sector['technology_label'] ); ?></p>
				<h2 class="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $sector['technology_heading'] ); ?></h2>
				<p class="mt-6 max-w-lg text-base text-ink-dim"><?php echo esc_html( $sector['technology_body'] ); ?></p>
				<ul class="mt-8 space-y-4">
					<?php foreach ( $sector['technology_bullets'] as $b ) : ?>
						<li class="flex items-start gap-3 text-sm text-ink">
							<span class="mt-0.5 shrink-0" style="color: <?php echo esc_attr( $sector['accent'] ); ?>;"><?php tecknotrove_the_icon( 'Check', 16 ); ?></span>
							<?php echo esc_html( $b['text'] ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div data-reveal class="relative aspect-[4/3] overflow-hidden rounded-2xl">
				<?php if ( $sector['image'] ) : ?>
					<img src="<?php echo esc_url( $sector['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
