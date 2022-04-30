<?php
/**
 * Theme Functions
 *
 * @package DTtheme
 * @author DesignThemes
 * @link http://wedesignthemes.com
 */

define( 'PETSWORLD_THEME_DIR', get_template_directory() );
define( 'PETSWORLD_THEME_URI', get_template_directory_uri() );
define( 'PETSWORLD_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );
define( 'PETSWORLD_SETTINGS', 'petsworld-opts' );

if (function_exists ('wp_get_theme')) :
	$themeData = wp_get_theme();
	define( 'THEME_NAME', $themeData->get('Name'));
	define( 'THEME_VERSION', $themeData->get('Version'));
endif;

define( 'PETSWORLD_LANG_DIR', PETSWORLD_THEME_DIR. '/languages' );

/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * --------------------------------------------------------------------------- */
load_theme_textdomain( 'petsworld', PETSWORLD_LANG_DIR );

/* ---------------------------------------------------------------------------
 * Loads the Admin Panel Scripts
 * --------------------------------------------------------------------------- */
function petsworld_admin_scripts() {

	wp_enqueue_style('petsworld-admin', PETSWORLD_THEME_URI .'/framework/theme-options/style.css');
	wp_enqueue_style('petsworld-chosen', PETSWORLD_THEME_URI .'/framework/theme-options/css/chosen.css');
	wp_enqueue_style('wp-color-picker');

	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('wp-color-picker');

	wp_enqueue_script('petsworld-browser', PETSWORLD_THEME_URI . '/framework/theme-options/js/jquery.browser.min.js');
	wp_enqueue_script('petsworld-tooltip', PETSWORLD_THEME_URI . '/framework/theme-options/js/jquery.tools.min.js');
	wp_enqueue_script('petsworld-chosen', PETSWORLD_THEME_URI . '/framework/theme-options/js/chosen.jquery.min.js');
	wp_enqueue_script('petsworld-custom', PETSWORLD_THEME_URI . '/framework/theme-options/js/dttheme.admin.js', array( 'wp-blocks' ));
	wp_enqueue_media();

	wp_localize_script('petsworld-custom', 'objectL10n', array(
		'saveall' => esc_html__('Save All', 'petsworld'),
		'saving' => esc_html__('Saving ...', 'petsworld'),
		'noResult' => esc_html__('No Results Found!', 'petsworld'),
		'resetConfirm' => esc_html__('This will restore all of your options to default. Are you sure?', 'petsworld'),
		'importConfirm' => esc_html__('You are going to import the dummy data provided with the theme, kindly confirm?', 'petsworld'),
		'backupMsg' => esc_html__('Click OK to backup your current saved options.', 'petsworld'),
		'backupSuccess' => esc_html__('Your options are backuped successfully', 'petsworld'),
		'backupFailure' => esc_html__('Backup Process not working', 'petsworld'),
		'disableImportMsg' => esc_html__('Importing is disabled.. :), Please select atleast import type','petsworld'),
		'restoreMsg' => esc_html__('Warning: All of your current options will be replaced with the data from your last backup! Proceed?', 'petsworld'),
		'restoreSuccess' => esc_html__('Your options are restored from previous backup successfully', 'petsworld'),
		'restoreFailure' => esc_html__('Restore Process not working', 'petsworld'),
		'importMsg' => esc_html__('Click ok import options from the above textarea', 'petsworld'),
		'importSuccess' => esc_html__('Your options are imported successfully', 'petsworld'),
		'importFailure' => esc_html__('Import Process not working', 'petsworld')));
}
add_action( 'admin_enqueue_scripts', 'petsworld_admin_scripts' );

/* ---------------------------------------------------------------------------
 * Loads the Options Panel
 * --------------------------------------------------------------------------- */
require_once( PETSWORLD_THEME_DIR .'/framework/utils.php' );
require_once( PETSWORLD_THEME_DIR .'/framework/fonts.php' );
require_once( PETSWORLD_THEME_DIR .'/framework/theme-options/init.php' );

/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * --------------------------------------------------------------------------- */

// Functions --------------------------------------------------------------------
require_once( PETSWORLD_THEME_DIR .'/functions/register-functions.php' );

// Header -----------------------------------------------------------------------
require_once( PETSWORLD_THEME_DIR .'/functions/register-head.php' );

// Menu -------------------------------------------------------------------------
require_once( PETSWORLD_THEME_DIR .'/functions/register-menu.php' );
require_once( PETSWORLD_THEME_DIR .'/functions/register-mega-menu.php' );

// Hooks ------------------------------------------------------------------------
require_once( PETSWORLD_THEME_DIR .'/functions/register-hooks.php' );

// Widgets ----------------------------------------------------------------------
add_action( 'widgets_init', 'petsworld_widgets_init' );
function petsworld_widgets_init() {
	require_once( PETSWORLD_THEME_DIR .'/functions/register-widgets.php' );
}

// Plugins ----------------------------------------------------------------------
require_once( PETSWORLD_THEME_DIR .'/functions/register-plugins.php' );

// WooCommerce ------------------------------------------------------------------
if( function_exists( 'is_woocommerce' ) ){
	require_once( PETSWORLD_THEME_DIR .'/functions/register-woocommerce-functions.php' );
	require_once( PETSWORLD_THEME_DIR .'/functions/register-woocommerce.php' );
}

// Register Gutenberg -----------------------------------------------------------
require_once( PETSWORLD_THEME_DIR .'/functions/register-gutenberg-editor.php' ); ?>