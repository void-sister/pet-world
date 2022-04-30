<?php
if (! class_exists ( 'DTCoreCustomPostTypes' )) {

	/**
	 *
	 * @author iamdesigning11
	 *        
	 */
	class DTCoreCustomPostTypes {
		
		function __construct() {

			// Pets Post Type			
			require_once plugin_dir_path ( __FILE__ ) . '/dt-pets-post-type.php';
			if( class_exists('DTPetsPostType') ) {
				new DTPetsPostType();
			}

            // Volunteers Post Type
            require_once plugin_dir_path ( __FILE__ ) . '/dt-volunteers-post-type.php';
            if( class_exists('DTVolunteersPostType') ) {
                new DTVolunteersPostType();
            }

            // Pet Shelters Post Type
            require_once plugin_dir_path ( __FILE__ ) . '/dt-pet-shelters-post-type.php';
            if( class_exists('DTPetSheltersPostType') ) {
                new DTPetSheltersPostType();
            }

			// Pet Sitters Post Type
			require_once plugin_dir_path ( __FILE__ ) . '/dt-pet-sitters-post-type.php';
			if( class_exists('DTPetSitterPostType') ) {
				new DTPetSitterPostType();
			}
			

			// Portfolio custom post type
			require_once plugin_dir_path ( __FILE__ ) . '/dt-portfolio-post-type.php';
			if (class_exists ( 'DTPortfolioPostType' )) {
				new DTPortfolioPostType();
			}

			// Add Hook into the 'admin_init()' action
			add_action ( 'admin_init', array (
					$this,
					'dt_admin_init'
			) );

			add_action( 'admin_head-edit-tags.php', array(
				$this, 'dt_remove_parent_taxonomy' ) );

			add_action( 'admin_head-term.php', array(
				$this, 'dt_remove_parent_taxonomy' ) );			
		}
		
		/**
		 * A function hook that the WordPress core launches at 'admin_init' points
		 */
		function dt_admin_init() {
			wp_enqueue_style ( 'dt-custom-post-css', plugin_dir_url ( __FILE__ ) . 'css/styles.css' );
			wp_enqueue_script ( 'dt-metabox-script', plugin_dir_url ( __FILE__ ) . 'js/dt.metabox.js', array (), false, true );
		}

		function dt_remove_parent_taxonomy() {

			if( $_GET['taxonomy'] == 'dt_tax_pet_breeds' || $_GET['taxonomy'] == 'dt_tax_pet_ages'
				|| $_GET['taxonomy'] == 'dt_tax_pet_genders' || $_GET['taxonomy'] == 'dt_tax_pet_sizes'
				|| $_GET['taxonomy'] == 'dt_tax_pet_types' /*|| $_GET['taxonomy'] == 'dt_tax_pet_services' */

				|| $_GET['taxonomy'] == 'dt_tax_pet_sitter_experiences' || $_GET['taxonomy'] == 'dt_tax_pet_sitter_genders'
				|| $_GET['taxonomy'] == 'dt_tax_pet_sitter_roles') {

				$parent = 'parents(".term-parent-wrap")';?>
				<script type="text/javascript">
					jQuery(document).ready(function($){
				 		$('label[for=parent]').<?php echo $parent; ?>.remove();
				 	});
				</script>
				<?php
			}
		}		
	}
}
?>