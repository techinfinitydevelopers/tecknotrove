<?php
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'TECKNOTROVE_VERSION', '1.0.0' );

require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/repeater-field.php';
require get_template_directory() . '/inc/cpts.php';
require get_template_directory() . '/inc/rewrite-fix.php';
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/icons.php';
require get_template_directory() . '/inc/admin-assets.php';
require get_template_directory() . '/inc/meta-boxes/sector-meta.php';
require get_template_directory() . '/inc/meta-boxes/product-meta.php';
