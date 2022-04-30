<?php
add_action( 'vc_before_init', 'dt_sc_google_map_vc_map' );
function dt_sc_google_map_vc_map() {

	vc_map( array(
		"name" => esc_html__( "Google Map", 'petsworld-core' ),
		"base" => "dt_sc_google_map",
		"category" => DT_VC_CATEGORY,
		"class" => "dt_vc_style",
		"icon" => "dt_sc_google_map",
		'as_parent' => array( 'only' => 'dt_sc_google_map_marker' ),
		"content_element" => true,
		"params" => array(

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Map Type', 'petsworld-core' ),
      			'param_name' => 'map_type',
      			'value' => array(
      				esc_html__('Roadmap','petsworld-core') => 'roadmap',
      				esc_html__('Satellite','petsworld-core') => 'satellite',
      				esc_html__('Terrain','petsworld-core') => 'terrain',
      				esc_html__('Hybrid','petsworld-core') => 'hybrid'
      			),
				'save_always' => true,
      			'description' => esc_html__( 'The popup window which appears when a marker is clicked.', 'petsworld-core' ),				
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Map Style', 'petsworld-core' ),
      			'param_name' => 'map_style',
      			'value' => array(
      				esc_html__('Default','petsworld-core') => '',
      				esc_html__('Custom','petsworld-core') => 'custom',
					esc_html__('Style 1','petsworld-core') => '1',
					esc_html__('Style 2','petsworld-core') => '2',
					esc_html__('Style 3','petsworld-core') => '3',
					esc_html__('Style 4','petsworld-core') => '4',
					esc_html__('Style 5','petsworld-core') => '5',
					esc_html__('Style 6','petsworld-core') => '6',
					esc_html__('Style 7','petsworld-core') => '7',
					esc_html__('Style 8','petsworld-core') => '8',
					esc_html__('Style 9','petsworld-core') => '9',
					esc_html__('Style 10','petsworld-core') => '10',
					esc_html__('Style 11','petsworld-core') => '11',
					esc_html__('Style 12','petsworld-core') => '12',
					esc_html__('Style 13','petsworld-core') => '13',
					esc_html__('Style 14','petsworld-core') => '14',
					esc_html__('Style 15','petsworld-core') => '15',
					esc_html__('Style 16','petsworld-core') => '16',
					esc_html__('Style 17','petsworld-core') => '17',
					esc_html__('Style 18','petsworld-core') => '18',
					esc_html__('Style 19','petsworld-core') => '19',
					esc_html__('Style 20','petsworld-core') => '20',
					esc_html__('Style 21','petsworld-core') => '21',
					esc_html__('Style 22','petsworld-core') => '22',
					esc_html__('Style 23','petsworld-core') => '23',
					esc_html__('Style 24','petsworld-core') => '24',
					esc_html__('Style 25','petsworld-core') => '25',
					esc_html__('Style 26','petsworld-core') => '26',
					esc_html__('Style 27','petsworld-core') => '27',
					esc_html__('Style 28','petsworld-core') => '28',
					esc_html__('Style 29','petsworld-core') => '29',
					esc_html__('Style 30','petsworld-core') => '30',
					esc_html__('Style 31','petsworld-core') => '31',
					esc_html__('Style 32','petsworld-core') => '32',
					esc_html__('Style 33','petsworld-core') => '33',
					esc_html__('Style 34','petsworld-core') => '34',
					esc_html__('Style 35','petsworld-core') => '35',
					esc_html__('Style 36','petsworld-core') => '36',
					esc_html__('Style 37','petsworld-core') => '37',
					esc_html__('Style 38','petsworld-core') => '38',
					esc_html__('Style 39','petsworld-core') => '39',
					esc_html__('Style 40','petsworld-core') => '40',
					esc_html__('Style 41','petsworld-core') => '41',
					esc_html__('Style 42','petsworld-core') => '42',
					esc_html__('Style 43','petsworld-core') => '43',
					esc_html__('Style 44','petsworld-core') => '44',
					esc_html__('Style 45','petsworld-core') => '45',
					esc_html__('Style 46','petsworld-core') => '46',
					esc_html__('Style 47','petsworld-core') => '47',
					esc_html__('Style 48','petsworld-core') => '48',
					esc_html__('Style 49','petsworld-core') => '49',
					esc_html__('Style 50','petsworld-core') => '50',      				
      			),
      			'description' => esc_html__( 'Choose map custom style.', 'petsworld-core' ),				
			),

			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Custom Style", 'petsworld-core' ),
      			"param_name" => "custom_map_style",
      			"description" => esc_html__( "Select custom color for map", 'petsworld-core' ),
				'dependency' => array( 'element' => 'map_style', 'value' =>'custom' )				
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Map Width', 'petsworld-core' ),
				'param_name' => 'map_width',
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '100%',
      			'description' => esc_html__( 'In px or % , 100% for a responsive map.', 'petsworld-core' ),
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Map Height', 'petsworld-core' ),
				'param_name' => 'map_height',
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-6',
				'value' => '500px',
      			'description' => esc_html__( 'In px or % ,eg: 500px or 30%.', 'petsworld-core' ),
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Map Zoom Level', 'petsworld-core' ),
      			'param_name' => 'map_zoom_level',
      			'value' => array( 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20),
				'save_always' => true,
				'std' => 13
			),			

			// Controls
			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Street View Control', 'petsworld-core' ),
      			'param_name' => 'map_street_view_control',
				'edit_field_class' => 'vc_col-sm-6',
      			'value' => array(
      				esc_html__('Enable','petsworld-core') => 'enable',
      				esc_html__('Disable','petsworld-core') => 'disable'
      			),
				'save_always' => true,
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Map Type Control', 'petsworld-core' ),
      			'param_name' => 'map_type_control',
				'edit_field_class' => 'vc_col-sm-6',
      			'value' => array(
      				esc_html__('Enable','petsworld-core') => 'enable',
      				esc_html__('Disable','petsworld-core') => 'disable'
      			),
				'save_always' => true,
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Zoom Control', 'petsworld-core' ),
      			'param_name' => 'map_zoom_control',
				'edit_field_class' => 'vc_col-sm-6',
      			'value' => array(
      				esc_html__('Enable','petsworld-core') => 'enable',
      				esc_html__('Disable','petsworld-core') => 'disable'
      			),
				'save_always' => true,
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Scale Control', 'petsworld-core' ),
      			'param_name' => 'map_scale_control',
				'edit_field_class' => 'vc_col-sm-6',
      			'value' => array(
      				esc_html__('Enable','petsworld-core') => 'enable',
      				esc_html__('Disable','petsworld-core') => 'disable'
      			),
				'save_always' => true,
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Scroll wheel', 'petsworld-core' ),
      			'param_name' => 'map_scroll_wheel',
				'edit_field_class' => 'vc_col-sm-6',
      			'value' => array(
      				esc_html__('Enable','petsworld-core') => 'enable',
      				esc_html__('Disable','petsworld-core') => 'disable'
      			),
				'save_always' => true,
			),

			array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( ' Draggable?', 'petsworld-core' ),
      			'param_name' => 'map_draggable',
				'edit_field_class' => 'vc_col-sm-6',
      			'value' => array(
      				esc_html__('Enable','petsworld-core') => 'enable',
      				esc_html__('Disable','petsworld-core') => 'disable'
      			),
				'save_always' => true,
			),

			vc_map_add_css_animation(),

			array(
				"type" => "textfield",
				"heading" => __("Animation delay ( optional )", 'petsworld-core'),
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'petsworld-core')
			),			
			// Controls
			
			// Markers
			array(
				'type' => 'param_group',
				'param_name' => 'map_markers',
				'group' => esc_html__( 'Markers', 'petsworld-core' ),
				'params' => array(

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Latitude', 'petsworld-core' ),
						'param_name' => 'marker_latitude',
						'save_always' => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Longitude', 'petsworld-core' ),
						'param_name' => 'marker_longitude',
						'save_always' => true
					),

					array(
						'type' => 'textarea_raw_html',
						'heading' => esc_html__('Content', 'petsworld-core'),
						'param_name' => 'marker_content',
					),

					array(
		      			'type' => 'dropdown',
		      			'heading' => esc_html__( 'Icon', 'petsworld-core' ),
		      			'param_name' => 'marker_icon',
						'save_always' => true,
		      			'value' => array( 
		      				esc_html__('Built in','petsworld-core') => 'pin.png',
		      				esc_html__('Custom','petsworld-core') => 'custom',
		      				esc_html__('Black','petsworld-core') => 'black.png',
		      				esc_html__('Blue','petsworld-core') => 'blue.png',
		      				esc_html__('Gray','petsworld-core') => 'gray.png',
		      				esc_html__('Green','petsworld-core') => 'green.png',
		      				esc_html__('Magenta','petsworld-core') => 'magenta.png',
		      				esc_html__('Orange','petsworld-core') => 'orange.png',
		      				esc_html__('Purple','petsworld-core') => 'purple.png',
		      				esc_html__('Red','petsworld-core') => 'red.png',
		      				esc_html__('White','petsworld-core') => 'white.png',
		      				esc_html__('Yellow','petsworld-core') => 'yellow.png',
		      			),
		      			'description' => esc_html__( 'Select marker icon', 'petsworld-core' ),
		      			'std' => 'green.png',
					),

					array(
						"type" => "attach_image",
		      			"heading" => esc_html__( "Custom Marker icon", 'petsworld-core' ),
		      			"param_name" => "custom_marker_icon",
		      			"group" => esc_html__( 'Marker', 'petsworld-core' ),
		      			"description" => esc_html__( "Select custom marker icon", 'petsworld-core' ),
						'dependency' => array( 'element' => 'marker_icon', 'value' =>'custom' )				
					),

					array(
		      			'type' => 'dropdown',
		      			'heading' => esc_html__( 'Popup Window', 'petsworld-core' ),
		      			'group' => esc_html__( 'Marker', 'petsworld-core' ),
		      			'param_name' => 'popup',
		      			'value' => array(
		      				esc_html__('Hidden','petsworld-core') => 'hidden',
		      				esc_html__('Visible','petsworld-core') => 'visible'
		      			),
						'save_always' => true,
		      			'description' => esc_html__( 'The popup window which appears when a marker is clicked.', 'petsworld-core' ),
					),
				)
			)
			// markers
		)
	) );
}
