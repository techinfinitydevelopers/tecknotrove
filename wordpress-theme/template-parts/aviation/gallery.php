<?php
/** @var array $v  accent, label, heading, images[image,caption] */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg py-20 sm:py-24">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php if ( ! empty( $v['label'] ) ) : ?><p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ); ?></p><?php endif; ?>
		<h2 class="text-3xl font-black tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $v['heading'] ?: 'Gallery.' ); ?></h2>
		<div class="mt-10 grid grid-cols-2 gap-4 lg:grid-cols-4">
			<?php foreach ( $v['images'] as $i => $im ) : ?>
				<figure data-reveal class="group relative overflow-hidden rounded-2xl bg-bg-panel <?php echo 0 === $i ? 'col-span-2 row-span-2' : ''; ?>">
					<div class="<?php echo 0 === $i ? 'aspect-[4/3] lg:aspect-auto lg:h-full lg:min-h-[420px]' : 'aspect-[4/3]'; ?>">
						<img src="<?php echo esc_url( $im['image'] ); ?>" alt="<?php echo esc_attr( $im['caption'] ); ?>" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
					</div>
					<?php if ( ! empty( $im['caption'] ) ) : ?><figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/75 to-transparent px-4 pb-3 pt-10 text-xs font-semibold text-white"><?php echo esc_html( $im['caption'] ); ?></figcaption><?php endif; ?>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
