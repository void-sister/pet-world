<?php add_action( 'vc_before_init', 'dt_sc_recent_post_vc_map' );
function dt_sc_recent_post_vc_map() {

	$arr = array( esc_html__('Yes','petsworld-core') => 'yes', esc_html__('No','petsworld-core') => 'no' );

	vc_map( array(
		"name" => esc_html__( "Recent Posts", 'petsworld-core' ),
		"base" => "dt_sc_recent_post",
		"icon" => "dt_sc_recent_post",
		"category" => DT_VC_CATEGORY,
		"description" => esc_html__("Show recent posts",'petsworld-core'),
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
					esc_html__('I Column','petsworld-core') => 1,
					esc_html__('II Columns','petsworld-core') => 2 ,
					esc_html__('III Columns','petsworld-core') => 3
				),
				'std' => 2
			),

			// Post style
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Style','petsworld-core'),
				'param_name' => 'style',
				'value' => array(
					esc_html__('Default','petsworld-core') => '',
					esc_html__('Date Left','petsworld-core') => 'entry-date-left',
					esc_html__('Date and Author Left','petsworld-core') => 'entry-date-author-left',
					esc_html__('Medium','petsworld-core') => 'blog-medium-style',
					esc_html__('Medium Highlight','petsworld-core') => 'blog-medium-style dt-blog-medium-highlight',
					esc_html__('Medium Skin Highlight','petsworld-core') => 'blog-medium-style dt-blog-medium-highlight dt-sc-skin-highlight'	
				)
			),

			// Allow excerpt
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Allow Excerpt','petsworld-core'),
				'param_name' => 'allow_excerpt',
				'value' => $arr
			),

			// Excerpt Length
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Excerpt Length', 'petsworld-core' ),
				'param_name' => 'excerpt_length',
				'value' => 40
			),

			// Show Post Format?
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Post Format?','petsworld-core'),
				'param_name' => 'show_post_format',
				'value' => $arr
			),

			// Show Author ?
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Author ?','petsworld-core'),
				'param_name' => 'show_author',
				'value' => $arr
			),

			// Show Date ?
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Date ?','petsworld-core'),
				'param_name' => 'show_date',
				'value' => $arr
			),

			// Show Comment ?
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Comment ?','petsworld-core'),
				'param_name' => 'show_comment',
				'value' => $arr
			),

			// Show Category?
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Category?','petsworld-core'),
				'param_name' => 'show_category',
				'value' => $arr
			),

			// Show Tag?
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Show Tag?','petsworld-core'),
				'param_name' => 'show_tag',
				'value' => $arr
			),

			// Button Style
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__('Read more Button','petsworld-core'),
				'param_name' => 'content',
				'value' => '[dt_sc_button size="small" iconclass="fa fa-long-arrow-right" iconalign="icon-right with-icon" style="filled" class="type1" title="Read More" icon_type="fontawesome" target="_blank" /]'
			)
		)
	) );	
}?>