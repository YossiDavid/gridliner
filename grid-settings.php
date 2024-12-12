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
		'styliner_grid_color',
		[
			'label' => esc_html__('Grid Color', 'textdomain'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => "#ff000026",
			'condition' => [
				'styliner_grid' => 'yes'
			]
		]
	);

	$preferences->end_injection();
}
add_action('elementor/element/editor-preferences/preferences/before_section_end', 'add_preferences_controls');
