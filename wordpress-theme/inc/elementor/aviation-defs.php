<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Aviation hub / product widgets (client doc "Aviation Hub Menu Layout").
 * Included from definitions.php, so $defs and the field helpers ($t, $ta, $im, $col, $url, $rep) are in scope.
 */
// definitions.php reuses $col for the menu loop, so restore the colour-field helper.
$col       = fn( $id, $label, $default = '#0033a1' ) => [ 'id' => $id, 'label' => $label, 'type' => 'color', 'default' => $default ];
$av_accent = $col( 'accent', 'Accent colour', '#0091d1' );
$av_cta    = [ $t( 'cta1_label', 'Primary button label' ), $url( 'cta1_url', 'Primary button link' ), $t( 'cta2_label', 'Secondary button label' ), $url( 'cta2_url', 'Secondary button link' ) ];
$av_yesno  = [ 'no' => 'No', 'yes' => 'Yes' ];

$defs['tt_av_subnav'] = [
	'title'  => 'TT Aviation Sub-menu (sticky)',
	'icon'   => 'eicon-nav-menu',
	'fields' => [
		$av_accent,
		$t( 'label', 'Sector label', 'Tecknotrove Aviation' ),
		$url( 'home_url', 'Sector link', home_url( '/aviation/' ) ),
		$t( 'cta_label', 'Button label', 'Enquire Now' ),
		$url( 'cta_url', 'Button link', '#contact' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/subnav', [], [ 'v' => $v ] ); },
];

$defs['tt_av_hero'] = [
	'title'  => 'TT Aviation Hero',
	'icon'   => 'eicon-banner',
	'fields' => array_merge( [
		$av_accent,
		$t( 'eyebrow', 'Eyebrow (used when there is no breadcrumb)' ),
		$rep( 'crumbs', 'Breadcrumb', [ $t( 'label', 'Label' ), $url( 'url', 'Link (empty for current page)' ) ], [], 'label' ),
		$t( 'h1', 'H1', 'Heading' ),
		$ta( 'intro', 'Intro' ),
		$im( 'image', 'Background image', get_template_directory_uri() . '/assets/images/sector-aviation.jpg' ),
	], $av_cta ),
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/hero', [], [ 'v' => $v ] ); },
];

$defs['tt_av_hub_sections'] = [
	'title'  => 'TT Aviation Hub Sections (2 per row)',
	'icon'   => 'eicon-posts-grid',
	'fields' => [
		$av_accent,
		$t( 'heading', 'Heading' ),
		$rep( 'hubs', 'Hubs', [
			$t( 'title', 'Hub title (H2)' ), $ta( 'intro', 'Short intro' ),
			$ta( 'products', 'Products: one per line as  Name | one-liner | link' ),
			$url( 'url', 'Hub page link' ), $t( 'link_label', 'Link label', 'Explore hub' ),
		], [], 'title' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/hub-sections', [], [ 'v' => $v ] ); },
];

$defs['tt_av_tiles'] = [
	'title'  => 'TT Aviation Tiles (products / points / links)',
	'icon'   => 'eicon-gallery-grid',
	'fields' => [
		$av_accent,
		$t( 'label', 'Small label' ), $t( 'heading', 'Heading' ), $ta( 'intro', 'Intro' ),
		[ 'id' => 'columns', 'label' => 'Columns', 'type' => 'select', 'options' => [ '2' => '2', '3' => '3', '4' => '4' ], 'default' => '4' ],
		[ 'id' => 'dark', 'label' => 'Dark background', 'type' => 'select', 'options' => $av_yesno, 'default' => 'no' ],
		$rep( 'tiles', 'Tiles', [
			$t( 'icon', 'Icon name (Phosphor, e.g. Cube)', 'Cube' ), $t( 'title', 'Title' ), $ta( 'desc', 'Description' ), $url( 'url', 'Link (optional)' ),
		], [], 'title' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/tiles', [], [ 'v' => $v ] ); },
];

$defs['tt_av_faq'] = [
	'title'  => 'TT Aviation FAQ',
	'icon'   => 'eicon-accordion',
	'fields' => [
		$av_accent, $t( 'label', 'Small label', 'FAQ' ), $t( 'heading', 'Heading', 'Common questions.' ),
		$rep( 'items', 'Questions', [ $t( 'q', 'Question' ), $ta( 'a', 'Answer' ) ], [], 'q' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/faq', [], [ 'v' => $v ] ); },
];

$defs['tt_av_features'] = [
	'title'  => 'TT Aviation Key Features (tabs)',
	'icon'   => 'eicon-tabs',
	'fields' => [
		$av_accent, $t( 'label', 'Small label', 'Key Features' ), $t( 'heading', 'Heading', 'Key features.' ),
		$rep( 'groups', 'Feature groups', [
			$t( 'title', 'Title' ), $t( 'icon', 'Icon name (Phosphor)', 'Cube' ), $ta( 'body', 'Description' ),
			$ta( 'bullets', 'Bullets (one per line)' ), $im( 'image', 'Image' ),
		], [], 'title' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/features', [], [ 'v' => $v ] ); },
];

$defs['tt_av_video'] = [
	'title'  => 'TT Aviation Video Demo',
	'icon'   => 'eicon-video-camera',
	'fields' => [
		$av_accent, $t( 'label', 'Small label', 'Video Demo' ), $t( 'heading', 'Heading' ), $ta( 'body', 'Text' ),
		$url( 'video_url', 'Video URL (YouTube link or MP4 file; empty shows a placeholder)' ),
		$im( 'poster', 'Poster image' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/video', [], [ 'v' => $v ] ); },
];

$defs['tt_av_gallery'] = [
	'title'  => 'TT Aviation Gallery',
	'icon'   => 'eicon-gallery-justified',
	'fields' => [
		$av_accent, $t( 'label', 'Small label', 'Gallery' ), $t( 'heading', 'Heading', 'Gallery.' ),
		$rep( 'images', 'Images (first one is shown large)', [ $im( 'image', 'Image' ), $t( 'caption', 'Caption' ) ], [], 'caption' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/gallery', [], [ 'v' => $v ] ); },
];

$defs['tt_av_cta'] = [
	'title'  => 'TT Aviation Bottom CTA',
	'icon'   => 'eicon-call-to-action',
	'fields' => array_merge( [ $t( 'heading', 'Heading', 'Talk to our aviation team.' ), $ta( 'body', 'Text' ) ], $av_cta ),
	'render' => function ( $v ) { tecknotrove_el_render_part( 'aviation/cta', [], [ 'v' => $v ] ); },
];
