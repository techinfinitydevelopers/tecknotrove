<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * "Homepage Content" admin page — makes the text/numbers a marketing editor
 * would actually want to change (hero copy, news articles, partner/careers
 * tiles, LinkedIn stats & posts, callout heading) editable from wp-admin
 * without a developer, without needing a Page/CPT for the homepage itself
 * (front-page.php renders unconditionally regardless of Reading settings).
 *
 * Everything here has a hardcoded fallback matching the original design,
 * so an empty option never breaks the page — see the tecknotrove_home_*()
 * getters in this file, used by template-parts/home/*.php.
 */

function tecknotrove_home_admin_menu() {
	add_menu_page(
		'Homepage Content',
		'Homepage',
		'edit_pages',
		'tecknotrove-homepage',
		'tecknotrove_render_home_options_page',
		'dashicons-admin-home',
		25
	);
}
add_action( 'admin_menu', 'tecknotrove_home_admin_menu' );

function tecknotrove_render_home_options_page() {
	if ( isset( $_POST['tecknotrove_home_nonce'] ) && wp_verify_nonce( $_POST['tecknotrove_home_nonce'], 'tecknotrove_save_home' ) && current_user_can( 'edit_pages' ) ) {
		$text_fields = [ 'tt_home_hero_eyebrow', 'tt_home_hero_line1', 'tt_home_hero_line2', 'tt_home_why_line1', 'tt_home_why_line2', 'tt_home_linkedin_followers', 'tt_home_linkedin_countries', 'tt_home_callout_line1', 'tt_home_callout_line2' ];
		foreach ( $text_fields as $f ) {
			if ( isset( $_POST[ $f ] ) ) update_option( $f, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
		}
		$textarea_fields = [ 'tt_home_hero_subhead', 'tt_home_why_body', 'tt_home_callout_body' ];
		foreach ( $textarea_fields as $f ) {
			if ( isset( $_POST[ $f ] ) ) update_option( $f, sanitize_textarea_field( wp_unslash( $_POST[ $f ] ) ) );
		}
		tecknotrove_save_repeater_option( 'tt_home_news' );
		tecknotrove_save_repeater_option( 'tt_home_partners' );
		tecknotrove_save_repeater_option( 'tt_home_hashtags' );
		tecknotrove_save_repeater_option( 'tt_home_linkedin_posts' );
		echo '<div class="notice notice-success"><p>Saved.</p></div>';
	}
	?>
	<div class="wrap">
		<h1>Homepage Content</h1>
		<p>Edits here show up on the homepage immediately — no code or git push needed.</p>
		<form method="post">
			<?php wp_nonce_field( 'tecknotrove_save_home', 'tecknotrove_home_nonce' ); ?>

			<h2 class="title">Hero</h2>
			<table class="form-table">
				<tr><th>Eyebrow</th><td><input type="text" name="tt_home_hero_eyebrow" value="<?php echo esc_attr( tecknotrove_home_hero_eyebrow() ); ?>" class="large-text" /></td></tr>
				<tr><th>Headline, line 1</th><td><input type="text" name="tt_home_hero_line1" value="<?php echo esc_attr( tecknotrove_home_hero_line1() ); ?>" class="large-text" /></td></tr>
				<tr><th>Headline, line 2</th><td><input type="text" name="tt_home_hero_line2" value="<?php echo esc_attr( tecknotrove_home_hero_line2() ); ?>" class="large-text" /></td></tr>
				<tr><th>Subhead</th><td><textarea name="tt_home_hero_subhead" rows="3" class="large-text"><?php echo esc_textarea( tecknotrove_home_hero_subhead() ); ?></textarea></td></tr>
			</table>

			<h2 class="title">Why Tecknotrove</h2>
			<table class="form-table">
				<tr><th>Headline, line 1</th><td><input type="text" name="tt_home_why_line1" value="<?php echo esc_attr( tecknotrove_home_why_line1() ); ?>" class="large-text" /></td></tr>
				<tr><th>Headline, line 2</th><td><input type="text" name="tt_home_why_line2" value="<?php echo esc_attr( tecknotrove_home_why_line2() ); ?>" class="large-text" /></td></tr>
				<tr><th>Body</th><td><textarea name="tt_home_why_body" rows="3" class="large-text"><?php echo esc_textarea( tecknotrove_home_why_body() ); ?></textarea></td></tr>
			</table>

			<h2 class="title">News &amp; Insights (3 articles)</h2>
			<?php tecknotrove_render_repeater_option( 'tt_home_news', [
				[ 'key' => 'title', 'label' => 'Title' ],
				[ 'key' => 'meta', 'label' => 'Date · read time' ],
				[ 'key' => 'image', 'label' => 'Image URL (from Media Library)' ],
			] ); ?>

			<h2 class="title">Partner / Careers tiles</h2>
			<?php tecknotrove_render_repeater_option( 'tt_home_partners', [
				[ 'key' => 'tag', 'label' => 'Tag' ],
				[ 'key' => 'title', 'label' => 'Title' ],
				[ 'key' => 'desc', 'label' => 'Description', 'type' => 'textarea' ],
				[ 'key' => 'stat_value', 'label' => 'Stat value' ],
				[ 'key' => 'stat_label', 'label' => 'Stat label' ],
				[ 'key' => 'cta', 'label' => 'Button text' ],
				[ 'key' => 'href', 'label' => 'Button link' ],
			] ); ?>

			<h2 class="title">LinkedIn</h2>
			<table class="form-table">
				<tr><th>Followers</th><td><input type="text" name="tt_home_linkedin_followers" value="<?php echo esc_attr( tecknotrove_home_linkedin_followers() ); ?>" /></td></tr>
				<tr><th>Countries reached</th><td><input type="text" name="tt_home_linkedin_countries" value="<?php echo esc_attr( tecknotrove_home_linkedin_countries() ); ?>" /></td></tr>
			</table>
			<p><strong>Hashtags</strong></p>
			<?php tecknotrove_render_repeater_option( 'tt_home_hashtags', [ [ 'key' => 'text', 'label' => 'Hashtag' ] ] ); ?>
			<p><strong>Posts (up to 2 shown)</strong></p>
			<?php tecknotrove_render_repeater_option( 'tt_home_linkedin_posts', [
				[ 'key' => 'time', 'label' => 'Posted' ],
				[ 'key' => 'text', 'label' => 'Post text', 'type' => 'textarea' ],
				[ 'key' => 'doc_title', 'label' => 'Document title' ],
				[ 'key' => 'pages', 'label' => 'Pages' ],
				[ 'key' => 'reactions', 'label' => 'Reactions' ],
				[ 'key' => 'image', 'label' => 'Image URL' ],
				[ 'key' => 'href', 'label' => 'Link to post' ],
			] ); ?>

			<h2 class="title">Callout</h2>
			<table class="form-table">
				<tr><th>Headline, line 1</th><td><input type="text" name="tt_home_callout_line1" value="<?php echo esc_attr( tecknotrove_home_callout_line1() ); ?>" class="large-text" /></td></tr>
				<tr><th>Headline, line 2</th><td><input type="text" name="tt_home_callout_line2" value="<?php echo esc_attr( tecknotrove_home_callout_line2() ); ?>" class="large-text" /></td></tr>
				<tr><th>Body</th><td><textarea name="tt_home_callout_body" rows="3" class="large-text"><?php echo esc_textarea( tecknotrove_home_callout_body() ); ?></textarea></td></tr>
			</table>

			<?php submit_button( 'Save Homepage Content' ); ?>
		</form>
	</div>
	<?php
}

/* ---------- Getters with hardcoded fallbacks (original design copy) ---------- */

function tecknotrove_home_hero_eyebrow() { return get_option( 'tt_home_hero_eyebrow' ) ?: 'Simulation & Training Technology · Est. 2002'; }
function tecknotrove_home_hero_line1() { return get_option( 'tt_home_hero_line1' ) ?: 'Precise today.'; }
function tecknotrove_home_hero_line2() { return get_option( 'tt_home_hero_line2' ) ?: 'Perfect tomorrow.'; }
function tecknotrove_home_hero_subhead() { return get_option( 'tt_home_hero_subhead' ) ?: 'Building technologies for demanding industries, from full-motion armoured vehicle trainers to airport ground-support simulators.'; }

function tecknotrove_home_why_line1() { return get_option( 'tt_home_why_line1' ) ?: 'Every subsystem.'; }
function tecknotrove_home_why_line2() { return get_option( 'tt_home_why_line2' ) ?: 'One source.'; }
function tecknotrove_home_why_body() { return get_option( 'tt_home_why_body' ) ?: 'Motion platforms, visuals, controls and instructor software are all engineered in-house, so every simulator ships as one integrated system instead of a stack of vendors.'; }

function tecknotrove_home_news() {
	$rows = get_option( 'tt_home_news' );
	if ( is_array( $rows ) && $rows ) return $rows;
	$u = get_template_directory_uri() . '/assets/images/';
	return [
		[ 'title' => 'Tank Driving Simulator delivered to the Indian Army', 'meta' => '12 Aug 2025 · 4 min read', 'image' => $u . 'news-army.jpg' ],
		[ 'title' => 'What we showcased and signed at DefExpo 2025', 'meta' => '02 Jun 2025 · 3 min read', 'image' => $u . 'news-expo.jpg' ],
		[ 'title' => 'Why 6-DOF matters for full-motion training', 'meta' => '21 Apr 2025 · 6 min read', 'image' => $u . 'news-motion.jpg' ],
	];
}

function tecknotrove_home_partners() {
	$rows = get_option( 'tt_home_partners' );
	if ( is_array( $rows ) && $rows ) return $rows;
	return [
		[ 'tag' => 'Partnerships', 'title' => 'Partner With Us', 'desc' => 'Distribution, integration and technology partnerships across our global network.', 'stat_value' => '35+', 'stat_label' => 'Countries', 'cta' => 'Get in Touch', 'href' => '#contact' ],
		[ 'tag' => 'Careers', 'title' => 'Join Our Team', 'desc' => 'Work on full-motion simulation systems, from motion platforms to visuals.', 'stat_value' => '20+', 'stat_label' => 'Years running', 'cta' => 'View Open Roles', 'href' => '#careers' ],
	];
}

function tecknotrove_home_linkedin_followers() { return get_option( 'tt_home_linkedin_followers' ) ?: '9,232'; }
function tecknotrove_home_linkedin_countries() { return get_option( 'tt_home_linkedin_countries' ) ?: '35+'; }

function tecknotrove_home_hashtags() {
	$rows = get_option( 'tt_home_hashtags' );
	if ( is_array( $rows ) && $rows ) return array_column( $rows, 'text' );
	return [ '#Tecknotrove', '#CoalMining', '#MakeInIndia' ];
}

function tecknotrove_home_linkedin_posts() {
	$rows = get_option( 'tt_home_linkedin_posts' );
	if ( is_array( $rows ) && $rows ) return $rows;
	$u = get_template_directory_uri() . '/assets/images/';
	return [
		[ 'time' => '2d', 'text' => 'A single incident during training can cost a coal mine far more than most leaders account for: lost production, investigations, regulatory scrutiny, and above all, the human impact.', 'doc_title' => 'Tecknotrove_Coal_Mining_Incident_Reduction_HSE', 'pages' => 4, 'reactions' => 8, 'image' => $u . 'li-post-1.jpg', 'href' => 'https://www.linkedin.com/posts/tecknotrove-systems-i-pvt-ltd_tecknotrovecoalminingincidentreductionhse-activity-7506952375555739649-5lnD' ],
		[ 'time' => '5d', 'text' => 'How long does it really take for a new operator to become productive? On-site training on live machines is slow and costly. Scenario-based simulation gets crews to full competency up to 4x faster.', 'doc_title' => 'Time-to-Competency_Tecknotrove', 'pages' => 4, 'reactions' => 6, 'image' => $u . 'li-post-2.jpg', 'href' => 'https://www.linkedin.com/posts/tecknotrove-systems-i-pvt-ltd_time-to-competencytecknotrove-activity-7505524623187488770-QzAV' ],
	];
}

function tecknotrove_home_callout_line1() { return get_option( 'tt_home_callout_line1' ) ?: 'See a simulator'; }
function tecknotrove_home_callout_line2() { return get_option( 'tt_home_callout_line2' ) ?: 'in action.'; }
function tecknotrove_home_callout_body() { return get_option( 'tt_home_callout_body' ) ?: 'Visit our Mumbai facility for a live demonstration, or request a virtual walkthrough with our engineering team.'; }
