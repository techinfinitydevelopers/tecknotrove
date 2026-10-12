<?php
/**
 * Creates the Elementor-built pages, header and footer.
 * Run (after tools/seed.php): wp eval-file wp-content/themes/tecknotrove/tools/seed-elementor.php
 * Safe to re-run: pages are matched by slug and their Elementor data is rewritten.
 */
if ( ! class_exists( '\Elementor\Plugin' ) ) { echo "Elementor is not active.\n"; return; }

$img  = get_template_directory_uri() . '/assets/images/';
$data = json_decode( file_get_contents( __DIR__ . '/seed-data.json' ), true );

update_option( 'elementor_cpt_support', [ 'post', 'page', 'product', 'sector', 'tt_layout' ] );
update_option( 'elementor_disable_color_schemes', 'yes' );
update_option( 'elementor_disable_typography_schemes', 'yes' );

function tt_id() { return substr( md5( uniqid( '', true ) ), 0, 7 ); }
function tt_rows( $rows ) { return array_map( fn( $r ) => array_merge( [ '_id' => tt_id() ], $r ), $rows ); }
function tt_img( $url ) { return [ 'url' => $url, 'id' => '', 'size' => '', 'alt' => '', 'source' => 'library' ]; }
function tt_link( $url ) { return [ 'url' => $url, 'is_external' => '', 'nofollow' => '', 'custom_attributes' => '' ]; }
function tt_widget( $type, $settings = [] ) {
	return [ 'id' => tt_id(), 'elType' => 'widget', 'widgetType' => $type, 'settings' => $settings, 'elements' => [] ];
}
/** A full-width, zero-padding container holding one widget. */
function tt_section( $type, $settings = [] ) {
	$z = [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ];
	return [
		'id' => tt_id(), 'elType' => 'container', 'isInner' => false,
		'settings' => [ 'content_width' => 'full', 'flex_direction' => 'column', 'padding' => $z, 'margin' => $z, 'flex_gap' => [ 'unit' => 'px', 'size' => 0, 'column' => '0', 'row' => '0', 'isLinked' => true ] ],
		'elements' => [ tt_widget( $type, $settings ) ],
	];
}

function tt_upsert_post( $type, $slug, $title, $meta = [] ) {
	$ex   = get_posts( [ 'post_type' => $type, 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'any' ] );
	$args = [ 'post_type' => $type, 'post_name' => $slug, 'post_title' => $title, 'post_status' => 'publish' ];
	if ( 'page' === $type || 'tt_layout' === $type ) $args['post_content'] = '';
	if ( $ex ) { $args['ID'] = $ex[0]->ID; $id = wp_update_post( $args ); } else { $id = wp_insert_post( $args ); }
	foreach ( $meta as $k => $v ) update_post_meta( $id, $k, $v );
	return $id;
}

function tt_set_elementor( $id, $sections, $template = 'wp-page' ) {
	update_post_meta( $id, '_elementor_edit_mode', 'builder' );
	update_post_meta( $id, '_elementor_template_type', $template );
	update_post_meta( $id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '3.0.0' );
	update_post_meta( $id, '_elementor_data', wp_slash( wp_json_encode( $sections ) ) );
	delete_post_meta( $id, '_elementor_css' );
}

/* ---------- header + footer ---------- */
$h = tt_upsert_post( 'tt_layout', 'site-header', 'Site Header', [ '_tt_layout_type' => 'header' ] );
tt_set_elementor( $h, [ tt_section( 'tt_navbar' ) ], 'wp-post' );
$f = tt_upsert_post( 'tt_layout', 'site-footer', 'Site Footer', [ '_tt_layout_type' => 'footer' ] );
tt_set_elementor( $f, [ tt_section( 'tt_footer' ) ], 'wp-post' );
echo "layouts header #$h footer #$f\n";

/* ---------- home ---------- */
$home = tt_upsert_post( 'page', 'home', 'Home' );
tt_set_elementor( $home, [
	tt_section( 'tt_hero' ), tt_section( 'tt_sector_grid' ), tt_section( 'tt_why' ), tt_section( 'tt_news' ),
	tt_section( 'tt_partners' ), tt_section( 'tt_linkedin' ), tt_section( 'tt_callout' ),
] );
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
echo "home #$home\n";

/* ---------- home, carousel variant (same page, sector fan swapped for the Framer carousel) ---------- */
$home2 = tt_upsert_post( 'page', 'home-carousel', 'Home (Carousel)' );
tt_set_elementor( $home2, [
	tt_section( 'tt_hero' ), tt_section( 'tt_framer_carousel' ), tt_section( 'tt_why' ), tt_section( 'tt_news' ),
	tt_section( 'tt_partners' ), tt_section( 'tt_linkedin' ), tt_section( 'tt_callout' ),
] );
echo "home-carousel #$home2
";

/* ---------- sector pages ---------- */
foreach ( $data['sectors'] as $s ) {
	$accent = $s['accent'];
	$sections = [
		tt_section( 'tt_sector_hero', [ 'accent' => $accent, 'eyebrow' => $s['eyebrow'], 'h1' => $s['h1'], 'subhead' => $s['subhead'], 'image' => tt_img( $img . 'sector-' . $s['key'] . '.jpg' ) ] ),
		tt_section( 'tt_sector_stats', [ 'accent' => $accent, 'stats' => tt_rows( $s['stats'] ) ] ),
		tt_section( 'tt_sector_benefits', [ 'accent' => $accent, 'benefits' => tt_rows( $s['benefits'] ) ] ),
		tt_section( 'tt_sector_products', [ 'accent' => $accent, 'sector_id' => '' ] ),
		tt_section( 'tt_sector_applications', [
			'accent' => $accent, 'label' => $s['applicationsLabel'], 'heading' => $s['applicationsHeading'], 'body' => $s['applicationsBody'],
			'items' => tt_rows( array_map( fn( $a ) => [ 'title' => $a ], $s['applications'] ) ),
		] ),
		tt_section( 'tt_sector_technology', [
			'accent' => $accent, 'label' => $s['technologyLabel'], 'heading' => $s['technologyHeading'], 'body' => $s['technologyBody'],
			'bullets' => tt_rows( array_map( fn( $b ) => [ 'text' => $b ], $s['technologyBullets'] ) ), 'image' => tt_img( $img . 'sector-' . $s['key'] . '.jpg' ),
		] ),
	];
	if ( ! empty( $s['trust'] ) ) {
		$sections[] = tt_section( 'tt_sector_trust', [ 'heading' => $s['trust']['heading'], 'body' => $s['trust']['body'], 'stats' => tt_rows( $s['trust']['stats'] ) ] );
	}
	$sections[] = tt_section( 'tt_news' );
	$sections[] = tt_section( 'tt_linkedin' );
	$sections[] = tt_section( 'tt_sector_callout' );
	$pid = tt_upsert_post( 'page', $s['key'], $s['name'] );
	tt_set_elementor( $pid, $sections );
	echo "sector page {$s['key']} #$pid\n";
}

/* ---------- product page ---------- */
foreach ( $data['products'] as $p ) {
	$prod = get_posts( [ 'post_type' => 'product', 'name' => $p['slug'], 'posts_per_page' => 1, 'post_status' => 'any' ] );
	if ( $prod ) {
		tt_set_elementor( $prod[0]->ID, [ tt_section( 'tt_product_page', [ 'product_id' => '' ] ) ], 'wp-post' );
		echo "product {$p['slug']} #{$prod[0]->ID}\n";
	}
}

/* ---------- about / careers / news / contact ---------- */
$about = tt_upsert_post( 'page', 'about', 'About' );
tt_set_elementor( $about, [
	tt_section( 'tt_page_hero', [ 'eyebrow' => 'About Tecknotrove', 'title' => 'Simulation and training technology, built in-house since 2002.', 'subtitle' => 'From our Mumbai headquarters we design the motion platforms, visuals, controls and instructor software that make up every Tecknotrove simulator.', 'image' => tt_img( $img . 'why-simulator.jpg' ), 'accent' => '#0033a1' ] ),
	tt_section( 'tt_content_split', [
		'label' => 'Who we are', 'heading' => 'One company. Every subsystem.',
		'body' => '<p>Tecknotrove designs and builds full-motion simulators for defence, aviation, automobile and industrial operators. Because every subsystem is engineered in-house, each simulator ships as one integrated system instead of a stack of third-party vendors.</p><p>Our simulators are in service with customers across 35+ countries, and our team provides technical support 24×7.</p>',
		'image' => tt_img( $img . 'news-motion.jpg' ), 'reverse' => 'no', 'accent' => '#0033a1',
		'bullets' => tt_rows( [ [ 'text' => 'ISO 9001:2015 certified' ], [ 'text' => '1,500+ simulators delivered' ], [ 'text' => 'Headquartered in Mumbai, India' ] ] ),
	] ),
	tt_section( 'tt_card_grid', [
		'heading' => 'Where we work', 'intro' => 'Four sectors, one engineering team.', 'columns' => '4', 'accent' => '#0033a1',
		'cards' => tt_rows( [
			[ 'icon' => 'ShieldChevron', 'title' => 'Defence', 'desc' => 'Simulators built for the demands of armed forces.', 'url' => tt_link( home_url( '/defence/' ) ), 'cta' => 'Explore' ],
			[ 'icon' => 'AirplaneTilt', 'title' => 'Aviation', 'desc' => 'Flight and ground-support simulation to the standard of flight.', 'url' => tt_link( home_url( '/aviation/' ) ), 'cta' => 'Explore' ],
			[ 'icon' => 'SteeringWheel', 'title' => 'Automobile', 'desc' => 'Driver training for fleets that cannot afford mistakes.', 'url' => tt_link( home_url( '/automobile/' ) ), 'cta' => 'Explore' ],
			[ 'icon' => 'Factory', 'title' => 'OESD', 'desc' => 'Operator training for high-consequence industrial environments.', 'url' => tt_link( home_url( '/oesd/' ) ), 'cta' => 'Explore' ],
		] ),
	] ),
	tt_section( 'tt_sector_callout' ),
] );

$careers = tt_upsert_post( 'page', 'careers', 'Careers' );
tt_set_elementor( $careers, [
	tt_section( 'tt_page_hero', [ 'eyebrow' => 'Careers', 'title' => 'Join our team.', 'subtitle' => 'Work on full-motion simulation systems, from motion platforms to visuals.', 'image' => tt_img( $img . 'news-army.jpg' ), 'accent' => '#d84300' ] ),
	tt_section( 'tt_card_grid', [
		'heading' => 'What you could work on', 'intro' => 'Every subsystem of a Tecknotrove simulator is built by our own engineers.', 'columns' => '3', 'accent' => '#d84300',
		'cards' => tt_rows( [
			[ 'icon' => 'Gauge', 'title' => 'Motion platforms', 'desc' => '6-DOF electric motion systems with sub-20ms latency.' ],
			[ 'icon' => 'Eye', 'title' => 'Visuals', 'desc' => 'Wide field-of-view, high frame-rate rendering for day, dusk, night and NVG.' ],
			[ 'icon' => 'ChartBar', 'title' => 'Instructor software', 'desc' => 'Scoring, session recording and replay for training management.' ],
		] ),
	] ),
	tt_section( 'tt_contact', [ 'heading' => 'Apply or ask about roles', 'intro' => 'Send us a note with your area of interest and your CV link. We will get back to you.', 'accent' => '#d84300', 'form_heading' => 'Tell us about yourself', 'button' => 'Send application' ] ),
] );

$news = tt_upsert_post( 'page', 'news', 'News' );
tt_set_elementor( $news, [
	tt_section( 'tt_page_hero', [ 'eyebrow' => 'Media', 'title' => 'News & insights.', 'subtitle' => 'Deliveries, exhibitions and thinking from the Tecknotrove team.', 'image' => tt_img( $img . 'news-expo.jpg' ), 'accent' => '#0033a1' ] ),
	tt_section( 'tt_news' ),
	tt_section( 'tt_linkedin' ),
] );

$contact = tt_upsert_post( 'page', 'contact', 'Contact' );
tt_set_elementor( $contact, [
	tt_section( 'tt_page_hero', [ 'eyebrow' => 'Contact', 'title' => 'Let us talk about your training requirement.', 'subtitle' => 'Visit our Mumbai facility for a live demonstration, or request a virtual walkthrough.', 'image' => tt_img( $img . 'sector-defence.jpg' ), 'accent' => '#0033a1' ] ),
	tt_section( 'tt_contact' ),
] );
echo "about #$about careers #$careers news #$news contact #$contact\n";

flush_rewrite_rules();
\Elementor\Plugin::$instance->files_manager->clear_cache();
echo "done\n";
