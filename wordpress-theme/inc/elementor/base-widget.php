<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Repeater;

/**
 * Generic widget: controls come from the field list in definitions.php,
 * and render() hands the collected values to that definition's callback.
 */
abstract class TT_Widget extends \Elementor\Widget_Base {
	const NAME = '';

	protected function tt_def() { return tecknotrove_el_defs()[ static::NAME ]; }

	public function get_name() { return static::NAME; }
	public function get_title() { return $this->tt_def()['title']; }
	public function get_icon() { return $this->tt_def()['icon'] ?? 'eicon-section'; }
	public function get_categories() { return [ 'tecknotrove' ]; }
	public function get_keywords() { return [ 'tecknotrove', 'section' ]; }

	/** Build one Elementor control from a field array. */
	private function tt_control_args( $f ) {
		$map = [
			'text'     => Controls_Manager::TEXT,
			'textarea' => Controls_Manager::TEXTAREA,
			'wysiwyg'  => Controls_Manager::WYSIWYG,
			'image'    => Controls_Manager::MEDIA,
			'color'    => Controls_Manager::COLOR,
			'url'      => Controls_Manager::URL,
			'number'   => Controls_Manager::NUMBER,
			'select'   => Controls_Manager::SELECT,
			'switch'   => Controls_Manager::SWITCHER,
		];
		$type = $f['type'] ?? 'text';
		$args = [ 'label' => $f['label'] ?? $f['id'], 'type' => $map[ $type ] ?? Controls_Manager::TEXT ];
		$d = $f['default'] ?? null;
		if ( 'image' === $type ) {
			$args['default'] = [ 'url' => $d ?: '' ];
		} elseif ( 'url' === $type ) {
			$args['default'] = [ 'url' => $d ?: '' ];
			$args['label_block'] = true;
		} elseif ( null !== $d ) {
			$args['default'] = $d;
		}
		if ( 'select' === $type ) $args['options'] = $f['options'] ?? [];
		if ( in_array( $type, [ 'text', 'textarea' ], true ) ) $args['label_block'] = true;
		if ( 'textarea' === $type ) $args['rows'] = 3;
		return $args;
	}

	protected function register_controls() {
		$def  = $this->tt_def();
		$open = false;
		$n    = 0;
		foreach ( $def['fields'] as $f ) {
			if ( isset( $f['section'] ) ) {
				if ( $open ) $this->end_controls_section();
				$this->start_controls_section( 's' . ( ++$n ), [ 'label' => $f['section'], 'tab' => Controls_Manager::TAB_CONTENT ] );
				$open = true;
				continue;
			}
			if ( ! $open ) {
				$this->start_controls_section( 's' . ( ++$n ), [ 'label' => 'Content', 'tab' => Controls_Manager::TAB_CONTENT ] );
				$open = true;
			}
			if ( 'repeater' === ( $f['type'] ?? '' ) ) {
				$rep = new Repeater();
				foreach ( $f['fields'] as $sf ) {
					$rep->add_control( $sf['id'], $this->tt_control_args( $sf ) );
				}
				$this->add_control( $f['id'], [
					'label'       => $f['label'] ?? $f['id'],
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $rep->get_controls(),
					'default'     => $this->tt_repeater_default( $f ),
					'title_field' => '{{{ ' . ( $f['title_field'] ?? $f['fields'][0]['id'] ) . ' }}}',
				] );
			} else {
				$this->add_control( $f['id'], $this->tt_control_args( $f ) );
			}
		}
		if ( $open ) $this->end_controls_section();
	}

	/** Defaults for repeaters: images/urls need the control's array shape. */
	private function tt_repeater_default( $f ) {
		$rows = [];
		foreach ( $f['default'] ?? [] as $row ) {
			foreach ( $f['fields'] as $sf ) {
				$t = $sf['type'] ?? 'text';
				if ( ( 'image' === $t || 'url' === $t ) && isset( $row[ $sf['id'] ] ) && ! is_array( $row[ $sf['id'] ] ) ) {
					$row[ $sf['id'] ] = [ 'url' => $row[ $sf['id'] ] ];
				}
			}
			$rows[] = $row;
		}
		return $rows;
	}

	private function tt_value( $f, $raw ) {
		$t = $f['type'] ?? 'text';
		if ( 'image' === $t || 'url' === $t ) return is_array( $raw ) ? ( $raw['url'] ?? '' ) : (string) $raw;
		return $raw;
	}

	/** Settings to plain values: images/links become URL strings, repeaters lists of arrays. */
	protected function tt_values() {
		$s   = $this->get_settings_for_display();
		$out = [];
		foreach ( $this->tt_def()['fields'] as $f ) {
			if ( isset( $f['section'] ) ) continue;
			$raw = $s[ $f['id'] ] ?? ( $f['default'] ?? '' );
			if ( 'repeater' === ( $f['type'] ?? '' ) ) {
				$rows = [];
				foreach ( (array) $raw as $row ) {
					$r = [];
					foreach ( $f['fields'] as $sf ) {
						$r[ $sf['id'] ] = $this->tt_value( $sf, $row[ $sf['id'] ] ?? '' );
					}
					$rows[] = $r;
				}
				$out[ $f['id'] ] = $rows;
			} else {
				$out[ $f['id'] ] = $this->tt_value( $f, $raw );
			}
		}
		return $out;
	}

	protected function render() {
		call_user_func( $this->tt_def()['render'], $this->tt_values(), $this );
	}
}
