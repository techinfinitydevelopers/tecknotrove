<?php
/**
 * Aviation hub structure from the client doc "Aviation Hub Menu Layout".
 * Run: php -r 'require "C:/xampp/htdocs/tecknotrove/wp-load.php"; require ".../tools/seed-aviation.php";'
 * Safe to re-run (posts matched by slug, Elementor data rewritten).
 * Cargo Loader copy comes from the Cargo High Loader brochure. All other product/hub copy is DRAFT
 * written from the doc structure, to be replaced with client copy.
 */
if ( ! class_exists( '\Elementor\Plugin' ) ) { echo "Elementor is not active.\n"; return; }

$img = get_template_directory_uri() . '/assets/images/';
$av  = $img . 'aviation/';

if ( ! function_exists( 'tt_id' ) ) {
	function tt_id() { return substr( md5( uniqid( '', true ) ), 0, 7 ); }
	function tt_rows( $rows ) { return array_map( fn( $r ) => array_merge( [ '_id' => tt_id() ], $r ), $rows ); }
	function tt_img( $url ) { return [ 'url' => $url, 'id' => '', 'size' => '', 'alt' => '', 'source' => 'library' ]; }
	function tt_link( $url ) { return [ 'url' => $url, 'is_external' => '', 'nofollow' => '', 'custom_attributes' => '' ]; }
	function tt_widget( $type, $settings = [] ) { return [ 'id' => tt_id(), 'elType' => 'widget', 'widgetType' => $type, 'settings' => $settings, 'elements' => [] ]; }
	function tt_section( $type, $settings = [] ) {
		$z = [ 'unit' => 'px', 'top' => '0', 'right' => '0', 'bottom' => '0', 'left' => '0', 'isLinked' => true ];
		return [
			'id' => tt_id(), 'elType' => 'container', 'isInner' => false,
			'settings' => [ 'content_width' => 'full', 'flex_direction' => 'column', 'padding' => $z, 'margin' => $z, 'flex_gap' => [ 'unit' => 'px', 'size' => 0, 'column' => '0', 'row' => '0', 'isLinked' => true ] ],
			'elements' => [ tt_widget( $type, $settings ) ],
		];
	}
	function tt_upsert_post( $type, $slug, $title, $meta = [], $extra = [] ) {
		$ex   = get_posts( [ 'post_type' => $type, 'name' => $slug, 'posts_per_page' => 1, 'post_status' => 'any' ] );
		$args = array_merge( [ 'post_type' => $type, 'post_name' => $slug, 'post_title' => $title, 'post_status' => 'publish' ], $extra );
		if ( 'page' === $type ) $args['post_content'] = '';
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
}

$A     = '#0091d1';
$home  = home_url( '/aviation/' );
$hub_u = fn( $s ) => home_url( "/aviation/$s/" );
$pr_u  = fn( $s ) => home_url( "/products/$s/" );
$crumb = fn( $rows ) => tt_rows( array_map( fn( $r ) => [ 'label' => $r[0], 'url' => tt_link( $r[1] ?? '' ) ], $rows ) );
$tiles = fn( $rows ) => tt_rows( array_map( fn( $r ) => [ 'icon' => $r[0], 'title' => $r[1], 'desc' => $r[2] ?? '', 'url' => tt_link( $r[3] ?? '' ) ], $rows ) );
$faqs  = fn( $rows ) => tt_rows( array_map( fn( $r ) => [ 'q' => $r[0], 'a' => $r[1] ], $rows ) );
$subnav = fn() => tt_section( 'tt_av_subnav', [ 'accent' => $A, 'label' => 'Tecknotrove Aviation', 'home_url' => tt_link( $home ), 'cta_label' => 'Enquire Now', 'cta_url' => tt_link( home_url( '/contact/' ) ) ] );
$cta = fn( $h, $b, $c1 = 'Enquire Now', $c2 = 'Download Brochure' ) => tt_section( 'tt_av_cta', [ 'heading' => $h, 'body' => $b, 'cta1_label' => $c1, 'cta1_url' => tt_link( home_url( '/contact/' ) ), 'cta2_label' => $c2, 'cta2_url' => tt_link( '#brochure' ) ] );
$hero = fn( $crumbs, $h1, $intro, $image, $c1, $c2 = '' ) => tt_section( 'tt_av_hero', [
	'accent' => $A, 'crumbs' => $crumbs, 'h1' => $h1, 'intro' => $intro, 'image' => tt_img( $image ),
	'cta1_label' => $c1, 'cta1_url' => tt_link( home_url( '/contact/' ) ), 'cta2_label' => $c2, 'cta2_url' => tt_link( '#brochure' ),
] );

/* ------------------------------------------------------------------ hubs */
$hubs = [
	'gse-simulators' => [
		'title' => 'GSE Simulators', 'order' => 1,
		'h1' => 'Ground Support Equipment (GSE) Simulators',
		'intro' => 'Operator training simulators for the ground support equipment that turns an aircraft around: pushback tugs, cargo loaders, baggage tractors and catering trucks. Used by airports, ground handlers and airlines to train and certify operators without risking aircraft or equipment.',
		'products' => [ 'aircraft-pushback-simulator', 'cargo-loader-simulator', 'baggage-tractor-simulator', 'catering-truck-simulator' ],
		'who' => 'Airports & Ground Handlers',
		'why' => [
			[ 'ShieldCheck', 'Protect aircraft and people', 'Apron incidents with GSE damage aircraft and injure staff. Operators practise hazardous manoeuvres in simulation instead.' ],
			[ 'Gauge', 'Faster operator readiness', 'New operators build control skills and airside procedures before they touch real equipment.' ],
			[ 'Coins', 'Lower training cost', 'Less equipment downtime, less fuel and fewer damage claims during training.' ],
			[ 'ChartBar', 'Measurable, repeatable assessment', 'Every session is scored and recorded, so competence is evidenced and comparable across operators.' ],
			[ 'UsersThree', 'Team turnaround training', 'Wing walkers, ramp managers and operators train together to shorten and de-risk turnarounds.' ],
		],
		'faq' => [
			[ 'Which GSE types does Tecknotrove simulate?', 'Aircraft pushback tugs, cargo high loaders, baggage tractors and catering trucks, each with an operator station matched to the real equipment.' ],
			[ 'Can the simulator match our own equipment and airport?', 'Yes. The simulators are compatible with a variety of equipment models, and airside terrain can be built geo-specific to your airport.' ],
			[ 'What drives the price of a GSE simulator?', 'Cab replica level, number of displays, custom airside terrain, number of operator stations, TMS licences and installation or on-site training.' ],
			[ 'Is there an instructor station?', 'Yes. The TechnoSIM instructor station sets up scenarios, injects faults, monitors sessions and generates reports.' ],
			[ 'Can several operators train together?', 'Team Play lets multiple airside roles train in the same environment, including wing walkers, ATC and ramp managers.' ],
		],
	],
	'airside-driving-simulators' => [
		'title' => 'Airside Driving Simulators', 'order' => 2,
		'h1' => 'Airside Driving Simulators',
		'intro' => 'Driver training for the airport apron, taxiways and service roads. Covers airport driving, ramp safety, passenger bus operation and ARFF response driving, on realistic airside environments built to international airside standards.',
		'products' => [ 'passenger-bus-simulator', 'arff-simulator' ],
		'who' => 'Airports & Ground Handlers',
		'why' => [
			[ 'ShieldCheck', 'Ramp safety first', 'Drivers learn airside markings, signage, right-of-way and aircraft proximity rules before driving on the apron.' ],
			[ 'Eye', 'Realistic airside environment', 'Terminal buildings, aprons, taxiways, runways and AI traffic of aircraft and vehicles make training real.' ],
			[ 'Gauge', 'Emergency response readiness', 'Response drivers rehearse time-critical routes and hazards repeatedly, safely.' ],
			[ 'ChartBar', 'Evidence of competence', 'Automated scoring and reports support airside driving permits and refresher cycles.' ],
		],
		'faq' => [
			[ 'Does this replace airside driving permit training?', 'It complements it. Drivers get repeatable practice and assessment in simulation before and alongside on-airport training.' ],
			[ 'Can the airside match our airport?', 'Yes. Generic and geo-specific airside environments are available.' ],
			[ 'Which vehicles are covered?', 'Passenger buses and ARFF vehicles today, with airport driving and ramp safety training folded into these simulators.' ],
			[ 'What affects cost?', 'Cab replica level, displays, custom airport terrain, number of stations, TMS licences and installation.' ],
		],
	],
	'aircraft-maintenance-training' => [
		'title' => 'Aircraft Maintenance Training Solutions', 'order' => 3,
		'h1' => 'Aircraft Maintenance Training Solutions',
		'intro' => 'Training solutions for line maintenance and MRO technicians: procedural, task-based practice on aircraft systems without taking an aircraft out of service.',
		'products' => [ 'line-maintenance-training', 'mro-training' ],
		'who' => 'MROs & Airlines',
		'why' => [
			[ 'Coins', 'No aircraft out of service', 'Technicians practise tasks on a trainer instead of a revenue aircraft.' ],
			[ 'ShieldCheck', 'Procedure-first training', 'Task cards and sequences are rehearsed until they are right the first time.' ],
			[ 'ChartBar', 'Tracked competence', 'Scores and session records show where each technician needs more practice.' ],
			[ 'Gauge', 'Faster onboarding', 'New technicians reach productive speed sooner.' ],
		],
		'faq' => [
			[ 'What is the difference between Line Maintenance and MRO training?', 'Line maintenance covers turnaround and daily checks on the line; MRO covers deeper scheduled and heavy maintenance tasks.' ],
			[ 'Which aircraft types are covered?', 'Content is configured per customer requirement. Contact us with your fleet.' ],
			[ 'Does it integrate with our training records?', 'Sessions run through the Tecknotrove TMS, which records and reports training progress.' ],
			[ 'What drives cost?', 'Aircraft type and systems covered, hardware fidelity, number of stations and TMS licences.' ],
		],
	],
	'supported-technologies' => [
		'title' => 'Supported Technologies & Services', 'order' => 4,
		'h1' => 'Supported Technologies & Services',
		'intro' => 'The shared technology behind every Tecknotrove aviation simulator, available across all products and hubs.',
		'products' => [],
		'who' => 'Airports & Ground Handlers',
		'tech' => true,
		'why' => [], 'faq' => [],
	],
];

/* -------------------------------------------------------------- products */
$common_faq = fn( $n, $extra = [] ) => array_merge( [
	[ "How much does a $n cost?", 'Price depends on the configuration. The main cost drivers are cab replica level, number and size of displays, custom or geo-specific airside terrain, number of operator stations, TMS and Team Play licences, and installation and on-site training. Request a quote with your requirements for exact pricing.' ],
	[ 'Can the airside environment be customised to our airport?', 'Yes. Simulators ship with a generic airside, or a geo-specific airside built to your training needs.' ],
	[ 'What does the instructor station do?', 'The TechnoSIM instructor station sets up scenarios, monitors progress, injects faults and generates reports for trainee feedback.' ],
	[ "Does the $n work with real equipment models?", 'The simulator design is based on the actual equipment and is compatible with a variety of models.' ],
	[ 'How is operator performance assessed?', 'The Performance Analysis System produces graphical session reports of major and minor offences, so instructors can target skill and safety gaps.' ],
	[ 'What support is available after installation?', 'Phone, remote and emergency support, scheduled on-site service and spare part support through Tecknotrove’s network of technicians.' ],
], $extra );

$features = function ( $name, $operator, $display ) use ( $av ) {
	return [
		[ 'title' => 'Instructor Station & Software', 'icon' => 'Monitor', 'body' => 'The TechnoSIM instructor station lets the instructor set up scenarios, monitor progress and generate trainee feedback reports.', 'bullets' => "Trainee registration\nEquipment selection\nReal-time weather selection\nTraining and route selection\nReal-time fault injection\nRecord and replay", 'image' => $av . 'instructor-module.jpg' ],
		[ 'title' => 'Operator Station', 'icon' => 'Cube', 'body' => $operator, 'bullets' => "Controls laid out as on the real equipment\nCompatible with a variety of equipment models\nRealistic operation and dynamics", 'image' => $av . 'cargo-station.jpg' ],
		[ 'title' => 'Testing & Evaluation', 'icon' => 'ChartBar', 'body' => 'The Performance Analysis System gives a detailed, consistent and scientific report on every session.', 'bullets' => "Graphical session reports\nMajor and minor offences highlighted\nOperator testing and certification", 'image' => $av . 'training-module.jpg' ],
		[ 'title' => 'Group Training', 'icon' => 'UsersThree', 'body' => 'Tecknotrove Team Play lets multiple airside operators train together in the same environment.', 'bullets' => "Wing walkers, break rider, ATC, headset man, ramp manager\nCollective training minimises errors and incidents\nImproves aircraft turnaround time", 'image' => $av . 'teamplay.jpg' ],
		[ 'title' => 'TMS', 'icon' => 'ChartLineUp', 'body' => 'Tecknotrove Training Management System® is a cloud-based system to assign, schedule, monitor, review and update training programmes remotely and systematically.', 'bullets' => "Cloud-based, remote access\nDefine training needs and deliver expected results\nLowest possible cost" ],
		[ 'title' => 'Display & Motion', 'icon' => 'Eye', 'body' => $display, 'bullets' => "Seamless immersive view of up to 180°\nCustom airside terrain, generic or geo-specific\nAI traffic of aircraft, vehicles and equipment", 'image' => $av . 'cargo-sim-view.jpg' ],
	];
};

$products = [
	'cargo-loader-simulator' => [
		'title' => 'Cargo Loader Simulator', 'hub' => 'gse-simulators', 'order' => 2, 'code' => 'CHL',
		'h1' => 'Cargo Loader Simulator',
		'intro' => 'An advanced training tool to train and evaluate operators on safe cargo loading operations. The design is based on the actual high loader and replicates the dynamics and operations of the equipment, compatible with a variety of cargo loader models. Designed and manufactured by Tecknotrove.',
		'image' => $av . 'cargo-hero.jpg',
		'modules' => [
			[ 'Wrench', 'Equipment Familiarisation', 'Pre-check and walk-around, controls and operation.' ],
			[ 'MapTrifold', 'Airside Familiarisation', 'Training on a realistic airside, generic or geo-specific.' ],
			[ 'ChartBar', 'Performance Evaluation', 'Scientific scoring of every session.' ],
			[ 'SealCheck', 'Operator Testing & Certification', 'Assess and certify operators against set standards.' ],
			[ 'Cube', 'Loading & Unloading', 'Pallets and containers, main deck and lower deck, different door types.' ],
			[ 'Lightning', 'Night & Adverse Weather', 'Operating at night and in difficult weather conditions.' ],
		],
		'features' => $features( 'Cargo Loader', 'A cab-style operator station with steering, instrument and control panel and pedals, replicating the dynamics and operations of the actual high loader.', 'A seamless three-screen display gives an immersive training view of up to 180° over a custom airside terrain with international-standard markings, signage and lighting.' ),
		'gallery' => [ [ 'cargo-hero.jpg', 'Cargo High Loader at the aircraft' ], [ 'cargo-gallery-1.jpg', 'Operator at the simulator' ], [ 'cargo-gallery-2.jpg', 'Operator station' ], [ 'cargo-gallery-3.jpg', 'Three-screen display' ], [ 'terrain-1.jpg', 'Custom airside: runway' ], [ 'terrain-2.jpg', 'Custom airside: aircraft stand' ], [ 'terrain-3.jpg', 'Custom airside: terminal' ], [ 'terrain-4.jpg', 'Custom airside: apron' ] ],
		'faq' => $common_faq( 'Cargo Loader Simulator', [
			[ 'Which loading tasks can operators practise?', 'Loading and unloading pallets and containers on main and lower deck, different door types, night and difficult-weather operation, parking and shutdown, and team training for quick turnarounds.' ],
		] ),
	],
	'aircraft-pushback-simulator' => [
		'title' => 'Aircraft Pushback Simulator', 'hub' => 'gse-simulators', 'order' => 1, 'code' => 'APS',
		'h1' => 'Aircraft Pushback Simulator',
		'intro' => 'Trains tug operators and ground crew for safe aircraft pushback and towing, with realistic apron layouts, aircraft behaviour and wing-walker coordination. Designed and manufactured by Tecknotrove. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Wrench', 'Equipment Familiarisation', 'Pre-check and control familiarisation.' ],
			[ 'MapTrifold', 'Apron & Stand Layouts', 'Pushback on realistic stands and taxiways.' ],
			[ 'UsersThree', 'Crew Coordination', 'Headset and wing-walker communication.' ],
			[ 'Lightning', 'Night & Adverse Weather', 'Pushback in reduced visibility and weather.' ],
		],
		'features' => $features( 'Pushback', 'An operator station replicating the pushback tug controls and driving dynamics.', 'A wide immersive display shows the apron, aircraft and surrounding traffic.' ),
		'gallery' => [ [ 'cargo-hero.jpg', 'Airside operations' ], [ 'terrain-2.jpg', 'Aircraft stand' ], [ 'terrain-4.jpg', 'Apron' ], [ 'terrain-1.jpg', 'Runway' ] ],
		'faq' => $common_faq( 'Aircraft Pushback Simulator' ),
	],
	'baggage-tractor-simulator' => [
		'title' => 'Baggage Tractor Simulator', 'hub' => 'gse-simulators', 'order' => 3, 'code' => 'BTS',
		'h1' => 'Baggage Tractor Simulator',
		'intro' => 'Trains baggage tractor drivers on airside routes, trailer handling and apron rules. Designed and manufactured by Tecknotrove. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Wrench', 'Equipment Familiarisation', 'Controls, pre-checks and handling.' ],
			[ 'MapTrifold', 'Airside Routes', 'Service roads, stands and crossings.' ],
			[ 'Cube', 'Trailer Handling', 'Coupling, reversing and manoeuvring trailers.' ],
			[ 'ShieldCheck', 'Ramp Safety', 'Right-of-way, speed limits and aircraft proximity.' ],
		],
		'features' => $features( 'Baggage Tractor', 'An operator station replicating the baggage tractor controls.', 'An immersive display of the airside environment.' ),
		'gallery' => [ [ 'terrain-3.jpg', 'Terminal airside' ], [ 'terrain-4.jpg', 'Apron' ], [ 'terrain-2.jpg', 'Aircraft stand' ], [ 'cargo-sim-view.jpg', 'Simulator view' ] ],
		'faq' => $common_faq( 'Baggage Tractor Simulator' ),
	],
	'catering-truck-simulator' => [
		'title' => 'Catering Truck Simulator', 'hub' => 'gse-simulators', 'order' => 4, 'code' => 'CTS',
		'h1' => 'Catering Truck Simulator',
		'intro' => 'Trains catering truck operators on approach, docking and platform operation at the aircraft door. Designed and manufactured by Tecknotrove. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Wrench', 'Equipment Familiarisation', 'Controls and pre-checks.' ],
			[ 'MapTrifold', 'Approach & Docking', 'Precise docking at different door types.' ],
			[ 'Cube', 'Platform Operation', 'Raising, lowering and positioning the platform.' ],
			[ 'ShieldCheck', 'Ramp Safety', 'Safe working around aircraft and crew.' ],
		],
		'features' => $features( 'Catering Truck', 'An operator station replicating the catering truck controls.', 'An immersive display of the airside environment.' ),
		'gallery' => [ [ 'terrain-2.jpg', 'Aircraft stand' ], [ 'terrain-4.jpg', 'Apron' ], [ 'terrain-3.jpg', 'Terminal airside' ], [ 'cargo-gallery-3.jpg', 'Display' ] ],
		'faq' => $common_faq( 'Catering Truck Simulator' ),
	],
	'passenger-bus-simulator' => [
		'title' => 'Passenger Bus Simulator', 'hub' => 'airside-driving-simulators', 'order' => 1, 'code' => 'PBS',
		'h1' => 'Passenger Bus Simulator',
		'intro' => 'Trains airside passenger bus drivers on apron driving rules, passenger safety and stand operations. Designed and manufactured by Tecknotrove. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Wrench', 'Vehicle Familiarisation', 'Controls, pre-checks and handling.' ],
			[ 'MapTrifold', 'Airside Routes', 'Terminal, stand and apron routes.' ],
			[ 'ShieldCheck', 'Passenger Safety', 'Smooth driving and safe boarding procedures.' ],
			[ 'Lightning', 'Night & Adverse Weather', 'Driving in reduced visibility and weather.' ],
		],
		'features' => $features( 'Passenger Bus', 'A driver station replicating the airside passenger bus controls.', 'An immersive display of the airside environment.' ),
		'gallery' => [ [ 'terrain-3.jpg', 'Terminal airside' ], [ 'terrain-4.jpg', 'Apron' ], [ 'terrain-1.jpg', 'Runway' ], [ 'cargo-gallery-3.jpg', 'Display' ] ],
		'faq' => $common_faq( 'Passenger Bus Simulator' ),
	],
	'arff-simulator' => [
		'title' => 'ARFF Simulator', 'hub' => 'airside-driving-simulators', 'order' => 2, 'code' => 'ARFF',
		'h1' => 'ARFF Simulator',
		'intro' => 'Trains Aircraft Rescue and Fire Fighting drivers and crews to respond quickly and safely across the airfield. Designed and manufactured by Tecknotrove. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Wrench', 'Vehicle Familiarisation', 'Controls and handling of the response vehicle.' ],
			[ 'Lightning', 'Emergency Response Driving', 'Time-critical routes across the airfield.' ],
			[ 'UsersThree', 'Crew Coordination', 'Command and crew communication.' ],
			[ 'ShieldCheck', 'Hazard Scenarios', 'Incident scenarios at stands, taxiways and runways.' ],
		],
		'features' => $features( 'ARFF', 'A driver station replicating the ARFF vehicle controls.', 'An immersive display of the airfield and incident scenarios.' ),
		'gallery' => [ [ 'terrain-1.jpg', 'Runway' ], [ 'terrain-4.jpg', 'Apron' ], [ 'terrain-2.jpg', 'Aircraft stand' ], [ 'cargo-sim-view.jpg', 'Simulator view' ] ],
		'faq' => $common_faq( 'ARFF Simulator' ),
	],
	'line-maintenance-training' => [
		'title' => 'Line Maintenance', 'hub' => 'aircraft-maintenance-training', 'order' => 1, 'code' => 'LM',
		'h1' => 'Line Maintenance Training Solution',
		'intro' => 'Task-based training for line maintenance technicians: walk-arounds, servicing and turnaround checks practised without an aircraft out of service. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Eye', 'Walk-around Inspection', 'Systematic inspection routines.' ],
			[ 'Wrench', 'Servicing Tasks', 'Routine servicing procedures.' ],
			[ 'SealCheck', 'Turnaround Checks', 'Checks and sign-offs between flights.' ],
			[ 'ChartBar', 'Assessment', 'Scored task completion.' ],
		],
		'features' => $features( 'Line Maintenance', 'A task station configured to the aircraft type.', 'A visual presentation of the aircraft and task steps.' ),
		'gallery' => [ [ 'cargo-hero.jpg', 'Airside operations' ], [ 'terrain-2.jpg', 'Aircraft stand' ], [ 'terrain-4.jpg', 'Apron' ], [ 'training-module.jpg', 'Training module' ] ],
		'faq' => $common_faq( 'Line Maintenance training solution' ),
	],
	'mro-training' => [
		'title' => 'MRO', 'hub' => 'aircraft-maintenance-training', 'order' => 2, 'code' => 'MRO',
		'h1' => 'MRO Training Solution',
		'intro' => 'Training for MRO technicians on scheduled and heavy maintenance tasks, with procedures rehearsed before they are performed on an aircraft. Draft copy pending client content.',
		'image' => $img . 'sector-aviation.jpg',
		'modules' => [
			[ 'Wrench', 'Component Tasks', 'Removal, installation and checks.' ],
			[ 'SealCheck', 'Procedure Compliance', 'Task card sequences followed correctly.' ],
			[ 'Eye', 'Inspection', 'Structural and systems inspection.' ],
			[ 'ChartBar', 'Assessment', 'Scored task completion.' ],
		],
		'features' => $features( 'MRO', 'A task station configured to the aircraft type and systems.', 'A visual presentation of the aircraft systems and task steps.' ),
		'gallery' => [ [ 'cargo-hero.jpg', 'Airside operations' ], [ 'terrain-2.jpg', 'Aircraft stand' ], [ 'terrain-4.jpg', 'Apron' ], [ 'training-module.jpg', 'Training module' ] ],
		'faq' => $common_faq( 'MRO training solution' ),
	],
];

/* ----------------------------------------------------------- create posts */
$hub_ids = [];
foreach ( $hubs as $slug => $h ) {
	$hub_ids[ $slug ] = tt_upsert_post( 'hub', $slug, $h['title'], [], [ 'menu_order' => $h['order'] ] );
}
$prod_ids = [];
foreach ( $products as $slug => $p ) {
	$prod_ids[ $slug ] = tt_upsert_post( 'product', $slug, $p['title'], [
		'tt_hub_id' => $hub_ids[ $p['hub'] ], 'tt_code' => $p['code'], 'tt_h1' => $p['h1'], 'tt_subhead' => $p['intro'],
	], [ 'menu_order' => $p['order'] ] );
	$sec = get_posts( [ 'post_type' => 'sector', 'name' => 'aviation', 'posts_per_page' => 1 ] );
	if ( $sec ) update_post_meta( $prod_ids[ $slug ], 'tt_sector_id', $sec[0]->ID );
}
flush_rewrite_rules();

$digital = tt_upsert_post( 'page', 'digital-twins', 'Digital Twins' );
$istc    = tt_upsert_post( 'page', 'istc', 'Integrated Simulation Training Center (ISTC)' );

/* --------------------------------------------------------- product pages */
foreach ( $products as $slug => $p ) {
	$hub = $hubs[ $p['hub'] ];
	$related = [];
	foreach ( $products as $s2 => $p2 ) {
		if ( $s2 === $slug ) continue;
		$related[] = [ 'k' => ( $p2['hub'] === $p['hub'] ? 0 : 1 ), 's' => $s2, 'p' => $p2 ];
	}
	usort( $related, fn( $a, $b ) => $a['k'] <=> $b['k'] );
	$related = array_slice( $related, 0, 4 );
	$rel_tiles = $tiles( array_map( fn( $r ) => [ 'Cube', $r['p']['title'], '', $pr_u( $r['s'] ) ], $related ) );

	tt_set_elementor( $prod_ids[ $slug ], [
		$hero( $crumb( [ [ 'Aviation', $home ], [ $hub['title'], $hub_u( $p['hub'] ) ], [ $p['title'] ] ] ), $p['h1'], $p['intro'], $p['image'], 'Request a Quote', 'Download Brochure' ),
		$subnav(),
		tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Applications', 'heading' => 'Applications & training modules', 'columns' => '3', 'tiles' => $tiles( $p['modules'] ) ] ),
		tt_section( 'tt_av_features', [ 'accent' => $A, 'label' => 'Key Features', 'heading' => 'What is in the ' . $p['title'], 'groups' => tt_rows( array_map( fn( $g ) => array_merge( $g, [ 'image' => tt_img( $g['image'] ?? '' ) ] ), $p['features'] ) ) ] ),
		tt_section( 'tt_av_video', [ 'accent' => $A, 'label' => 'Video Demo', 'heading' => 'See the ' . $p['title'] . ' in action', 'body' => 'Watch the operator station, instructor station and airside environment working together.', 'poster' => tt_img( $p['gallery'][0] ? $av . $p['gallery'][0][0] : '' ) ] ),
		tt_section( 'tt_av_gallery', [ 'accent' => $A, 'label' => 'Gallery', 'heading' => 'Gallery', 'images' => tt_rows( array_map( fn( $g ) => [ 'image' => tt_img( $av . $g[0] ), 'caption' => $g[1] ], $p['gallery'] ) ) ] ),
		tt_section( 'tt_av_faq', [ 'accent' => $A, 'label' => 'FAQ', 'heading' => 'Cost, configuration and support', 'items' => $faqs( $p['faq'] ) ] ),
		tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Related Simulators', 'heading' => 'Related simulators', 'columns' => '4', 'tiles' => $rel_tiles ] ),
		tt_section( 'tt_news' ), tt_section( 'tt_linkedin' ),
		$cta( 'Get a quote for the ' . $p['title'] . '.', 'Tell us about your airport, equipment and training goals.', 'Request a Quote', 'Download Brochure' ),
	] );
}

/* ------------------------------------------------------------- hub pages */
$other_tiles = function ( $skip ) use ( $hubs, $hub_u, $tiles ) {
	$rows = [];
	foreach ( $hubs as $s => $h ) if ( $s !== $skip ) $rows[] = [ 'AirplaneTilt', $h['title'], '', $hub_u( $s ) ];
	return $tiles( $rows );
};
$advantage = [
	[ 'Wrench', 'Built in-house', 'Motion, visuals, controls and instructor software are engineered by Tecknotrove, so every simulator ships as one integrated system.' ],
	[ 'ChartLineUp', 'TMS included', 'Cloud-based Training Management System to assign, schedule, monitor and review training.' ],
	[ 'UsersThree', 'Team Play', 'Multiple airside roles train together in the same environment.' ],
	[ 'Headset', 'Reliable support', 'Phone, remote, emergency and on-site service plus spare parts through our technician network.' ],
];
foreach ( $hubs as $slug => $h ) {
	if ( ! empty( $h['tech'] ) ) {
		tt_set_elementor( $hub_ids[ $slug ], [
			$hero( $crumb( [ [ 'Aviation', $home ], [ $h['title'] ] ] ), $h['h1'], $h['intro'], $img . 'sector-aviation.jpg', 'Enquire Now' ),
			$subnav(),
			tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Technologies & Services', 'heading' => 'Shared across every aviation product', 'columns' => '2', 'tiles' => $tiles( [
				[ 'Globe', 'Digital Twins', 'Virtual replicas of equipment and airside environments. Common page across products and hubs.', home_url( '/digital-twins/' ) ],
				[ 'Monitor', 'Integrated Simulation Training Center (ISTC)', 'Multiple simulators and instructor stations in one managed training centre. Common page across products and hubs.', home_url( '/istc/' ) ],
			] ) ] ),
			tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Other hubs', 'heading' => 'Other aviation hubs', 'columns' => '3', 'tiles' => $other_tiles( $slug ) ] ),
			$cta( 'Talk to our aviation team.', 'Tell us about your airport, equipment and training goals.' ),
		] );
		continue;
	}
	$prod_tiles = $tiles( array_map( fn( $ps ) => [ 'Cube', $products[ $ps ]['title'], mb_strimwidth( $products[ $ps ]['intro'], 0, 110, '…' ), $pr_u( $ps ) ], $h['products'] ) );
	tt_set_elementor( $hub_ids[ $slug ], [
		$hero( $crumb( [ [ 'Aviation', $home ], [ $h['title'] ] ] ), $h['h1'], $h['intro'], $img . 'sector-aviation.jpg', 'Enquire Now', 'Download Brochure' ),
		$subnav(),
		tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Related Products', 'heading' => 'Simulators in this hub', 'columns' => count( $h['products'] ) > 3 ? '4' : '2', 'tiles' => $prod_tiles ] ),
		tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Tecknotrove Advantage', 'heading' => 'The Tecknotrove advantage', 'columns' => '4', 'dark' => 'yes', 'tiles' => $tiles( $advantage ) ] ),
		tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Why invest', 'heading' => 'Why ' . $h['who'] . ' invest in ' . $h['title'], 'columns' => '3', 'tiles' => $tiles( array_map( fn( $w ) => [ $w[0], $w[1], $w[2] ], $h['why'] ) ) ] ),
		tt_section( 'tt_av_faq', [ 'accent' => $A, 'label' => 'FAQ', 'heading' => $h['title'] . ': common questions', 'items' => $faqs( $h['faq'] ) ] ),
		tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Other hubs', 'heading' => 'Other aviation hubs', 'columns' => '3', 'tiles' => $other_tiles( $slug ) ] ),
		$cta( 'Talk to our aviation team.', 'Tell us about your airport, equipment and training goals.' ),
	] );
}

/* --------------------------------------------------- industry hub /aviation */
$industry = [];
foreach ( $hubs as $s => $h ) {
	$lines = [];
	foreach ( $h['products'] as $ps ) $lines[] = $products[ $ps ]['title'] . ' | ' . mb_strimwidth( $products[ $ps ]['intro'], 0, 80, '…' ) . ' | ' . $pr_u( $ps );
	if ( ! empty( $h['tech'] ) ) {
		$lines = [ 'Digital Twins | Virtual replicas of equipment and airside | ' . home_url( '/digital-twins/' ), 'Integrated Simulation Training Center (ISTC) | Multi-simulator managed training centre | ' . home_url( '/istc/' ) ];
	}
	$industry[] = [ 'title' => $h['title'], 'intro' => mb_strimwidth( $h['intro'], 0, 170, '…' ), 'products' => implode( "\n", $lines ), 'url' => tt_link( $hub_u( $s ) ), 'link_label' => 'Explore ' . $h['title'] ];
}
$av_page = tt_upsert_post( 'page', 'aviation', 'Aviation' );
tt_set_elementor( $av_page, [
	$hero( [], 'Aviation simulators built for the apron, the airside and the hangar.', 'Tecknotrove designs and manufactures ground support, airside driving and maintenance training simulators for airports, ground handlers, airlines and MROs worldwide.', $img . 'sector-aviation.jpg', 'Enquire Now', 'Download Brochure' ),
	$subnav(),
	tt_section( 'tt_av_hub_sections', [ 'accent' => $A, 'heading' => 'Explore Aviation training solutions', 'hubs' => tt_rows( $industry ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Why Choose Tecknotrove', 'heading' => 'Why choose Tecknotrove for aviation', 'columns' => '4', 'dark' => 'yes', 'tiles' => $tiles( [
		[ 'Wrench', 'Manufacturer, not reseller', 'Every subsystem is engineered in-house, so each simulator ships as one integrated system.' ],
		[ 'Globe', 'Global deployments', 'Simulators in service with customers across 35+ countries.' ],
		[ 'SealCheck', 'ISO 9001:2015 certified', 'Quality-certified design and manufacture.' ],
		[ 'Headset', '24×7 technical support', 'Phone, remote, emergency and on-site service plus spare parts.' ],
	] ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Simulation Technologies', 'heading' => 'Simulation technologies behind every product', 'columns' => '4', 'tiles' => $tiles( [
		[ 'Globe', 'Digital Twins', 'Virtual replicas of equipment and airside environments.', home_url( '/digital-twins/' ) ],
		[ 'Monitor', 'ISTC', 'Integrated Simulation Training Center.', home_url( '/istc/' ) ],
		[ 'ChartLineUp', 'TMS®', 'Cloud-based Training Management System.' ],
		[ 'UsersThree', 'Team Play', 'Collective airside team training.' ],
	] ) ] ),
	tt_section( 'tt_av_faq', [ 'accent' => $A, 'label' => 'FAQ', 'heading' => 'Aviation training: buyer questions', 'items' => $faqs( [
		[ 'What aviation simulators does Tecknotrove make?', 'GSE simulators (pushback, cargo loader, baggage tractor, catering truck), airside driving simulators (passenger bus, ARFF) and aircraft maintenance training solutions.' ],
		[ 'Who are the simulators for?', 'Airports, ground handlers, airlines and MROs.' ],
		[ 'Where do you deliver?', 'Tecknotrove serves customers in 35+ countries from its base in Mumbai, India.' ],
		[ 'How is the price decided?', 'By configuration: cab replica level, displays, custom airside terrain, number of stations, TMS and Team Play licences and installation.' ],
		[ 'Can you build the airside of our airport?', 'Yes. Geo-specific airside environments are available alongside generic ones.' ],
		[ 'How do you assess operators?', 'The Performance Analysis System produces graphical session reports of major and minor offences, with record and replay.' ],
		[ 'What support do you provide?', 'Phone, remote, emergency and on-site service, plus spare parts, through our network of technicians.' ],
	] ) ] ),
	$cta( 'Talk to our aviation team.', 'Tell us about your airport, equipment and training goals.' ),
] );

/* ------------------------------------------------- common technology pages */
$common = [
	$digital => [ 'Digital Twins', 'Virtual replicas of your equipment and airside environment, used to train, test and plan before anything happens on the apron.', 'Digital Twins at Tecknotrove', '<p>A digital twin is a virtual replica of real equipment or an airport airside. Tecknotrove builds the airside terrain, markings, signage, lighting and traffic into the simulator so operators train in a world that behaves like yours.</p><p>This is a common page across all aviation products and hubs. Draft copy pending client content.</p>' ],
	$istc    => [ 'Integrated Simulation Training Center (ISTC)', 'Multiple simulators, instructor stations and Tecknotrove TMS in one managed training centre.', 'The Integrated Simulation Training Center', '<p>An ISTC brings several Tecknotrove simulators together with instructor stations and the cloud-based Training Management System, so a training centre can schedule, run and review programmes from one place.</p><p>This is a common page across all aviation products and hubs. Draft copy pending client content.</p>' ],
];
foreach ( $common as $id => $c ) {
	tt_set_elementor( $id, [
		$hero( $crumb( [ [ 'Aviation', $home ], [ 'Supported Technologies', $hub_u( 'supported-technologies' ) ], [ $c[0] ] ] ), $c[0], $c[1], $img . 'sector-aviation.jpg', 'Enquire Now' ),
		$subnav(),
		tt_section( 'tt_content_split', [ 'accent' => $A, 'label' => 'Overview', 'heading' => $c[2], 'body' => $c[3], 'image' => tt_img( $av . 'cargo-sim-view.jpg' ), 'reverse' => 'no', 'bullets' => [], 'cta_label' => 'Enquire Now', 'cta_url' => tt_link( home_url( '/contact/' ) ) ] ),
		$cta( 'Talk to our aviation team.', 'Tell us about your airport, equipment and training goals.' ),
	] );
}

\Elementor\Plugin::$instance->files_manager->clear_cache();
echo 'hubs: ' . implode( ',', $hub_ids ) . "\nproducts: " . implode( ',', $prod_ids ) . "\naviation page #$av_page\n";
