<?php
/**
 * Aviation sector navbar: replaces the main site navbar on the Aviation industry page, hub pages and Aviation product pages.
 * Minimal bar (logo, Enquire Now, Menu) + full-screen menu overlay listing the hubs and their products.
 */
$accent = '#0091d1';
$menu   = tecknotrove_av_menu();
$home   = get_permalink( get_page_by_path( 'aviation' ) ) ?: home_url( '/aviation/' );
$logo   = get_template_directory_uri() . '/assets/images/logo-white.png';
$here   = (int) get_queried_object_id();
?>
<header id="tt-av-nav" class="tt-av-nav fixed inset-x-0 top-0 z-50 text-white" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="tt-av-nav-bar relative z-10">
		<nav class="mx-auto mt-4 grid h-[76px] max-w-[1400px] grid-cols-[1fr_auto] items-center gap-4 px-5 sm:px-8 xl:grid-cols-[minmax(0,1fr)_auto_minmax(0,1fr)]" aria-label="Aviation">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center justify-self-start" aria-label="<?php bloginfo( 'name' ); ?> home">
				<span role="img" aria-label="<?php bloginfo( 'name' ); ?>" class="tt-av-logo relative block aspect-[4/1] h-7 sm:h-8"><span class="tt-av-logo-w absolute inset-0 bg-contain bg-left bg-no-repeat" style="background-image: url('<?php echo esc_url( $logo ); ?>');"></span><span class="tt-av-logo-b absolute inset-0 bg-contain bg-left bg-no-repeat" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo-blue.png' ); ?>');"></span></span>
			</a>

			<div class="tt-av-pill hidden items-center gap-1 rounded-full bg-white p-1.5 pl-2 text-[13.5px] text-[#062440] shadow-[0_10px_30px_-12px_rgba(6,36,64,.45)] xl:flex">
				<a href="<?php echo esc_url( $home ); ?>" class="flex items-center gap-2 rounded-full px-3.5 py-2 font-bold<?php echo is_page( 'aviation' ) ? ' bg-[#e6f4fa]' : ''; ?>"><span class="h-1.5 w-1.5 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>;"></span>Aviation</a>
				<?php foreach ( $menu as $m ) : $hub = $m['hub']; $label = trim( str_replace( [ ' Training Solutions', ' & Services', ' Simulators' ], '', html_entity_decode( $hub->post_title, ENT_QUOTES ) ) ); ?>
					<a href="<?php echo esc_url( get_permalink( $hub ) ); ?>" class="rounded-full px-3 py-2 font-medium transition-colors hover:text-[#062440]<?php echo $here === $hub->ID ? ' bg-[#e6f4fa] text-[#062440]' : ' text-[#062440]/55'; ?>"><?php echo esc_html( $label ); ?></a>
				<?php endforeach; ?>
				<a href="#contact" data-av-menu-close class="ml-2 rounded-full bg-[#062440] px-5 py-2.5 font-semibold text-white shadow-[inset_0_1px_0_rgba(255,255,255,.15)] transition-transform hover:-translate-y-0.5">Enquire Now</a>
			</div>

			<div class="flex items-center justify-self-end gap-5">
				<a href="#contact" data-av-menu-close class="hidden shrink-0 rounded-full bg-white px-5 py-2.5 text-[13px] font-semibold text-[#062440] sm:inline-block xl:hidden">Enquire Now</a>
				<button type="button" id="tt-av-toggle" class="tt-av-burger group flex items-center gap-2.5 rounded-full py-1.5 pl-1 pr-1.5 text-[13.5px] text-white/75 transition-colors hover:text-white" aria-label="Open menu" aria-expanded="false" aria-controls="tt-av-menu">
					<span class="relative block h-4 overflow-hidden leading-4"><span class="tt-av-burger-txt block"><span class="block">Menu</span><span class="block">Close</span></span></span>
					<span class="relative flex h-8 w-8 items-center justify-center rounded-full bg-white text-[#062440]"><i class="tt-av-burger-l"></i><i class="tt-av-burger-l"></i></span>
				</button>
			</div>
		</nav>
		<span id="tt-av-progress" aria-hidden="true" class="pointer-events-none absolute bottom-0 left-0 h-[2px] w-full origin-left scale-x-0" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
	</div>

	<div id="tt-av-menu" class="tt-av-menu fixed inset-0 z-0 overflow-y-auto bg-[#06090d]" aria-hidden="true">
		<div class="tt-av-grid-bg pointer-events-none absolute inset-0 opacity-60"></div>
		<div class="relative mx-auto flex min-h-full max-w-[1400px] flex-col px-5 pb-8 pt-28 sm:px-8 lg:pt-32">
			<div class="grid flex-1 grid-cols-1 gap-10 lg:grid-cols-[1.35fr_1fr] lg:gap-16">
				<ol class="tt-av-menu-hubs">
					<?php foreach ( $menu as $i => $m ) : $hub = $m['hub']; ?>
						<li class="tt-av-menu-item" style="--d: <?php echo esc_attr( $i ); ?>;">
							<a href="<?php echo esc_url( get_permalink( $hub ) ); ?>" data-av-menu-hub="<?php echo esc_attr( $i ); ?>" class="tt-av-menu-hub group flex items-baseline gap-4 border-b border-white/10 py-4 sm:gap-6 sm:py-5<?php echo $here === $hub->ID ? ' is-current' : ''; ?>">
								<span class="mono-label w-7 shrink-0 text-[11px] text-white/40">0<?php echo esc_html( $i + 1 ); ?></span>
								<span class="tt-av-menu-name flex-1 text-[1.5rem] font-black leading-[1.1] tracking-tight sm:text-[2rem] xl:text-[2.4rem]"><?php echo esc_html( $hub->post_title ); ?></span>
								<span class="tt-av-menu-arrow hidden shrink-0 sm:block"><?php tecknotrove_the_icon( 'ArrowUpRight', 28 ); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ol>

				<div class="tt-av-menu-side relative hidden lg:block">
					<?php foreach ( $menu as $i => $m ) : ?>
						<div data-av-menu-panel="<?php echo esc_attr( $i ); ?>" class="tt-av-menu-panel<?php echo 0 === $i ? ' is-on' : ''; ?>">
							<p class="mono-label text-[11px] text-white/45">Inside this hub</p>
							<?php if ( $m['products'] ) : ?>
								<ul class="mt-5 divide-y divide-white/10 border-y border-white/10">
									<?php foreach ( $m['products'] as $k => $p ) : ?>
										<li style="--k: <?php echo esc_attr( $k ); ?>;"><a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="group/p flex items-center justify-between gap-4 py-3.5 text-[15px] font-semibold text-white/75 transition-colors hover:text-white<?php echo $here === $p->ID ? ' text-white' : ''; ?>"><?php echo esc_html( $p->post_title ); ?><span class="text-white/40 transition-transform group-hover/p:translate-x-1 group-hover/p:text-[var(--accent)]"><?php tecknotrove_the_icon( 'ArrowUpRight', 16 ); ?></span></a></li>
									<?php endforeach; ?>
								</ul>
							<?php else : ?>
								<p class="mt-5 max-w-sm text-[15px] leading-relaxed text-white/60">Simulators and training modules for this hub are coming soon.</p>
							<?php endif; ?>
							<a href="<?php echo esc_url( get_permalink( $m['hub'] ) ); ?>" class="mt-6 inline-flex items-center gap-2 text-sm font-bold transition-all hover:gap-3" style="color: <?php echo esc_attr( $accent ); ?>;">Explore <?php echo esc_html( $m['hub']->post_title ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="tt-av-menu-foot mt-12 flex flex-col gap-4 border-t border-white/10 pt-6 text-sm sm:flex-row sm:items-center sm:justify-between">
				<div class="flex flex-wrap gap-x-7 gap-y-2 font-semibold text-white/70">
					<a href="<?php echo esc_url( $home ); ?>" class="transition-colors hover:text-white">Aviation home</a>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-1 transition-colors hover:text-white">Tecknotrove.com <?php tecknotrove_the_icon( 'ArrowUpRight', 13 ); ?></a>
				</div>
				<a href="#contact" data-av-menu-close class="inline-flex w-max items-center gap-2 rounded-full px-6 py-3 text-sm font-bold text-white" style="background: <?php echo esc_attr( $accent ); ?>;">Enquire Now <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></a>
			</div>
		</div>
	</div>
</header>
