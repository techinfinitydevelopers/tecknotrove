<?php
/** Fallback template — required to exist by WordPress, but every real
 * route on this site is served by front-page.php, page-sector.php or
 * single-product.php. */
get_header();
?>
<main class="flex-1 py-20 text-center">
	<p><?php esc_html_e( 'Nothing here yet.', 'tecknotrove' ); ?></p>
</main>
<?php
get_footer();
