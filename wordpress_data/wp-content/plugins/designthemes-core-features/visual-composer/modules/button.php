<?php add_action( 'vc_before_init', 'dt_sc_button_vc_map' );
function dt_sc_button_vc_map() {

	global $variations;

	global $dt_animation_types;

	vc_map( array(
		"name" => esc_html__( "Button", 'petsworld-core' ),
		"base" => "dt_sc_button",
		"icon" => "dt_sc_button",
		"category" => DT_VC_CATEGORY,
		"params" => array(

			// Button Text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Text', 'petsworld-core' ),
				'param_name' => 'title',
				'value' => esc_html__( 'Text on the button', 'petsworld-core' ),
			),

			// Button Link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'URL (Link)', 'petsworld-core' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Add link to button', 'petsworld-core' ),
			),

			// Button Size
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Size', 'petsworld-core' ),
				'description' => esc_html__( 'Select button display size', 'petsworld-core' ),
				'param_name' => 'size',
				'value' => array(
					esc_html__( 'Small', 'petsworld-core' ) => 'small',
					esc_html__( 'Medium', 'petsworld-core' ) => 'medium',
					esc_html__( 'Large', 'petsworld-core' ) => 'large',
					esc_html__( 'Xlarge', 'petsworld-core' ) => 'xlarge',
				),
				'std' => 'small'
			),

			// Content Color			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Text color", 'petsworld-core' ),
      			"param_name" => "textcolor",
      			"description" => esc_html__( "Select text color", 'petsworld-core' ),
      		),

			array(
				"type" => "textfield",
      			"heading" => esc_html__( "Text size", 'petsworld-core' ),
      			"param_name" => "textsize",
      			"description" => esc_html__( "Select text size ( eg: 10px or 1.5em )", 'petsworld-core' ),
      		),      		

      		// Custom Font
      		array(
      			'type' => 'checkbox',
				'heading' => __( 'Use theme default font family?', 'petsworld-core' ),
				'param_name' => 'use_theme_fonts',
				'value' => array( __( 'Yes', 'petsworld-core' ) => 'yes'  ),
				'std' => 'yes',
				'description' => __( 'Use font family from the theme.', 'petsworld-core' ),
			),

			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts',
				'group' => __('Typography','petsworld-core'),
				'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __( 'Select font family.', 'petsworld-core' ),
						'font_style_description' => __( 'Select font styling.', 'petsworld-core' ),
					),
				),
				'dependency' => array(
					'element' => 'use_theme_fonts',
					'value_not_equal_to' => 'yes',
				),
			),


      		// Variation
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__( 'Background Color', 'petsworld-core' ),
      			'admin_label' => true,
      			'param_name' => 'color',
      			'value' => $variations,
      			'description' => esc_html__( 'Select button background color', 'petsworld-core' ),
      		),

			// BG Color			
			array(
				"type" => "colorpicker",
      			"heading" => esc_html__( "Custom Background color", 'petsworld-core' ),
      			"param_name" => "bgcolor",
      			"description" => esc_html__( "Select button background color", 'petsworld-core' ),
				'dependency' => array( 'element' => 'color', 'value' =>'-' )
      		),      		      					

			// Button Style
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Style', 'petsworld-core' ),
				'description' => esc_html__( 'Select button display style', 'petsworld-core' ),
				'param_name' => 'style',
				'value' => array(
					esc_html__( 'None', 'petsworld-core') => '',
					esc_html__( 'Bordered', 'petsworld-core' ) => 'bordered',
					esc_html__( 'Filled', 'petsworld-core' ) => 'filled',
					esc_html__( 'Filled Rounded Corner', 'petsworld-core' ) => 'filled rounded-corner',
					esc_html__( 'Rounded Corner', 'petsworld-core' ) => 'rounded-corner',
					esc_html__( 'Rounded Border', 'petsworld-core' ) => 'rounded-border',
					esc_html__( 'Fully Rounded Border', 'petsworld-core' ) => 'fully-rounded-border',
				),				
			),

			// Icon Type
      		array(
      			'type' => 'dropdown',
      			'heading' => esc_html__('Icon Type','petsworld-core'),
      			'param_name' => 'icon_type',
      			'value' => array(
      				esc_html__('None', 'petsworld-core' ) => '',	 
      				esc_html__('Font Awesome', 'petsworld-core' ) => 'fontawesome' ,
      				esc_html__('Class','petsworld-core') => 'css_class'
      			),
      			'std' => ''
      		),

			// Icon Alignment
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Alignment', 'petsworld-core' ),
				'description' => esc_html__( 'Select icon alignment', 'petsworld-core' ),
				'param_name' => 'iconalign',
				'value' => array(
					esc_html__( 'Left', 'petsworld-core' ) => 'icon-left with-icon',
					esc_html__( 'Right', 'petsworld-core' ) => 'icon-right with-icon',
				),
				'dependency' => array( 'element' => 'icon_type', 'value' => array( 'fontawesome', 'css_class' ) ),
				'std' => ''
			),

      		// Font Awesome
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome', 'petsworld-core' ),
				'param_name' => 'iconclass',
				'settings' => array( 'emptyIcon' => false, 'iconsPerPage' => 4000 ),
				'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
				'description' => esc_html__( 'Select icon from library', 'petsworld-core' ),
			),

			// Custom Class
            array(
            	'type' => 'textfield',
            	'heading' => esc_html__( 'Custom icon class', 'petsworld-core' ),
            	'param_name' => 'icon_css_class',
            	'dependency' => array( 'element' => 'icon_type', 'value' => 'css_class' )
            ),

			// Button Animation
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Animation', 'petsworld-core' ),
				'description' => esc_html__( 'Select button animation', 'petsworld-core' ),
				'param_name' => 'animation',
				'value' => $dt_animation_types
			),			

          	// Extra class name
          	array(
          		'type' => 'textfield',
          		'heading' => esc_html__( 'Extra class name', 'petsworld-core' ),
          		'param_name' => 'class',
          		'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'petsworld-core' )
          	),

			// Custom CSS
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'CSS box', 'petsworld-core' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design Options', 'petsworld-core' )
			),
		)
	) );
} ?>