<?php add_action( 'vc_before_init', 'dt_sc_petshop_striped_tab_element_vc_map' );
function dt_sc_petshop_striped_tab_element_vc_map() {

	# Tab Elements
	vc_map(array(
		"name" => esc_html__( "Tab", 'dt-petshop-plugin' ),
		"base" => "dt_sc_petshop_striped_tab_element",
		"icon" => "dt_sc_petshop_striped_tab_element",
		"category" => DT_VC_CATEGORY,
		"is_container" => true,
		"content_element" => false,
		"as_child" => array('only' => 'dt_sc_petshop_striped_tab'),
		"admin_enqueue_js" =>  plugins_url('designthemes-core-features').'/visual-composer/js/dt-sc-striped-tab-element-view.js',
		"js_view" => "DTStripedTabView",
		"params" => array(

			# Tab Id
			array(
				'type' => 'tab_id',
				'heading' => esc_html__( 'Tab ID', 'dt-petshop-plugin' ),
				'param_name' => "tab_id"
			),

			# Title
      		array( 'type' => 'textfield',
      			'heading' => esc_html__( 'Title', 'dt-petshop-plugin' ),
      			'param_name' => 'title',
      			'description' => esc_html__( 'Enter title of tab.', 'dt-petshop-plugin' ),
      		),

      		# Icon library
      		array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'dt-petshop-plugin' ),
				'value' => array(
					__( 'Font Awesome', 'dt-petshop-plugin' ) => 'fontawesome',
					__( 'Open Iconic', 'dt-petshop-plugin' ) => 'openiconic',
					__( 'Typicons', 'dt-petshop-plugin' ) => 'typicons',
					__( 'Entypo', 'dt-petshop-plugin' ) => 'entypo',
					__( 'Linecons', 'dt-petshop-plugin' ) => 'linecons',
					__( 'Mono Social', 'dt-petshop-plugin' ) => 'monosocial',
					__( 'Custom Image', 'dt-petshop-plugin' ) => 'custom_image',
				),
				'admin_label' => true,
				'param_name' => 'type',
				'description' => __( 'Select icon library.', 'dt-petshop-plugin' ),
			),

			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'dt-petshop-plugin' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'dt-petshop-plugin' ),
			),

			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'dt-petshop-plugin' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'dt-petshop-plugin' ),
			),

			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'dt-petshop-plugin' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'dt-petshop-plugin' ),
			),

			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'dt-petshop-plugin' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'entypo',
				),
			),

			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'dt-petshop-plugin' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'dt-petshop-plugin' ),
			),

			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'dt-petshop-plugin' ),
				'param_name' => 'icon_monosocial',
				'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'monosocial',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'monosocial',
				),
				'description' => __( 'Select icon from library.', 'dt-petshop-plugin' ),
			),

			array(
				'type' => 'attach_image',
				'heading' => __( 'Image', 'dt-petshop-plugin' ),
				'param_name' => 'image',
				'dependency' => array( 'element' => 'type', 'value' => 'custom_image' ),
				'description' => __( 'Select image.', 'dt-petshop-plugin' ),
			),			

			array(
				'type' => 'attach_image',
				'heading' => __( 'Active Image', 'dt-petshop-plugin' ),
				'param_name' => 'active_image',
				'dependency' => array( 'element' => 'type', 'value' => 'custom_image' ),
				'description' => __( 'Select active image.', 'dt-petshop-plugin' ),
			)
		)
	));

	require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');

	class WPBakeryShortCode_dt_sc_petshop_striped_tab_element extends WPBakeryShortCode_VC_Column {
		protected $controls_css_settings = 'tc vc_control-container';
		protected $controls_list = array('add', 'edit', 'clone', 'delete');

		protected $predefined_atts = array(
			'tab_id' => 'Tab',
			'title' => '',
		);

		public function __construct( $settings ) {
			parent::__construct( $settings );
		}

		public function customAdminBlockParams() {
			return ' id="tab-' . $this->atts['tab_id'] . '"';
		}

		public function mainHtmlBlockParams( $width, $i ) {
			return 'data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable wpb_content_holder"' . $this->customAdminBlockParams();
		}

		public function containerHtmlBlockParams( $width, $i ) {
			return 'class="wpb_column_container vc_container_for_children"';
		}

		public function getColumnControls( $controls, $extended_css = '' ) {
			return $this->getColumnControlsModular($extended_css);
		}
	}	

}