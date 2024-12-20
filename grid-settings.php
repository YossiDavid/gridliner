<?php
if (!defined('ABSPATH')) exit;

/**
 * @param \Elementor\Core\Settings\EditorPreferences\Model $preferences The editor preferences model.
 */
function add_preferences_controls(\Elementor\Core\Settings\EditorPreferences\Model $preferences)
{
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
			'default' => 'no',
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

	$preferences->add_control(
		'styliner_columns_color',
		[
			'label' => esc_html__('Columns Color', 'textdomain'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => "#ff00000A",
			'condition' => [
				'styliner_grid' => 'yes'
			]
		]
	);

	$preferences->add_control(
		'styliner_rows_color',
		[
			'label' => esc_html__('Rows Color', 'textdomain'),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => "#ff00000A",
			'condition' => [
				'styliner_grid' => 'yes'
			]
		]
	);

	$preferences->end_injection();
}
add_action('elementor/element/editor-preferences/preferences/before_section_end', 'add_preferences_controls');
