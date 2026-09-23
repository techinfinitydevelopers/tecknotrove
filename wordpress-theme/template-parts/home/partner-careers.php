<?php
$tiles = [
	[
		'index'    => '01', 'tag' => 'Partnerships', 'title' => 'Partner With Us',
		'desc'     => 'Distribution, integration and technology partnerships across our global network.',
		'stat_value' => '35+', 'stat_label' => 'Countries',
		'cta'      => 'Get in Touch', 'href' => '#contact', 'icon' => 'Handshake',
		'accent'   => 'var(--orange)',
		'gradient' => 'linear-gradient(160deg, var(--blue-brand) 0%, var(--blue-950) 100%)',
		'sweep'    => 'blue',
	],
	[
		'index'    => '02', 'tag' => 'Careers', 'title' => 'Join Our Team',
		'desc'     => 'Work on full-motion simulation systems, from motion platforms to visuals.',
		'stat_value' => '20+', 'stat_label' => 'Years running',
		'cta'      => 'View Open Roles', 'href' => '#careers', 'icon' => 'UsersThree',
		'accent'   => '#ffffff',
		'gradient' => 'linear-gradient(160deg, #24262d 0%, #0a0a0c 100%)',
		'sweep'    => 'orange',
	],
];
?>
<section class="bg-bg-elevated pb-12 pt-16 sm:pb-16 sm:pt-20">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php tecknotrove_eyebrow( 'Work With Tecknotrove' ); ?>
		<h2 class="max-w-2xl text-3xl font-black leading-[1.05] tracking-tight sm:text-4xl" data-reveal>Build the next simulator with us.</h2>

		<div class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2">
			<?php foreach ( $tiles as $t ) : ?>
				<div data-reveal class="group relative flex min-h-[300px] flex-col overflow-hidden rounded-2xl p-6 text-white sm:min-h-[330px] sm:p-8" style="background: <?php echo esc_attr( $t['gradient'] ); ?>;">
					<div class="absolute inset-x-0 top-0 h-[3px] origin-left scale-x-0 transition-transform duration-500 ease-[cubic-bezier(0.65,0,0.35,1)] group-hover:scale-x-100" style="background: <?php echo esc_attr( $t['accent'] ); ?>;"></div>
					<div class="pointer-events-none absolute inset-0 opacity-[0.15] transition-[opacity,transform] duration-700 group-hover:scale-105 group-hover:opacity-25" style="background-image: radial-gradient(rgba(255,255,255,0.9) 1px, transparent 1px); background-size: 22px 22px; mask-image: radial-gradient(ellipse 70% 60% at 80% 10%, black 0%, transparent 75%);"></div>

					<div class="relative z-10 flex items-start justify-between">
						<span class="font-mono text-sm text-white/35"><?php echo esc_html( $t['index'] ); ?></span>
						<span class="text-white/50 transition-transform duration-500 group-hover:-translate-y-1 group-hover:rotate-6"><?php tecknotrove_the_icon( $t['icon'], 32 ); ?></span>
					</div>

					<div class="relative z-10 mt-auto">
						<span class="mono-label mb-2 inline-block text-[10.5px] text-orange-300"><?php echo esc_html( $t['tag'] ); ?></span>
						<h3 class="text-2xl font-black tracking-tight sm:text-3xl"><?php echo esc_html( $t['title'] ); ?></h3>
						<p class="mt-2 max-w-sm text-sm text-white/65"><?php echo esc_html( $t['desc'] ); ?></p>

						<div class="mt-5 flex flex-wrap items-end justify-between gap-6 border-t border-white/10 pt-4">
							<div>
								<p class="font-mono text-xl font-medium text-white"><?php echo esc_html( $t['stat_value'] ); ?></p>
								<p class="mt-0.5 text-xs text-white/50"><?php echo esc_html( $t['stat_label'] ); ?></p>
							</div>
							<?php tecknotrove_the_button( $t['cta'], [ 'href' => $t['href'], 'variant' => 'outline-light', 'sweep' => $t['sweep'], 'class' => 'px-4 py-2 text-xs', 'icon' => tecknotrove_icon( 'ArrowUpRight', 14 ) ] ); ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
