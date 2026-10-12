<?php get_header(); ?>

<main class="flex-1">
	<?php
	$tt_built = is_page() && class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor();
	if ( $tt_built ) {
		while ( have_posts() ) { the_post(); the_content(); }
	} else {
		get_template_part( 'template-parts/home/hero' );
		get_template_part( 'template-parts/home/sector-grid' );
		get_template_part( 'template-parts/home/why' );
		get_template_part( 'template-parts/home/news' );
		get_template_part( 'template-parts/home/partner-careers' );
		get_template_part( 'template-parts/home/linkedin' );
		get_template_part( 'template-parts/home/callout' );
	}
	?>
</main>

<?php get_footer(); ?>
