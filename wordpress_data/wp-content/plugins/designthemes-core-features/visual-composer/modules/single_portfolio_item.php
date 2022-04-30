<?php add_action( 'vc_before_init', 'dt_sc_portfolio_item_vc_map' );
function dt_sc_portfolio_item_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Single Portfolio Item", 'petsworld-core' ),
		"base" => "dt_sc_portfolio_item",
		"icon" => "dt_sc_portfolio_item",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Post ID
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'ID', 'petsworld-core' ),
				'param_name' => 'id',
				'description' => esc_html__( 'Enter post ID', 'petsworld-core' ),
				'admin_label' => true
			),

			// Post style
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Style','petsworld-core'),
				'param_name' => 'style',
				'value' => array(
					esc_html__('Modern Title','petsworld-core') => 'type1', 
					esc_html__('Title & Icons Overlay','petsworld-core') => 'type2', 
					esc_html__('Title Overlay','petsworld-core') => 'type3', 
					esc_html__('Icons Only','petsworld-core') => 'type4', 
					esc_html__('Classic','petsworld-core') => 'type5', 
					esc_html__('Minimal Icons','petsworld-core') => 'type6', 
					esc_html__('Presentation','petsworld-core') => 'type7', 
					esc_html__('Girly','petsworld-core') => 'type8', 
					esc_html__('Art','petsworld-core') => 'type9' 
				),
				'std' => 'type1'
			)
		)
	) );
}?>