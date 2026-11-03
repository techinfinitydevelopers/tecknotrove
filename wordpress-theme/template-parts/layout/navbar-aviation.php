<?php
/**
 * Aviation sector navbar: replaces the main site navbar on the Aviation industry page, hub pages and Aviation product pages.
 * Centred logo with links split either side (wireframe "SECTOR NAV" + client reference).
 */
$accent = '#0091d1';
$menu   = tecknotrove_av_menu();
$home   = get_permalink( get_page_by_path( 'aviation' ) ) ?: home_url( '/aviation/' );
$logo   = get_template_directory_uri() . '/assets/images/logo-white.png';
$here   = (int) get_queried_object_id();

// Left: Home + first three hubs. Right: last hub + Tecknotrove.com.
$left  = array_slice( $menu, 0, 3 );
$right = array_slice( $menu, 3 );

$link = function ( $label, $url, $products = [], $align = 'left', $active = false, $external = false ) use ( $here ) { ?>
	<li class="group relative">
		<a href="<?php echo esc_url( $url ); ?>" class="tt-av-link flex items-center gap-1.5 whitespace-nowrap px-3.5 py-6 text-[13px] font-semibold transition-colors hover:text-white <?php echo $active ? 'text-white' : 'text-white/70'; ?>">
			<?php echo esc_html( $label ); ?>
			<?php if ( $products ) tecknotrove_the_icon( 'CaretDown', 11 ); ?>
			<?php if ( $external ) tecknotrove_the_icon( 'ArrowUpRight', 13 ); ?>
		</a>
		<?php if ( $products ) : ?>
			<div class="invisible absolute top-full w-72 translate-y-1 rounded-2xl border border-white/10 bg-[#0a0d12]/95 p-2 opacity-0 shadow-2xl backdrop-blur-xl transition-all duration-200 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 <?php echo 'right' === $align ? 'right-0' : 'left-0'; ?>">
				<?php foreach ( $products as $p ) : ?>
					<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="block rounded-lg px-3 py-2.5 text-[13px] transition-colors hover:bg-white/5 hover:text-white <?php echo $here === $p->ID ? 'bg-white/5 text-white' : 'text-white/75'; ?>"><?php echo esc_html( $p->post_title ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</li>
<?php };
$short = fn( $m ) => str_replace( [ ' Training Solutions', ' & Services' ], '', $m['hub']->post_title );
?>
<header id="tt-av-nav" class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#06090d]/80 text-white backdrop-blur-xl" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<nav class="mx-auto grid h-[68px] max-w-[1400px] grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)] items-center gap-4 px-5 sm:px-8" aria-label="Aviation">
		<div class="flex items-center">
			<button type="button" id="tt-av-toggle" aria-label="Open menu" aria-expanded="false" class="flex h-10 w-10 items-center justify-center rounded-full border border-white/25 xl:hidden">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H40a8,8,0,0,1,0-16H216A8,8,0,0,1,224,128ZM40,72H216a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16ZM216,184H40a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Z"/></svg>
			</button>
			<ul class="hidden items-center xl:flex">
				<?php $link( 'Home', $home ); ?>
				<?php foreach ( $left as $m ) $link( $short( $m ), get_permalink( $m['hub'] ), $m['products'], 'left', $here === $m['hub']->ID ); ?>
			</ul>
		</div>

		<a href="<?php echo esc_url( $home ); ?>" class="flex flex-col items-center gap-1.5" aria-label="<?php bloginfo( 'name' ); ?> Aviation">
			<span role="img" aria-label="<?php bloginfo( 'name' ); ?>" class="block aspect-[4/1] h-7 bg-contain bg-center bg-no-repeat sm:h-8" style="background-image: url('<?php echo esc_url( $logo ); ?>');"></span>
			<span class="mono-label flex items-center gap-1.5 text-[9px] leading-none tracking-[0.28em] text-white/80"><span class="h-1 w-1 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>; box-shadow: 0 0 8px <?php echo esc_attr( $accent ); ?>;"></span>AVIATION</span>
		</a>

		<div class="flex items-center justify-end">
			<ul class="hidden items-center xl:flex">
				<?php foreach ( $right as $m ) $link( $short( $m ), get_permalink( $m['hub'] ), $m['products'], 'right', $here === $m['hub']->ID ); ?>
				<?php $link( 'Tecknotrove.com', home_url( '/' ), [], 'right', false, true ); ?>
			</ul>
			<a href="#contact" class="ml-2 hidden shrink-0 rounded-full px-5 py-2 text-[13px] font-bold text-white shadow-lg transition-transform hover:-translate-y-0.5 sm:inline-block" style="background: <?php echo esc_attr( $accent ); ?>;">Enquire Now</a>
		</div>
	</nav>

	<span id="tt-av-progress" aria-hidden="true" class="pointer-events-none absolute bottom-[-1px] left-0 h-[2px] w-full origin-left scale-x-0" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
	<div id="tt-av-panel" class="hidden max-h-[calc(100vh-4.25rem)] overflow-y-auto border-t border-white/10 bg-[#06090d] px-5 pb-8 pt-4 xl:hidden">
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
