<?php add_action( 'vc_before_init', 'dt_sc_progress_bar_vc_map' );
function dt_sc_progress_bar_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Progress Bar", 'petsworld-core' ),
		"base" => "dt_sc_progress_bar",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Style
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Style', 'petsworld-core'),
				'param_name' => 'type',
				'admin_label' => true,
				'value' => array(
					esc_html__('Standard','petsworld-core') => 'standard',
					esc_html__('Striped','petsworld-core') => 'progress-striped',
					esc_html__('Active Striped','petsworld-core') => 'progress-striped-active'					
				),
				'std' => 'progress-striped'
			),

			// Label			
			array(
				"type" => "textfield",
      			'admin_label' => true,
      			"heading" => esc_html__( "Label", 'petsworld-core' ),
      			"param_name" => "text",
      			"description" => esc_html__( "Enter text used as title of bar", 'petsworld-core' ),
      		),

			// Value			
			array(
				"type" => "textfield",
      			'admin_label' => true,
      			"heading" => esc_html__( "Value", 'petsworld-core' ),
      			"param_name" => "value",
      			"description" => esc_html__( "Enter value of bar", 'petsworld-core' ),
      		),

			// Colorpicker			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Color", 'petsworld-core' ),
      			"param_name" => "color",
      			"description" => esc_html__( "Select bar background color", 'petsworld-core' ),
      		),      				
		)
	) );
}?>