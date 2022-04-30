<?php add_action( 'vc_before_init', 'dt_sc_tab_vc_map' );
function dt_sc_tab_vc_map() {

	vc_map( array(
		'name' => esc_html__( 'Tab', 'petsworld-core' ),
		'base' => 'dt_sc_tab',
		'allowed_container_element' => 'vc_row',
		'is_container' => true,
		'content_element' => false,
		"as_child" => array('only' => 'dt_sc_tabs'),
		'admin_enqueue_js' =>  plugins_url('designthemes-core-features').'/visual-composer/js/dt-sc-tab-view.js',
		'params' => array(

			array(
				'type' => 'tab_id',
				'heading' => esc_html__( 'Tab ID', 'petsworld-core' ),
				'param_name' => "tab_id"
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'petsworld-core' ),
				'param_name' => 'title',
				'description' => esc_html__( 'Enter title of tab', 'petsworld-core' )
			),

			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Sub Title', 'petsworld-core' ),
				'param_name' => 'sub_title',
				'description' => esc_html__( 'Enter sub title of tab', 'petsworld-core' )
			),			

			// Icon Type
			array(
				'type' => 'dropdown',
				'heading' => esc_html__('Icon','petsworld-core'),
				'param_name' => 'icon_type',
				'value' => array(
					esc_html__('None','petsworld-core') => 'none',
					esc_html__('Font awesome', 'petsworld-core') => 'fontawesome',
					esc_html__('Custom Image', 'petsworld-core') => 'custom_image',					
					esc_html__('Custom', 'petsworld-core') => 'custom',
				)
			),			

			# Font Awesome
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Font Awesome', 'petsworld-core' ),
				'param_name' => 'icon',
				'settings' => array( 'emptyIcon' => false, 'iconsPerPage' => 4000 ),
				'dependency' => array( 'element' => 'icon_type', 'value' => 'fontawesome' ),
				'description' => esc_html__( 'Select icon from library', 'petsworld-core' ),
			),

			# Custom Image
      		array(
      			"type" => "attach_image",
      			"heading" => esc_html__( "Image", 'petsworld-core' ),
      			"param_name" => "custom_image",
				'dependency' => array( 'element' => 'icon_type', 'value' => 'custom_image' )
      		),			

			# Custom Hover Image
      		array(
      			"type" => "attach_image",
      			"heading" => esc_html__( "Hover Image", 'petsworld-core' ),
      			"param_name" => "hover_image",
				'dependency' => array( 'element' => 'icon_type', 'value' => 'custom_image' )
      		),
			
			# Custom icon Class
      		array(
      			"type" => "textfield",
      			"heading" => esc_html__( "Icon class name", 'petsworld-core' ),
      			"param_name" => "icon_class",
				'dependency' => array( 'element' => 'icon_type', 'value' => 'custom' )
      		)			
		),
		'js_view' => 'DTTabView'
	) );

	require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');

	class WPBakeryShortCode_DT_SC_TAB extends WPBakeryShortCode_VC_Column {
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
}?>