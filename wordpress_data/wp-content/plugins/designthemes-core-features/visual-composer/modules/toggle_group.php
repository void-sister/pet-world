<?php add_action( 'vc_before_init', 'dt_sc_toggle_group_vc_map' );
function dt_sc_toggle_group_vc_map() {

	class WPBakeryShortCode_dt_sc_toggle_group extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_dt_sc_toggle extends WPBakeryShortCode {
	}

	vc_map( array(
		"name" => esc_html__( "Toggles", 'petsworld-core' ),
		"base" => "dt_sc_toggle_group",
		"icon" => "dt_sc_toggle_group",
		"category" => DT_VC_CATEGORY,
		"content_element" => true,
		"js_view" => 'VcColumnView',
		'as_parent' => array( 'only' => 'dt_sc_toggle' ),
		'description' => esc_html__( 'Toggle', 'petsworld-core' ),
		"params" => array(

			// Style
			array(
				'type' => 'dropdown',
				'param_name' => 'style',
				'value' => array(
					esc_html__( 'Default', 'petsworld-core' ) => 'default',
					esc_html__( 'Frame', 'petsworld-core' ) => 'frame',
				),
      			'admin_label' => true,
				'heading' => esc_html__( 'Style', 'petsworld-core' ),
				'description' => esc_html__( 'Select toggles display style', 'petsworld-core' )
			),

			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'type',
				'value' => array(
					esc_html__(' Type 1','petsworld-core') => 'type1',
					esc_html__(' Type 2','petsworld-core') => 'type2'
				),
				'heading' => esc_html__( 'Type', 'petsworld-core' ),
				'description' => esc_html__( 'Select framed toggles display type', 'petsworld-core' ),
				'dependency' => array( 'element' => 'style', 'value' => 'frame')
			),

			# Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Extra class name", 'petsworld-core' ),
      			"param_name" => "class",
      			'description' => esc_html__('Style particular element differently - add a class name and refer to it in custom CSS','petsworld-core')
      		)			
		)
	) );
}?>