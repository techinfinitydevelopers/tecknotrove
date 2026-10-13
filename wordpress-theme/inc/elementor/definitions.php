<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Elementor widget definitions. Each entry: title, icon, fields (controls) and
 * a render callback that maps the field values onto the existing theme partials.
 * Field types: text textarea wysiwyg image color url number select switch repeater.
 */

$img = get_template_directory_uri() . '/assets/images/';

$t = fn( $id, $label, $default = '' ) => [ 'id' => $id, 'label' => $label, 'type' => 'text', 'default' => $default ];
$ta = fn( $id, $label, $default = '' ) => [ 'id' => $id, 'label' => $label, 'type' => 'textarea', 'default' => $default ];
$im = fn( $id, $label, $default = '' ) => [ 'id' => $id, 'label' => $label, 'type' => 'image', 'default' => $default ];
$col = fn( $id, $label, $default = '#0033a1' ) => [ 'id' => $id, 'label' => $label, 'type' => 'color', 'default' => $default ];
$url = fn( $id, $label, $default = '' ) => [ 'id' => $id, 'label' => $label, 'type' => 'url', 'default' => $default ];
$rep = fn( $id, $label, $fields, $default = [], $title = null ) => [ 'id' => $id, 'label' => $label, 'type' => 'repeater', 'fields' => $fields, 'default' => $default, 'title_field' => $title ];

/** Sector options for selects (sector CPT posts). */
$sector_options = [ '' => 'Auto (from page slug)' ];
foreach ( get_posts( [ 'post_type' => 'sector', 'posts_per_page' => -1, 'post_status' => 'publish' ] ) as $sp ) {
	$sector_options[ $sp->ID ] = $sp->post_title;
}
$product_options = [ '' => 'Current product' ];
foreach ( get_posts( [ 'post_type' => 'product', 'posts_per_page' => -1, 'post_status' => 'publish' ] ) as $pp ) {
	$product_options[ $pp->ID ] = $pp->post_title;
}

/** Normalised sector array consumed by template-parts/sector/*.php */
$sector_from = function ( array $v, array $extra = [] ) {
	$accent = $v['accent'] ?? '#0033a1';
	return array_merge( [
		'id' => 0, 'key' => '', 'name' => '', 'eyebrow' => '', 'h1' => '', 'subhead' => '', 'image' => '',
		'stats' => [], 'benefits' => [], 'applications' => [], 'technology_bullets' => [], 'trust_stats' => [],
		'applications_label' => '', 'applications_heading' => '', 'applications_body' => '',
		'technology_label' => '', 'technology_heading' => '', 'technology_body' => '',
		'trust_heading' => '', 'trust_body' => '',
		'accent' => $accent, 'accent_soft' => tecknotrove_hex_to_rgba( $accent, 0.16 ),
	], $v, $extra, [ 'accent' => $accent, 'accent_soft' => tecknotrove_hex_to_rgba( $accent, 0.16 ) ] );
};

$defs = [];

/* ============================== HOME ============================== */

$defs['tt_hero'] = [
	'title'  => 'TT Home Hero',
	'icon'   => 'eicon-banner',
	'fields' => [
		$t( 'eyebrow', 'Eyebrow', 'Simulation & Training Technology · Est. 2002' ),
		$t( 'line1', 'Heading line 1', 'Precise today.' ),
		$t( 'line2', 'Heading line 2', 'Perfect tomorrow.' ),
		$ta( 'subhead', 'Sub-heading', 'Building technologies for demanding industries.' ),
		$im( 'essence', 'Headline (brand essence image)', $img . 'brand-essence-white.png' ),
	],
	'render' => function ( $v ) {
		tecknotrove_el_render_part( 'home/hero', [
			'tt_home_hero_eyebrow' => $v['eyebrow'], 'tt_home_hero_line1' => $v['line1'],
			'tt_home_hero_line2' => $v['line2'], 'tt_home_hero_subhead' => $v['subhead'], 'tt_home_hero_essence' => $v['essence'],
		] );
	},
];

$grid_defaults = [
	[ 'name' => 'Defence', 'accent' => '#355a17', 'h1' => 'Simulation systems built for the demands of armed forces.', 'subhead' => "When the training environment fails to match the battlefield, operators pay the price. Our defence simulators don't compromise.", 'image' => $img . 'sector-defence.jpg', 'url' => home_url( '/defence/' ), 'icon' => 'ShieldChevron' ],
	[ 'name' => 'Aviation', 'accent' => '#0091d1', 'h1' => 'Simulation systems that meet the standard of flight.', 'subhead' => 'From the flight deck to the apron, every Tecknotrove aviation simulator is built to the fidelity regulators and crews expect.', 'image' => $img . 'sector-aviation.jpg', 'url' => home_url( '/aviation/' ), 'icon' => 'AirplaneTilt' ],
	[ 'name' => 'Driving', 'accent' => '#ae1857', 'h1' => 'Driver training simulation for fleets that cannot afford mistakes.', 'subhead' => 'Passenger, commercial and emergency-response fleets trained on the hazards that cause real incidents, without the real risk.', 'image' => $img . 'sector-automobile.jpg', 'url' => home_url( '/automobile/' ), 'icon' => 'SteeringWheel' ],
	[ 'name' => 'OESD', 'accent' => '#b87626', 'h1' => 'Operator training simulation for high-consequence industrial environments.', 'subhead' => 'Oil, energy, shipping and disaster-response operations, trained on the equipment and emergencies that matter most, before they happen.', 'image' => $img . 'sector-oesd.jpg', 'url' => home_url( '/oesd/' ), 'icon' => 'Factory' ],
];
$defs['tt_sector_grid'] = [
	'title'  => 'TT Sector Cards',
	'icon'   => 'eicon-posts-grid',
	'fields' => [
		$t( 'heading', 'Section heading', "Built for the world's most demanding industries." ),
		$rep( 'cards', 'Sector cards', [
			$t( 'name', 'Sector name' ), $col( 'accent', 'Brand colour' ), $t( 'h1', 'Card title' ), $ta( 'subhead', 'Card description' ),
			$im( 'image', 'Image' ), $url( 'url', 'Link' ), $t( 'icon', 'Icon name (Phosphor, e.g. ShieldChevron)' ),
		], $grid_defaults, 'name' ),
	],
	'render' => function ( $v ) {
		$cards = [];
		foreach ( $v['cards'] as $c ) {
			$c['key'] = sanitize_title( $c['name'] );
			$cards[]  = $c;
		}
		$GLOBALS['tt_sector_grid'] = $cards;
		tecknotrove_el_render_part( 'home/sector-grid', [ 'tt_home_sectors_heading' => $v['heading'] ] );
		unset( $GLOBALS['tt_sector_grid'] );
	},
];

$defs['tt_framer_carousel'] = [
	'title'  => 'TT Framer Carousel (sectors)',
	'icon'   => 'eicon-slider-push',
	'fields' => [
		$t( 'heading', 'Section heading', "Built for the world's most demanding industries." ),
		$rep( 'slides', 'Slides', [
			$im( 'image', 'Image' ), $im( 'logo', 'Sector logo (white version)' ), $t( 'title', 'Title' ), $t( 'category', 'Category' ), $ta( 'description', 'Description' ),
			$t( 'buttonText', 'Button label', 'Discover' ), $url( 'link', 'Link' ), $col( 'color', 'Sector colour', '#ff5100' ),
		], array_map( fn( $c ) => [
			'image' => $c['image'], 'logo' => $img . 'sector-logo-' . ( 'driving' === sanitize_title( $c['name'] ) ? 'automobile' : sanitize_title( $c['name'] ) ) . '-white.png', 'title' => $c['name'], 'category' => 'Tecknotrove ' . $c['name'],
			'description' => $c['subhead'], 'buttonText' => 'Discover', 'link' => $c['url'], 'color' => $c['accent'],
		], $grid_defaults ), 'title' ),
		[ 'section' => 'Style' ],
		
		
		$col( 'accent', 'Accent colour', '#ff5100' ),
		[ 'id' => 'radius', 'label' => 'Corner radius (px)', 'type' => 'number', 'default' => 24 ],
		[ 'id' => 'height', 'label' => 'Height (px)', 'type' => 'number', 'default' => 820 ],
		[ 'id' => 'overlay', 'label' => 'Image shade (0 to 1)', 'type' => 'number', 'default' => 0.6 ],
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'home/framer-carousel', [], [ 'v' => $v ] ); },
];

$defs['tt_why'] = [
	'title'  => 'TT Split Showcase (Every subsystem)',
	'icon'   => 'eicon-image-box',
	'fields' => [
		$t( 'line1', 'Heading line 1', 'Every subsystem.' ),
		$t( 'line2', 'Heading line 2', 'One source.' ),
		$ta( 'body', 'Body text', 'Motion platforms, visuals, controls and instructor software are all engineered in-house, so every simulator ships as one integrated system instead of a stack of vendors.' ),
		$im( 'image', 'Photo', $img . 'why-simulator.jpg' ),
		$rep( 'stats', 'Stats', [
			$t( 'value', 'Number (counts up)' ), $t( 'suffix', 'Suffix (+ or ×7)' ), $t( 'label', 'Label' ), $t( 'icon', 'Icon name (Phosphor)' ),
		], [
			[ 'value' => '35', 'suffix' => '+', 'label' => 'Countries served', 'icon' => 'GlobeHemisphereWest' ],
			[ 'value' => '1500', 'suffix' => '+', 'label' => 'Simulators delivered', 'icon' => 'Wrench' ],
			[ 'value' => '2002', 'suffix' => '', 'label' => 'Established', 'icon' => 'CalendarBlank' ],
			[ 'value' => '24', 'suffix' => '×7', 'label' => 'Technical support', 'icon' => 'Headset' ],
		], 'label' ),
	],
	'render' => function ( $v ) {
		$stats = [];
		foreach ( $v['stats'] as $s ) {
			$s['value'] = (int) $s['value'];
			$s['plain'] = ( $s['value'] >= 1900 && $s['value'] <= 2100 );
			$stats[]    = $s;
		}
		tecknotrove_el_render_part( 'home/why', [
			'tt_home_why_line1' => $v['line1'], 'tt_home_why_line2' => $v['line2'], 'tt_home_why_body' => $v['body'],
			'tt_home_why_image' => $v['image'], 'tt_home_why_stats' => $stats,
		] );
	},
];

$defs['tt_news'] = [
	'title'  => 'TT News Cards',
	'icon'   => 'eicon-post-list',
	'fields' => [
		$rep( 'items', 'News items', [ $t( 'title', 'Title' ), $t( 'meta', 'Date · read time' ), $im( 'image', 'Image' ) ], [
			[ 'title' => 'Tank Driving Simulator delivered to the Indian Army', 'meta' => '12 Aug 2025 · 4 min read', 'image' => $img . 'news-army.jpg' ],
			[ 'title' => 'What we showcased and signed at DefExpo 2025', 'meta' => '02 Jun 2025 · 3 min read', 'image' => $img . 'news-expo.jpg' ],
			[ 'title' => 'Why 6-DOF matters for full-motion training', 'meta' => '21 Apr 2025 · 6 min read', 'image' => $img . 'news-motion.jpg' ],
		], 'title' ),
	],
	'render' => function ( $v ) {
		tecknotrove_el_render_part( 'home/news', [ 'tt_home_news' => $v['items'] ] );
	},
];

$defs['tt_partners'] = [
	'title'  => 'TT Partner / Careers Tiles',
	'icon'   => 'eicon-gallery-grid',
	'fields' => [
		$t( 'heading', 'Section heading', 'Build the next simulator with us.' ),
		$rep( 'tiles', 'Tiles', [
			$t( 'tag', 'Tag' ), $t( 'title', 'Title' ), $ta( 'desc', 'Description' ), $t( 'stat_value', 'Stat value' ), $t( 'stat_label', 'Stat label' ), $t( 'cta', 'Button label' ), $t( 'href', 'Button link' ),
		], [
			[ 'tag' => 'Partnerships', 'title' => 'Partner With Us', 'desc' => 'Distribution, integration and technology partnerships across our global network.', 'stat_value' => '35+', 'stat_label' => 'Countries', 'cta' => 'Get in Touch', 'href' => '/contact/' ],
			[ 'tag' => 'Careers', 'title' => 'Join Our Team', 'desc' => 'Work on full-motion simulation systems, from motion platforms to visuals.', 'stat_value' => '20+', 'stat_label' => 'Years running', 'cta' => 'View Open Roles', 'href' => '/careers/' ],
		], 'title' ),
	],
	'render' => function ( $v ) {
		tecknotrove_el_render_part( 'home/partner-careers', [ 'tt_home_partners' => $v['tiles'], 'tt_home_partners_heading' => $v['heading'] ] );
	},
];

$defs['tt_linkedin'] = [
	'title'  => 'TT LinkedIn Posts',
	'icon'   => 'eicon-social-icons',
	'fields' => [
		$t( 'followers', 'Followers', '9,232' ),
		$t( 'countries', 'Countries', '35+' ),
		$rep( 'hashtags', 'Hashtags', [ $t( 'text', 'Hashtag' ) ], [ [ 'text' => '#Tecknotrove' ], [ 'text' => '#CoalMining' ], [ 'text' => '#MakeInIndia' ] ], 'text' ),
		$rep( 'posts', 'Posts', [
			$t( 'time', 'Age (e.g. 2d)' ), $ta( 'text', 'Post text' ), $t( 'doc_title', 'Document title' ), $t( 'pages', 'Pages' ), $t( 'reactions', 'Reactions' ), $im( 'image', 'Image' ), $url( 'href', 'LinkedIn link' ),
		], [
			[ 'time' => '2d', 'text' => 'A single incident during training can cost a coal mine far more than most leaders account for: lost production, investigations, regulatory scrutiny, and above all, the human impact.', 'doc_title' => 'Tecknotrove_Coal_Mining_Incident_Reduction_HSE', 'pages' => '4', 'reactions' => '8', 'image' => $img . 'li-post-1.jpg', 'href' => 'https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/' ],
			[ 'time' => '5d', 'text' => 'How long does it really take for a new operator to become productive? Scenario-based simulation gets crews to full competency up to 4x faster.', 'doc_title' => 'Time-to-Competency_Tecknotrove', 'pages' => '4', 'reactions' => '6', 'image' => $img . 'li-post-2.jpg', 'href' => 'https://www.linkedin.com/company/tecknotrove-systems-i-pvt-ltd/' ],
		], 'doc_title' ),
	],
	'render' => function ( $v ) {
		tecknotrove_el_render_part( 'home/linkedin', [
			'tt_home_linkedin_followers' => $v['followers'], 'tt_home_linkedin_countries' => $v['countries'],
			'tt_home_hashtags' => $v['hashtags'], 'tt_home_linkedin_posts' => $v['posts'],
		] );
	},
];

$defs['tt_callout'] = [
	'title'  => 'TT Orange Call-to-Action + Contact Card',
	'icon'   => 'eicon-call-to-action',
	'fields' => [
		$t( 'line1', 'Heading line 1', 'See a simulator' ),
		$t( 'line2', 'Heading line 2', 'in action.' ),
		$ta( 'body', 'Body text', 'Visit our Mumbai facility for a live demonstration, or request a virtual walkthrough with our engineering team.' ),
	],
	'render' => function ( $v ) {
		tecknotrove_el_render_part( 'home/callout', [
			'tt_home_callout_line1' => $v['line1'], 'tt_home_callout_line2' => $v['line2'], 'tt_home_callout_body' => $v['body'],
		] );
	},
];

/* ============================== SECTOR PAGES ============================== */

$defs['tt_sector_hero'] = [
	'title'  => 'TT Sector Hero',
	'icon'   => 'eicon-banner',
	'fields' => [
		$col( 'accent', 'Sector colour', '#355a17' ),
		$t( 'eyebrow', 'Eyebrow', 'Tecknotrove Defence' ),
		$t( 'h1', 'Heading', 'Simulation systems built for the demands of armed forces.' ),
		$ta( 'subhead', 'Sub-heading' ),
		$im( 'image', 'Background image', $img . 'sector-defence.jpg' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		$sector = $sector_from( $v );
		tecknotrove_el_render_part( 'sector/hero', [], [ 'sector' => $sector ] );
	},
];

$defs['tt_sector_stats'] = [
	'title'  => 'TT Sector Stat Strip',
	'icon'   => 'eicon-number-field',
	'fields' => [
		$col( 'accent', 'Sector colour', '#355a17' ),
		$rep( 'stats', 'Stats', [ $t( 'value', 'Value' ), $t( 'label', 'Label' ) ], [
			[ 'value' => '20+', 'label' => 'Years in Defence' ], [ 'value' => '8', 'label' => 'Simulator Platforms' ],
			[ 'value' => '6-DOF', 'label' => 'Motion Fidelity' ], [ 'value' => 'MIL-STD', 'label' => 'Compliance' ],
		], 'label' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		tecknotrove_el_render_part( 'sector/stat-strip', [], [ 'sector' => $sector_from( $v ) ] );
	},
];

$defs['tt_sector_benefits'] = [
	'title'  => 'TT Sector Benefits',
	'icon'   => 'eicon-icon-box',
	'fields' => [
		$col( 'accent', 'Sector colour', '#355a17' ),
		$rep( 'benefits', 'Benefits', [ $t( 'title', 'Title' ), $ta( 'desc', 'Description' ) ], [
			[ 'title' => 'Risk-Free Training', 'desc' => 'Train in hazardous scenarios without exposing personnel or equipment.' ],
			[ 'title' => 'Accelerated Learning', 'desc' => 'Repeat drills until muscle memory and confidence develop.' ],
			[ 'title' => 'Measurable Performance', 'desc' => 'Instructor dashboards, automated scoring, detailed reports.' ],
			[ 'title' => 'Lower Training Costs', 'desc' => 'Reduce fuel, maintenance and equipment downtime.' ],
		], 'title' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		tecknotrove_el_render_part( 'sector/benefits', [], [ 'sector' => $sector_from( $v ) ] );
	},
];

$defs['tt_sector_products'] = [
	'title'  => 'TT Sector Products (auto list)',
	'icon'   => 'eicon-products',
	'fields' => [
		$col( 'accent', 'Sector colour', '#355a17' ),
		[ 'id' => 'sector_id', 'label' => 'Sector whose products to list', 'type' => 'select', 'options' => $sector_options, 'default' => '' ],
	],
	'render' => function ( $v ) use ( $sector_from ) {
		$sid = (int) $v['sector_id'];
		if ( ! $sid ) {
			$slug = get_post_field( 'post_name', get_the_ID() );
			$sp   = $slug ? tecknotrove_get_sector_by_key( $slug ) : null;
			$sid  = $sp ? $sp->ID : 0;
		}
		tecknotrove_el_render_part( 'sector/products', [], [ 'sector' => $sector_from( $v, [ 'id' => $sid ] ) ] );
	},
];

$defs['tt_sector_applications'] = [
	'title'  => 'TT Sector Applications',
	'icon'   => 'eicon-bullet-list',
	'fields' => [
		$col( 'accent', 'Sector colour', '#355a17' ),
		$t( 'label', 'Label', '02 / Applications' ),
		$t( 'heading', 'Heading', 'Training for conditions that operators actually face.' ),
		$ta( 'body', 'Body text' ),
		$rep( 'items', 'Applications', [ $t( 'title', 'Application' ) ], [ [ 'title' => 'Control Familiarisation' ], [ 'title' => 'Night & NVG Driving' ] ], 'title' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		tecknotrove_el_render_part( 'sector/applications', [], [ 'sector' => $sector_from( $v, [
			'applications_label' => $v['label'], 'applications_heading' => $v['heading'], 'applications_body' => $v['body'], 'applications' => $v['items'],
		] ) ] );
	},
];

$defs['tt_sector_technology'] = [
	'title'  => 'TT Sector Technology',
	'icon'   => 'eicon-settings',
	'fields' => [
		$col( 'accent', 'Sector colour', '#355a17' ),
		$t( 'label', 'Label', '03 / Technology' ),
		$t( 'heading', 'Heading', 'The engineering behind the realism.' ),
		$ta( 'body', 'Body text' ),
		$rep( 'bullets', 'Bullet points', [ $t( 'text', 'Text' ) ], [ [ 'text' => '6-DOF electric motion platform, <20ms latency' ] ], 'text' ),
		$im( 'image', 'Image', $img . 'sector-defence.jpg' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		tecknotrove_el_render_part( 'sector/technology', [], [ 'sector' => $sector_from( $v, [
			'technology_label' => $v['label'], 'technology_heading' => $v['heading'], 'technology_body' => $v['body'], 'technology_bullets' => $v['bullets'],
		] ) ] );
	},
];

$defs['tt_sector_trust'] = [
	'title'  => 'TT Sector Track Record',
	'icon'   => 'eicon-counter',
	'fields' => [
		$t( 'heading', 'Heading (leave empty to hide)' ),
		$ta( 'body', 'Body text' ),
		$rep( 'stats', 'Stats', [ $t( 'value', 'Value' ), $t( 'label', 'Label' ) ], [], 'label' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		tecknotrove_el_render_part( 'sector/trust', [], [ 'sector' => $sector_from( [ 'accent' => '#0033a1' ], [
			'trust_heading' => $v['heading'], 'trust_body' => $v['body'], 'trust_stats' => $v['stats'],
		] ) ] );
	},
];

$defs['tt_sector_callout'] = [
	'title'  => 'TT Sector Closing Call-to-Action',
	'icon'   => 'eicon-call-to-action',
	'fields' => [
		$t( 'heading', 'Heading', 'Ready to see it in action?' ),
		$t( 'btn1_label', 'Button 1 label', 'Get in Touch' ), $url( 'btn1_url', 'Button 1 link', home_url( '/contact/' ) ),
		$t( 'btn2_label', 'Button 2 label', 'Download Brochure' ), $url( 'btn2_url', 'Button 2 link', '#brochure' ),
		$t( 'footer_text', 'Footer line', 'Explore other industries.' ),
	],
	'render' => function ( $v ) use ( $sector_from ) {
		tecknotrove_el_render_part( 'sector/callout', [], [ 'sector' => $sector_from( [], [ 'callout' => $v ] ) ] );
	},
];

/* ============================== PRODUCT ============================== */

$defs['tt_product_page'] = [
	'title'  => 'TT Product Page (full)',
	'icon'   => 'eicon-product-info',
	'fields' => [
		[ 'section' => 'Product' ],
		[ 'id' => 'product_id', 'label' => 'Product (content is edited under Products in wp-admin)', 'type' => 'select', 'options' => $product_options, 'default' => '' ],
	],
	'render' => function ( $v ) {
		$post = $v['product_id'] ? get_post( (int) $v['product_id'] ) : get_post();
		if ( ! $post || 'product' !== $post->post_type ) { echo '<p class="py-20 text-center">Select a product.</p>'; return; }
		tecknotrove_el_render_part( 'product/body', [], [ 'product_post' => $post ] );
	},
];

/* ============================== GENERIC PAGE SECTIONS ============================== */

$defs['tt_page_hero'] = [
	'title'  => 'TT Page Hero',
	'icon'   => 'eicon-banner',
	'fields' => [
		$col( 'accent', 'Accent colour', '#0033a1' ),
		$t( 'eyebrow', 'Eyebrow' ), $t( 'title', 'Title', 'Page title' ), $ta( 'subtitle', 'Sub-title' ),
		$im( 'image', 'Background image', $img . 'why-simulator.jpg' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'page/hero', [], [ 'v' => $v ] ); },
];

$defs['tt_content_split'] = [
	'title'  => 'TT Text + Image',
	'icon'   => 'eicon-image-before-after',
	'fields' => [
		$col( 'accent', 'Accent colour', '#0033a1' ),
		$t( 'label', 'Small label' ), $t( 'heading', 'Heading', 'Heading' ),
		[ 'id' => 'body', 'label' => 'Text', 'type' => 'wysiwyg', 'default' => '<p>Write your text here.</p>' ],
		$im( 'image', 'Image' ),
		[ 'id' => 'reverse', 'label' => 'Image on the left', 'type' => 'select', 'options' => [ 'no' => 'No', 'yes' => 'Yes' ], 'default' => 'no' ],
		$rep( 'bullets', 'Bullet points', [ $t( 'text', 'Text' ) ], [], 'text' ),
		$t( 'cta_label', 'Button label' ), $url( 'cta_url', 'Button link' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'page/split', [], [ 'v' => $v ] ); },
];

$defs['tt_card_grid'] = [
	'title'  => 'TT Card Grid',
	'icon'   => 'eicon-gallery-grid',
	'fields' => [
		$col( 'accent', 'Accent colour', '#0033a1' ),
		$t( 'heading', 'Heading', 'Heading' ), $ta( 'intro', 'Intro text' ),
		[ 'id' => 'columns', 'label' => 'Columns', 'type' => 'select', 'options' => [ '2' => '2', '3' => '3', '4' => '4' ], 'default' => '3' ],
		$rep( 'cards', 'Cards', [
			$t( 'icon', 'Icon name (Phosphor, e.g. Cube)', 'Cube' ), $t( 'title', 'Title' ), $ta( 'desc', 'Description' ), $url( 'url', 'Link (optional)' ), $t( 'cta', 'Link label (optional)' ),
		], [ [ 'icon' => 'Cube', 'title' => 'Card title', 'desc' => 'Card description.' ] ], 'title' ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'page/cards', [], [ 'v' => $v ] ); },
];

$defs['tt_contact'] = [
	'title'  => 'TT Contact + Form',
	'icon'   => 'eicon-form-horizontal',
	'fields' => [
		$col( 'accent', 'Accent colour', '#0033a1' ),
		$t( 'heading', 'Heading', 'Talk to our team.' ),
		$ta( 'intro', 'Intro', 'Tell us about your training requirement and we will get back to you.' ),
		$rep( 'details', 'Contact details', [ $t( 'label', 'Label' ), $t( 'value', 'Value' ), $url( 'url', 'Link (tel:, mailto:, https:)' ) ], [
			[ 'label' => 'Address', 'value' => '505, Windfall, Sahar Plaza, Chakala, Andheri (East), Mumbai 400059', 'url' => '' ],
			[ 'label' => 'Phone', 'value' => '+91 22 6151 3002', 'url' => 'tel:+912261513002' ],
			[ 'label' => 'Website', 'value' => 'www.tecknotrove.com', 'url' => 'https://www.tecknotrove.com' ],
		], 'label' ),
		$t( 'form_heading', 'Form heading', 'Send us a message' ),
		$t( 'button', 'Button label', 'Send message' ),
		$t( 'to_email', 'Send enquiries to (email)', get_option( 'admin_email' ) ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'page/contact', [], [ 'v' => $v ] ); },
];

/* ============================== HEADER / FOOTER ============================== */

$nv = tecknotrove_navbar_defaults();
$ft = tecknotrove_footer_defaults();
$link_fields = [ $t( 'label', 'Label' ), $url( 'url', 'Link' ) ];
$defs['tt_navbar'] = [
	'title'  => 'TT Navbar (curved)',
	'icon'   => 'eicon-nav-menu',
	'fields' => [
		[ 'section' => 'Bar' ],
		$im( 'logo', 'Logo (white)', $nv['logo'] ),
		$rep( 'links', 'Centre links', $link_fields, $nv['links'], 'label' ),
		$t( 'cta_label', 'Button label', $nv['cta_label'] ), $url( 'cta_url', 'Button link', $nv['cta_url'] ),
		[ 'section' => 'Full-screen menu (links: one per line as Label | URL)' ],
	],
	'render' => function ( $v ) {
		$cols = [];
		for ( $i = 1; $i <= 4; $i++ ) {
			$sections = [];
			foreach ( [ 1, 2 ] as $n ) {
				if ( '' === trim( (string) ( $v[ "c{$i}_h{$n}" ] ?? '' ) ) ) continue;
				$sections[] = [ 'heading' => $v[ "c{$i}_h{$n}" ], 'links' => tecknotrove_parse_links( $v[ "c{$i}_l{$n}" ] ?? '' ) ];
			}
			$col = [ 'label' => $v[ "c{$i}_label" ], 'sections' => $sections ];
			if ( 4 === $i ) {
				$col['card'] = [ 'label' => $v['card_label'], 'lines' => array_values( array_filter( array_map( 'trim', preg_split( '/
?
/', (string) $v['card_lines'] ) ) ) ) ];
			}
			$cols[] = $col;
		}
		$args = [
			'logo' => $v['logo'] ?: tecknotrove_navbar_defaults()['logo'], 'links' => $v['links'],
			'cta_label' => $v['cta_label'], 'cta_url' => $v['cta_url'],
			'menu_columns' => $cols,
		];
		tecknotrove_el_render_part( 'layout/navbar', [], [ 'args' => $args ] );
	},
];

/* menu column fields (generated: 4 columns x label + 2 sections, plus the contact card) */
$dl = function ( $links ) { return implode( "
", array_map( fn( $l ) => $l['label'] . ' | ' . $l['url'], $links ) ); };
foreach ( $nv['menu_columns'] as $i => $col ) {
	$n = $i + 1;
	$defs['tt_navbar']['fields'][] = $t( "c{$n}_label", "Column {$n}: label", $col['label'] );
	foreach ( [ 0, 1 ] as $k ) {
		$sec = $col['sections'][ $k ] ?? [ 'heading' => '', 'links' => [] ];
		$defs['tt_navbar']['fields'][] = $t( "c{$n}_h" . ( $k + 1 ), "Column {$n}: heading " . ( $k + 1 ), $sec['heading'] );
		$defs['tt_navbar']['fields'][] = $ta( "c{$n}_l" . ( $k + 1 ), "Column {$n}: links " . ( $k + 1 ), $dl( $sec['links'] ) );
	}
}
$defs['tt_navbar']['fields'][] = $t( 'card_label', 'Contact card: label', $nv['menu_columns'][3]['card']['label'] );
$defs['tt_navbar']['fields'][] = $ta( 'card_lines', 'Contact card: lines (one per line)', implode( "
", $nv['menu_columns'][3]['card']['lines'] ) );

$defs['tt_footer'] = [
	'title'  => 'TT Footer',
	'icon'   => 'eicon-footer',
	'fields' => [
		$t( 'wordmark', 'Big wordmark', $ft['wordmark'] ),
		$t( 'copyright', 'Copyright text', $ft['copyright'] ),
		$rep( 'explore', 'Explore links', $link_fields, $ft['explore'], 'label' ),
		$rep( 'follow', 'Follow links', $link_fields, $ft['follow'], 'label' ),
		$t( 'tagline', 'Bottom line', $ft['tagline'] ),
	],
	'render' => function ( $v ) { tecknotrove_el_render_part( 'layout/footer', [], [ 'args' => $v ] ); },
];

return $defs;
