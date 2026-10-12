	<?php tecknotrove_the_layout( 'footer' ); ?>


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
