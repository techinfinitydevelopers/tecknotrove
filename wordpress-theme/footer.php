	<footer class="relative overflow-hidden bg-footer-bg pt-16 text-white">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<div class="flex flex-col justify-between gap-8 sm:flex-row sm:items-start">
				<div class="min-w-0">
					<div class="relative text-[19vw] sm:text-[10vw] lg:text-[7.5rem]">
						<div class="pointer-events-none absolute right-[-0.06em] top-[-0.03em] h-[0.2em] w-[0.2em]">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-mark.png' ); ?>" alt="" class="h-full w-full object-contain" />
						</div>
						<div class="overflow-hidden">
							<p class="tt-footer-wordmark -ml-1 select-none whitespace-nowrap font-black uppercase leading-[0.82] tracking-tighter">Tecknotrove</p>
						</div>
					</div>
					<p class="mt-3 text-[11px] text-white/35">
						&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Tecknotrove Systems India Pvt Ltd. All rights reserved.
					</p>
				</div>

				<div class="flex gap-16 sm:pt-2">
					<div>
						<p class="mono-label mb-4 text-[10.5px] text-white/35">Explore</p>
						<ul class="space-y-2.5">
							<?php foreach ( [ 'Simulation', 'Software', 'About', 'Careers', 'Contact' ] as $link ) : ?>
								<li><a href="/#simulation" class="text-sm text-white/55 transition-colors hover:text-white"><?php echo esc_html( $link ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div>
						<p class="mono-label mb-4 text-[10.5px] text-white/35">Follow</p>
						<ul class="space-y-2.5">
							<li><a href="https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/" target="_blank" rel="noopener noreferrer" class="text-sm text-white/55 transition-colors hover:text-white">LinkedIn</a></li>
							<li><a href="https://youtu.be/hb-hqyMnMLw" target="_blank" rel="noopener noreferrer" class="text-sm text-white/55 transition-colors hover:text-white">YouTube</a></li>
							<li><a href="#" class="text-sm text-white/55 transition-colors hover:text-white">X</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="mt-10 border-t border-white/10 py-5">
				<p class="text-xs text-white/30">Precise today. Perfect tomorrow.</p>
			</div>
		</div>
	</footer>

	<div id="tt-enquire-button" class="fixed bottom-6 right-5 z-50 opacity-0 pointer-events-none transition-all duration-300 sm:bottom-8 sm:right-8" style="transform: translateY(24px) scale(0.9);">
		<?php
		tecknotrove_the_button( 'Enquire Now', [
			'href'    => '#contact',
			'variant' => 'dark',
			'class'   => 'shadow-[0_10px_40px_-8px_rgba(0,51,161,0.45)]',
			'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 256 256" fill="currentColor"><path d="M223.87,114.43,54.65,26.14A16,16,0,0,0,32.59,45.7L59.4,128,32.59,210.3a16,16,0,0,0,22.06,19.56l169.22-88.29a16,16,0,0,0,0-27.14ZM54.53,213.34,80.24,136H136a8,8,0,0,0,0-16H80.24L54.53,42.66,222.38,128Z"></path></svg>',
		] );
		?>
	</div>

	<?php wp_footer(); ?>
	</body>
	</html>
