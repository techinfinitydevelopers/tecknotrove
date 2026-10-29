<?php
/** @var array $v  accent, heading, items[type,title,url,note]  type = Blog | News | Social */
$accent = $v['accent'] ?: '#0091d1';
$cols   = [ 'Blog' => 'Blogs', 'News' => 'News', 'Social' => 'Social posts' ];
?>
<section class="bg-bg py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="mx-auto max-w-[1400px] px-5 sm:px-8">
		<p class="mono-label tt-av-eyebrow mb-6 text-[11px]" style="color: <?php echo esc_attr( $accent ); ?>;">Related Content</p>
		<h2 class="max-w-3xl text-3xl font-black leading-[1.05] tracking-tight sm:text-[3.25rem]" data-reveal><?php echo esc_html( $v['heading'] ?: 'Related content' ); ?></h2>
		<div class="mt-14 grid grid-cols-1 gap-6 md:grid-cols-3">
			<?php foreach ( $cols as $type => $label ) :
				$items = array_filter( $v['items'], fn( $i ) => ( $i['type'] ?? '' ) === $type ); ?>
				<div data-reveal class="tt-av-card is-lift rounded-3xl border border-line bg-bg-elevated p-7">
					<h3 class="mono-label text-[11px] text-ink-dim"><?php echo esc_html( $label ); ?></h3>
					<ul class="mt-4 divide-y divide-line">
						<?php foreach ( $items as $i ) :
							$placeholder = 0 === strpos( trim( $i['title'] ), '[Placeholder' ); ?>
							<li class="py-3.5">
								<?php if ( ! empty( $i['url'] ) ) : ?>
									<a href="<?php echo esc_url( $i['url'] ); ?>" class="group flex items-start justify-between gap-3 text-sm font-bold leading-snug"><span><?php echo esc_html( $i['title'] ); ?></span><span class="mt-0.5 shrink-0 text-ink-dim group-hover:text-orange-400"><?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span></a>
								<?php else : ?>
									<p class="text-sm leading-snug <?php echo $placeholder ? 'italic text-ink-dim' : 'font-bold'; ?>"><?php echo esc_html( $i['title'] ); ?></p>
								<?php endif; ?>
								<?php if ( ! empty( $i['note'] ) ) : ?><p class="mt-1 text-xs text-ink-dim"><?php echo esc_html( $i['note'] ); ?></p><?php endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
