<?php
/** @var array $v  accent, label, heading, intro, columns, dark, layout (cards|list|scroll), tiles[title,desc,url,icon,cta,badge] */
$accent = $v['accent'] ?: '#0091d1';
$cols   = [ '2' => 'sm:grid-cols-2', '3' => 'sm:grid-cols-2 lg:grid-cols-3', '4' => 'sm:grid-cols-2 lg:grid-cols-4' ][ (string) $v['columns'] ] ?? 'sm:grid-cols-2 lg:grid-cols-4';
$dark   = 'yes' === ( $v['dark'] ?? 'no' );
$layout = in_array( $v['layout'] ?? 'cards', [ 'list', 'scroll' ], true ) ? $v['layout'] : 'cards';
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
$bg = $dark ? 'bg-[#0a0d12] text-white' : 'bg-bg-elevated';
?>
<?php if ( 'scroll' === $layout ) : ?>
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
