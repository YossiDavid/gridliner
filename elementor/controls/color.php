<?php

class Color_Control extends \Elementor\Base_Data_Control
{

	public function get_type(): string
	{
		return 'shos_color';
	}

	public function content_template(): void
	{
		$control_uid = $this->get_control_uid();

?>

		<div class="elementor-control-field">
			<# if ( data.label ) {#>
				<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<# } #>

			<div class="elementor-control-input-wrapper elementor-control-unit-5 elementor-control-dynamic-switcher-wrapper">
				<input id="<?php echo $control_uid; ?>" type="{{ data.input_type }}" class="tooltip-target elementor-control-tag-area" data-tooltip="{{ data.title }}" title="{{ data.title }}" data-setting="{{ data.name }}" />
			</div>
		</div>

<?php
	}

	public function enqueue(): void
	{

		// Styles
		wp_register_style('color-picker-style', plugins_url('./src/color-control.css', GRIDLINER_URL));
		wp_enqueue_style('color-picker-style');

		// Scripts
		// wp_register_script( 'control-script', plugins_url( 'assets/js/control-script.js', __FILE__ ) );
		// wp_enqueue_script( 'control-script' );

	}
}
