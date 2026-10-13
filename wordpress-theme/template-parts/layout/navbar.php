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

<?php
// Sector accent colours (brand book), lightened so they read on the dark menu.
$menu_colors = [ 'defence' => '#8fb76a', 'aviation' => '#4cc0f0', 'automobile' => '#e0609a', 'driving' => '#e0609a', 'oesd' => '#e3a14f', 'industrial' => '#e3a14f' ];
$menu_main   = $nv['menu_groups'][0] ?? null;
$menu_rest   = array_slice( $nv['menu_groups'], 1 );
$menu_social = array_filter( tecknotrove_footer_defaults()['follow'], fn( $l ) => '#' !== $l['url'] );
?>
<div id="tt-mobile-menu" class="tt-menu fixed inset-0 z-40 hidden flex-col overflow-y-auto bg-[#050507] pt-24 text-white" style="clip-path: inset(0 0 100% 0);">
	<div class="tt-menu-grid pointer-events-none absolute inset-0 opacity-[0.07]" aria-hidden="true"></div>

	<div class="relative mx-auto grid w-full max-w-[1400px] flex-1 grid-cols-1 gap-10 px-6 pb-10 pt-6 sm:px-8 lg:grid-cols-[1.35fr_1fr] lg:gap-20 lg:pt-12">
		<?php if ( $menu_main ) : ?>
			<div>
				<p class="tt-menu-item mono-label mb-6 text-[11px] text-white/40"><?php echo esc_html( $menu_main['title'] ); ?></p>
				<ul>
					<?php foreach ( $menu_main['links'] as $i => $l ) :
						$key   = sanitize_title( $l['label'] );
						$color = $menu_colors[ $key ] ?? '#ff5100';
						?>
						<li class="tt-menu-item border-t border-white/10 last:border-b" style="--c: <?php echo esc_attr( $color ); ?>;">
							<a href="<?php echo esc_url( $l['url'] ); ?>" class="tt-menu-link group flex items-center gap-5 py-4 sm:py-5">
								<span class="font-mono text-xs text-white/30 transition-colors group-hover:text-[var(--c)]"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
								<span class="text-4xl font-black leading-none tracking-tight transition-all duration-300 group-hover:translate-x-2 group-hover:text-[var(--c)] sm:text-6xl"><?php echo esc_html( $l['label'] ); ?></span>
								<span class="ml-auto h-3 w-3 shrink-0 rounded-full opacity-60 transition-transform duration-300 group-hover:scale-150 group-hover:opacity-100" style="background: var(--c);"></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<div class="flex flex-col gap-10 lg:pt-1">
			<?php foreach ( $menu_rest as $g ) : ?>
				<div>
					<p class="tt-menu-item mono-label mb-4 text-[11px] text-white/40"><?php echo esc_html( $g['title'] ); ?></p>
					<ul class="space-y-1">
						<?php foreach ( $g['links'] as $l ) : ?>
							<li class="tt-menu-item">
								<a href="<?php echo esc_url( $l['url'] ); ?>" class="group inline-flex items-center gap-2 py-1 text-2xl font-bold tracking-tight text-white/85 transition-colors hover:text-orange-300 sm:text-3xl">
									<?php echo esc_html( $l['label'] ); ?>
									<span class="translate-y-0.5 opacity-0 transition-all duration-300 group-hover:translate-x-1 group-hover:opacity-100"><?php tecknotrove_the_icon( 'ArrowUpRight', 20 ); ?></span>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="tt-menu-item relative border-t border-white/10 px-6 py-5 sm:px-8">
		<div class="mx-auto flex max-w-[1400px] flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
			<p class="text-sm text-white/45"><?php echo esc_html( $nv['address'] ); ?></p>
			<div class="flex flex-wrap items-center gap-5">
				<?php foreach ( $menu_social as $l ) : ?>
					<a href="<?php echo esc_url( $l['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="text-sm text-white/55 transition-colors hover:text-white"><?php echo esc_html( $l['label'] ); ?></a>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( $nv['cta_url'] ); ?>" class="rounded-full bg-orange px-5 py-2 text-sm font-semibold text-white transition-colors hover:bg-orange-400"><?php echo esc_html( $nv['cta_label'] ); ?></a>
			</div>
		</div>
	</div>
</div>
