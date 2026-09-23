<?php
/**
 * Renders /defence, /aviation, /automobile, /oesd — routed here via the
 * `sector` query var set by the rewrite rule in inc/rewrite-fix.php and the
 * template_include filter there.
 */
$sector_key = get_query_var( 'sector' );
$sector_post = tecknotrove_get_sector_by_key( $sector_key );

if ( ! $sector_post ) {
	status_header( 404 );
	get_header();
	echo '<main class="flex-1 py-32 text-center"><p>Sector not found.</p></main>';
	get_footer();
	return;
}

$sector = tecknotrove_get_sector_data( $sector_post );

get_header();
?>
<main class="flex-1">
	<?php
	include get_template_directory() . '/template-parts/sector/hero.php';
	include get_template_directory() . '/template-parts/sector/stat-strip.php';
	include get_template_directory() . '/template-parts/sector/benefits.php';
	include get_template_directory() . '/template-parts/sector/products.php';
	include get_template_directory() . '/template-parts/sector/applications.php';
	include get_template_directory() . '/template-parts/sector/technology.php';
	include get_template_directory() . '/template-parts/sector/trust.php';
	get_template_part( 'template-parts/home/news' );
	get_template_part( 'template-parts/home/linkedin' );
	include get_template_directory() . '/template-parts/sector/callout.php';
	?>
</main>
<?php get_footer(); ?>
