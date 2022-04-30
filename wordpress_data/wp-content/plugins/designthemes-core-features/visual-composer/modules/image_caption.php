<?php add_action( 'vc_before_init', 'dt_sc_image_caption_vc_map' );
function dt_sc_image_caption_vc_map() {

	vc_map( array(
		"name" => esc_html__("Image Caption", 'petsworld-core'),
		"base" => "dt_sc_image_caption",
		"icon" => "dt_sc_image_caption",
		"category" => DT_VC_CATEGORY,
		"description" => esc_html__("Add different types of image caption",'petsworld-core'),
		"params" => array(

			# Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Type', 'petsworld-core'),
				'param_name' => 'type',
				'value' => array( esc_html__('Type 1','petsworld-core') => 'type1',
					esc_html__('Type 2','petsworld-core') => 'type2',
					esc_html__('Type 3','petsworld-core') => 'type3',
					esc_html__('Type 4','petsworld-core') => 'type4',
					esc_html__('Type 5','petsworld-core') => 'type5',
					esc_html__('Type 6','petsworld-core') => 'type6',
					esc_html__('Type 7','petsworld-core') => 'type7',
					esc_html__('Type 8','petsworld-core') => 'type8',
					esc_html__('Type 9','petsworld-core') => 'type9',
				),
			),			

      		# Title
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Title", 'petsworld-core' ),
      			"param_name" => "title",
			),
			  
			# Title Link
			array(
				"type"       => "vc_link",
				"heading"    => esc_html__( "Title Link", 'petsworld-core' ),
				"param_name" => "title_link",
			),

      		# Sub Title
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Sub Title", 'petsworld-core' ),
      			"param_name" => "subtitle",
      		), 

			# Image url
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image URL', 'petsworld-core'),
				'param_name' => 'image',
			),

			# Image Position
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Image Position', 'petsworld-core'),
				'param_name' => 'imgpos',
				'value' => array( esc_html__('Default','petsworld-core') => '', esc_html__('Below Content','petsworld-core') => 'bottom' )
			),

			# Icon Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Icon Type', 'petsworld-core'),
				'param_name' => 'icon_type',
				'value' => array( esc_html__('None','petsworld-core') => '' , esc_html__('Icon class','petsworld-core') => 'icon_class', esc_html__('Image','petsworld-core') => 'icon_url' ),
				'dependency' => array('element' => 'type','value' => array('type2', 'type3', 'type4', 'type5', 'type6', 'type7', 'type8', 'type9' ) )
			),

			# Icon Class
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Icon Class', 'petsworld-core'),
				'param_name' => 'icon',
				'dependency' => array('element' => 'icon_type','value' => 'icon_class')
			),

			# Icon url
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Image URL', 'petsworld-core'),
				'param_name' => 'iconurl',
				'dependency' => array('element' => 'icon_type','value' => 'icon_url')
			),

			# Content
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__('Content','petsworld-core'),
				'param_name' => 'content',
				'value' => '<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>'
			),			

			# Extra Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Extra class name", 'petsworld-core' ),
      			"param_name" => "class",
      			'description' => esc_html__('Style particular icon box element differently - add a class name and refer to it in custom CSS','petsworld-core')
      		)
		)
	) );
} ?>