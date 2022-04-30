<?php add_action( 'vc_before_init', 'dt_sc_blockquote_vc_map' );
function dt_sc_blockquote_vc_map() {

	global $variations;

	vc_map( array(
		"name" => esc_html__( "Blockquote", 'petsworld-core' ),
            "base" => "dt_sc_blockquote",
		"icon" => "dt_sc_blockquote",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			# Types
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Types', 'petsworld-core' ),
      			'param_name' => 'type',
                        'admin_label' => true,
      			'value' => array( esc_html__('Type 1','petsworld-core') => 'type1', esc_html__('Type 2','petsworld-core') => 'type2', esc_html__('Type 3','petsworld-core') => 'type3',
					esc_html__('Type 4','petsworld-core') => 'type4' ),
      			'description' => esc_html__( 'Select blockquote type', 'petsworld-core' ),
      		),

			# Align
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Align', 'petsworld-core' ),
      			'param_name' => 'align',
                        'admin_label' => true,
                        'value' => array( 
      				esc_html__('None','petsworld-core') => '',
      				esc_html__('Left','petsworld-core') => 'alignleft',
      				esc_html__('Center','petsworld-core') => 'aligncenter',
      				esc_html__('Right','petsworld-core') => 'alignright',
      			),
      			'description' => esc_html__( 'Select blockquote type', 'petsworld-core' ),
      		),

      		# Cite
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Cite", 'petsworld-core' ),
      			"param_name" => "cite"
      		),

      		# Role
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Role", 'petsworld-core' ),
      			"param_name" => "role"
      		),

      		// Content
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__('Content','petsworld-core'),
				'param_name' => 'content',
				'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.'
            ),
			
			# Variation
            array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Color', 'petsworld-core' ),
				'admin_label' => true,
				'param_name' => 'variation',
				'value' => $variations,
				'description' => esc_html__( 'Select Text color', 'petsworld-core' ),
            ),
			
			# Custom Text Color
      		array(
      			'type' => 'colorpicker',
      			'heading' => esc_html__( 'Custom text color', 'petsworld-core' ),
      			'param_name' => 'textcolor',
				'dependency' => array( 'element' => 'variation', 'value' =>'-' ),
      			'description' => esc_html__( 'Select text color', 'petsworld-core' ),
      		)
		)
	) );	
} ?>