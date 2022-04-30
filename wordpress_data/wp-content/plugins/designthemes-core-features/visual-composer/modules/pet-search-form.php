<?php add_action( 'vc_before_init', 'dt_sc_pet_search_form_vc_map' );
function dt_sc_pet_search_form_vc_map() {
	
	vc_map( array( 
		"name" => esc_html__( "Pet Search Form", 'petsworld-core' ),
		"base" => "dt_sc_pet_search_form",
		"icon" => "dt_sc_pet_search_form",
		"category" => DT_VC_CATEGORY,
		"show_settings_on_create" => false,
		"params" => array(
		
			// Result column
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Result Columns Layout','petsworld-core'),
				'param_name' => 'column',
				'value' => array(
					esc_html__('I Column','petsworld-core') => 1,
					esc_html__('II Columns','petsworld-core') => 2 ,
					esc_html__('III Columns','petsworld-core') => 3
				),
				'std' => 2
			)
		)
	) );
}