<?php
if (! class_exists ( 'DTPetsPostType' )) {

	class DTPetsPostType {

		function __construct() {

			add_action( 'add_meta_boxes', array(
				$this, 'dt_pets_metaboxes' ) );

			add_action ( 'init', array (
				$this, 'dt_init' ) );

			// Add Hook into the 'template_include' filter
			add_filter ( 'template_include', array (
				$this, 'dt_template_include' ) );
		}

		function dt_pets_metaboxes() {

			add_meta_box( 'dt-pet-owner-info', __('Submitter Info','dt-petshop-plugin'),
				array( $this, 'dt_pet_submitter_metabox'),
				'dt_cpt_pets', 'side', 'high');

			add_meta_box( 'dt-pet-default-metabox', __('Default Options','dt-petshop-plugin'),
				array( $this, 'dt_pet_default_metabox'),
				'dt_cpt_pets', 'normal', 'high');
		}

		function dt_pet_submitter_metabox( $post ) {

			$submitter = get_post_meta ( $post->ID, '_pet_submitter', TRUE );
			
			if( empty( $submitter) ) {
				$submitter = get_current_user_id();
			}
			
			$submitter = get_userdata( $submitter );			
			$submitter  = $submitter->display_name;
			$submitter = !empty( $submitter ) ? $submitter : $submitter->nickname;
			echo 'Submitted By <strong>'. $submitter.'</strong>';
			
		}
		
		function dt_pet_default_metabox() {
			include_once plugin_dir_path ( __FILE__ ) . 'metaboxes/dt_cpt_pets_metabox.php';
		}

		function dt_init() {
			
			# Save Post Meta Data
			add_action ( 'save_post', array ( $this, 'save_post_meta' ) );

			# Pets
			$labels = array( 'name'   => __ ( 'Pets', 'dt-petshop-plugin' ),
				'singular_name' 	  => __ ( 'Pet', 'dt-petshop-plugin' ),
				'menu_name' 		  => __ ( 'Pets', 'dt-petshop-plugin' ),
				'add_new' 			  => __ ( 'Add New Pet', 'dt-petshop-plugin' ),
				'add_new_item' 		  => __ ( 'Add New Pet', 'dt-petshop-plugin' ),
				'new_item' 			  => __ ( 'New Pet', 'dt-petshop-plugin' ),
				'edit_item' 		  => __ ( 'Edit Pet', 'dt-petshop-plugin' ),
				'view_item' 		  => 	__ ( 'View Pet', 'dt-petshop-plugin' ),
				'all_items' 		  => 	__ ( 'Pets', 'dt-petshop-plugin' ),
				'search_items' 		  =>	__ ( 'Search Pets', 'dt-petshop-plugin' ),
				'parent_item_colon'   => 	__ ( 'Parent Pets:', 'dt-petshop-plugin' ),
				'not_found' 		  => 	__ ( 'No pets found', 'dt-petshop-plugin' ),
				'not_found_in_trash'  => 	__ ( 'No pets found in Trash', 'dt-petshop-plugin' ));

			$args = array( 'labels' => $labels,
				'hierarchical' 		  => false,
				'supports' 			  => array ( 'title', 'editor', 'thumbnail', 'revisions'),
				'show_in_rest' 		  => true,
				'public' 			  => true,
				'show_ui' 			  => true,
				'menu_position' 	  => 4,
				'menu_icon'			  => 'dashicons-pets',
				'show_in_menu' 		  => true,
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive' 		  => true,
				'query_var' 	  	  => true,
				'can_export' 	  	  => true,
				'rewrite' 		  	  => array( 'slug' => 'dt_cpt_pets' ),
				'capability_type' 	  => 'post');

			register_post_type( 'dt_cpt_pets', $args );

			# Pet Age
			register_taxonomy( 'dt_tax_pet_ages', 'dt_cpt_pets', array( 
				"hierarchical" => true,
				"label" => __( "Ages",'dt-petshop-plugin' ),
				"singular_label" => __( "Age",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_ages' ),
				'show_in_rest' => true,
			) );			

			# Pet Breed
			register_taxonomy( 'dt_tax_pet_breeds', 'dt_cpt_pets', array( 
				"hierarchical" => true,
				"label" => __( "Breeds",'dt-petshop-plugin' ),
				"singular_label" => __( "Breed",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_breeds' ),
				'show_in_rest' => true,
			) );

			# Pet District
			register_taxonomy( 'dt_tax_pet_districts', 'dt_cpt_pets', array(
				"hierarchical" => true,
				"label" => __( "Districts",'dt-petshop-plugin' ),
				"singular_label" => __( "District",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_districts' ),
				'show_in_rest' => true,
			) );			

			# Pet Gender
			register_taxonomy( 'dt_tax_pet_genders', 'dt_cpt_pets', array( 
				"hierarchical" => true,
				"label" => __( "Genders",'dt-petshop-plugin' ),
				"singular_label" => __( "Gender",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_genders' ),
				'show_in_rest' => true,
			) );

			# Pet Size
			register_taxonomy( 'dt_tax_pet_sizes', 'dt_cpt_pets', array( 
				"hierarchical" => true,
				"label" => __( "Sizes",'dt-petshop-plugin' ),
				"singular_label" => __( "Size",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_sizes' ),
				'show_in_rest' => true,
			) );						

			# Pet Types
			register_taxonomy( 'dt_tax_pet_types', 'dt_cpt_pets', array( 
				"hierarchical" => true,
				"label" => __( "Types",'dt-petshop-plugin' ),
				"singular_label" => __( "Type",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_types' ),
				'show_in_rest' => true,
			) );

			# Pet Services
			register_taxonomy( 'dt_tax_pet_services', 'dt_cpt_pets', array( 
				"hierarchical" => true,
				"label" => __( "Services",'dt-petshop-plugin' ),
				"singular_label" => __( "Service",'dt-petshop-plugin' ),
				"show_admin_column" => true,
				"query_var" => true,
				"rewrite" => array( 'slug' => 'dt_pet_services' ),
				'show_in_rest' => true,
			) );
		}
		
		function save_post_meta( $post_id ) {
			
			if( key_exists ( '_inline_edit',$_POST )) :
				if ( wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) return;
			endif;
			
			if( key_exists( 'dt_theme_pet_meta_nonce',$_POST ) ) :
				if ( ! wp_verify_nonce( $_POST['dt_theme_pet_meta_nonce'], 'dt_theme_pet_nonce') ) return;
			endif;
		 
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

			if (!current_user_can('edit_post', $post_id)) :
				return;
			endif;

			if ( (key_exists('post_type', $_POST)) && ('dt_cpt_pets' == $_POST['post_type']) ) :

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
	
					update_post_meta ( $post_id, "_custom_settings", array_filter ( $settings ) );
				endif;
			
			endif;			
		}
		
		function dt_template_include($template) {
			
			if (is_singular('dt_cpt_pets' )) {
				if (! file_exists ( get_stylesheet_directory () . '/single-dt_cpt_pets.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/single-dt_cpt_pets.php';
				}
			} elseif ( is_tax('dt_tax_pet_ages') || is_tax('dt_tax_pet_breeds') || is_tax('dt_tax_pet_cities') || is_tax('dt_tax_pet_genders')
				|| is_tax('dt_tax_pet_sizes') || is_tax( 'dt_tax_pet_types' ) || is_tax ( 'dt_pet_services' )) {
					
				if (! file_exists ( get_stylesheet_directory () . '/taxonomy-dt_cpt_pets.php' )) {
					$template = plugin_dir_path ( __FILE__ ) . 'templates/taxonomy-dt_cpt_pets.php';
				}
			}
			
			return $template;
			
		}
	}
}