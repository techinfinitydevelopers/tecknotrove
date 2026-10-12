<?php
/** @var array $v  heading, intro, details[label,value,url], form_heading, button, to_email, accent */
$accent = $v['accent'] ?: '#0033a1';
$sent   = isset( $_GET['tt_sent'] ) ? sanitize_key( wp_unslash( $_GET['tt_sent'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
?>
<section id="contact" class="bg-bg py-20 sm:py-28">
	<div class="mx-auto grid max-w-[1400px] grid-cols-1 gap-12 px-5 sm:px-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-16">
		<div>
			<h2 class="text-3xl font-black leading-[1.05] tracking-tight sm:text-5xl" data-reveal><?php echo esc_html( $v['heading'] ); ?></h2>
			<p class="mt-5 max-w-md text-base text-ink-dim"><?php echo esc_html( $v['intro'] ); ?></p>
			<dl class="mt-10 space-y-6">
				<?php foreach ( $v['details'] as $d ) : ?>
					<div>
						<dt class="mono-label text-[10.5px]" style="color: <?php echo esc_attr( $accent ); ?>;"><?php echo esc_html( $d['label'] ); ?></dt>
						<dd class="mt-1.5 text-base text-ink">
							<?php if ( ! empty( $d['url'] ) ) : ?>
								<a href="<?php echo esc_url( $d['url'] ); ?>" class="hover:underline"><?php echo esc_html( $d['value'] ); ?></a>
							<?php else : echo esc_html( $d['value'] ); endif; ?>
						</dd>
					</div>
				<?php endforeach; ?>
			</dl>
		</div>

		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="rounded-2xl border border-line bg-bg-elevated p-6 sm:p-8" data-reveal>
			<h3 class="text-xl font-bold"><?php echo esc_html( $v['form_heading'] ); ?></h3>
			<?php if ( 'ok' === $sent ) : ?>
				<p class="mt-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-800">Thank you. We will get back to you shortly.</p>
			<?php elseif ( 'err' === $sent ) : ?>
				<p class="mt-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-800">Please fill in your name, a valid email and a message.</p>
			<?php endif; ?>
			<input type="hidden" name="action" value="tecknotrove_contact" />
			<input type="hidden" name="to" value="<?php echo esc_attr( wp_hash( $v['to_email'] ) ); ?>:<?php echo esc_attr( base64_encode( $v['to_email'] ) ); ?>" />
			<input type="hidden" name="back" value="<?php echo esc_url( get_permalink() ); ?>" />
			<?php wp_nonce_field( 'tecknotrove_contact', 'tt_nonce' ); ?>
			<p style="position:absolute;left:-9999px" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off" /></p>
			<div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
				<label class="block text-sm font-medium">Name
					<input required name="name" type="text" class="mt-1.5 w-full rounded-lg border border-line-strong bg-bg px-4 py-3 text-base outline-none focus:border-blue-brand" /></label>
				<label class="block text-sm font-medium">Email
					<input required name="email" type="email" class="mt-1.5 w-full rounded-lg border border-line-strong bg-bg px-4 py-3 text-base outline-none focus:border-blue-brand" /></label>
				<label class="block text-sm font-medium sm:col-span-2">Company / Organisation
					<input name="company" type="text" class="mt-1.5 w-full rounded-lg border border-line-strong bg-bg px-4 py-3 text-base outline-none focus:border-blue-brand" /></label>
				<label class="block text-sm font-medium sm:col-span-2">How can we help?
					<textarea required name="message" rows="5" class="mt-1.5 w-full rounded-lg border border-line-strong bg-bg px-4 py-3 text-base outline-none focus:border-blue-brand"></textarea></label>
			</div>
			<button type="submit" class="mt-6 inline-flex items-center gap-2 rounded-full bg-ink px-7 py-3 text-sm font-semibold text-white transition-colors hover:bg-blue-brand"><?php echo esc_html( $v['button'] ); ?></button>
		</form>
	</div>
</section>
