<?php add_action( 'vc_before_init', 'dt_sc_tooltip_vc_map' );
function dt_sc_tooltip_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Tooltip", 'petsworld-core' ),
		"base" => "dt_sc_tooltip",
		"icon" => "dt_sc_tooltip",
		"category" => DT_VC_CATEGORY,
		'description' => esc_html__( 'Section for Tooltips', 'petsworld-core' ),
		"params" => array(

			// Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type', 'petsworld-core'),
				'param_name' => 'type',
				'admin_label' => true,
				'value' => array(
					esc_html__('Default','petsworld-core') => '',
					esc_html__('Boxed','petsworld-core') => 'boxed',
				),
				'std' => ''
			),

			// Position
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Position', 'petsworld-core'),
				'param_name' => 'position',
				'admin_label' => true,
				'value' => array(
					esc_html__('Top','petsworld-core') => 'top',
					esc_html__('Right','petsworld-core') => 'right',
					esc_html__('Bottom','petsworld-core') => 'bottom',
					esc_html__('Left','petsworld-core') => 'left',
				),
				'std' => 'top'
			),

			// BG Color
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Background Color", 'petsworld-core' ),
				"param_name" => "bgcolor",
				"description" => esc_html__( "Select tooltip background color", 'petsworld-core' ),
				'value' =>'#000000',
				'dependency' => array( 'element' => 'type', 'value' =>'boxed' )

      		),

			// Text Color
			array(
				"type" => "colorpicker",
				"heading" => esc_html__( "Text Color", 'petsworld-core' ),
				"param_name" => "textcolor",
				"description" => esc_html__( "Select tooltip text color", 'petsworld-core' ),
				"value" => '#ffffff',
				'dependency' => array( 'element' => 'type', 'value' =>'boxed' )
      		),

      		# URL
      		array(
      			'type' => 'vc_link',
      			'heading' => esc_html__( 'URL (Link)', 'petsworld-core' ),
      			'param_name' => 'link',
      			'description' => esc_html__( 'Add tooltip link', 'petsworld-core' )
      		),

      		# Content
      		array(
      			'type' => 'textarea_html',
      			'heading' => esc_html__( 'Content', 'petsworld-core' ),
      			'param_name' => 'content',
      			'value' => 'Lorem ipsum dolor sit amet'
      		),      		
		)
	) );
}?>