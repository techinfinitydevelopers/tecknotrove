<?php get_header(); ?>

<main class="flex-1">
	<?php
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/sector-grid' );
	get_template_part( 'template-parts/home/stat-strip' );
	get_template_part( 'template-parts/home/why' );
	get_template_part( 'template-parts/home/news' );
	get_template_part( 'template-parts/home/partner-careers' );
	get_template_part( 'template-parts/home/linkedin' );
	get_template_part( 'template-parts/home/callout' );
	?>
</main>

<?php get_footer(); ?>
