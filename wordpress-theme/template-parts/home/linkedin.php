<?php
$company_url = 'https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/';
$hashtags = [ '#Tecknotrove', '#CoalMining', '#MakeInIndia' ];
$posts = [
	[
		'time' => '2d',
		'text' => "A single incident during training can cost a coal mine far more than most leaders account for: lost production, investigations, regulatory scrutiny, and above all, the human impact.",
		'doc_title' => 'Tecknotrove_Coal_Mining_Incident_Reduction_HSE',
		'pages' => 4, 'reactions' => 8,
		'image' => get_template_directory_uri() . '/assets/images/li-post-1.jpg',
		'href'  => 'https://www.linkedin.com/posts/tecknotrove-systems-i-pvt-ltd_tecknotrovecoalminingincidentreductionhse-activity-7506952375555739649-5lnD',
		'place' => 'z-10 sm:left-0 sm:top-0 sm:-rotate-3 sm:group-hover:-translate-x-3 sm:group-hover:-translate-y-3',
	],
	[
		'time' => '5d',
		'text' => 'How long does it really take for a new operator to become productive? On-site training on live machines is slow and costly. Scenario-based simulation gets crews to full competency up to 4x faster.',
		'doc_title' => 'Time-to-Competency_Tecknotrove',
		'pages' => 4, 'reactions' => 6,
		'image' => get_template_directory_uri() . '/assets/images/li-post-2.jpg',
		'href'  => 'https://www.linkedin.com/posts/tecknotrove-systems-i-pvt-ltd_time-to-competencytecknotrove-activity-7505524623187488770-QzAV',
		'place' => 'z-20 sm:left-[52px] sm:top-[44px] sm:rotate-3 sm:group-hover:translate-x-3 sm:group-hover:translate-y-3',
	],
];
?>
<section class="bg-bg pb-24 pt-12 sm:pb-32 sm:pt-16">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<div class="grid grid-cols-1 items-center gap-14 lg:grid-cols-[0.85fr_1.15fr] lg:gap-12">
			<div data-reveal>
				<?php tecknotrove_eyebrow( 'Latest from LinkedIn' ); ?>
				<h2 class="max-w-xl text-4xl font-black leading-[1.08] tracking-tight sm:text-5xl">Join 9,000+ professionals following Tecknotrove.</h2>

				<div class="mt-10 flex items-center gap-4">
					<div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-brand text-white">
						<?php tecknotrove_the_icon( 'LinkedinLogo', 32 ); ?>
					</div>
					<div>
						<p class="text-lg font-bold text-ink">Tecknotrove Systems (I) Pvt Ltd</p>
						<p class="text-sm text-ink-dim">Defence &middot; Aviation &middot; Mining &middot; Automotive</p>
					</div>
				</div>

				<div class="mt-8 flex gap-14 border-y border-line py-6">
					<div>
						<p class="font-mono text-4xl font-medium text-ink">9,232</p>
						<p class="mt-1 text-sm text-ink-dim">Followers</p>
					</div>
					<div>
						<p class="font-mono text-4xl font-medium text-ink">35+</p>
						<p class="mt-1 text-sm text-ink-dim">Countries reached</p>
					</div>
				</div>

				<div class="mt-8 flex flex-wrap gap-3">
					<?php foreach ( $hashtags as $h ) : ?>
						<span class="rounded-full border border-line-strong px-4 py-2 text-sm font-medium text-ink-dim"><?php echo esc_html( $h ); ?></span>
					<?php endforeach; ?>
				</div>

				<div class="mt-10 flex flex-wrap items-center gap-6">
					<?php tecknotrove_the_button( 'Follow Tecknotrove', [ 'href' => $company_url, 'target' => '_blank', 'variant' => 'dark' ] ); ?>
					<a href="<?php echo esc_url( $company_url ); ?>" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center gap-2 text-base font-semibold text-ink-dim transition-colors hover:text-orange-400">
						View all posts
						<?php tecknotrove_the_icon( 'ArrowUpRight', 18, 'transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5' ); ?>
					</a>
				</div>
			</div>

			<div data-reveal>
				<div class="group relative flex flex-col items-center gap-8 sm:mx-auto sm:block sm:h-[660px] sm:w-[432px]">
					<?php foreach ( $posts as $p ) : ?>
						<a href="<?php echo esc_url( $p['href'] ); ?>" target="_blank" rel="noopener noreferrer" class="relative flex w-full max-w-[380px] flex-col overflow-hidden rounded-xl border border-line-strong bg-white text-left shadow-[0_16px_36px_-14px_rgba(15,18,30,0.3)] transition-[transform,box-shadow] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] hover:z-30 hover:shadow-[0_28px_56px_-16px_rgba(15,18,30,0.4)] sm:absolute sm:w-[380px] <?php echo esc_attr( $p['place'] ); ?>">
							<div class="flex items-start gap-2.5 px-4 pt-4">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/li-logo.png' ); ?>" alt="" class="h-11 w-11 shrink-0 rounded-md object-cover" />
								<div class="min-w-0 flex-1">
									<p class="truncate text-[13.5px] font-bold text-[#14161c]">Tecknotrove Systems (I) Pvt Ltd</p>
									<p class="truncate text-xs text-[#565a6b]">9,232 followers</p>
									<p class="mt-0.5 flex items-center gap-1 text-xs text-[#565a6b]">
										<?php echo esc_html( $p['time'] ); ?> &middot; <?php tecknotrove_the_icon( 'Globe', 12 ); ?>
									</p>
								</div>
							</div>

							<p class="mt-2.5 line-clamp-3 px-4 text-[13.5px] leading-relaxed text-[#14161c]"><?php echo esc_html( $p['text'] ); ?></p>

							<div class="relative mt-3 aspect-[4/3] w-full bg-[#101c52]">
								<img src="<?php echo esc_url( $p['image'] ); ?>" alt="" class="absolute inset-0 h-full w-full object-cover" />
							</div>
							<div class="flex items-center justify-between border-b border-[#e6e7e8] bg-[#f3f4f7] px-4 py-2">
								<span class="truncate text-[11.5px] font-medium text-[#565a6b]"><?php echo esc_html( $p['doc_title'] ); ?></span>
								<span class="mono-label shrink-0 text-[9.5px] text-[#8b8f9e]"><?php echo (int) $p['pages']; ?> pages</span>
							</div>

							<div class="flex items-center gap-1.5 px-4 pt-2.5 text-xs text-[#565a6b]">
								<span class="flex h-4 w-4 items-center justify-center rounded-full bg-blue-brand text-white"><?php tecknotrove_the_icon( 'ThumbsUp', 10 ); ?></span>
								<?php echo (int) $p['reactions']; ?>
							</div>

							<div class="mt-2 grid grid-cols-4 gap-1 border-t border-[#e6e7e8] px-2 py-1.5">
								<?php foreach ( [ [ 'ThumbsUp', 'Like' ], [ 'ChatCircle', 'Comment' ], [ 'Repeat', 'Repost' ], [ 'PaperPlaneTilt', 'Send' ] ] as $act ) : ?>
									<span class="flex items-center justify-center gap-1.5 rounded-md py-2 text-[11.5px] font-semibold text-[#565a6b]">
										<?php tecknotrove_the_icon( $act[0], 15 ); ?>
										<span class="hidden sm:inline"><?php echo esc_html( $act[1] ); ?></span>
									</span>
								<?php endforeach; ?>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
