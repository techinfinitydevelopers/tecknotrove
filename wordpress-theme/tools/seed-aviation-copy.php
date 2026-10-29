<?php
/**
 * Client copy (draft, 2026-10-27) for three pages: Aviation industry page, GSE Simulators hub, Cargo Loader & High Loader product.
 * Source docs: "Tecknotrove Aviation Pages (1).docx", "GSE Simulators.docx", "Cargo Loader & High Loader Simulator.docx".
 * Run after (it requires) seed-aviation.php:
 *   php -r 'require "C:/xampp/htdocs/tecknotrove/wp-load.php"; require ".../tools/seed-aviation-copy.php";'
 * Bracketed items such as [confirm offered] and [Placeholder ...] are the client's own markers and are kept on purpose.
 */
require __DIR__ . '/seed-aviation.php';

// Rich rows: icon, title, desc, url, cta, badge.
$rows = fn( $list ) => tt_rows( array_map( fn( $r ) => [
	'icon' => $r[0], 'title' => $r[1], 'desc' => $r[2] ?? '', 'url' => tt_link( $r[3] ?? '' ), 'cta' => $r[4] ?? '', 'badge' => $r[5] ?? '',
], $list ) );
// "Lead: sentence" -> title + desc.
$lead = function ( $icons, $items ) use ( $rows ) {
	$out = [];
	foreach ( $items as $i => $s ) {
		$p = explode( ': ', $s, 2 );
		$out[] = [ $icons[ $i % count( $icons ) ], rtrim( $p[0], '.' ), $p[1] ?? '' ];
	}
	return $rows( $out );
};
$faq_rows = fn( $list ) => tt_rows( array_map( fn( $s ) => [ 'q' => $s[0], 'a' => $s[1] ], $list ) );
$seo = function ( $id, $title, $desc ) { update_post_meta( $id, 'tt_seo_title', $title ); update_post_meta( $id, 'tt_seo_desc', $desc ); };

// Titles as written in the copy.
$renames = [
	'aircraft-pushback-simulator' => 'Aircraft Pushback & Towing Simulator',
	'cargo-loader-simulator'      => 'Cargo Loader & High Loader Simulator',
	'catering-truck-simulator'    => 'Hi-Lift Catering Truck Simulator',
	'passenger-bus-simulator'     => 'Airport Passenger Bus Simulator',
	'arff-simulator'              => 'ARFF / Fire Truck Simulator',
];
foreach ( $renames as $slug => $title ) wp_update_post( [ 'ID' => $prod_ids[ $slug ], 'post_title' => $title ] );

$cta_req = fn( $h, $b, $c2 ) => tt_section( 'tt_av_cta', [
	'heading' => $h, 'body' => $b, 'cta1_label' => 'Request a Quote', 'cta1_url' => tt_link( home_url( '/contact/' ) ),
	'cta2_label' => $c2, 'cta2_url' => tt_link( 'Talk to an Aviation Specialist' === $c2 ? home_url( '/contact/' ) : '#brochure' ),
] );

/* ===================================================== Aviation industry page */
$I = [
	'GSE Simulators' => [
		'Ground support equipment simulators replicate the cab, controls and dynamics of the equipment your operators use during aircraft turnaround. Operators learn equipment handling, aircraft-specific procedures and incident response without risk to aircraft, people or GSE.',
		[ [ 'Aircraft Pushback & Towing Simulator', 'Towbar and towbarless pushback training on narrow and wide-body aircraft.', $pr_u( 'aircraft-pushback-simulator' ) ],
		  [ 'Cargo Loader & High Loader Simulator', 'Main deck and lower deck loading on Airbus and Boeing aircraft types.', $pr_u( 'cargo-loader-simulator' ) ],
		  [ 'Baggage Tractor Simulator', 'Safe towing of baggage carts across aprons and GSE roads.', $pr_u( 'baggage-tractor-simulator' ) ],
		  [ 'Hi-Lift Catering Truck Simulator', 'Lift, dock and service procedures at the aircraft door.', $pr_u( 'catering-truck-simulator' ) ],
		  [ 'Passenger Boarding Bridge Simulator', '[confirm offered] bridge positioning and docking to the aircraft.', '' ] ],
		'gse-simulators', 'Explore GSE Simulators',
	],
	'Airside Driving Simulators' => [
		'Airside driving simulators train, up-skill and objectively test everyone who drives on the airfield. Drivers practise airside rules, markings, route familiarisation and emergency response in a virtual replica of the airport, in day, night and low-visibility conditions.',
		[ [ 'Airside Driving Simulator', 'Light vehicle training on SUV, sedan and follow-me vehicles.', '' ],
		  [ 'Airport Passenger Bus Simulator', 'Apron bus driving between terminals and remote stands.', $pr_u( 'passenger-bus-simulator' ) ],
		  [ 'ARFF / Fire Truck Simulator', 'Emergency response driving for airport rescue and firefighting crews.', $pr_u( 'arff-simulator' ) ],
		  [ 'Fuel Tanker Simulator', 'Refuelling vehicle driving and positioning on the apron.', '' ],
		  [ 'Ramp Safety Simulator (VR)', 'Hazard awareness and FOD identification on the ramp.', '' ] ],
		'airside-driving-simulators', 'Explore Airside Driving Simulators',
	],
	'Aircraft Maintenance Training Solutions' => [
		'VR and AR training modules prepare line maintenance engineers, mechanics and ground staff to inspect and service aircraft in a fully immersive environment. Modules are available for narrow and wide-body aircraft from Airbus and Boeing.',
		[ [ 'Aircraft Walk-Around Inspection (VR)', 'Post-arrival and pre-departure inspection training.', '' ],
		  [ 'AR/VR Maintenance Manual Digitisation', 'Existing maintenance manuals converted into immersive, hands-on modules.', '' ],
		  [ 'Hangar Operations Add-on', 'Hangar area environment for training operators on hangar operations.', '' ] ],
		'aircraft-maintenance-training', 'Explore Aircraft Maintenance Training Solutions',
	],
	'Supported Technologies & Services' => [
		'The technologies and services that sit around every Tecknotrove simulator: a digital twin of your airport, operator assessment tools, theory testing and on-site training delivered by our team.',
		[ [ '3D Airport Customization', 'A digital twin of your own airside, built to ICAO markings and signage.', '' ],
		  [ 'Clinical Testing System', 'Psychometric assessment of operator aptitude before training.', '' ],
		  [ 'Online Theory Testing System', 'Online knowledge tests on airside rules and procedures.', '' ],
		  [ 'GSE Operator Training Services', 'On-site training for airside drivers and GSE operators.', '' ],
		  [ 'VR Training Solutions', 'Portable VR versions of our airside and GSE modules.', '' ],
		  [ 'Airport Simulation Training Centres', 'Full-scale learning and development centres set up for your team.', '' ] ],
		'supported-technologies', 'Explore Supported Technologies & Services',
	],
];
$industry = [];
foreach ( $I as $title => $h ) {
	$industry[] = [
		'title' => $title, 'intro' => $h[0], 'url' => tt_link( $hub_u( $h[2] ) ), 'link_label' => $h[3],
		'products' => implode( "\n", array_map( fn( $p ) => $p[0] . ' | ' . $p[1] . ( $p[2] ? ' | ' . $p[2] : '' ), $h[1] ) ),
	];
}

tt_set_elementor( $av_page, [
	$hero( [], 'Aviation Training Simulators for Airports, Airlines and Ground Handlers',
		"Tecknotrove designs and manufactures training simulators and VR training solutions for the aviation industry. Our simulators are built for airports, airlines, ground handlers, aviation training institutes and MRO training institutes, and they cover the equipment and vehicles that operate on the airside: aircraft pushback and towing, cargo loaders, baggage tractors, catering trucks, passenger buses, fire trucks and airside light vehicles.\nEvery system is designed and built at our manufacturing facility in Gujarat, India, and supplied worldwide through authorised distribution and integration partners in India, the Middle East, Africa, Europe and Southeast Asia. Since 2002, Tecknotrove has delivered more than 1,000 simulation projects across 28 countries.",
		$img . 'sector-aviation.jpg', 'Request a Quote', 'Download the Airside Simulator Brochure' ),
	tt_section( 'tt_av_hub_sections', [ 'accent' => $A, 'heading' => '', 'hubs' => tt_rows( $industry ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Why Choose Tecknotrove', 'heading' => 'Why Choose Tecknotrove', 'columns' => '3', 'dark' => 'yes',
		'tiles' => $lead( [ 'Wrench', 'UsersThree', 'ShieldCheck', 'Lightning', 'Gauge', 'Cube' ], [
			'Customised training programmes: modules are built around your airside environment, training language, objectives, equipment types and assessment criteria. Past incidents can be recreated on the simulator so operators train on the situations that matter to you.',
			'Standardised training: every operator reaches the same skill level for safe ground operations, which supports a faster, more consistent aircraft turnaround.',
			'Fewer airside incidents: simulated training builds situational awareness, helping operators avoid costly incidents and damage on the airside.',
			'Emergency preparedness: operators practise fire response, vehicle and radio failures and other emergencies with no real danger.',
			'Less equipment downtime: your GSE stays in operation while operators train, and the simulator flags operator behaviour that damages equipment.',
			'Built in-house, delivered fast: we design, build and support every simulator ourselves. Most projects are delivered within 6 to 8 weeks, depending on customisation.',
		] ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Simulation Technologies', 'heading' => 'Simulation Technologies', 'columns' => '4',
		'tiles' => $lead( [ 'Gauge', 'Monitor', 'MapTrifold', 'ChartBar', 'UsersThree', 'Waveform', 'ArrowsClockwise' ], [
			'Fidelity range: low fidelity portable simulators with a built-in instructor station, medium fidelity simulators with a separate instructor station and motion option, and high fidelity simulators with advanced instructor station, motion system and 180-degree curved projection.',
			'VR and desktop versions: VR modules and desktop simulators for pre-employment screening, familiarisation and safety training at lower cost.',
			'Virtual airside environment: GSE roads, aprons, markings and signage designed to ICAO standards, with remote bays, aerobridges, narrow and wide-body aircraft, terminals, taxiways and runways.',
			'Instructor software and testing: trainee database, real-time performance evaluation, fault injection, and record and replay of every session.',
			'Group training: a team play plugin that puts several operators in the same airside environment.',
			'Motion and display: 3DOF and 6DOF electric motion platforms; single 32-inch, triple 32-inch or 180-degree curved projection displays.',
			'Convertible kits: multiple equipment types run on one simulator base unit.',
		] ) ] ),
	tt_section( 'tt_av_faq', [ 'accent' => $A, 'label' => 'FAQs', 'heading' => 'Frequently asked questions', 'items' => $faq_rows( [
		[ 'Which aviation simulators does Tecknotrove offer?', 'We offer simulators for aircraft pushback and towing, cargo loaders and high loaders, baggage tractors, catering trucks, passenger buses, fire trucks, fuel tankers, follow-me vehicles and other airside light vehicles, plus ramp safety simulators and VR modules for aircraft inspection.' ],
		[ 'Can the simulators be customised to our airport?', 'Yes. Customisation covers a digital twin or replica of your airside environment, training language, training modules, equipment types and assessment criteria.' ],
		[ 'How long does a project take to deliver?', 'Most projects are delivered and completed within 6 to 8 weeks. The exact timeline depends on the type of project and the level of customisation required.' ],
		[ 'How much does an airside simulator cost?', 'Cost depends on your requirements and the complexity of the project: fidelity level, cab configuration, display and motion options, and the extent of airport customisation. Lower-cost desktop and VR versions are also available. [Placeholder: indicative price bands, if the client wants to publish them]' ],
		[ 'What after-sales support do you provide?', 'All Tecknotrove simulators carry a one-year international warranty, with online and offline support during that period. After that, simulators are maintained under an extended warranty or an annual maintenance contract (AMC), which includes regular software updates.' ],
		[ 'What is the life expectancy of a simulator?', 'The average life of a simulator is 5 years, depending on usage and wear and tear. Life can extend beyond 5 years when the simulator is kept under manufacturer warranty and maintenance.' ],
		[ 'Who can benefit from airside simulators?', 'GSE operators, airside drivers, airport operations managers, line maintenance engineers and airport police can all train on Tecknotrove airside simulators.' ],
		[ 'Do you offer VR training for aircraft maintenance?', 'Yes. Our VR modules train line maintenance engineers and ground staff on aircraft inspection after arrival and before departure, for narrow and wide-body Airbus and Boeing aircraft. We can also digitise your existing training manuals into AR/VR modules.' ],
		[ 'Can you set up a complete training centre?', 'Yes. We set up full-scale learning and development centres with a mix of simulators and VR, and we provide on-site training services for airside drivers and GSE operators.' ],
	] ) ] ),
	$cta_req( 'Plan your airside training programme with Tecknotrove', 'Tell us which equipment you need to train on and how your airport is laid out. We will recommend the right simulator configuration and send a detailed quote.', 'Talk to an Aviation Specialist' ),
] );
$seo( $av_page, 'Aviation Training Simulators for Airports | Tecknotrove', 'Airside, GSE and aircraft maintenance training simulators built in India for airports, airlines and ground handlers across 28 countries.' );

/* ============================================================= GSE hub */
$gse = $hub_ids['gse-simulators'];
tt_set_elementor( $gse, [
	$hero( $crumb( [ [ 'Aviation', $home ], [ 'GSE Simulators' ] ] ), 'GSE Simulators for Ground Handling Training',
		"Tecknotrove ground support equipment (GSE) simulators are replicas of the equipment that works around the aircraft during turnaround: pushback tractors, cargo and high loaders, baggage tractors and catering trucks. Each simulator reproduces the actual cab, controls and equipment dynamics inside a realistic virtual airside, so operators learn and are assessed with no risk to aircraft, people or GSE.\nGSE simulators are bought by ground handling companies, airlines, airports and aviation training institutes that need to train new operators, refresh experienced ones and test them against a consistent standard. Every unit is designed and manufactured by Tecknotrove in India and supplied worldwide.",
		$img . 'sector-aviation.jpg', 'Request a Quote', 'Download the Airside Simulator Brochure' ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Related Products', 'heading' => 'GSE Simulator Range', 'columns' => '3', 'tiles' => $rows( [
		[ 'Cube', 'Aircraft Pushback & Towing Simulator', 'Towbar and towbarless pushback training with real aircraft dynamics, on a 3DOF motion platform.', $pr_u( 'aircraft-pushback-simulator' ), 'View Pushback Simulator' ],
		[ 'Cube', 'Cargo Loader & High Loader Simulator', 'Main deck and lower deck loading techniques on narrow and wide-body Airbus and Boeing aircraft.', $pr_u( 'cargo-loader-simulator' ), 'View Cargo Loader Simulator' ],
		[ 'Cube', 'Baggage Tractor Simulator', 'Safe towing of baggage carts on GSE roads, aprons and around parked aircraft.', $pr_u( 'baggage-tractor-simulator' ), 'View Baggage Tractor Simulator' ],
		[ 'Cube', 'Hi-Lift Catering Truck Simulator', 'Lift operation, docking at the aircraft door and safe positioning on the stand.', $pr_u( 'catering-truck-simulator' ), 'View Catering Truck Simulator' ],
		[ 'Cube', 'Passenger Boarding Bridge Simulator', '[confirm offered] bridge drive, alignment and docking to the aircraft door.', '', '', 'Coming soon' ],
	] ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Tecknotrove Advantage', 'heading' => 'Tecknotrove Advantage', 'columns' => '3', 'dark' => 'yes',
		'tiles' => $lead( [ 'Wrench', 'ArrowsClockwise', 'Gauge', 'MapTrifold', 'ChartBar' ], [
			'Real equipment controls: operator cabs replicate the actual seat, force feedback steering, levers and controls in ergonomically correct positions.',
			'Equipment-specific or convertible: choose an equipment-specific cab, or a convertible kit that runs several GSE types on one simulator base unit.',
			'Scalable fidelity: low, medium and high fidelity simulators, plus VR versions, so training can scale from screening to advanced certification.',
			'Your airside, your aircraft: a virtual airside built to ICAO markings and signage, with narrow and wide-body aircraft, remote bays and aerobridges, or a digital twin of your own airport.',
			'Built-in assessment: real-time evaluation of skill, knowledge, safety and productivity, with a stored report for every trainee.',
		] ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Why invest', 'heading' => 'Why Ground Handlers Invest in GSE Simulators', 'columns' => '3',
		'tiles' => $lead( [ 'ShieldCheck', 'Coins', 'SealCheck', 'Lightning', 'Gauge', 'Eye' ], [
			'Aircraft damage is the costliest mistake on the ramp. Operators make their first pushbacks, dockings and loader approaches on the simulator, not next to a real aircraft.',
			'Equipment stays in service. Training on simulators keeps pushback tractors, loaders and catering trucks on the ramp instead of out of operation for training.',
			'Every operator meets the same standard. Standardised modules and objective scoring give every shift the same skill baseline for turnaround work.',
			'Rare situations can be rehearsed. Night operations, rain, fog and snow, low visibility and equipment faults can be practised on demand.',
			'Faster, safer turnarounds. Operators who know the procedure for each aircraft type work more consistently, which supports on-time turnaround.',
			'Poor habits show up early. The simulator records operator behaviour that damages equipment, so instructors can correct it before it reaches the ramp.',
		] ) ] ),
	tt_section( 'tt_av_faq', [ 'accent' => $A, 'label' => 'FAQs', 'heading' => 'Frequently asked questions', 'items' => $faq_rows( [
		[ 'Which GSE simulators does Tecknotrove offer?', 'We offer the Aircraft Pushback & Towing Simulator, Cargo Loader & High Loader Simulator, Baggage Tractor Simulator and Hi-Lift Catering Truck Simulator. [Add Passenger Boarding Bridge Simulator if confirmed.]' ],
		[ 'Do you offer towbar and towbarless pushback simulators?', 'Yes. The Aircraft Pushback & Towing Simulator covers both towbar and towbarless pushback tractors, with actual vehicle dynamics and a realistic airport environment.' ],
		[ 'Is there a simulator for cargo handling at airports?', 'Yes. The Cargo Loader & High Loader Simulator trains operators on correct and safe loading on both main deck and lower deck, with modules for wide and narrow-body aircraft from Airbus and Boeing.' ],
		[ 'Can one simulator train operators on several types of GSE?', 'Yes. With a convertible kit, multiple equipment types can be accommodated on the same simulator base unit. Equipment-specific cabs are also available.' ],
		[ 'Are VR versions of the GSE simulators available?', 'Yes. VR versions are available for pre-employment screening, familiarisation, safety training and emergency preparedness, at a lower cost than full-scale simulators.' ],
		[ 'Can the simulators include our own airport and aircraft types?', 'Yes. Training modules, aircraft types, equipment models, training language and assessment criteria can all be customised, and we can build a 3D digital twin of your airside.' ],
	] ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Other Aviation Hubs', 'heading' => 'Other Aviation Hubs', 'columns' => '3', 'tiles' => $rows( [
		[ 'AirplaneTilt', 'Airside Driving Simulators', 'Train and test everyone who drives on the airfield.', $hub_u( 'airside-driving-simulators' ), 'Explore hub' ],
		[ 'AirplaneTilt', 'Aircraft Maintenance Training Solutions', 'VR inspection and maintenance training for engineers.', $hub_u( 'aircraft-maintenance-training' ), 'Explore hub' ],
		[ 'AirplaneTilt', 'Supported Technologies & Services', 'Digital twins, assessment tools and on-site training.', $hub_u( 'supported-technologies' ), 'Explore hub' ],
	] ) ] ),
	$cta_req( 'Find the right GSE simulator for your operation', 'Tell us which equipment and aircraft types your operators handle. We will recommend a configuration and send a detailed quote.', 'Download Brochure' ),
] );
$seo( $gse, 'GSE Simulators for Ground Handling Training | Tecknotrove', 'Pushback, cargo loader, baggage tractor and catering truck simulators that train GSE operators without taking equipment off the ramp.' );

/* ============================================ Cargo Loader & High Loader product */
$cargo = $prod_ids['cargo-loader-simulator'];
$feat  = fn( $title, $icon, $body, $image = '' ) => [ 'title' => $title, 'icon' => $icon, 'body' => $body, 'bullets' => '', 'image' => tt_img( $image ) ];
$cargo_sections = [
	$hero( $crumb( [ [ 'Aviation', $home ], [ 'GSE Simulators', $hub_u( 'gse-simulators' ) ], [ 'Cargo Loader & High Loader Simulator' ] ] ), 'Cargo Loader and High Loader Simulator',
		"The Tecknotrove Cargo Loader and High Loader Simulator trains and evaluates operators on safe aircraft cargo loading. Its design is based on the actual equipment, replicating the controls, levers and dynamics of a range of cargo loader and high loader models. Operators learn main deck and lower deck loading techniques on a variety of narrow and wide-body aircraft, in a realistic airside environment and in complete safety.\nIt is built for ground handling companies, cargo handlers, airlines, airports and aviation training institutes that need to train new operators and test experienced ones. The simulator is designed and manufactured by Tecknotrove in India and is available as a full-scale simulator or a portable VR version.",
		$av . 'cargo-hero.jpg', 'Request a Quote', 'Watch the Demo' ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Applications', 'heading' => 'Applications and Training Modules', 'columns' => '4',
		'tiles' => $lead( [ 'Wrench', 'Cube', 'MapTrifold', 'ShieldCheck', 'SealCheck', 'Gauge', 'Eye' ], [
			'Equipment familiarisation: controls, pre-checks and safe operation of the loader.',
			'Procedural training on high loader and belt loader: step-by-step loading and unloading procedures.',
			'Aircraft-specific cargo loading techniques: main deck and lower deck loading on narrow and wide-body aircraft.',
			'Incident preparedness training: handling faults and hazardous situations without risk.',
			'Operator testing and certification: objective assessment before operators work on the ramp.',
			'Equipment-specific training: modules matched to the loader models your team uses.',
			'Airside familiarisation: aprons, stands, GSE roads and safe movement around aircraft.',
		] ) ] ),
	tt_section( 'tt_av_notes', [ 'accent' => $A, 'rows' => tt_rows( [
		[ 'label' => 'Equipment types', 'text' => 'Belt loader, high loader (cargo loader).' ],
		[ 'label' => 'Training scenarios include', 'text' => 'Pre-checks, equipment control familiarisation, loading and unloading of containers, and parking and shutdown procedures, in rain, fog, snow, dust and night conditions. Difficulty increases as the trainee progresses. Customised scenarios are developed to client requirements in multiple languages.' ],
	] ) ] ),
	tt_section( 'tt_av_features', [ 'accent' => $A, 'label' => 'Key Features', 'heading' => 'Key Features', 'groups' => tt_rows( [
		$feat( 'Instructor Station & Software', 'Monitor', 'The Instructor Operator Station controls every training session. Instructors can manage a trainee and instructor database, control multiple simulators at once, create new exercises, change the environment and inject faults during a running session, record and replay sessions, manage evaluation reports, and run maintenance, calibration and diagnostics. An optional Monitoring Station allows real-time monitoring of the live session.', $av . 'instructor-module.jpg' ),
		$feat( 'Operator Station', 'Cube', 'The operator cab replicates the cargo loader cab with an actual seat, force feedback steering and controls in ergonomically correct positions. Equipment dynamics are modelled to reflect operation under different conditions. Choose an equipment-specific cab or a generic configuration; convertible kits let several equipment types run on the same simulator base unit.', $av . 'cargo-station.jpg' ),
		$feat( 'Testing & Evaluation', 'ChartBar', 'The simulator evaluates every trainee in real time on skills, knowledge, safety and productivity. A detailed report is generated for each trainee and stored in the trainee database for later analysis. Record and replay lets the instructor walk trainees through their mistakes.', $av . 'training-module.jpg' ),
		$feat( 'Group Training', 'UsersThree', 'The team play plugin lets several operators work and learn in the same virtual airside at the same time, so loader operators can practise alongside other GSE crews.', $av . 'teamplay.jpg' ),
		$feat( 'Training Management System (TMS)', 'ChartLineUp', "Trainee records, evaluation reports and session history are stored centrally, so instructors can track each operator's progress across sessions and simulators. [Confirm TMS name and full feature set with Tecknotrove.]" ),
		$feat( 'Display & Motion', 'Eye', 'Display options: a single 32-inch screen, three 32-inch screens, or curved screens with multiple projectors for a seamless 180-degree view. The integrated electric motion platform (3DOF or 6DOF) reproduces equipment dynamics, surface conditions, load weight and engine and tyre vibration, and is designed for maintenance-free operation.', $av . 'cargo-sim-view.jpg' ),
		$feat( 'Virtual Airside Environment', 'MapTrifold', 'GSE roads, aprons, markings and signage are designed to ICAO standards. The terrain bundle includes remote bays, aprons with aerobridges, narrow and wide-body aircraft, GSE, terminal buildings, taxiways and runways. A hangar area add-on is available for hangar operations training.', $av . 'terrain-1.jpg' ),
	] ) ] ),
	tt_section( 'tt_av_video', [ 'accent' => $A, 'label' => 'Video Demo', 'heading' => 'Tecknotrove Cargo Loader and High Loader Simulator Demo', 'video_url' => tt_link( 'https://www.youtube.com/watch?v=CNAXDgL6Se0' ), 'poster' => tt_img( $av . 'cargo-hero.jpg' ) ] ),
	tt_section( 'tt_av_gallery', [ 'accent' => $A, 'label' => 'Gallery', 'heading' => 'Gallery', 'images' => tt_rows( array_map( fn( $g ) => [ 'image' => tt_img( $av . $g[0] ), 'caption' => $g[1] ], $products['cargo-loader-simulator']['gallery'] ) ) ] ),
	tt_section( 'tt_av_faq', [ 'accent' => $A, 'label' => 'FAQs', 'heading' => 'Frequently asked questions', 'items' => $faq_rows( [
		[ 'How much does a cargo loader simulator cost?', 'The price depends on the configuration you choose. A portable VR or low fidelity simulator costs less than a high fidelity simulator with motion and a 180-degree display. Share your requirements and we will send a detailed quote. [Placeholder: indicative price band, if the client wants to publish one]' ],
		[ 'What affects the price of a cargo loader simulator?', 'The main cost drivers are fidelity level (low, medium or high), cab type (equipment-specific, generic or convertible), display (single screen, three screens or 180-degree projection), motion platform (none, 3DOF or 6DOF), the number of aircraft types and modules, airport customisation, training languages, and add-ons such as a monitoring station or group training.' ],
		[ 'What is a cargo loader simulator?', 'It is a training platform that replicates the equipment used to load and unload cargo at airports. Trainees learn to operate cargo loaders safely, navigate the airside and follow procedures with no risk to real equipment or flight schedules.' ],
		[ 'Which aircraft and loader types are covered?', 'Modules cover main deck and lower deck loading on wide and narrow-body aircraft from Airbus and Boeing. The simulator is compatible with a variety of cargo loader and high loader models, and also covers belt loaders.' ],
		[ 'What skills do operators develop on the simulator?', 'Operators master manoeuvring, docking to the aircraft, container loading and unloading, weight management and adherence to safety procedures, with real-time feedback on every session.' ],
		[ 'Is a VR version available?', 'Yes. The cargo loader module is available as a portable VR version and as a full-scale simulator.' ],
		[ 'How long does delivery take?', 'Most projects are delivered within 6 to 8 weeks, depending on the configuration and level of customisation.' ],
		[ 'What warranty and support are included?', 'Every simulator carries a one-year international warranty with online and offline support. After that, an extended warranty or annual maintenance contract (AMC) covers maintenance and regular software updates.' ],
	] ) ] ),
	tt_section( 'tt_av_tiles', [ 'accent' => $A, 'label' => 'Related Simulators', 'heading' => 'Related Simulators', 'columns' => '3', 'tiles' => $rows( [
		[ 'Cube', 'Aircraft Pushback & Towing Simulator', 'GSE Simulators', $pr_u( 'aircraft-pushback-simulator' ) ],
		[ 'Cube', 'Baggage Tractor Simulator', 'GSE Simulators', $pr_u( 'baggage-tractor-simulator' ) ],
		[ 'Cube', 'Hi-Lift Catering Truck Simulator', 'GSE Simulators', $pr_u( 'catering-truck-simulator' ) ],
		[ 'Cube', 'Airside Driving Simulator', 'Airside Driving Simulators', '', '', 'Coming soon' ],
		[ 'Globe', '3D Airport Customization', 'Supported Technologies & Services', '', '', 'Coming soon' ],
	] ) ] ),
	tt_section( 'tt_av_related_content', [ 'accent' => $A, 'heading' => 'Related content', 'items' => tt_rows( [
		[ 'type' => 'Blog', 'title' => 'Reducing Airside Incidents Through Ground Support Equipment Simulation' ],
		[ 'type' => 'Blog', 'title' => 'Why Simulator-Based Training Is Becoming Critical for Airside Operations (2026)' ],
		[ 'type' => 'News', 'title' => 'Exclusive Interview with Payal Gupta: Transforming Aviation Training Through Simulation and Digital Twins' ],
		[ 'type' => 'News', 'title' => 'Exclusive interview with Payal Gupta: Rebuilding the MRO skills pipeline' ],
		[ 'type' => 'News', 'title' => '[Placeholder: Cargo Loader Simulator launch announcement, if republished on the new site]' ],
		[ 'type' => 'Social', 'title' => '[Placeholder: LinkedIn post on the Cargo Loader Simulator]' ],
		[ 'type' => 'Social', 'title' => '[Placeholder: YouTube demo or Shorts clip]' ],
		[ 'type' => 'Social', 'title' => '[Placeholder: event or installation post]' ],
	] ) ] ),
	$cta_req( 'Train your cargo loader operators before they reach the aircraft', 'Tell us which loaders and aircraft types your team handles. We will recommend the right simulator configuration and send a detailed quote.', 'Download Brochure' ),
];
// The hero CTA "Watch the Demo" jumps to the video section.
$cargo_sections[0]['elements'][0]['settings']['cta2_url'] = tt_link( '#video' );
tt_set_elementor( $cargo, $cargo_sections );
$seo( $cargo, 'Cargo Loader & High Loader Simulator | Tecknotrove', 'Train cargo loader and high loader operators on main deck and lower deck loading for narrow and wide-body aircraft. Request a quote.' );

\Elementor\Plugin::$instance->files_manager->clear_cache();
echo "copy applied: industry #$av_page, GSE hub #$gse, Cargo Loader #$cargo\n";
