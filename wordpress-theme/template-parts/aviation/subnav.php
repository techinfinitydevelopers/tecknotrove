<?php
/** @var array $v  label, home_url, cta_label, cta_url, accent */
$accent = $v['accent'] ?: '#0091d1';
$menu   = tecknotrove_av_menu();
?>
<nav class="tt-av-subnav sticky top-[56px] z-30 border-b border-white/10 bg-[#0a0d12]/95 text-white backdrop-blur" aria-label="Aviation">
	<div class="mx-auto flex max-w-[1400px] items-center gap-2 px-5 sm:px-8">
		<a href="<?php echo esc_url( $v['home_url'] ?: home_url( '/aviation/' ) ); ?>" class="mr-4 flex shrink-0 items-center gap-2 py-3.5 text-sm font-black tracking-tight">
			<span class="h-2 w-2 rounded-full" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
			<?php echo esc_html( $v['label'] ?: 'Tecknotrove Aviation' ); ?>
		</a>
		<ul class="flex min-w-0 flex-1 items-center gap-1 overflow-x-auto lg:overflow-visible">
			<?php foreach ( $menu as $m ) : ?>
				<li class="group relative shrink-0">
					<a href="<?php echo esc_url( get_permalink( $m['hub'] ) ); ?>" class="flex items-center gap-1.5 px-3 py-4 text-[13px] font-bold text-white/80 transition-colors hover:text-white">
						<?php echo esc_html( $m['hub']->post_title ); ?>
						<?php if ( $m['products'] ) tecknotrove_the_icon( 'CaretDown', 12 ); ?>
					</a>
					<?php if ( $m['products'] ) : ?>
						<div class="invisible absolute left-0 top-full z-40 w-64 translate-y-1 rounded-b-xl border border-white/10 bg-[#0a0d12] p-2 opacity-0 shadow-2xl transition-all duration-200 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 max-lg:hidden">
							<?php foreach ( $m['products'] as $p ) : ?>
								<a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="block rounded-lg px-3 py-2.5 text-[13px] text-white/75 transition-colors hover:bg-white/5 hover:text-white"><?php echo esc_html( $p->post_title ); ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<a href="<?php echo esc_url( $v['cta_url'] ?: '#contact' ); ?>" class="ml-auto hidden shrink-0 rounded-full px-5 py-2 text-[13px] font-bold text-white sm:inline-block" style="background: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['cta_label'] ?: 'Enquire Now' ); ?></a>
	</div>
</nav>
