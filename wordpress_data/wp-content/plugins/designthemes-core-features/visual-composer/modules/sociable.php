<?php add_action( 'vc_before_init', 'dt_sc_sociable_vc_map' );
function dt_sc_sociable_vc_map() {

	vc_map( array(
		"name" => esc_html__( "Sociable", 'petsworld-core' ),
		"base" => "dt_sc_sociable",
		"icon" => "dt_sc_sociable",
		"category" => DT_VC_CATEGORY,
		"description" => esc_html__("To show sociables configured in admin panel, Pets World Options -> Layout -> Sociable",'petsworld-core'),
		"params" => array(

			# Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Extra class name", 'petsworld-core' ),
      			"param_name" => "class",
      			'description' => esc_html__('Style particular element differently - add a class name and refer to it in custom CSS','petsworld-core')
      		),

      		# Target
		  array(
		        "type" => "textfield",
		        "heading" => esc_html__( "Enter the icon link target", 'petsworld-core' ),
		        "param_name" => "target",
		        'description' => esc_html__('You can add a link target here e.g: _blank','petsworld-core')
		  )
		)
	) );
} ?>