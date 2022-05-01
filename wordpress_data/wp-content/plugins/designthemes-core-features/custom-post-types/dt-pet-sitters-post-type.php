<?php
if (! class_exists ( 'DTPetSitterPostType' )) {

	class DTPetSitterPostType {

		function __construct() {

			add_action( 'add_meta_boxes', array(
				$this, 'dt_petsitters_metaboxes' ) );

			add_action ( 'init', array (
				$this, 'dt_init' ) );

			// Add Hook into the 'template_include' filter
			add_filter ( 'template_include', array (
				$this, 'dt_template_include' ) );
		}

		function dt_petsitters_metaboxes() {

			add_meta_box( 'dt-pet-sitter-owner-info', __('Extra Info','dt-petshop-plugin'),
				array( $this, 'dt_petsitter_submitter_metabox'),
				'dt_cpt_pet_sitters', 'side', 'high');


			add_meta_box( 'dt-pet-sitter-default-metabox', __('Default Options','dt-petshop-plugin'),
				array( $this, 'dt_pet_default_metabox'),
				'dt_cpt_pet_sitters', 'normal', 'high');
		}

		function dt_petsitter_submitter_metabox( $post ) {

			$submitter = get_post_meta ( $post->ID, '_pet_sitter_submitter', TRUE );

			if( empty( $submitter) ) {
				$submitter = get_current_user_id();
			}
			
			$submitter = get_userdata( $submitter );
			$submitter  = $submitter->display_name;
			$submitter = !empty( $submitter ) ? $submitter : $submitter->nickname;
			echo '<p>'.__('Submitted By','dt-petshop-plugin').' <strong>'. $submitter.'</strong> </p>';
		}

		function dt_pet_default_metabox() {
			include_once plugin_dir_path ( __FILE__ ) . 'metaboxes/dt_cpt_pet_sitters_metabox.php';
		}
		
		function dt_init() {

			# Save Post Meta Data
			add_action ( 'save_post', array ( $this, 'save_post_meta' ) );

			# Pet Sitter
			$labels = array( 'name'   => __ ( 'Pet Sitters', 'dt-petshop-plugin' ),
				'singular_name' 	  => __ ( 'Pet Sitter', 'dt-petshop-plugin' ),
				'menu_name' 		  => __ ( 'Pet Sitters', 'dt-petshop-plugin' ),
				'add_new' 			  => __ ( 'Add New Pet Sitter', 'dt-petshop-plugin' ),
				'add_new_item' 		  => __ ( 'Add New Pet Sitter', 'dt-petshop-plugin' ),
				'new_item' 			  => __ ( 'New Pet Sitter', 'dt-petshop-plugin' ),
				'edit_item' 		  => __ ( 'Edit Pet Sitter', 'dt-petshop-plugin' ),
				'view_item' 		  => 	__ ( 'View Pet Sitter', 'dt-petshop-plugin' ),
				'all_items' 		  => 	__ ( 'Pet Sitters', 'dt-petshop-plugin' ),
				'search_items' 		  =>	__ ( 'Search Pet Sitters', 'dt-petshop-plugin' ),
				'parent_item_colon'   => 	__ ( 'Parent Pet Sitters:', 'dt-petshop-plugin' ),
				'not_found' 		  => 	__ ( 'No pet sitters found', 'dt-petshop-plugin' ),
				'not_found_in_trash'  => 	__ ( 'No pet sitters found in Trash', 'dt-petshop-plugin' ));

			$args = array( 'labels' => $labels,
				'hierarchical' 		  => false,
				'supports' 			  => array ( 'title', 'editor', 'thumbnail','comments', 'revisions'),
				'public' 			  => true,
				'show_in_rest'		  => true,
				'show_ui' 			  => true,
				'show_in_menu' 		  => true,
				'menu_position' 	  => 5,
				'menu_icon'			  => 'dashicons-businessman',
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive' 		  => true,
				'query_var' 	  	  => true,
				'can_export' 	  	  => true,
				'rewrite' 		  	  => array( 'slug' => 'dt_cpt_pet_sitters' ),
				'capability_type' 	  => 'post');

			register_post_type( 'dt_cpt_pet_sitters', $args );

			# Pet Sitter Age
			register_taxonomy( 'dt_tax_pet_sitter_ages', 'dt_cpt_pet_sitters', array( 
				"hierarchical" => true,
				"label" => __( "Ages",'dt-petshop-plugin' ),
				"singular_label" => __( "Age",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_sitter_ages' ),
				'show_in_rest' => true,
			) );			

			# Pet Sitter District
			register_taxonomy( 'dt_tax_pet_sitter_districts', 'dt_cpt_pet_sitters', array(
				"hierarchical" => true,
				"label" => __( "Districts",'dt-petshop-plugin' ),
				"singular_label" => __( "District",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_sitter_districts' ),
				'show_in_rest' => true,
			) );

			# Pet Sitter Experience
			register_taxonomy( 'dt_tax_pet_sitter_experiences', 'dt_cpt_pet_sitters', array( 
				"hierarchical" => true,
				"label" => __( "Experiences",'dt-petshop-plugin' ),
				"singular_label" => __( "Experience",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_tax_pet_sitter_experiences' ),
				'show_in_rest' => true,
			) );

			# Pet Sitter Gender
			register_taxonomy( 'dt_tax_pet_sitter_genders', 'dt_cpt_pet_sitters', array( 
				"hierarchical" => true,
				"label" => __( "Genders",'dt-petshop-plugin' ),
				"singular_label" => __( "Gender",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_sitter_genders' ),
				'show_in_rest' => true,
			) );

			# Pet Sitter Role
			register_taxonomy( 'dt_tax_pet_sitter_roles', 'dt_cpt_pet_sitters', array( 
				"hierarchical" => true,
				"label" => __( "Roles",'dt-petshop-plugin' ),
				"singular_label" => __( "Role",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_tax_pet_sitter_roles' ),
				'show_in_rest' => true,
			) );		
		}

		function save_post_meta( $post_id ) {
			
			if( key_exists ( '_inline_edit',$_POST )) :
				if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
			endif;
			
			if( key_exists( 'dt_theme_pet_sitter_meta_nonce',$_POST ) ) :
				if ( ! wp_verify_nonce( $_POST['dt_theme_pet_sitter_meta_nonce'], 'dt_theme_pet_sitter_nonce') ) return;
			endif;
		 
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

			if (!current_user_can('edit_post', $post_id)) :
				return;
			endif;

			if ( (key_exists('post_type', $_POST)) && ('dt_cpt_pet_sitters' == $_POST['post_type']) ) :

				$layout = isset($_POST['layout']) ? $_POST['layout'] : '';
				if($layout) :
					$settings = array ();
					$settings['layout'] = $layout;

					$settings['sub-title-bg'] = isset ( $_POST['sub-title-bg'] ) ? $_POST['sub-title-bg'] : "";
					$settings['sub-title-bg-repeat'] = isset ( $_POST['sub-title-bg-repeat'] ) ? $_POST['sub-title-bg-repeat'] : "";
					$settings['sub-title-opacity'] = isset ( $_POST['sub-title-opacity'] ) ? $_POST['sub-title-opacity'] : "";
					$settings['sub-title-bg-position'] = isset ( $_POST['sub-title-bg-position'] ) ? $_POST['sub-title-bg-position'] : "";
					$settings['sub-title-bg-color'] = isset ( $_POST['sub-title-bg-color'] ) ? $_POST['sub-title-bg-color'] : "";

					if($layout == 'with-both-sidebar') {
						$settings['show-standard-sidebar-left'] = isset( $_POST['show-standard-sidebar-left'] ) ? $_POST['show-standard-sidebar-left'] : '';
						$settings['show-standard-sidebar-right'] = isset( $_POST['show-standard-sidebar-right'] ) ? $_POST['show-standard-sidebar-right'] : '';
						$settings['widget-area-left'] = isset( $_POST['dttheme']['widgetareas-left'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-left'])) : '';
						$settings['widget-area-right'] = isset( $_POST['dttheme']['widgetareas-right'] ) ? array_unique(array_filter($_POST['dttheme']['widgetareas-right'])) : '';
					} elseif($layout == 'with-left-sidebar') {
						$settings['show-standard-sidebar-left'] = isset( $_POST['show-standard-sidebar-left'] ) ? $_POST['show-standard-sidebar-left'] : '';
						$settings['widget-area-left'] =  isset($_POST['dttheme']['widgetareas-left']) ? array_unique(array_filter($_POST['dttheme']['widgetareas-left'])) : '';
					} elseif($layout == 'with-right-sidebar') {
						$settings['show-standard-sidebar-right'] = $_POST['show-standard-sidebar-right'];
						$settings['widget-area-right'] =  isset($_POST['dttheme']['widgetareas-right']) ? array_unique(array_filter($_POST['dttheme']['widgetareas-right'])) : '';
					}
					
					
					$settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
					$settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
					$settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";
					
					$settings ['price'] = isset ( $_POST ['price'] ) ? $_POST ['price'] : "";
					$settings ['google_social_link'] = isset ( $_POST ['google_social_link'] ) ? $_POST ['google_social_link'] : "";
					$settings ['twitter_social_link'] = isset ( $_POST ['twitter_social_link'] ) ? $_POST ['twitter_social_link'] : "";
					$settings ['facebook_social_link'] = isset ( $_POST ['facebook_social_link'] ) ? $_POST ['facebook_social_link'] : "";
	
					update_post_meta ( $post_id, "_custom_settings", array_filter ( $settings ) );
				endif;
			
			endif;			
		}
		

		function dt_template_include($template) {
			
			if (is_singular( 'dt_cpt_pet_sitters' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_cpt_pet_sitters.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_cpt_pet_sitters.php';
				}
			} elseif ( is_tax('dt_tax_pet_sitter_roles') || is_tax('dt_tax_pet_sitter_genders') || is_tax('dt_tax_pet_sitter_experiences') || is_tax('dt_tax_pet_sitter_cities')
				|| is_tax('dt_tax_pet_sitter_ages') ) {
					
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-dt_cpt_pet_sitters.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-dt_cpt_pet_sitters.php';
				}
			}
			return $template;
			
		}
		
	}
}

