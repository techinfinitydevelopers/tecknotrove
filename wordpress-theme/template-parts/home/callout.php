<section id="contact" class="relative overflow-hidden bg-orange py-12 text-[#170800] sm:py-14">
	<div
		class="pointer-events-none absolute inset-0 opacity-40"
		style="background-image: linear-gradient(rgba(23,8,0,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(23,8,0,0.08) 1px, transparent 1px); background-size: 48px 48px; mask-image: radial-gradient(ellipse 80% 70% at 30% 40%, black 20%, transparent 85%);"
	></div>

	<div class="relative z-10 mx-auto grid max-w-[1400px] grid-cols-1 items-center gap-8 px-5 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:gap-14">
		<div>
			<h2 class="text-4xl font-black leading-[1.02] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( tecknotrove_home_callout_line1() ); ?><br /><?php echo esc_html( tecknotrove_home_callout_line2() ); ?></h2>
			<div data-reveal>
				<p class="mt-4 max-w-md text-base text-[#170800]/75">
					<?php echo esc_html( tecknotrove_home_callout_body() ); ?>
				</p>
				<div class="mt-6 flex flex-wrap items-center gap-3">
					<?php tecknotrove_the_button( 'Book a demo', [ 'href' => 'tel:+912261513002', 'variant' => 'dark', 'sweep' => 'blue' ] ); ?>
					<?php tecknotrove_the_button( 'Download Brochure', [ 'href' => '#brochure', 'variant' => 'outline-dark', 'sweep' => 'blue' ] ); ?>
				</div>
			</div>
		</div>

		<div data-reveal class="overflow-hidden rounded-2xl bg-white text-[#170800] shadow-[0_24px_50px_-30px_rgba(23,8,0,0.6)]">
			<div class="flex items-center justify-between gap-4 border-b border-[#170800]/10 px-6 py-4">
				<p class="text-base font-bold leading-snug">Tecknotrove Systems India Pvt Ltd</p>
				<span class="hidden shrink-0 items-center gap-2 text-xs text-[#170800]/60 sm:inline-flex">
					<span class="h-2 w-2 rounded-full bg-green-500"></span>
					Mon&ndash;Sat &middot; Facility visits
				</span>
			</div>

			<div class="grid grid-cols-1 divide-y divide-[#170800]/10 sm:grid-cols-2 sm:divide-x sm:divide-y-0">
				<div class="flex gap-3 px-6 py-5">
					<span class="mt-0.5 shrink-0 text-orange-400"><?php tecknotrove_the_icon( 'MapPin', 18 ); ?></span>
					<p class="text-sm leading-relaxed text-[#170800]/75">505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059</p>
				</div>
				<a href="tel:+912261513002" class="group flex items-center gap-3 px-6 py-5 text-sm text-[#170800]/75 transition-colors hover:text-[#170800]">
					<span class="shrink-0 text-orange-400"><?php tecknotrove_the_icon( 'Phone', 18 ); ?></span>
					+91 22 6151 3002
				</a>
			</div>

			<div class="flex items-center justify-between gap-4 border-t border-[#170800]/10 bg-[#170800]/[0.04] px-6 py-3 text-xs text-[#170800]/60">
				<span>Technical support</span>
				<span class="font-mono text-sm font-medium text-[#170800]">24&times;7</span>
			</div>
		</div>
	</div>
</section>
