<?php
/** @var array $v  heading, intro, columns, cards[icon,title,desc,url,cta], accent */
$accent = $v['accent'] ?: '#0033a1';
$cols   = in_array( (string) $v['columns'], [ '2', '3', '4' ], true ) ? $v['columns'] : '3';
$grid   = [ '2' => 'sm:grid-cols-2', '3' => 'sm:grid-cols-2 lg:grid-cols-3', '4' => 'sm:grid-cols-2 lg:grid-cols-4' ][ $cols ];
?>
<section class="bg-bg-elevated py-20 sm:py-28">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php if ( ! empty( $v['heading'] ) ) : ?>
			<h2 class="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
		<?php endif; ?>
		<?php if ( ! empty( $v['intro'] ) ) : ?>
			<p class="mt-5 max-w-xl text-base text-ink-dim"><?php echo esc_html( $v['intro'] ); ?></p>
		<?php endif; ?>
		<div class="mt-12 grid grid-cols-1 gap-5 <?php echo esc_attr( $grid ); ?>">
			<?php foreach ( $v['cards'] as $c ) :
				$tag = ! empty( $c['url'] ) ? 'a' : 'div';
				?>
				<<?php echo $tag; ?> <?php echo 'a' === $tag ? 'href="' . esc_url( $c['url'] ) . '"' : ''; ?> data-reveal class="group block rounded-2xl border border-line bg-bg p-6">
					<div class="flex h-12 w-12 items-center justify-center rounded-full" style="background: <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.14 ) ); ?>; color: <?php echo esc_attr( $accent ); ?>;">
						<?php tecknotrove_the_icon( $c['icon'] ?: 'Cube', 22 ); ?>
					</div>
					<h3 class="mt-6 text-lg font-bold leading-snug"><?php echo esc_html( $c['title'] ); ?></h3>
					<p class="mt-2 text-sm text-ink-dim"><?php echo esc_html( $c['desc'] ); ?></p>
					<?php if ( ! empty( $c['cta'] ) ) : ?>
						<span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-ink">
							<?php echo esc_html( $c['cta'] ); ?>
							<?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?>
						</span>
					<?php endif; ?>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
