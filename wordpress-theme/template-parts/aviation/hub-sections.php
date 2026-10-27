<?php
/** @var array $v  accent, heading, hubs[title,intro,url,link_label,products] (products: one "Name | one-liner | url" per line) */
$accent = $v['accent'] ?: '#0091d1';
?>
<section class="bg-bg py-20 sm:py-24">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php if ( ! empty( $v['heading'] ) ) : ?><h2 class="max-w-3xl text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2><?php endif; ?>
		<div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2">
			<?php foreach ( $v['hubs'] as $h ) : ?>
				<div data-reveal class="flex flex-col rounded-2xl border border-line bg-bg-elevated p-7 sm:p-8" style="border-top: 3px solid <?php echo esc_attr( $accent ); ?>;">
					<h3 class="text-2xl font-black leading-tight tracking-tight"><a href="<?php echo esc_url( $h['url'] ); ?>"><?php echo esc_html( $h['title'] ); ?></a></h3>
					<p class="mt-3 text-sm text-ink-dim"><?php echo esc_html( $h['intro'] ); ?></p>
					<ul class="mt-6 divide-y divide-line border-y border-line">
						<?php foreach ( preg_split( '/\r?\n/', trim( $h['products'] ) ) as $line ) :
							if ( '' === trim( $line ) ) continue;
							$p = array_map( 'trim', explode( '|', $line ) ); ?>
							<li>
								<?php $href = $p[2] ?? ''; $tag = $href ? 'a' : 'div'; ?>
								<<?php echo $tag; ?> <?php echo $href ? 'href="' . esc_url( $href ) . '"' : ''; ?> class="group flex items-start justify-between gap-4 py-3.5">
									<span><span class="block text-sm font-bold"><?php echo esc_html( $p[0] ); ?></span><span class="mt-0.5 block text-[13px] text-ink-dim"><?php echo esc_html( $p[1] ?? '' ); ?></span></span>
									<?php if ( $href ) : ?><span class="mt-0.5 shrink-0 text-ink-dim transition-colors group-hover:text-orange-400"><?php tecknotrove_the_icon( 'ArrowUpRight', 16 ); ?></span><?php endif; ?>
								</<?php echo $tag; ?>>
							</li>
						<?php endforeach; ?>
					</ul>
					<a href="<?php echo esc_url( $h['url'] ); ?>" class="mt-auto inline-flex items-center gap-1.5 pt-6 text-sm font-bold" style="color: <?php echo esc_attr( $accent ); ?>;">
						<?php echo esc_html( $h['link_label'] ?: 'Explore hub' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
