<!DOCTYPE html>
<html <?php language_attributes(); ?> class="antialiased">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-full flex flex-col bg-bg text-ink' ); ?>>
<?php wp_body_open(); ?>

<div class="grain" aria-hidden="true"></div>

<header id="tt-nav" class="fixed inset-x-0 top-0 z-50 bg-nav-bg transition-shadow duration-300">
	<nav class="mx-auto flex h-16 max-w-[1400px] items-center justify-between px-5 sm:h-[72px] sm:px-8">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative z-10 flex items-center">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-white.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="h-7 w-auto sm:h-8" />
		</a>

		<div class="hidden items-center gap-9 lg:flex">
			<a href="/#simulation" class="text-[14.5px] font-medium text-white/65 transition-colors hover:text-white">Simulation</a>
			<a href="/#software" class="text-[14.5px] font-medium text-white/65 transition-colors hover:text-white">Software</a>
			<a href="/#why" class="text-[14.5px] font-medium text-white/65 transition-colors hover:text-white">Company</a>
		</div>

		<div class="flex items-center gap-3">
			<span class="hidden sm:inline-flex">
				<?php tecknotrove_the_button( 'Get in Touch', [ 'href' => '#contact', 'variant' => 'light' ] ); ?>
			</span>
			<button id="tt-menu-toggle" aria-label="Open menu" class="relative z-10 flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-white transition-colors hover:border-orange/60">
				<svg id="tt-menu-icon-open" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path></svg>
				<svg id="tt-menu-icon-close" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor" style="display:none"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
			</button>
		</div>
	</nav>
</header>

<div id="tt-mobile-menu" class="fixed inset-0 z-40 flex-col bg-nav-bg pt-24 hidden" style="clip-path: inset(0 0 100% 0);">
	<div class="mx-auto grid w-full max-w-[1400px] flex-1 grid-cols-1 gap-12 px-6 pb-16 sm:px-8 md:grid-cols-3 md:gap-8">
		<div>
			<p class="mono-label mb-6 text-[11px] text-white/40">Simulation</p>
			<ul class="space-y-4">
				<?php
				$sim_links = [
					'Defence'    => '/defence',
					'Aviation'   => '/aviation',
					'Automobile' => '/automobile',
					'OESD'       => '/oesd',
				];
				foreach ( $sim_links as $label => $href ) :
					?>
					<li><a href="<?php echo esc_url( $href ); ?>" class="group flex items-center gap-2 text-2xl font-semibold text-white transition-colors hover:text-orange-300 sm:text-3xl"><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div>
			<p class="mono-label mb-6 text-[11px] text-white/40">Software</p>
			<ul class="space-y-4">
				<li><a href="/#software" class="group flex items-center gap-2 text-2xl font-semibold text-white transition-colors hover:text-orange-300 sm:text-3xl">Training Management System</a></li>
			</ul>
		</div>
		<div>
			<p class="mono-label mb-6 text-[11px] text-white/40">Company</p>
			<ul class="space-y-4">
				<?php
				$company_links = [
					'About Us' => '/#why',
					'Careers'  => '/#careers',
					'News'     => '/#news',
					'Contact'  => '/#contact',
				];
				foreach ( $company_links as $label => $href ) :
					?>
					<li><a href="<?php echo esc_url( $href ); ?>" class="group flex items-center gap-2 text-2xl font-semibold text-white transition-colors hover:text-orange-300 sm:text-3xl"><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="border-t border-white/10 px-6 py-6 text-sm text-white/40 sm:px-8">
		505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059
	</div>
</div>
