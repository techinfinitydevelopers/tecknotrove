<?php
/** @var array $v  accent, label, heading, intro, items ("Name | one-liner | link | image" per line, up to 6)
 *  Photo bento grid of the airside simulators. Image: 4th field, else the linked product's featured image, else a placeholder by keyword. */
$accent = $v['accent'] ?: '#0091d1';
$items  = [];
foreach ( preg_split( '/\r?\n/', trim( (string) ( $v['items'] ?? '' ) ) ) as $line ) {
	if ( '' === trim( $line ) ) continue;
	$p = array_map( 'trim', explode( '|', $line ) );
	$items[] = [ 'title' => $p[0], 'desc' => $p[1] ?? '', 'url' => $p[2] ?? '', 'image' => $p[3] ?? '' ];
}
$items = array_slice( $items, 0, 6 );
if ( ! $items ) return;
$dir   = get_template_directory_uri() . '/assets/images/aviation/';
$guess = [ 'pushback' => 'terrain-3.jpg', 'cargo' => 'cargo-hero.jpg', 'loader' => 'cargo-hero.jpg', 'baggage' => 'cargo-gallery-2.jpg', 'catering' => 'cargo-gallery-3.jpg', 'bus' => 'terrain-4.jpg', 'fire' => 'terrain-2.jpg', 'arff' => 'terrain-2.jpg', 'driving' => 'terrain-1.jpg', 'bridge' => 'terrain-4.jpg' ];
$img = function ( $it ) use ( $dir, $guess ) {
	if ( $it['image'] ) return $it['image'];
	if ( $it['url'] && ( $id = url_to_postid( $it['url'] ) ) && ( $t = get_the_post_thumbnail_url( $id, 'large' ) ) ) return $t;
	foreach ( $guess as $k => $f ) if ( false !== stripos( $it['title'], $k ) ) return $dir . $f;
	return $dir . 'training-module.jpg';
};
// 12-column bento: big | two small / big | wide / two mixed
$span = [ 'lg:col-span-6 lg:row-span-2', 'lg:col-span-3', 'lg:col-span-3', 'lg:col-span-6', 'lg:col-span-5', 'lg:col-span-7' ];
?>
<section class="tt-av-sheet relative overflow-hidden bg-[#e6f4fa] pb-20 pt-16 text-ink sm:pb-24 sm:pt-20" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php $dark = false; include __DIR__ . '/head.php'; ?>
		<div data-stagger class="mt-12 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:auto-rows-[250px] lg:grid-cols-12 lg:gap-4">
			<?php foreach ( $items as $i => $it ) : $tag = $it['url'] ? 'a' : 'div'; ?>
				<<?php echo $tag; ?> <?php echo $it['url'] ? 'href="' . esc_url( $it['url'] ) . '"' : ''; ?> data-reveal class="tt-av-bento group relative block h-64 overflow-hidden rounded-[1.5rem] bg-[#b6dce6] sm:h-72 lg:h-auto <?php echo esc_attr( $span[ $i ] ?? 'lg:col-span-4' ); ?>">
					<img src="<?php echo esc_url( $img( $it ) ); ?>" alt="<?php echo esc_attr( $it['title'] ); ?>" loading="lazy" class="tt-av-bento-img absolute inset-0 h-full w-full object-cover" />
					<span class="mono-label absolute right-3 top-3 rounded-full bg-[#e6f4fa] px-2.5 py-1 text-[10px] text-ink"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
					<span class="tt-av-bento-plate absolute bottom-3 left-3 right-3 block rounded-[1.1rem] bg-[#e6f4fa] p-4 sm:right-auto sm:max-w-[min(26rem,calc(100%-1.5rem))] sm:p-5">
						<span class="flex items-start justify-between gap-4">
							<span class="block text-[1.05rem] font-bold leading-snug tracking-tight sm:text-lg <?php echo 0 === $i ? 'lg:text-2xl' : ''; ?>"><?php echo esc_html( $it['title'] ); ?></span>
							<?php if ( $it['url'] ) : ?><span class="tt-av-bento-go flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#062440] text-white"><?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
						</span>
						<?php if ( $it['desc'] ) : ?><span class="tt-av-bento-desc block"><span class="block overflow-hidden"><span class="block pt-2 text-[13.5px] leading-relaxed text-ink-dim"><?php echo esc_html( $it['desc'] ); ?></span></span></span><?php endif; ?>
					</span>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
	</div>
</section>
