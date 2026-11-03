<?php
/** @var array $v  accent, label, heading, intro, columns, dark, layout (cards|list|scroll), tiles[title,desc,url,icon,cta,badge] */
$accent = $v['accent'] ?: '#0091d1';
$cols   = [ '2' => 'sm:grid-cols-2', '3' => 'sm:grid-cols-2 lg:grid-cols-3', '4' => 'sm:grid-cols-2 lg:grid-cols-4' ][ (string) $v['columns'] ] ?? 'sm:grid-cols-2 lg:grid-cols-4';
$dark   = 'yes' === ( $v['dark'] ?? 'no' );
$layout = in_array( $v['layout'] ?? 'cards', [ 'list', 'scroll', 'featured', 'showcase' ], true ) ? $v['layout'] : 'cards';
$tile   = function ( $t, $i, $extra = '' ) use ( $accent, $dark ) {
	$tag = ! empty( $t['url'] ) ? 'a' : 'div'; ?>
	<<?php echo $tag; ?> <?php echo 'a' === $tag ? 'href="' . esc_url( $t['url'] ) . '"' : ''; ?> data-reveal class="tt-av-card <?php echo 'div' === $tag ? 'is-lift' : ''; ?> group relative flex flex-col overflow-hidden rounded-2xl border p-7 <?php echo esc_attr( $extra ); ?> <?php echo $dark ? 'border-white/10 bg-white/[0.035] hover:bg-white/[0.06]' : 'border-line bg-bg'; ?>">
		<div class="flex items-start justify-between gap-3">
			<div class="flex h-12 w-12 items-center justify-center rounded-xl transition-transform duration-500 group-hover:-rotate-3 group-hover:scale-110" style="background: <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.14 ) ); ?>; color: <?php echo esc_attr( $accent ); ?>; box-shadow: inset 0 0 0 1px <?php echo esc_attr( tecknotrove_hex_to_rgba( $accent, 0.3 ) ); ?>;">
				<?php tecknotrove_the_icon( $t['icon'] ?: 'Cube', 22 ); ?>
			</div>
			<?php if ( ! empty( $t['badge'] ) ) : ?><span class="mono-label rounded-full border px-2.5 py-1 text-[9.5px] <?php echo $dark ? 'border-white/20 text-white/70' : 'border-line-strong text-ink-dim'; ?>"><?php echo esc_html( $t['badge'] ); ?></span>
			<?php else : ?><span class="mono-label text-[10.5px] <?php echo $dark ? 'text-white/25' : 'text-ink-dim/50'; ?>"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span><?php endif; ?>
		</div>
		<h3 class="mt-7 text-[1.05rem] font-bold leading-snug"><?php echo esc_html( $t['title'] ); ?></h3>
		<?php if ( ! empty( $t['desc'] ) ) : ?><p class="mt-3 text-sm leading-relaxed <?php echo $dark ? 'text-white/55' : 'text-ink-dim'; ?>"><?php echo esc_html( $t['desc'] ); ?></p><?php endif; ?>
		<?php if ( 'a' === $tag ) : ?><span class="mt-auto inline-flex items-center gap-1.5 pt-6 text-sm font-semibold transition-all group-hover:gap-2.5" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( ! empty( $t['cta'] ) ? $t['cta'] : 'View' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
	</<?php echo $tag; ?>>
<?php };
$media  = function ( $t, $class = '' ) use ( $accent ) {
	if ( ! empty( $t['image'] ) ) { echo '<img src="' . esc_url( $t['image'] ) . '" alt="" loading="lazy" class="' . esc_attr( $class ) . ' h-full w-full object-cover" />'; return; }
	echo '<span class="flex h-full w-full items-center justify-center" style="background: linear-gradient(135deg, ' . esc_attr( tecknotrove_hex_to_rgba( $accent, 0.22 ) ) . ', ' . esc_attr( tecknotrove_hex_to_rgba( $accent, 0.05 ) ) . '); color: ' . esc_attr( $accent ) . ';">';
	tecknotrove_the_icon( $t['icon'] ?: 'Cube', 44 );
	echo '</span>';
};
$bg = $dark ? 'bg-[#0a0d12] text-white' : 'bg-bg-elevated';
?>
<?php if ( 'featured' === $layout ) :
	$first = $v['tiles'][0] ?? null;
	$rest  = array_slice( $v['tiles'], 1 );
	$gc    = [ 1 => 'lg:grid-cols-1', 2 => 'lg:grid-cols-2', 3 => 'lg:grid-cols-3' ][ count( $rest ) ] ?? 'lg:grid-cols-4'; ?>
<section class="tt-av-sheet relative overflow-hidden bg-bg-elevated py-24 sm:py-32" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php include __DIR__ . '/head.php'; ?>
		<?php if ( $first ) : $tag = ! empty( $first['url'] ) ? 'a' : 'div'; ?>
			<<?php echo $tag; ?> <?php echo 'a' === $tag ? 'href="' . esc_url( $first['url'] ) . '"' : ''; ?> data-reveal class="tt-av-card group mt-14 grid grid-cols-1 overflow-hidden rounded-[1.75rem] border border-line bg-bg p-3 shadow-[0_30px_60px_-40px_rgba(0,0,0,0.25)] lg:grid-cols-[1.05fr_1fr]">
				<div class="relative min-h-[260px] overflow-hidden rounded-[1.25rem] bg-bg-panel lg:min-h-[340px]"><?php $media( $first, 'absolute inset-0 transition-transform duration-[1200ms] ease-out group-hover:scale-[1.05]' ); ?></div>
				<div class="flex flex-col justify-between gap-8 p-6 sm:p-9">
					<div>
						<span class="mono-label rounded-full border border-line-strong px-3 py-1 text-[10px] text-ink-dim"><?php echo esc_html( ! empty( $first['badge'] ) ? $first['badge'] : 'Featured' ); ?></span>
						<h3 class="mt-6 text-2xl font-black leading-tight tracking-tight sm:text-4xl"><?php echo esc_html( $first['title'] ); ?></h3>
						<?php if ( ! empty( $first['desc'] ) ) : ?><p class="mt-4 max-w-md text-[15px] leading-relaxed text-ink-dim"><?php echo esc_html( $first['desc'] ); ?></p><?php endif; ?>
					</div>
					<?php if ( 'a' === $tag ) : ?><span class="inline-flex items-center gap-2 text-sm font-bold transition-all group-hover:gap-3" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( ! empty( $first['cta'] ) ? $first['cta'] : 'View' ); ?> <?php tecknotrove_the_icon( 'ArrowUpRight', 15 ); ?></span><?php endif; ?>
				</div>
			</<?php echo $tag; ?>>
		<?php endif; ?>
		<?php if ( $rest ) : ?>
			<div data-stagger class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 <?php echo esc_attr( $gc ); ?>">
				<?php foreach ( $rest as $i => $t ) : $tag = ! empty( $t['url'] ) ? 'a' : 'div'; ?>
					<<?php echo $tag; ?> <?php echo 'a' === $tag ? 'href="' . esc_url( $t['url'] ) . '"' : ''; ?> data-reveal class="tt-av-card <?php echo 'div' === $tag ? 'is-lift' : ''; ?> group flex flex-col overflow-hidden rounded-[1.5rem] border border-line bg-bg p-3">
						<div class="relative aspect-[4/3] overflow-hidden rounded-[1.1rem] bg-bg-panel">
							<?php $media( $t, 'absolute inset-0 transition-transform duration-[1200ms] ease-out group-hover:scale-[1.06]' ); ?>
							<span class="mono-label absolute right-3 top-3 rounded-full bg-bg/90 px-2.5 py-1 text-[9.5px] text-ink-dim backdrop-blur"><?php echo esc_html( ! empty( $t['badge'] ) ? $t['badge'] : sprintf( '%02d', $i + 2 ) ); ?></span>
						</div>
						<div class="flex flex-1 flex-col p-4 pb-3">
							<h3 class="text-[1.02rem] font-bold leading-snug"><?php echo esc_html( $t['title'] ); ?></h3>
							<?php if ( ! empty( $t['desc'] ) ) : ?><p class="mt-2 text-[13.5px] leading-relaxed text-ink-dim"><?php echo esc_html( $t['desc'] ); ?></p><?php endif; ?>
						</div>
					</<?php echo $tag; ?>>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php elseif ( 'showcase' === $layout ) : ?>
<section class="tt-av-sheet relative overflow-hidden bg-bg-elevated py-24 sm:py-32" data-av-show style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php include __DIR__ . '/head.php'; ?>
		<div class="mt-14 grid grid-cols-1 gap-10 lg:grid-cols-[1fr_1.1fr] lg:gap-16">
			<ol class="order-2 lg:order-1">
				<?php foreach ( $v['tiles'] as $i => $t ) : ?>
					<li class="relative border-b border-line first:border-t">
						<span class="tt-av-showbar absolute inset-y-0 left-0 w-0.5 origin-top" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
						<button type="button" data-av-show-item="<?php echo (int) $i; ?>" aria-current="<?php echo 0 === $i ? 'true' : 'false'; ?>" class="tt-av-showitem block w-full py-6 pl-6 pr-2 text-left sm:py-7">
							<span class="mono-label text-[10.5px] text-ink-dim">(<?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?>)</span>
							<span class="mt-1 block text-2xl font-bold leading-tight tracking-tight sm:text-[2rem]"><?php echo esc_html( $t['title'] ); ?></span>
							<?php if ( ! empty( $t['desc'] ) ) : ?><span class="tt-av-showdesc"><span class="tt-av-showdesc-in block max-w-lg pt-3 text-[15px] leading-relaxed text-ink-dim"><?php echo esc_html( $t['desc'] ); ?></span></span><?php endif; ?>
						</button>
					</li>
				<?php endforeach; ?>
			</ol>
			<div class="order-1 lg:sticky lg:top-32 lg:order-2 lg:self-start">
				<div class="relative aspect-[4/3] overflow-hidden rounded-[1.75rem] border border-line bg-bg-panel">
					<?php foreach ( $v['tiles'] as $i => $t ) : ?>
						<div data-av-show-img="<?php echo (int) $i; ?>" class="tt-av-showimg absolute inset-0 <?php echo 0 === $i ? 'is-on' : ''; ?>"><?php $media( $t ); ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php elseif ( 'scroll' === $layout ) : ?>
<section class="tt-av-sheet relative flex flex-col justify-center overflow-hidden py-24 sm:py-28 lg:min-h-screen <?php echo $bg; ?>" data-av-hscroll style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<?php if ( $dark ) : ?><div class="tt-av-glow pointer-events-none absolute inset-0"></div><div class="tt-av-grid-bg pointer-events-none absolute inset-0"></div><?php endif; ?>
	<div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php include __DIR__ . '/head.php'; ?>
	</div>
	<div class="relative mt-14">
		<div data-av-hscroll-track class="tt-av-track flex gap-5 overflow-x-auto px-5 pb-4 sm:px-8 lg:overflow-visible lg:will-change-transform" style="scroll-snap-type: x mandatory;">
			<?php foreach ( $v['tiles'] as $i => $t ) $tile( $t, $i, 'w-[82vw] shrink-0 snap-start sm:w-[22rem] lg:w-[24rem]' ); ?>
			<span class="hidden shrink-0 lg:block lg:w-[calc(50vw-12rem)]" aria-hidden="true"></span>
		</div>
		<div class="mx-auto mt-6 hidden max-w-[1400px] px-8 lg:block"><div class="h-px w-full bg-line"><span data-av-hscroll-bar class="block h-px origin-left scale-x-0" style="background: <?php echo esc_attr( $accent ); ?>;"></span></div></div>
	</div>
</section>

<?php elseif ( 'list' === $layout ) : ?>
<section class="tt-av-sheet relative overflow-hidden py-24 sm:py-32 <?php echo $bg; ?>" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<?php if ( $dark ) : ?><div class="tt-av-glow pointer-events-none absolute inset-0"></div><div class="tt-av-grid-bg pointer-events-none absolute inset-0"></div><?php endif; ?>
	<div class="relative mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[0.8fr_1.6fr] lg:gap-20">
		<div class="lg:sticky lg:top-32 lg:self-start"><?php include __DIR__ . '/head.php'; ?></div>
		<ol data-stagger data-av-focus class="border-t <?php echo $dark ? 'border-white/10' : 'border-line'; ?>">
			<?php foreach ( $v['tiles'] as $i => $t ) : ?>
				<li data-reveal class="tt-av-row group relative grid grid-cols-[auto_1fr] items-start gap-x-6 gap-y-3 border-b py-8 sm:gap-x-8 lg:py-10 <?php echo $dark ? 'border-white/10' : 'border-line'; ?>">
					<span class="absolute inset-y-0 left-0 w-px origin-top scale-y-0 transition-transform duration-500 group-hover:scale-y-100" style="background: <?php echo esc_attr( $accent ); ?>;"></span>
					<span class="tt-av-num pl-1 text-4xl font-black leading-none tracking-tight sm:text-5xl"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
					<div>
						<h3 class="text-xl font-bold leading-snug tracking-tight transition-transform duration-500 group-hover:translate-x-1 sm:text-2xl"><?php echo esc_html( $t['title'] ); ?></h3>
						<?php if ( ! empty( $t['desc'] ) ) : ?><p class="mt-3 max-w-xl text-[15px] leading-relaxed <?php echo $dark ? 'text-white/55' : 'text-ink-dim'; ?>"><?php echo esc_html( $t['desc'] ); ?></p><?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>

<?php else : ?>
<section class="tt-av-sheet relative overflow-hidden py-24 sm:py-32 <?php echo $bg; ?>" style="--accent: <?php echo esc_attr( $accent ); ?>;">
	<?php if ( $dark ) : ?><div class="tt-av-glow pointer-events-none absolute inset-0"></div><div class="tt-av-grid-bg pointer-events-none absolute inset-0"></div><?php endif; ?>
	<div class="relative mx-auto max-w-[1400px] px-5 sm:px-8">
		<?php include __DIR__ . '/head.php'; ?>
		<div data-stagger class="mt-14 grid grid-cols-1 gap-4 sm:gap-5 <?php echo esc_attr( $cols ); ?>">
			<?php foreach ( $v['tiles'] as $i => $t ) $tile( $t, $i, '' ); ?>
		</div>
	</div>
</section>
<?php endif; ?>
