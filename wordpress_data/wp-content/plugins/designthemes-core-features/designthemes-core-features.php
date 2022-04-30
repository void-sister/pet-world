<?php
/*
 * Plugin Name:	DesignThemes Core Features Plugin
 * URI: 	http://wedesignthemes.com/plugins/designthemes-core-features
 * Description: A simple wordpress plugin designed to implements <strong>core features of DesignThemes</strong>
 * Version: 	1.8
 * Author: 		DesignThemes
 * Text Domain: petsworld-core
 * Author URI:	http://themeforest.net/user/designthemes
 */
if (! class_exists ( 'DTCorePlugin' )) {

	/**
	 * Basic class to load Shortcodes & Custom Posts
	 *
	 * @author iamdesigning11
	 */
	class DTCorePlugin {

		function __construct() {

			$this->plugin_dir_path = plugin_dir_path ( __FILE__ );

			// Add Hook into the 'init()' action
			add_action ( 'init', array (
					$this, 'dtLoadPluginTextDomain'
			) );

			// Register Shortcodes
			require_once plugin_dir_path ( __FILE__ ) . '/shortcodes/register-shortcodes.php';

			if (class_exists ( 'DTCoreShortcodes' )) {
				$dt_core_shortcodes = new DTCoreShortcodes ();
			}

			// Register Custom Post Types
			require_once plugin_dir_path ( __FILE__ ) . '/custom-post-types/register-post-types.php';

			if (class_exists ( 'DTCoreCustomPostTypes' )) {
				$dt_core_custom_posts = new DTCoreCustomPostTypes ();
			}

			if( $this->dt_core_is_plugin_active('js_composer/js_composer.php') ) {

				// Register Visual Composer Modules
				require_once plugin_dir_path ( __FILE__ ) . '/visual-composer/register-vc.php';
				if (class_exists ( 'DTCoreVC' )) {
					new DTCoreVC ();
				}
			}

			require_once plugin_dir_path ( __FILE__ ) . '/register-likes.php';

			// Register Privacy
			require_once plugin_dir_path ( __FILE__ ) . '/privacy/register-privacy.php';


			// Register Widgets
			add_action('widgets_init', array( $this, 'register_widgets' ) );
			require_once( plugin_dir_path ( __FILE__ ) .'/widgets/widget-twitter.php' );
			require_once( plugin_dir_path ( __FILE__ ) .'/widgets/widget-flickr.php' );
			require_once( plugin_dir_path ( __FILE__ ) .'/widgets/widget-recent-posts.php' );
			require_once( plugin_dir_path ( __FILE__ ) .'/widgets/widget-recent-portfolios.php' );
			require_once( plugin_dir_path ( __FILE__ ) .'/widgets/widget-pets.php' );

			// Register Metaboxes
			add_action( 'init', array( $this, 'register_metaboxes' ) );
		}

		function register_widgets() {
			register_widget('PetsWorld_Twitter');
			register_widget('PetsWorld_Flickr');
			register_widget('PetsWorld_Recent_Posts');
			register_widget('PetsWorld_Portfolio_Widget');
			register_widget('PetsWorld_Pets_Widget');
		}

		function register_metaboxes(){
			require_once( plugin_dir_path ( __FILE__ ) .'/metaboxes/post-metabox.php' );
			require_once( plugin_dir_path ( __FILE__ ) .'/metaboxes/page-metabox.php' );

			if ( class_exists( 'Tribe__Events__Main' ) )
				require_once( plugin_dir_path ( __FILE__ ) .'/metaboxes/event-metabox.php' );
		}

		function dt_core_is_plugin_active($plugin) {
			return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || $this->dt_core_is_plugin_active_for_network( $plugin );
		}

		function dt_core_is_plugin_active_for_network( $plugin ) {
			if ( !is_multisite() )
				return false;

			$plugins = get_site_option( 'active_sitewide_plugins');
			if ( isset($plugins[$plugin]) )
				return true;

			return false;
		}

		/**
		 * To load text domain
		 */
		function dtLoadPluginTextDomain() {
			load_plugin_textdomain ( 'petsworld-core', false, dirname ( plugin_basename ( __FILE__ ) ) . '/languages/' );
		}

		/**
		 */
		public static function dtCorePluginActivate() {
		}

		/**
		 */
		public static function dtCorePluginDectivate() {
		}
	}
}

if (class_exists ( 'DTCorePlugin' )) {

	register_activation_hook ( __FILE__, array (
			'DTCorePlugin',
			'dtCorePluginActivate'
	) );
	register_deactivation_hook ( __FILE__, array (
			'DTCorePlugin',
			'dtCorePluginDectivate'
	) );

	$dt_core_plugin = new DTCorePlugin ();
}
?>