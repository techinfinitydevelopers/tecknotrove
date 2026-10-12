<?php
/** Site footer. Rendered from theme defaults, or from the Elementor "Footer" widget via $args. */
$ft = wp_parse_args( $args ?? [], tecknotrove_footer_defaults() );
?>
<footer class="relative overflow-hidden bg-footer-bg pt-16 text-white">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<div class="flex flex-col justify-between gap-8 sm:flex-row sm:items-start">
				<div class="min-w-0">
					<div class="relative text-[19vw] sm:text-[10vw] lg:text-[7.5rem]">
						<div class="pointer-events-none absolute right-[-0.06em] top-[-0.03em] h-[0.2em] w-[0.2em]">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark.png' ); ?>" alt="" class="h-full w-full object-contain" />
						</div>
						<div class="overflow-hidden">
							<p class="tt-footer-wordmark -ml-1 select-none whitespace-nowrap font-black uppercase leading-[0.82] tracking-tighter"><?php echo esc_html( $ft['wordmark'] ); ?></p>
						</div>
					</div>
					<p class="mt-3 text-[11px] text-white/35">
						&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( $ft['copyright'] ); ?>
					</p>
				</div>

				<div class="flex gap-16 sm:pt-2">
					<div>
						<p class="mono-label mb-4 text-[10.5px] text-white/35">Explore</p>
						<ul class="space-y-2.5">
							<?php foreach ( $ft['explore'] as $l ) : ?>
								<li><a href="<?php echo esc_url( $l['url'] ); ?>" class="text-sm text-white/55 transition-colors hover:text-white"><?php echo esc_html( $l['label'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div>
						<p class="mono-label mb-4 text-[10.5px] text-white/35">Follow</p>
						<ul class="space-y-2.5">
							<?php foreach ( $ft['follow'] as $l ) : ?>
								<li><a href="<?php echo esc_url( $l['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="text-sm text-white/55 transition-colors hover:text-white"><?php echo esc_html( $l['label'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="mt-10 border-t border-white/10 py-5">
				<p class="text-xs text-white/30"><?php echo esc_html( $ft['tagline'] ); ?></p>
			</div>
		</div>
	</footer>
