<?php add_action( 'vc_before_init', 'dt_sc_portfolios_vc_map' );
function dt_sc_portfolios_vc_map() {

	$arr = array( esc_html__('Yes','petsworld-core') => 'yes', esc_html__('No','petsworld-core') => 'no' );

	vc_map( array(
		"name" => esc_html__( "Portfolio Items", 'petsworld-core' ),
		"base" => "dt_sc_portfolios",
		"icon" => "dt_sc_portfolios",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Post Count
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Post Counts', 'petsworld-core' ),
				'param_name' => 'count',
				'description' => esc_html__( 'Enter post count', 'petsworld-core' ),
				'admin_label' => true
			),

			// Post column
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
				'std' => 'type1',
				'admin_label' => true
			),

			// Allow Grid Space
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Allow Grid Space','petsworld-core'),
				'param_name' => 'allow_gridspace',
				'value' => $arr
			),

			// Allow Filter
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Allow Filter','petsworld-core'),
				'param_name' => 'allow_filter',
				'value' => $arr
			),

			// Term ID(s)
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Terms', 'petsworld-core' ),
				'param_name' => 'terms',
				'description' => esc_html__( 'Enter Portfolio Terms', 'petsworld-core' )
			),						
		)
	) );
} ?>