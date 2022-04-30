<?php
add_action( 'vc_before_init', 'dt_sc_filterable_pets_vc_map' );
function dt_sc_filterable_pets_vc_map() {

	vc_map( array(
		"name" => esc_html__("Filterable Pets", 'petsworld-core'),
		"base" => "dt_sc_pets_with_filter",
		"icon" => "dt_sc_pets_with_filter",
		"category" => DT_VC_CATEGORY,
		'description' => esc_html__("To Show pets with filterable option", 'petsworld-core'),
		"params" => array(
			array( 
				'type' => 'dropdown',
				'param_name' => 'column',
				'value' => array(
					esc_html__('I Column','petsworld-core') => 1,
					esc_html__('II Columns','petsworld-core') => 2 ,
					esc_html__('III Columns','petsworld-core') => 3,
					esc_html__('IV Columns','petsworld-core') => 4
				),
      			'admin_label' => true,
      			'std' => 3,
				'heading' => esc_html__( 'Layout', 'petsworld-core' ),
				'description' => esc_html__( 'Select filterable pet display layout.', 'petsworld-core' )				
			)			
		)
	) );
}?>