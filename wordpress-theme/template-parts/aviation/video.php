<?php
/** @var array $v  accent, label, heading, body, video_url, poster */
$accent = $v['accent'] ?: '#0091d1';
$url    = $v['video_url'] ?? '';
$embed  = '';
if ( preg_match( '~(?:youtube\.com/watch\?v=|youtu\.be/)([\w-]{11})~', $url, $m ) ) $embed = 'https://www.youtube.com/embed/' . $m[1];
?>
<section id="video" class="bg-[#0a0d12] py-20 text-white sm:py-24">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 items-center gap-10 px-5 sm:px-8 lg:grid-cols-[0.8fr_1.2fr] lg:gap-14">
		<div>
			<p class="mono-label mb-5 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $v['label'] ?: 'Video Demo' ); ?></p>
			<h2 class="text-3xl font-black leading-[1.05] tracking-tight sm:text-4xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
			<?php if ( ! empty( $v['body'] ) ) : ?><p class="mt-5 text-base text-white/65"><?php echo esc_html( $v['body'] ); ?></p><?php endif; ?>
		</div>
		<div class="relative aspect-video overflow-hidden rounded-2xl border border-white/10 bg-black">
			<?php if ( $embed ) : ?>
				<iframe src="<?php echo esc_url( $embed ); ?>" title="Video demo" class="absolute inset-0 h-full w-full" loading="lazy" allowfullscreen></iframe>
			<?php elseif ( $url ) : ?>
				<video src="<?php echo esc_url( $url ); ?>" poster="<?php echo esc_url( $v['poster'] ?? '' ); ?>" controls class="absolute inset-0 h-full w-full object-cover"></video>
			<?php else : ?>
				<?php if ( ! empty( $v['poster'] ) ) : ?><img src="<?php echo esc_url( $v['poster'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover opacity-60" /><?php endif; ?>
				<div class="absolute inset-0 flex flex-col items-center justify-center gap-3 text-center">
					<span class="flex h-16 w-16 items-center justify-center rounded-full text-white" style="background: <?php echo esc_attr( $accent ); ?>;"><?php tecknotrove_the_icon( 'Play', 26 ); ?></span>
					<span class="text-sm font-semibold">Demo video on request</span>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
