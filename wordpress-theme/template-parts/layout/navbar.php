<?php
/** Site navbar. Rendered from theme defaults, or from the Elementor "Navbar" widget via $args. */
$nv = wp_parse_args( $args ?? [], tecknotrove_navbar_defaults() );
?>
<header id="tt-nav" class="tt-nav fixed inset-x-0 top-0 z-50 transition-all duration-300">
	<nav class="relative mx-auto flex h-14 max-w-[1400px] items-center justify-between px-5 sm:h-16 sm:px-8 lg:h-[56px]">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative z-10 flex items-center">
			<span role="img" aria-label="<?php bloginfo( 'name' ); ?>" class="block aspect-[4/1] h-7 bg-contain bg-left bg-no-repeat sm:h-8" style="background-image: url('<?php echo esc_url( $nv['logo'] ); ?>');"></span>
		</a>

		<div class="tt-nav-center absolute left-1/2 top-0 hidden h-[96px] w-[680px] -translate-x-1/2 lg:block">
			<svg class="absolute inset-0 h-full w-full" viewBox="0 0 680 96" preserveAspectRatio="none" fill="#050507" aria-hidden="true"><path d="M0 0H680V56C648 56 636 62 628 76C622 88 614 96 596 96H84C66 96 58 88 52 76C44 62 32 56 0 56Z"/></svg>
			<div class="absolute inset-x-0 top-[38px] flex h-11 items-center justify-center gap-3">
			<?php foreach ( $nv['links'] as $l ) : ?>
				<a href="<?php echo esc_url( $l['url'] ); ?>" class="tt-nav-link rounded-full px-4 py-1.5 text-[15.5px] font-medium text-white/75 transition-colors hover:bg-white/10 hover:text-white"><?php echo esc_html( $l['label'] ); ?></a>
			<?php endforeach; ?>
			</div>
		</div>

		<div class="flex items-center gap-3">
			<a href="<?php echo esc_url( $nv['cta_url'] ); ?>" class="hidden rounded-full border border-white/60 px-5 py-2 text-[15px] font-medium text-white transition-colors hover:bg-white hover:text-ink sm:inline-flex lg:hidden xl:inline-flex"><?php echo esc_html( $nv['cta_label'] ); ?></a>
			<button id="tt-menu-toggle" aria-label="Open menu" class="relative z-10 flex h-10 w-10 items-center justify-center rounded-full border border-white/30 text-white transition-colors hover:border-orange/60">
				<svg id="tt-menu-icon-open" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"></path></svg>
				<svg id="tt-menu-icon-close" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor" style="display:none"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
			</button>
		</div>
	</nav>
</header>

<div id="tt-mobile-menu" class="fixed inset-0 z-40 flex-col bg-nav-bg pt-24 hidden" style="clip-path: inset(0 0 100% 0);">
	<div class="mx-auto grid w-full max-w-[1400px] flex-1 grid-cols-1 gap-12 px-6 pb-16 sm:px-8 md:grid-cols-3 md:gap-8">
		<?php foreach ( $nv['menu_groups'] as $g ) : ?>
			<div>
				<p class="mono-label mb-6 text-[11px] text-white/40"><?php echo esc_html( $g['title'] ); ?></p>
				<ul class="space-y-4">
					<?php foreach ( $g['links'] as $l ) : ?>
						<li><a href="<?php echo esc_url( $l['url'] ); ?>" class="group flex items-center gap-2 text-2xl font-semibold text-white transition-colors hover:text-orange-300 sm:text-3xl"><?php echo esc_html( $l['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="border-t border-white/10 px-6 py-6 text-sm text-white/40 sm:px-8">
		<?php echo esc_html( $nv['address'] ); ?>
	</div>
</div>
