<section id="contact" class="relative overflow-hidden bg-orange py-20 text-[#170800] sm:py-24">
	<div
		class="pointer-events-none absolute inset-0 opacity-40"
		style="background-image: linear-gradient(rgba(23,8,0,0.08) 1px, transparent 1px), linear-gradient(90deg, rgba(23,8,0,0.08) 1px, transparent 1px); background-size: 48px 48px; mask-image: radial-gradient(ellipse 80% 70% at 30% 40%, black 20%, transparent 85%);"
	></div>

	<div class="relative z-10 mx-auto grid max-w-[1400px] grid-cols-1 items-center gap-12 px-5 sm:px-8 lg:grid-cols-[1.05fr_0.95fr] lg:gap-16">
		<div>
			<h2 class="text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl" data-reveal>See a simulator<br />in action.</h2>
			<div data-reveal>
				<p class="mt-6 max-w-lg text-base text-[#170800]/75 sm:text-lg">
					Visit our Mumbai facility for a live demonstration, or request a virtual walkthrough with our engineering team.
				</p>
				<div class="mt-9 flex flex-wrap items-center gap-4">
					<?php tecknotrove_the_button( 'Book a demo', [ 'href' => 'tel:+912261513002', 'variant' => 'dark', 'sweep' => 'blue' ] ); ?>
					<?php tecknotrove_the_button( 'Download Brochure', [ 'href' => '#brochure', 'variant' => 'outline-dark', 'sweep' => 'blue' ] ); ?>
				</div>
			</div>
		</div>

		<div data-reveal class="rounded-2xl bg-[#170800] p-8 text-white sm:p-10">
			<p class="mono-label text-[11px] text-orange-300">The facility</p>
			<p class="mt-4 text-xl font-bold leading-snug">Tecknotrove Systems India Pvt Ltd</p>

			<div class="mt-7 space-y-5">
				<div class="flex gap-3.5">
					<span class="mt-0.5 shrink-0 text-orange-300"><?php tecknotrove_the_icon( 'MapPin', 20 ); ?></span>
					<p class="text-sm leading-relaxed text-white/70">505, Windfall, Sahar Plaza, Chakala,<br />Andheri (East), Mumbai 400059</p>
				</div>
				<a href="tel:+912261513002" class="group flex items-center gap-3.5 text-sm text-white/70 transition-colors hover:text-white">
					<span class="shrink-0 text-orange-300"><?php tecknotrove_the_icon( 'Phone', 20 ); ?></span>
					+91 22 6151 3002
				</a>
				<a href="https://www.tecknotrove.com" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3.5 text-sm text-white/70 transition-colors hover:text-white">
					<span class="shrink-0 text-orange-300"><?php tecknotrove_the_icon( 'Globe', 20 ); ?></span>
					www.tecknotrove.com
					<?php tecknotrove_the_icon( 'ArrowUpRight', 14, 'transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ); ?>
				</a>
			</div>

			<div class="mt-8 flex gap-8 border-t border-white/10 pt-6">
				<div>
					<p class="font-mono text-lg font-medium text-white">Mon&ndash;Sat</p>
					<p class="mt-0.5 text-xs text-white/50">Facility visits</p>
				</div>
				<div>
					<p class="font-mono text-lg font-medium text-white">24&times;7</p>
					<p class="mt-0.5 text-xs text-white/50">Technical support</p>
				</div>
			</div>
		</div>
	</div>
</section>
