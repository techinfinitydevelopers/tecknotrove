<?php
get_header();
$product = tecknotrove_get_product_data( get_post() );
$related = tecknotrove_get_related_products( $product, 3 );
$feature_icons = [ 'Eye', 'Gauge', 'MapTrifold', 'ChartBar', 'ArrowsClockwise', 'UsersThree', 'SealCheck' ];
$gallery_icons = [ 'Monitor', 'SteeringWheel', 'Aperture', 'Waveform' ];
$gallery_labels = [ 'Operator Cab Interior', 'Visual System — NVG Mode', '6-DOF Motion Platform', 'AIOS Console' ];
?>
<main class="flex-1">

	<!-- HERO -->
	<section class="relative flex h-[80vh] min-h-[520px] flex-col justify-end overflow-hidden text-white">
		<div class="absolute inset-0">
			<?php if ( $product['image'] ) : ?>
				<img src="<?php echo esc_url( $product['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
			<?php endif; ?>
			<div class="absolute inset-0 bg-gradient-to-t from-[#050916] via-[#050916]/70 to-[#050916]/40"></div>
		</div>

		<div class="relative z-10 mx-auto w-full max-w-[1400px] px-5 pb-16 pt-32 sm:px-8 sm:pb-20">
			<p class="mono-label mb-6 flex flex-wrap items-center gap-2 text-[10.5px] text-white/55">
				<a href="/#simulation" class="hover:text-white">Simulation</a>
				<span>/</span>
				<a href="/<?php echo esc_attr( $product['sector_key'] ); ?>" class="hover:text-white"><?php echo esc_html( $product['sector_name'] ); ?></a>
				<span>/</span>
				<span class="text-orange-300"><?php echo esc_html( $product['name'] ); ?></span>
			</p>

			<h1 class="max-w-2xl text-4xl font-black leading-[1.03] tracking-tight sm:text-6xl"><?php echo esc_html( $product['h1'] ); ?></h1>
			<p class="mt-6 max-w-lg text-base text-white/75 sm:text-lg"><?php echo esc_html( $product['subhead'] ); ?></p>

			<div class="mt-9 flex flex-wrap items-center gap-4">
				<?php tecknotrove_the_button( 'Get in Touch', [ 'href' => '#contact', 'variant' => 'solid' ] ); ?>
				<?php tecknotrove_the_button( 'Download Brochure', [ 'href' => '#brochure', 'variant' => 'outline-light' ] ); ?>
			</div>
		</div>
	</section>

	<!-- QUICK SPECS BAND -->
	<section class="bg-blue-950 py-8 text-white">
		<div class="mx-auto grid max-w-[1400px] grid-cols-2 gap-x-6 gap-y-6 px-5 sm:px-8 md:grid-cols-5">
			<?php foreach ( $product['quick_specs'] as $i => $s ) : ?>
				<div class="text-center md:text-left <?php echo $i > 0 ? 'md:border-l md:border-white/10 md:pl-6' : ''; ?>">
					<p class="mono-label text-[10px] text-white/40"><?php echo esc_html( $s['label'] ); ?></p>
					<p class="mt-1.5 font-mono text-sm font-medium sm:text-base"><?php echo esc_html( $s['value'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- OVERVIEW -->
	<section id="introduction" class="bg-bg py-20 sm:py-24">
		<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16">
			<div>
				<p class="mono-label mb-5 text-[11px] text-blue-500"><?php echo esc_html( $product['overview_label'] ); ?></p>
				<h2 class="max-w-xl text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $product['overview_heading'] ); ?></h2>
				<div class="mt-6 max-w-xl space-y-4">
					<?php foreach ( $product['overview_paragraphs'] as $p ) : ?>
						<p class="text-base text-ink-dim"><?php echo esc_html( $p['text'] ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div data-reveal class="relative aspect-[4/3] overflow-hidden rounded-2xl">
				<?php if ( $product['image'] ) : ?>
					<img src="<?php echo esc_url( $product['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- KEY FEATURES -->
	<section class="bg-bg-elevated py-20 sm:py-24">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<h2 class="text-3xl font-black tracking-tight sm:text-4xl" data-reveal>What sets it apart.</h2>
			<div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
				<?php foreach ( $product['features'] as $i => $f ) : ?>
					<div data-reveal class="rounded-2xl border border-line bg-bg p-6">
						<div class="flex h-11 w-11 items-center justify-center rounded-full bg-bg-panel text-blue-500">
							<?php tecknotrove_the_icon( $feature_icons[ $i % count( $feature_icons ) ], 20 ); ?>
						</div>
						<h3 class="mt-5 text-lg font-bold"><?php echo esc_html( $f['title'] ); ?></h3>
						<p class="mt-2 text-sm text-ink-dim"><?php echo esc_html( $f['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- APPLICATIONS -->
	<section class="bg-bg py-20 sm:py-24">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<p class="mono-label mb-5 text-[11px] text-blue-500">What operators train for</p>
			<h2 class="text-3xl font-black tracking-tight sm:text-4xl" data-reveal>Applications.</h2>
			<div class="mt-12 grid grid-cols-2 gap-3 sm:grid-cols-4">
				<?php foreach ( $product['applications'] as $a ) : ?>
					<div data-reveal class="rounded-xl border border-line bg-bg-elevated px-5 py-4">
						<p class="mono-label text-[9.5px] text-ink-faint"><?php echo esc_html( $a['category'] ); ?></p>
						<p class="mt-1.5 text-sm font-semibold text-ink"><?php echo esc_html( $a['title'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CONVERTIBLE KITS -->
	<section class="relative overflow-hidden py-20 text-white sm:py-24" style="background: linear-gradient(160deg, var(--blue-brand), var(--blue-950));">
		<div class="pointer-events-none absolute inset-0 opacity-[0.15]" style="background-image: radial-gradient(rgba(255,255,255,0.9) 1px, transparent 1px); background-size: 22px 22px; mask-image: radial-gradient(ellipse 70% 60% at 80% 20%, black 0%, transparent 75%);"></div>
		<div class="relative z-10 mx-auto max-w-[1400px] px-5 sm:px-8">
			<p class="mono-label mb-5 text-[11px] text-orange-300"><?php echo esc_html( $product['convertible_label'] ); ?></p>
			<h2 class="max-w-2xl text-3xl font-black leading-[1.08] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $product['convertible_heading'] ); ?></h2>
			<div class="mt-8 flex flex-wrap gap-3">
				<?php foreach ( $product['convertible_tags'] as $t ) : ?>
					<span class="rounded-full border border-white/25 px-4 py-2 text-sm font-medium"><?php echo esc_html( $t['text'] ); ?></span>
				<?php endforeach; ?>
			</div>
			<div class="mt-12 border-t border-white/10 pt-8">
				<p class="font-mono text-4xl font-medium sm:text-5xl"><?php echo esc_html( $product['convertible_stat'] ); ?></p>
				<p class="mt-2 text-sm text-white/60"><?php echo esc_html( $product['convertible_stat_label'] ); ?></p>
			</div>
		</div>
	</section>

	<!-- TMS CALLOUT -->
	<section class="bg-bg-elevated py-20 sm:py-24">
		<div class="mx-auto grid max-w-[1400px] grid-cols-1 items-center gap-12 px-5 sm:px-8 lg:grid-cols-2 lg:gap-16">
			<div>
				<p class="mono-label mb-5 text-[11px] text-blue-500">Integrated Software</p>
				<h2 class="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal>Comes with Tecknotrove TMS.</h2>
				<p class="mt-6 max-w-md text-base text-ink-dim">Every simulator ships with our in-house Training Management System — instructor scenario control, automated scoring and session reports, out of the box.</p>
				<div class="mt-8"><?php tecknotrove_the_button( 'Explore TMS', [ 'href' => '/#software', 'variant' => 'outline' ] ); ?></div>
			</div>
			<div data-reveal class="flex aspect-[4/3] flex-col justify-between rounded-2xl bg-[#0e0e11] p-8 text-white">
				<div class="flex items-center justify-between">
					<span class="mono-label text-[10px] text-white/40">TMS &middot; Session Monitor</span>
					<span class="h-2 w-2 rounded-full bg-orange"></span>
				</div>
				<div class="grid grid-cols-3 gap-3">
					<?php foreach ( [ 92, 78, 85 ] as $v ) : ?>
						<div class="rounded-lg bg-white/5 p-4">
							<p class="font-mono text-2xl font-medium"><?php echo (int) $v; ?>%</p>
							<p class="mt-1 text-[11px] text-white/40">Score</p>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="h-16 rounded-lg bg-white/5"></div>
			</div>
		</div>
	</section>

	<!-- SPECIFICATIONS -->
	<section class="bg-bg py-20 sm:py-24">
		<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[1fr_0.9fr] lg:gap-16">
			<div>
				<p class="mono-label mb-5 text-[11px] text-blue-500">Key Specifications</p>
				<h2 class="text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal>Built to exacting standards.</h2>
				<div class="mt-8 divide-y divide-line border-y border-line">
					<?php foreach ( $product['specs'] as $s ) : ?>
						<div class="flex flex-col gap-1 py-4 sm:flex-row sm:justify-between">
							<span class="text-sm font-semibold text-ink"><?php echo esc_html( $s['label'] ); ?></span>
							<span class="text-sm text-ink-dim"><?php echo esc_html( $s['value'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div data-reveal class="rounded-2xl bg-blue-brand p-8 text-white sm:p-10">
				<p class="mono-label text-[10.5px] text-orange-300">Full Specifications</p>
				<h3 class="mt-4 text-xl font-bold leading-snug">Every system is configured to your exact requirements.</h3>
				<p class="mt-3 text-sm text-white/70">Share your training objectives and site constraints, and our engineering team will send the full specification sheet for the <?php echo esc_html( $product['name'] ); ?>.</p>
				<div class="mt-7"><?php tecknotrove_the_button( 'Request Full Specifications', [ 'href' => '#contact', 'variant' => 'light' ] ); ?></div>
			</div>
		</div>
	</section>

	<!-- GALLERY -->
	<section class="bg-bg-elevated py-20 sm:py-24">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<p class="mono-label mb-5 text-[11px] text-blue-500">Gallery</p>
			<h2 class="text-3xl font-black tracking-tight sm:text-4xl" data-reveal>Full System View.</h2>
			<div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
				<div data-reveal class="relative col-span-1 aspect-[4/3] overflow-hidden rounded-2xl sm:col-span-2 lg:col-span-2 lg:row-span-2 lg:aspect-auto">
					<?php if ( $product['image'] ) : ?>
						<img src="<?php echo esc_url( $product['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
					<?php endif; ?>
				</div>
				<?php foreach ( $gallery_labels as $i => $label ) : ?>
					<div data-reveal class="flex aspect-[4/3] flex-col justify-end rounded-2xl p-6 text-white" style="background: linear-gradient(160deg, var(--blue-500), var(--blue-950));">
						<span class="mb-auto text-white/50"><?php tecknotrove_the_icon( $gallery_icons[ $i % count( $gallery_icons ) ], 28 ); ?></span>
						<p class="text-sm font-semibold"><?php echo esc_html( $label ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<section class="bg-bg py-20 sm:py-24">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<p class="mono-label mb-5 text-[11px] text-blue-500">FAQ</p>
			<h2 class="mb-10 text-3xl font-black tracking-tight sm:text-4xl" data-reveal>Common questions.</h2>
			<div class="divide-y divide-line border-y border-line">
				<?php foreach ( $product['faq'] as $item ) : ?>
					<div class="tt-faq-item">
						<button class="tt-faq-q flex w-full items-center justify-between gap-6 py-6 text-left">
							<span class="text-base font-bold sm:text-lg"><?php echo esc_html( $item['q'] ); ?></span>
							<span class="tt-faq-icon shrink-0 text-ink-dim"><?php tecknotrove_the_icon( 'Plus', 20 ); ?></span>
						</button>
						<div class="tt-faq-a">
							<div><p class="max-w-2xl pb-6 text-sm leading-relaxed text-ink-dim"><?php echo esc_html( $item['a'] ); ?></p></div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php if ( $related ) : ?>
	<!-- RELATED PRODUCTS -->
	<section class="bg-bg-elevated py-20 sm:py-24">
		<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
			<div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
				<h2 class="max-w-xl text-3xl font-black leading-[1.08] tracking-tight sm:text-4xl" data-reveal>Explore other <?php echo esc_html( $product['sector_name'] ); ?> simulators.</h2>
				<a href="/<?php echo esc_attr( $product['sector_key'] ); ?>#products" class="group hidden shrink-0 items-center gap-2 text-sm font-semibold text-ink-dim transition-colors hover:text-orange-400 sm:flex">
					All <?php echo esc_html( $product['sector_name'] ); ?> products
					<?php tecknotrove_the_icon( 'ArrowUpRight', 16, 'transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ); ?>
				</a>
			</div>
			<div class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-3">
				<?php foreach ( $related as $r ) : ?>
					<a href="<?php echo esc_url( home_url( '/products/' . $r['slug'] ) ); ?>" data-reveal class="rounded-2xl border border-line bg-bg p-6">
						<div class="flex h-11 w-11 items-center justify-center rounded-full bg-bg-panel text-blue-500"><?php tecknotrove_the_icon( 'Cube', 20 ); ?></div>
						<h3 class="mt-5 text-lg font-bold"><?php echo esc_html( $r['name'] ); ?></h3>
						<p class="mt-2 text-sm text-ink-dim"><?php echo esc_html( $r['subhead'] ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- CALLOUT -->
	<section id="contact" class="relative overflow-hidden bg-orange py-20 text-[#170800] sm:py-24">
		<div class="relative z-10 mx-auto max-w-[1400px] px-5 text-center sm:px-8">
			<h2 class="mx-auto max-w-2xl text-4xl font-black leading-[1.05] tracking-tight sm:text-6xl" data-reveal>See the <?php echo esc_html( $product['code'] ); ?> in action.</h2>
			<div data-reveal class="mt-9 flex flex-wrap items-center justify-center gap-4">
				<?php tecknotrove_the_button( 'Get in Touch', [ 'href' => 'tel:+912261513002', 'variant' => 'dark', 'sweep' => 'blue' ] ); ?>
				<?php tecknotrove_the_button( 'Download Brochure', [ 'href' => '#brochure', 'variant' => 'outline-dark', 'sweep' => 'blue' ] ); ?>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
