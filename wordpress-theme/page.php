<?php
/** Generic page: Elementor pages (and plain content pages) render inside the site header and footer. */
get_header();
?>
<main class="flex-1">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
