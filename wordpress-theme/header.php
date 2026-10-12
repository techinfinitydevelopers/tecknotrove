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

<?php tecknotrove_the_layout( 'header' ); ?>
