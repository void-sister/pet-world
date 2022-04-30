<?php add_action( 'vc_before_init', 'dt_sc_pricing_table_item_vc_map' );
function dt_sc_pricing_table_item_vc_map() {
	vc_map( array( 
		"name" => esc_html__( "Pricing Box 1", 'petsworld-core' ),
		"base" => "dt_sc_pricing_table_item",
		"icon" => "dt_sc_pricing_table_item",
		"category" => DT_VC_CATEGORY,		
		"params" => array(

			// Heading
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Title", 'petsworld-core' ),
				'admin_label' => true,
      			"param_name" => "heading"
      		),

			// Sub Title
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Sub title", 'petsworld-core' ),
				'admin_label' => true,
      			"param_name" => "subtitle"
      		),

      		// selected
      		array(
      			'type' => 'checkbox',
      			'heading' => esc_html__( 'Is active?', 'petsworld-core' ),
				'admin_label' => true,
      			'param_name' => 'highlight',
      			'description' => esc_html__( 'If checked pricing box will be highlighted', 'petsworld-core' ),
      			'value' => array( esc_html__( 'Yes', 'petsworld-core' ) => 'yes' )
      		),

      		// Thumb
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'petsworld-core' ),
				'param_name' => 'thumb',
				'description' => esc_html__( 'Select image from media library', 'petsworld-core' ),
			),

			// Currency
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Currency", 'petsworld-core' ),
      			"param_name" => "currency",
      			"description" => esc_html__("Enter the price for this package e.g. $157.99 enter $ here",'petsworld-core'),
      		),

			// Price
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Price", 'petsworld-core' ),
      			"param_name" => "price",
      			"description" => esc_html__("Enter the price for this package e.g. $157.99 enter 157 here",'petsworld-core'),
      			),

			// Price decimal
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Price", 'petsworld-core' ),
      			"param_name" => "decimal",
      			"description" => esc_html__("Enter the price for this package e.g. $157.99 enter .99 here",'petsworld-core')
      		),

			// Price Unit
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Price Unit", 'petsworld-core' ),
      			"param_name" => "permonth",
      			"description" => esc_html__("Enter the price unit for this package e.g. / Month",'petsworld-core')
      		),

      		// Content
      		array(
      			'type' => 'textarea_html',
      			'heading' => esc_html__( 'Content', 'petsworld-core' ),
      			'param_name' => 'content',
				'value' => '<ul><li>Lorem ipsum dolor sit</li><li>Praesent convallis nibh</li><li>Nullam ac sapien sit</li><li>Phasellus auctor augue</li></ul>'
      		),

      		# URL
      		array(
      			'type' => 'vc_link',
      			'heading' => esc_html__( 'URL (Link)', 'petsworld-core' ),
      			'param_name' => 'link',
      			'description' => esc_html__( 'Add link to this package', 'petsworld-core' )
      		)      		      		      					      		
		)
	) );
}?>