<?php
/** Site footer. Rendered from theme defaults, or from the Elementor "Footer" widget via $args. */
$ft = wp_parse_args( $args ?? [], tecknotrove_footer_defaults() );
?>
<footer class="relative overflow-hidden bg-footer-bg pt-16 text-white">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<div class="flex flex-col justify-between gap-8 sm:flex-row sm:items-start">
				<div class="min-w-0">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block">
						<img
							src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-white-tight.png' ); ?>"
							alt="<?php echo esc_attr( $ft['wordmark'] ); ?>"
							class="block h-auto w-[min(86vw,34rem)] select-none"
							width="1000" height="178" draggable="false"
						/>
					</a>
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
