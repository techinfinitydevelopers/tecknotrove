<?php
/**
 * Aviation sector navbar: replaces the main site navbar on the Aviation industry page, hub pages and Aviation product pages
 * (wireframe "SECTOR NAV": sector logo | sector links | Tecknotrove.com | CTA).
 */
$accent = '#0091d1';
$menu   = tecknotrove_av_menu();
$home   = get_permalink( get_page_by_path( 'aviation' ) ) ?: home_url( '/aviation/' );
$logo   = get_template_directory_uri() . '/assets/images/logo-white.png';
$here   = (int) get_queried_object_id();
?>
<header id="tt-av-nav" class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#06090d]/80 text-white backdrop-blur-xl" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<nav class="mx-auto flex h-16 max-w-[1400px] items-center gap-6 px-5 sm:px-8" aria-label="Aviation">
		<a href="<?php echo esc_url( $home ); ?>" class="flex shrink-0 items-center gap-3">
			<span role="img" aria-label="<?php bloginfo( 'name' ); ?>" class="block aspect-[4/1] h-6 bg-contain bg-left bg-no-repeat sm:h-7" style="background-image: url('<?php echo esc_url( $logo ); ?>');"></span>
			<span class="h-5 w-px bg-white/25"></span>
			<span class="mono-label flex items-center gap-2 text-[11px] text-white"><span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>; box-shadow: 0 0 10px <?php echo esc_attr( $accent ); ?>;"></span>Aviation</span>
		</a>

		<ul class="ml-4 hidden flex-1 items-center gap-0.5 xl:flex">
			<li><a href="<?php echo esc_url( $home ); ?>" class="tt-av-link block whitespace-nowrap px-3 py-5 text-[13.5px] font-semibold text-white/70 transition-colors hover:text-white">Home</a></li>
			<?php foreach ( $menu as $m ) :
				$active = $here === $m['hub']->ID; ?>
				<li class="group relative">
					<a href="<?php echo esc_url( get_permalink( $m['hub'] ) ); ?>" class="tt-av-link flex items-center gap-1.5 whitespace-nowrap px-3 py-5 text-[13px] font-semibold transition-colors hover:text-white <?php echo $active ? 'text-white' : 'text-white/70'; ?>">
						<?php echo esc_html( str_replace( [ ' Training Solutions', ' & Services' ], '', $m['hub']->post_title ) ); ?>
						<?php if ( $m['products'] ) tecknotrove_the_icon( 'CaretDown', 11 ); ?>
					</a>
					<?php if ( $m['products'] ) : ?>
						<div class="invisible absolute left-0 top-full w-72 translate-y-1 rounded-2xl border border-white/10 bg-[#0a0d12]/95 p-2 opacity-0 shadow-2xl backdrop-blur-xl transition-all duration-200 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
							<?php foreach ( $m['products'] as $p ) : ?>
								<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="block rounded-lg px-3 py-2.5 text-[13px] transition-colors hover:bg-white/5 hover:text-white <?php echo $here === $p->ID ? 'bg-white/5 text-white' : 'text-white/75'; ?>"><?php echo esc_html( $p->post_title ); ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tt-av-link flex items-center gap-1.5 whitespace-nowrap px-3 py-5 text-[13px] font-semibold text-white/70 transition-colors hover:text-white">Tecknotrove.com <?php tecknotrove_the_icon( 'ArrowUpRight', 13 ); ?></a></li>
		</ul>

		<a href="#contact" class="ml-auto hidden shrink-0 rounded-full px-5 py-2 text-[13px] font-bold text-white shadow-lg transition-transform hover:-translate-y-0.5 sm:inline-block" style="background: <?php echo esc_attr( $accent ); ?>;">Enquire Now</a>
		<button type="button" id="tt-av-toggle" aria-label="Open menu" aria-expanded="false" class="ml-auto flex h-10 w-10 items-center justify-center rounded-full border border-white/25 sm:ml-0 xl:hidden">
			<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"/></svg>
		</button>
	</nav>

	<div id="tt-av-panel" class="hidden max-h-[calc(100vh-4rem)] overflow-y-auto border-t border-white/10 bg-[#06090d] px-5 pb-8 pt-4 xl:hidden">
		<a href="<?php echo esc_url( $home ); ?>" class="block py-3 text-base font-bold">Home</a>
		<?php foreach ( $menu as $m ) : ?>
			<div class="border-t border-white/10 py-3">
				<a href="<?php echo esc_url( get_permalink( $m['hub'] ) ); ?>" class="block py-1 text-base font-bold"><?php echo esc_html( $m['hub']->post_title ); ?></a>
				<?php foreach ( $m['products'] as $p ) : ?><a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="block py-1.5 pl-4 text-sm text-white/60"><?php echo esc_html( $p->post_title ); ?></a><?php endforeach; ?>
			</div>
		<?php endforeach; ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block border-t border-white/10 py-3 text-base font-bold">Tecknotrove.com</a>
		<a href="#contact" class="mt-3 inline-block rounded-full px-6 py-2.5 text-sm font-bold" style="background: <?php echo esc_attr( $accent ); ?>;">Enquire Now</a>
	</div>
</header>
