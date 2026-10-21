<?php
/** Hub page (e.g. /aviation/gse-simulators/): built with Elementor widgets, rendered inside the site header and footer. */
get_header();
?>
<main class="flex-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
