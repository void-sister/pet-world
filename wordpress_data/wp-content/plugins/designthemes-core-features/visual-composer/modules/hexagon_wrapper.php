<?php add_action( 'vc_before_init', 'dt_sc_hexagon_wrapper_vc_map' );
function dt_sc_hexagon_wrapper_vc_map() {

	class WPBakeryShortCode_dt_sc_hexagon_wrapper extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_dt_sc_hexagon_item extends WPBakeryShortCode {
	}

	vc_map( array(
		"name" => esc_html__( "Hexagon", 'petsworld-core' ),
		"base" => "dt_sc_hexagon_wrapper",
		"icon" => "dt_sc_hexagon_wrapper",
		"category" => DT_VC_CATEGORY,
		"content_element" => true,
		"js_view" => 'VcColumnView',
		'as_parent' => array( 'only' => 'dt_sc_hexagon_item' ),
		'description' => esc_html__( 'Hexagon wrapper', 'petsworld-core' ),
		"params" => array(

			# Title
			array(
				'type' => 'textfield',
				'param_name' => 'title',
				'heading' => esc_html__( 'Title', 'petsworld-core' ),
				'description' => esc_html__( 'Enter title', 'petsworld-core' )
			),

			# Sub Title
			array(
				'type' => 'textfield',
				'param_name' => 'subtitle',
				'heading' => esc_html__( 'Sub title', 'petsworld-core' ),
				'description' => esc_html__( 'Enter sub title', 'petsworld-core' )
			),

			# Extra Sub Title
			array(
				'type' => 'textfield',
				'param_name' => 'extratitle',
				'heading' => esc_html__( 'Extra sub title', 'petsworld-core' ),
				'description' => esc_html__( 'Enter extra sub title', 'petsworld-core' )
			),

			# Image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image','petsworld-core'),
                'param_name' => 'image'
            )												
		)
	) );
}?>