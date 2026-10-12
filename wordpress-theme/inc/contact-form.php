<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/** Contact form handler (used by the Elementor "Contact" widget). Emails the address set in the widget. */
function tecknotrove_handle_contact() {
	$back = isset( $_POST['back'] ) ? esc_url_raw( wp_unslash( $_POST['back'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );
	$fail = add_query_arg( 'tt_sent', 'err', $back ) . '#contact';

	if ( ! isset( $_POST['tt_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tt_nonce'] ) ), 'tecknotrove_contact' ) ) wp_safe_redirect( $fail ) && exit;
	if ( ! empty( $_POST['website'] ) ) wp_safe_redirect( add_query_arg( 'tt_sent', 'ok', $back ) ) && exit; // honeypot

	$name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
	$company = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

	$to = get_option( 'admin_email' );
	$raw = isset( $_POST['to'] ) ? sanitize_text_field( wp_unslash( $_POST['to'] ) ) : '';
	if ( false !== strpos( $raw, ':' ) ) {
		list( $sig, $enc ) = explode( ':', $raw, 2 );
		$addr = base64_decode( $enc ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions
		if ( $addr && is_email( $addr ) && hash_equals( wp_hash( $addr ), $sig ) ) $to = $addr;
	}

	if ( ! $name || ! is_email( $email ) || ! $message ) wp_safe_redirect( $fail ) && exit;

	$body = "Name: $name
Email: $email
Company: $company

$message";
	wp_mail( $to, 'Website enquiry from ' . $name, $body, [ 'Reply-To: ' . $name . ' <' . $email . '>' ] );
	wp_safe_redirect( add_query_arg( 'tt_sent', 'ok', $back ) . '#contact' );
	exit;
}
add_action( 'admin_post_nopriv_tecknotrove_contact', 'tecknotrove_handle_contact' );
add_action( 'admin_post_tecknotrove_contact', 'tecknotrove_handle_contact' );
