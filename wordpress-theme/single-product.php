<?php
/** Product detail page. If the product is built with Elementor its content is rendered; otherwise the default layout. */
get_header();
?>
<main class="flex-1">
	<?php
	$tt_built = class_exists( '\Elementor\Plugin' ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() ) && \Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor();
	if ( $tt_built ) {
		while ( have_posts() ) { the_post(); the_content(); }
	} else {
		include get_template_directory() . '/template-parts/product/body.php';
	}
	?>
</main>
<?php get_footer(); ?>
