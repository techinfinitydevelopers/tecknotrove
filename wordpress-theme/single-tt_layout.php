<?php
/** Preview shell for header/footer layouts edited in Elementor. */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-bg text-ink' ); ?>>
<?php wp_body_open(); ?>
<div style="min-height: 60vh; padding-top: 0;">
	<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
