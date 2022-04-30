<?php add_action( 'vc_before_init', 'dt_sc_iconbox_vc_map' );
function dt_sc_iconbox_vc_map() {

	vc_map( array(
		"name" => esc_html__( "Icon box", 'petsworld-core' ),
        "base" => "dt_sc_iconbox",
		"icon" => "dt_sc_iconbox",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			# Types
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Types', 'petsworld-core' ),
      			'param_name' => 'type',
      			'value' => array( 
      				esc_html__('Type 1','petsworld-core') => 'type1',		esc_html__('Type 2','petsworld-core') => 'type2',		esc_html__('Type 3','petsworld-core') => 'type3',
      				esc_html__('Type 4','petsworld-core') => 'type4',		esc_html__('Type 5','petsworld-core') => 'type5',		esc_html__('Type 6','petsworld-core') => 'type6',
      				esc_html__('Type 7','petsworld-core') => 'type7',		esc_html__('Type 8','petsworld-core') => 'type8',		esc_html__('Type 9','petsworld-core') => 'type9',
      				esc_html__('Type 10','petsworld-core') => 'type10',		esc_html__('Type 11','petsworld-core') => 'type11',      esc_html__('Type 12','petsworld-core') => 'type12',
                    esc_html__('Type 13','petsworld-core') => 'type13',      esc_html__('Type 14','petsworld-core') => 'type14'
      			),
      			'description' => esc_html__( 'Select icon box type', 'petsworld-core' ),
      			'std' => 'type1',
      			'admin_label' => true
      		),

      		# Title
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Title", 'petsworld-core' ),
      			"param_name" => "title"
      		),
			
			# Title Color
      		array(
      			"type" => "colorpicker",
      			"heading" => esc_html__( "Title Color", 'petsworld-core' ),
      			"param_name" => "title_color",
				"value" => '#a3ad55',
				'dependency' => array( 'element' => 'type', 'value' => 'type1')
      		),

      		# Sub Title
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Sub Title", 'petsworld-core' ),
      			"param_name" => "subtitle"
      		),

      		# Icon Type
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__('Icon Type','petsworld-core'),
      			'param_name' => 'icon_type',
      			'value' => array( 
                              esc_html__('Image','petsworld-core') => 'image',
                              esc_html__('Font Awesome', 'petsworld-core' ) => 'fontawesome' ,
                              esc_html__('Class','petsworld-core') => 'css_class',
							  esc_html__('Text','petsworld-core') => 'custom_text',							  
                              esc_html__('None','petsworld-core') => 'none' ),
      			'std' => 'fontawesome'
      		),
			
			# Custom Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Text', 'petsworld-core' ),
				'param_name' => 'custom_text',
				'value' => '01',
				'dependency' => array( 'element' => 'icon_type', 'value' => 'custom_text' )
			),      		
			

      		# Font Awesome
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome', 'petsworld-core' ),
				'param_name' => 'icon',
				'value' => 'fa fa-info-circle',
				'settings' => array( 'emptyIcon' => false, 'iconsPerPage' => 4000 ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library', 'petsworld-core' ),
			),

			# Custom Icon
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'petsworld-core' ),
				'param_name' => 'iconurl',
				'description' => esc_html__( 'Select image from media library', 'petsworld-core' ),
				'dependency' => array( 'element' => 'icon_type', 'value' => 'image' )
			),

			  # Custom Class
		  array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom class', 'petsworld-core' ),
				'param_name' => 'icon_css_class',
				'value' => '',
				'dependency' => array(
					  'element' => 'icon_type',
					  'value' => 'css_class',
				)
		  ), 
			  
			# BG Color for Type 3
		  array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon BG Color', 'petsworld-core' ),
				'param_name' => 'icon_bg_color',
				'dependency' => array( 'element' => 'type', 'value' => array( 'type3', 'type7' ) )
		  ), 
			     		

      		# URL
      		array(
      			'type' => 'vc_link',
      			'heading' => esc_html__( 'URL (Link)', 'petsworld-core' ),
      			'param_name' => 'link',
      			'description' => esc_html__( 'Add link to icon box', 'petsworld-core' )
      		),

      		# Content
      		array(
      			'type' => 'textarea_html',
      			'heading' => esc_html__( 'Content', 'petsworld-core' ),
      			'param_name' => 'content',
      			'value' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit elit turpis, a porttitor tellus sollicitudin at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>'
      		),

      		# Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Extra class name", 'petsworld-core' ),
      			"param_name" => "class",
      			'description' => esc_html__('Style particular icon box element differently - add a class name and refer to it in custom CSS','petsworld-core')
      		),

                  array(
                        'type' => 'textarea',
                        'heading' => "Inline styles",
                        'param_name' => 'addstyles',
                        'description' => esc_html__( 'Enter inline styles for this iconbox', 'petsworld-core' )
                  )      		
		)
	) );
}?>