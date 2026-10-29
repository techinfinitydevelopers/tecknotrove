<?php
/** @var array $v  accent, label, heading, images[image,caption] */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php $v['heading'] = $v['heading'] ?: 'Gallery.'; include __DIR__ . '/head.php'; ?>
		<div class="mt-14 grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4">
			<?php foreach ( $v['images'] as $i => $im ) : ?>
				<figure data-reveal class="group relative overflow-hidden rounded-3xl bg-bg-panel <?php echo 0 === $i ? 'col-span-2 row-span-2' : ''; ?>">
					<div class="<?php echo 0 === $i ? 'aspect-[4/3] lg:aspect-auto lg:h-full lg:min-h-[440px]' : 'aspect-[4/3]'; ?>">
						<img src="<?php echo esc_url( $im['image'] ); ?>" alt="<?php echo esc_attr( $im['caption'] ); ?>" class="h-full w-full object-cover transition-transform duration-[900ms] ease-out group-hover:scale-[1.06]" loading="lazy" />
					</div>
					<?php if ( ! empty( $im['caption'] ) ) : ?><figcaption class="absolute inset-x-0 bottom-0 translate-y-2 bg-gradient-to-t from-black/80 via-black/30 to-transparent px-5 pb-4 pt-14 text-xs font-semibold text-white opacity-90 transition-all duration-500 group-hover:translate-y-0 group-hover:opacity-100"><?php echo esc_html( $im['caption'] ); ?></figcaption><?php endif; ?>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>
