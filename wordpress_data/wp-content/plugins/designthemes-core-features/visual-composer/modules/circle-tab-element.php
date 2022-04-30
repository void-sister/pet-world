<?php add_action( 'vc_before_init', 'dt_sc_petshop_circle_tab_element_vc_map' );
function dt_sc_petshop_circle_tab_element_vc_map() {

	# Tab Elements
	vc_map(array(
		"name" => esc_html__( "Tab", 'dt-petshop-plugin' ),
		"base" => "dt_sc_petshop_circle_tab_element",
		"icon" => "dt_sc_petshop_circle_tab_element",
		"category" => DT_VC_CATEGORY,
		"is_container" => true,
		"content_element" => false,
		"as_child" => array('only' => 'dt_sc_petshop_circle_tab'),
		"admin_enqueue_js" =>  plugins_url('designthemes-core-features').'/visual-composer/js/dt-sc-circle-tab-element-view.js',
		"js_view" => "DTCircleTabView",
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

      		# Color
      		array( 'type' => 'colorpicker',
      			'heading' => esc_html__( 'Color', 'dt-petshop-plugin' ),
      			'param_name' => 'color',
      			'description' => esc_html__( 'Select custom color.', 'dt-petshop-plugin' )
      		),

			# Extra Class
      		array( 'type' => 'textfield',
      			'heading' => esc_html__( 'Extra Class', 'dt-petshop-plugin' ),
      			'param_name' => 'el_class',
      			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dt-petshop-plugin' ),
      		)
		)
	));

	require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');

	class WPBakeryShortCode_dt_sc_petshop_circle_tab_element extends WPBakeryShortCode_VC_Column {
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