<?php add_action( 'vc_before_init', 'dt_sc_donutchart_vc_map' );
function dt_sc_donutchart_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Donut chart", 'petsworld-core' ),
		"base" => "dt_sc_donutchart",
		"icon" => "dt_sc_donutchart",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Label			
			array(
				"type" => "textfield",
      			'admin_label' => true,
      			"heading" => esc_html__( "Label", 'petsworld-core' ),
      			"param_name" => "title",
      			"description" => esc_html__( "Enter text used as title of donut chart", 'petsworld-core' ),
      		),

			// Size
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Size', 'petsworld-core'),
				'param_name' => 'size',
				'admin_label' => true,
				'value' => array(
					esc_html__('Small','petsworld-core') => 'small',
					esc_html__('Medium','petsworld-core') => 'medium',
					esc_html__('Large','petsworld-core') => 'large'					
				),
				'std' => 'medium'
			),

			// Datasize
			array(
				"type" => "textfield",
      			"heading" => esc_html__( "Data size", 'petsworld-core' ),
      			"param_name" => "datasize",
      			'value' => 100,
      			"description" => esc_html__( "Enter data size", 'petsworld-core' ),
      		),

			// Datasize
			array(
				"type" => "textfield",
      			"heading" => esc_html__( "Data size", 'petsworld-core' ),
      			"param_name" => "datapercent",
      			'value' => 60,
      			"description" => esc_html__( "Enter data percentage eg: 70% , give 70 only", 'petsworld-core' ),
      		),

			// BG Color			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Background color", 'petsworld-core' ),
      			"param_name" => "bgcolor",
      			"description" => esc_html__( "Select chart background color", 'petsworld-core' ),
      			'value' => '#79deff'
      		),

			// FG Color			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Foreground color", 'petsworld-core' ),
      			"param_name" => "fgcolor",
      			"description" => esc_html__( "Select chart foreground color", 'petsworld-core' ),
      			'value' => '#666666'
      		)      		      		      					
		)
	) );
}?>