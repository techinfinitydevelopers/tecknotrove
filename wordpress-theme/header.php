<!DOCTYPE html>
<html <?php language_attributes(); ?> class="antialiased">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'min-h-full flex flex-col bg-bg text-ink' ); ?>>
<?php wp_body_open(); ?>

<div class="grain" aria-hidden="true"></div>

<?php
// Aviation is a site within the site: its own navbar replaces the main one.
if ( tecknotrove_is_aviation() ) {
	get_template_part( 'template-parts/layout/navbar-aviation' );
} else {
	tecknotrove_the_layout( 'header' );
}
?>
