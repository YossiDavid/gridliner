<?php
if (!defined('ABSPATH')) exit;

/**
 * @param \Elementor\Core\Settings\EditorPreferences\Model $preferences The editor preferences model.
 */
function add_preferences_controls(\Elementor\Core\Settings\EditorPreferences\Model $preferences)
{

	$styliner_grid = get_user_meta(get_current_user_id(), 'styliner_grid', true);

	$styliner_grid = $styliner_grid ? 'yes' : 'no';
	// $grid_color = $grid_color ? $grid_color : 'rgb(255 0 0 / .15)';
	// $columns_color = $columns_color ? $columns_color : 'rgb(255 0 0 / .04)';
	// $rows_color = $rows_color ? $rows_color : 'rgb(255 0 0 / .04)';
	$preferences->start_injection(
		[
			'at' => 'after',
			'of' => 'show_hidden_elements',
		]
	);

	$preferences->add_control(
		'styliner_grid',
		[
			'label' => esc_html__('Enable Styliner Grid', 'textdomain'),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'default' => $styliner_grid,
			'selectors' => [
				'#styliner-grid-system' => 'display: block !important;'
			]
		]
	);

	$preferences->add_control(
		'width',
		[
			'label' => esc_html__( 'Grid Opacity', 'textdomain' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'min' => 0,
				'max' => 100,
			],
			'default' => [
				'size' => 100,
			],
			'selectors' => [
				'#styliner-grid-system' => 'opacity: {{UNIT}};',
			],
		]
	);

	$preferences->end_injection();
	// $preferences->add_control(
	// 	'grid_color',
	// 	[
	// 		'label' => esc_html__('Grids Color', 'textdomain'),
	// 		'type' => \Elementor\Controls_Manager::COLOR,
	// 		'default' => $grid_color,
	// 		'frontend_available' => true,
	// 	]
	// );

	// $preferences->add_control(
	// 	'columns_color',
	// 	[
	// 		'label' => esc_html__('Columns Color', 'textdomain'),
	// 		'type' => \Elementor\Controls_Manager::COLOR,
	// 		'default' => $columns_color,
	// 		'frontend_available' => true,
	// 	]
	// );

	// $preferences->add_control(
	// 	'rows_color',
	// 	[
	// 		'label' => esc_html__('Rows Color', 'textdomain'),
	// 		'type' => \Elementor\Controls_Manager::COLOR,
	// 		'default' => $rows_color,
	// 		'frontend_available' => true,
	// 	]
	// );
}
add_action('elementor/element/editor-preferences/preferences/before_section_end', 'add_preferences_controls');
