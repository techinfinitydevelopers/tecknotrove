<?php
/** @var array $v  heading, slides[], background, textColor, accent, radius, height, overlay */
$slides = [];
$colors = [];
foreach ( $v['slides'] as $s ) {
	$slides[] = [
		'image'      => [ 'src' => $s['image'], 'alt' => $s['title'] ],
		'title'      => $s['title'],
		'category'   => $s['category'],
		'description' => $s['description'],
		'buttonText' => $s['buttonText'],
		'link'       => $s['link'] ?: '#',
		'newTab'     => false,
	];
	$colors[] = $s['color'] ?: $v['accent'];
}
$props = [
	'slides'      => $slides,
	'colors'      => $colors,
	'background'  => $v['background'] ?? '#0b1230',
	'textColor'   => '#170800',
	'accent'      => $v['accent'],
	'radius'      => (int) $v['radius'],
	'padding'     => 12,
	'gap'         => 8,
	'overlay'     => (float) $v['overlay'],
	'headingFont' => [ 'fontFamily' => 'Lato, sans-serif', 'fontWeight' => 900 ],
	'bodyFont'    => [ 'fontFamily' => 'Lato, sans-serif', 'fontWeight' => 400 ],
];
$h = max( 420, (int) $v['height'] );
?>
<section id="simulation" class="relative z-10 -mt-px overflow-hidden rounded-t-[2.5rem] bg-bg-elevated pb-8 pt-24 sm:rounded-t-[3rem] sm:pb-8 sm:pt-24">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<p class="mono-label mb-3 text-[11px] text-blue-500">Simulation Solutions</p>
		<h2 class="max-w-4xl text-3xl font-black leading-[1.05] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
		<div class="mt-6 overflow-hidden" style="height: clamp(440px, calc(100svh - 240px), <?php echo (int) $h; ?>px); border-radius: <?php echo (int) $v['radius']; ?>px;">
			<div data-tt-framer data-props="<?php echo esc_attr( wp_json_encode( $props ) ); ?>" style="width:100%;height:100%;"></div>
		</div>
	</div>
</section>
