<?php
/** @var array $sector */
$products = get_posts( [
	'post_type'      => 'product',
	'posts_per_page' => -1,
	'meta_query'     => [ [ 'key' => 'tt_sector_id', 'value' => $sector['id'] ] ],
] );
if ( empty( $products ) ) return;
?>
<section id="products" class="bg-bg-elevated py-20 sm:py-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<h2 class="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal>Every simulator ships with<br />Tecknotrove TMS.</h2>

		<div class="mt-14 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
			<?php foreach ( $products as $p ) :
				$name = get_the_title( $p );
				$desc = get_post_meta( $p->ID, 'tt_subhead', true );
				$url  = get_permalink( $p );
				?>
				<a href="<?php echo esc_url( $url ); ?>" data-reveal class="group block rounded-2xl border border-line bg-bg p-6">
					<div class="flex h-12 w-12 items-center justify-center rounded-full" style="background: <?php echo esc_attr( $sector['accent_soft'] ); ?>; color: <?php echo esc_attr( $sector['accent'] ); ?>;">
						<?php tecknotrove_the_icon( 'Cube', 22 ); ?>
					</div>
					<h3 class="mt-6 text-lg font-bold leading-snug"><?php echo esc_html( $name ); ?></h3>
					<p class="mt-2 text-sm text-ink-dim"><?php echo esc_html( $desc ); ?></p>
					<span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-ink">
						View Product
						<?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?>
					</span>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
