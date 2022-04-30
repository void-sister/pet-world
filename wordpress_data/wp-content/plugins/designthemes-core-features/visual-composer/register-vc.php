<?php
if (! class_exists ( 'DTCoreVC' )) {

	class DTCoreVC {

		function __construct() {

			add_action( 'vc_before_init', array ( $this, 'dt_vcSetAsTheme') );
			add_action( 'vc_after_init', array( $this, 'dt_updated_vc_sc_params') );
			add_action( 'admin_enqueue_scripts', array ( $this, 'dt_vc_admin_scripts') );
			add_filter( 'vc_load_default_templates',  array( $this, 'dt_vc_custom_template_modify_array' ) );
			add_action( 'after_setup_theme', array( $this, 'dt_map_shortcodes') );
			add_action( 'init', array( $this, 'dt_vs_contanct_form_7_fields') );
			
			add_filter( 'vc_google_fonts_get_fonts_filter', array( $this,'dt_vc_google_fonts_get_fonts_filter' ) );
			
			// Grid Template Variables
			add_filter('vc_gitem_template_attribute_dt_post_format', array( $this, 'vc_gitem_template_attribute_dt_post_format' ), 10, 2 );
			add_filter('vc_gitem_template_attribute_dt_post_tag', array( $this, 'vc_gitem_template_attribute_dt_post_tag' ), 10, 2 );
			add_filter('vc_gitem_template_attribute_dt_post_category', array( $this, 'vc_gitem_template_attribute_dt_post_category' ), 10, 2 );
			add_filter('vc_gitem_template_attribute_dt_post_comment', array( $this, 'vc_gitem_template_attribute_dt_post_comment' ), 10, 2 );
			add_filter('vc_grid_item_shortcodes', array( $this, 'dt_vc_add_grid_shortcodes' ) );
		}

		function dt_vcSetAsTheme() {
			vc_set_as_theme();

			# Set Shortcode templates folder
			$path = plugin_dir_path ( __FILE__ ) . 'vc_templates';
			vc_set_shortcodes_templates_dir( $path );
		}

		function dt_vc_admin_scripts( $hook ) {

			if($hook == "post.php" || $hook == "post-new.php") {

				wp_enqueue_style( 'dt-vc-admin', plugins_url('designthemes-core-features') .'/visual-composer/admin.css', false, THEME_VERSION, 'all' );
			}
		}

		function dt_vc_custom_template_modify_array( $templates ) {
			return array();
		}
		
		function dt_updated_vc_sc_params() {
			// Button
				$param = WPBMap::getParam('vc_btn','title');
				$param['weight'] = 200;
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_fontawesome' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_openiconic' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );			

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_typicons' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_entypo' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_linecons' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_monosocial' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );						

				$param = WPBMap::getParam( 'vc_btn', 'i_icon_pixelicons' );
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_type' );
				$param['value'][__( 'Image', 'petsworld-core' )] = 'image';
				$param['weight'] = 99;
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );

				$param = WPBMap::getParam( 'vc_btn', 'i_align' );
				$param['weight'] = 100;
				$param['group'] = 'Icon';
				vc_update_shortcode_param( 'vc_btn', $param );
		}

		function dt_map_shortcodes() {
			
			// Button
				$param = array(
					'type' => 'attach_image',
					'group' => 'Icon',
					'heading' => __( 'Image', 'petsworld-core' ),
					'param_name' => 'image',
					'description' => __( 'Select Image.', 'dt-core' ),
					'dependency' => array( 'element' => 'i_type', 'value' => 'image')
				);			
				vc_add_param('vc_btn', $param);

				$param = array(
					'type' => 'attach_image',
					'group' => 'Icon',
					'heading' => __( 'Hover Image', 'petsworld-core' ),
					'param_name' => 'hover_image',
					'description' => __( 'Select hover Image.', 'dt-core' ),
					'dependency' => array( 'element' => 'i_type', 'value' => 'image')
				);			
				vc_add_param('vc_btn', $param);
			


			require_once plugin_dir_path( __FILE__ ).'modules/index.php';
		}

		function dt_vs_contanct_form_7_fields() {
			
			vc_add_param('contact-form-7',array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'petsworld-core' ),
				'param_name' => 'html_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'petsworld-core' ),
			) );
		}

		function dt_vc_google_fonts_get_fonts_filter( $fonts ) {

			$fonts[] = json_decode (
				json_encode( array('font_family' => 'Chewy', 'font_styles' => 'regular', 'font_types' => '400 regular:400:normal') ),
			FALSE );

			$fonts[] = json_decode (
				json_encode( array('font_family' => 'Caveat', 'font_styles' => 'regular,700', 'font_types' => '400 regular:400:normal,700 
					bold regular:700:normal') ),
			FALSE );

			return $fonts;
		}		

		function vc_gitem_template_attribute_dt_post_format( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_format.php' );
		}

		function vc_gitem_template_attribute_dt_post_tag( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_tag.php' );
		}

		function vc_gitem_template_attribute_dt_post_category( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_category.php' );
		}		

		function vc_gitem_template_attribute_dt_post_comment( $value, $data ) {
			extract( array_merge( array(
				'post' => null,
				'data' => ''
			), $data ) );

			return include(  plugin_dir_path( __FILE__ ).'templates/dt_post_comment.php' );
		}

		function dt_vc_add_grid_shortcodes( $shortcodes ) {

			# Post Format
			$shortcodes['dt_sc_gitem_post_format'] = array(
				'name' => __( 'Post Format', 'petsworld-core' ),
				'base' => 'dt_sc_gitem_post_format',
				'category' => __( 'Post', 'petsworld-core' ),
				'description' => __( 'Post Format of current post', 'petsworld-core' ),
				'show_settings_on_create' => false,
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => array(
					array( 'type' => 'textfield',
						'heading' => __( 'Extra class name', 'petsworld-core' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'petsworld-core')
					)
				)
			);

			# Post Tag
			$shortcodes['dt_sc_gitem_post_tag'] = array(
				'name' => __( 'Post Tag', 'petsworld-core' ),
				'base' => 'dt_sc_gitem_post_tag',
				'category' => __( 'Post', 'petsworld-core' ),
				'description' => __( 'Post Tags of current post', 'petsworld-core' ),
				'show_settings_on_create' => false,
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => array(
					array( 'type' => 'textfield',
						'heading' => __( 'Extra class name', 'petsworld-core' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'petsworld-core')
					)
				)
			);

			# Post Category
			$shortcodes['dt_sc_gitem_post_category'] = array(
				'name' => __( 'Post Categories', 'petsworld-core' ),
				'base' => 'dt_sc_gitem_post_category',
				'category' => __( 'Post', 'petsworld-core' ),
				'description' => __( 'Categories of current post', 'petsworld-core' ),
				'params' => array(
					array(
						'type' => 'checkbox',
						'heading' => __( 'Add link', 'petsworld-core' ),
						'param_name' => 'link',
						'description' => __( 'Add link to category?', 'petsworld-core' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Style', 'petsworld-core' ),
						'param_name' => 'category_style',
						'value' => array(
							__( 'None', 'petsworld-core' ) => ' ',
							__( 'Comma', 'petsworld-core' ) => ', ',
							__( 'Rounded', 'petsworld-core' ) => 'filled vc_grid-filter-filled-round-all',
							__( 'Less Rounded', 'petsworld-core' ) => 'filled vc_grid-filter-filled-rounded-all',
							__( 'Border', 'petsworld-core' ) => 'bordered',
							__( 'Rounded Border', 'petsworld-core' ) => 'bordered-rounded vc_grid-filter-filled-round-all',
							__( 'Less Rounded Border', 'petsworld-core' ) => 'bordered-rounded-less vc_grid-filter-filled-rounded-all',
						),
						'description' => __( 'Select category display style.', 'petsworld-core' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Color', 'petsworld-core' ),
						'param_name' => 'category_color',
						'value' => getVcShared( 'colors' ),
						'std' => 'grey',
						'param_holder_class' => 'vc_colored-dropdown',
						'dependency' => array(
							'element' => 'category_style',
							'value_not_equal_to' => array( ' ', ', ' ),
						),
						'description' => __( 'Select category color.', 'petsworld-core' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Category size', 'petsworld-core' ),
						'param_name' => 'category_size',
						'value' => getVcShared( 'sizes' ),
						'std' => 'md',
						'description' => __( 'Select category size.', 'petsworld-core' ),
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'petsworld-core' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'petsworld-core' ),
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'CSS box', 'petsworld-core' ),
						'param_name' => 'css',
						'group' => __( 'Design Options', 'petsworld-core' ),
					),
				),
				'post_type' => Vc_Grid_Item_Editor::postType(),
			);

			# Post Comment
			$shortcodes['dt_sc_gitem_post_comment'] = array(
				'name' => __( 'Post Comment', 'petsworld-core' ),
				'base' => 'dt_sc_gitem_post_comment',
				'category' => __( 'Post', 'petsworld-core' ),
				'description' => __( 'Post Comment Count of current post', 'petsworld-core' ),
				'show_settings_on_create' => false,
				'post_type' => Vc_Grid_Item_Editor::postType(),
				'params' => array(
					array( 'type' => 'textfield',
						'heading' => __( 'Extra class name', 'petsworld-core' ),
						'param_name' => 'el_class',
						'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'petsworld-core')
					)
				)
			);						

			return $shortcodes;
		}
	}
}