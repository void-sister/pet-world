<?php add_action( 'vc_before_init', 'dt_sc_horizontal_timeline_vc_map' );
function dt_sc_horizontal_timeline_vc_map() {

	class WPBakeryShortCode_dt_sc_horizontal_timeline extends WPBakeryShortCodesContainer {
	}
	class WPBakeryShortCode_dt_sc_hr_timeline_entry extends WPBakeryShortCode {
	}

	vc_map( array(
		"name" => esc_html__( "Horizontal timeline", 'petsworld-core' ),
		"base" => "dt_sc_horizontal_timeline",
		"icon" => "dt_sc_horizontal_timeline",
		"category" => DT_VC_CATEGORY,
		"content_element" => true,
		"js_view" => 'VcColumnView',
		'as_parent' => array( 'only' => 'dt_sc_hr_timeline_entry' ),
		'description' => esc_html__( 'Tabbed content', 'petsworld-core' ),		
		"params" => array(

			// Type
			array(
				'type' => 'dropdown',
				'param_name' => 'type',
      			'admin_label' => true,
				'value' => array(
					esc_html__( 'Type 1', 'petsworld-core' ) => 'type1',
					esc_html__( 'Type 2', 'petsworld-core' ) => 'type2',
				),
				'std' => 'type1',
				'heading' => esc_html__( 'Type', 'petsworld-core' ),
			),

			// Column
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Columns','petsworld-core'),
				'param_name' => 'column',
				'value' => array(
					esc_html__('II Columns','petsworld-core') => 2 ,
					esc_html__('III Columns','petsworld-core') => 3,
					esc_html__('IV Columns','petsworld-core') => 4,
				),
				'std' => '3'
			),

			# Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Extra class name", 'petsworld-core' ),
      			"param_name" => "class",
      			'description' => esc_html__('Style particular icon box element differently - add a class name and refer to it in custom CSS','petsworld-core')
      		)									
		)		
	) );
}?>