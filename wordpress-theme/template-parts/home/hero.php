<section id="top" class="relative h-[150vh]">
	<div
		class="sticky top-0 flex h-dvh flex-col overflow-hidden text-white"
		style="background: radial-gradient(ellipse 90% 70% at 78% 15%, #12409e 0%, var(--blue-brand) 45%, var(--blue-950) 100%);"
	>
		<div class="pointer-events-none absolute inset-0">
			<div
				class="absolute inset-0 opacity-[0.5]"
				style="background-image: linear-gradient(rgba(255,255,255,0.09) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.09) 1px, transparent 1px); background-size: 56px 56px; mask-image: radial-gradient(ellipse 80% 60% at 65% 40%, black 10%, transparent 75%);"
			></div>
			<div class="absolute right-[-10%] top-1/2 h-[130vmin] w-[130vmin] -translate-y-1/2 sm:right-[-4%]">
				<div class="absolute inset-0 rounded-full border border-white/20 animate-spin-slow"></div>
				<div class="absolute inset-[9%] rounded-full border border-white/15 animate-spin-slow-reverse"></div>
				<div class="absolute inset-[20%] rounded-full border border-orange/25"></div>
				<div class="absolute inset-[20%] rounded-full border border-white/10">
					<span class="absolute inset-0 rounded-full border border-orange/40" style="animation: pulse-ring 3.6s ease-out infinite;"></span>
				</div>
				<div
					class="absolute inset-0"
					style="background: conic-gradient(from 200deg, transparent 0deg, rgba(255,255,255,0.16) 40deg, transparent 90deg); animation: spin-slow 12s linear infinite; border-radius: 9999px;"
				></div>
			</div>
			<div class="absolute inset-0 bg-gradient-to-t from-blue-950/80 via-transparent to-transparent"></div>
		</div>

		<div class="relative z-10 mx-auto flex w-full max-w-[1400px] flex-1 flex-col justify-center px-5 pt-16 sm:px-8">
			<p class="mono-label mb-6 text-[11px] text-orange-300" data-reveal>
				<?php echo esc_html( tecknotrove_home_hero_eyebrow() ); ?>
			</p>

			<h1 class="max-w-3xl text-[13vw] font-black leading-[0.95] tracking-tight sm:text-[7.5vw] lg:text-[5.6rem]">
				<span class="block overflow-hidden"><span class="block" data-reveal><?php echo esc_html( tecknotrove_home_hero_line1() ); ?></span></span>
				<span class="block overflow-hidden"><span class="block" data-reveal><?php echo esc_html( tecknotrove_home_hero_line2() ); ?></span></span>
			</h1>

			<p class="mt-7 max-w-md text-base text-white/75 sm:text-lg" data-reveal>
				<?php echo esc_html( tecknotrove_home_hero_subhead() ); ?>
			</p>

			<div class="mt-10 flex flex-wrap items-center gap-4" data-reveal>
				<?php tecknotrove_the_button( 'About Us', [ 'href' => '#why', 'variant' => 'solid' ] ); ?>
				<?php tecknotrove_the_button( 'Corporate Video', [ 'href' => 'https://youtu.be/hb-hqyMnMLw', 'target' => '_blank', 'variant' => 'outline-light' ] ); ?>
			</div>
		</div>
	</div>
</section>
