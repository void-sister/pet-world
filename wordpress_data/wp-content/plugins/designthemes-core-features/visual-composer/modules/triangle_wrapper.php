<?php add_action( 'vc_before_init', 'dt_sc_triangle_wrapper_vc_map' );
function dt_sc_triangle_wrapper_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Triangle wrapper", 'petsworld-core' ),
		"base" => "dt_sc_triangle_wrapper",
		"icon" => "dt_sc_triangle_wrapper",
		"category" => DT_VC_CATEGORY,
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

			# Image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image','petsworld-core'),
                'param_name' => 'image'
            ),

            # Link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Link','petsworld-core'),
                'param_name' => 'link'
            ),

			# Type
			array(
				'type' => 'dropdown',
				'param_name' => 'type',
				'heading' => esc_html__('Type','petsworld-core'),
				'value' => array( esc_html__('Image First','petsworld-core') => '', esc_html__('Details First','petsworld-core') => 'alter' )
			)                        						
		)
	) );	
}?>