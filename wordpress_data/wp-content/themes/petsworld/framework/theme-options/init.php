<?php
/* ---------------------------------------------------------------------------
 * Create menu for theme options panel
 * --------------------------------------------------------------------------- */
function petsworld_create_admin_menu() {
	/**
	 * Creates main options page.
	*/
	add_theme_page( THEME_NAME . esc_html__(' Theme Options', 'petsworld'), THEME_NAME . esc_html__(' Options', 'petsworld'), 'manage_options', 'petsworld-opts', 'petsworld_options_page'	);
}
add_action('admin_menu', 'petsworld_create_admin_menu');
require_once(PETSWORLD_THEME_DIR . '/framework/theme-options/settings.php');

/* ---------------------------------------------------------------------------
 * Create function to init petsworld options
 * --------------------------------------------------------------------------- */
add_action('admin_init', 'petsworld_admin_options_init', 1);
function petsworld_admin_options_init() {
	register_setting(PETSWORLD_SETTINGS, PETSWORLD_SETTINGS);
	add_option(PETSWORLD_SETTINGS, petsworld_default_option());

	if (isset($_POST['dttheme-option-save'])) :
		petsworld_ajax_option_save();
	endif;

	if (isset($_POST['dttheme']['reset'])) :
		delete_option(PETSWORLD_SETTINGS);
		update_option(PETSWORLD_SETTINGS, petsworld_default_option()); # To set Default options
		wp_redirect(admin_url('admin.php?page=parent&reset=true'));
		exit;
	endif;
}

function petsworld_ajax_option_save() {

	$ajax_ref_check = check_ajax_referer('dttheme_wpnonce', 'dttheme_admin_wpnonce');

	if( $ajax_ref_check === false ) {
		return false;
	} else {

		$data = $_POST;

		unset($data['_wp_http_referer'], $data['_wpnonce'], $data['action']);
		unset($data['dttheme_admin_wpnonce'], $data['dttheme-option-save'], $data['option_page']);

		$msg = array(
			'success' => false, 
			'message' => esc_html__('Error: Options not saved, please try again.', 'petsworld')
		);

		$data = array_filter($data['dttheme']);

		if (get_option(PETSWORLD_SETTINGS) != $data) {
			if (update_option(PETSWORLD_SETTINGS, $data))
				$msg = array(
					'success' => 'options_saved',
					'message' => esc_html__('Options Saved.', 'petsworld')
				);
		} else {
			$msg = array(
				'success' => true,
				'message' => esc_html__('Options Saved.', 'petsworld')
			);
		}

		$echo = json_encode($msg);
		header('Content-Type: application/json; charset='.get_option('blog_charset'));
		echo "{$echo}";
		exit;
	}
}

/* ---------------------------------------------------------------------------
 * Backup And Restore theme options
 * --------------------------------------------------------------------------- */
add_action('wp_ajax_petsworld_backup_and_restore_action', 'petsworld_backup_and_restore_action');
function petsworld_backup_and_restore_action() {
	
	$save_type = $_REQUEST['type'];
	
	if ($save_type == 'backup_options') :
	
		$data = array(
			'general' => petsworld_option('general'),
			'layout' => petsworld_option('layout'),
			'social' => petsworld_option('social'),
			'pageoptions' => petsworld_option('pageoptions'),
			'woo' => petsworld_option('woo'),
			'colors' => petsworld_option('colors'),
			'fonts' => petsworld_option('fonts'),
			'backup' => date('r')
		);
		
		update_option("dt_theme_backup", $data);
		die('1');
	elseif ($save_type == 'restore_options') :
		$data = get_option("dt_theme_backup");
		update_option(PETSWORLD_SETTINGS, $data);
		die('1');
	elseif ($save_type == "import_options") :
		$data = $_REQUEST['data'];
		$data =  unserialize( stripcslashes($data) );
		update_option(PETSWORLD_SETTINGS, $data);
		die('1');
	elseif( $save_type == "reset_options") :
		delete_option(PETSWORLD_SETTINGS);
		update_option(PETSWORLD_SETTINGS, petsworld_default_option()); #To set Default options
		die('1');
	endif;
}

/* ---------------------------------------------------------------------------
 * Getting privacy button action selection box
 * --------------------------------------------------------------------------- */
if ( ! function_exists( 'petsworld_privacy_btnaction_selection' ) ) {
	function petsworld_privacy_btnaction_selection($name = '', $selected = "") {
		$actions = array( '' => esc_html__('Dismiss the notification', 'petsworld'), 'link' => esc_html__('Link to another page', 'petsworld'), 'info_modal' => esc_html__('Open info modal on privacy and cookies', 'petsworld') );
	
		$name = ! empty ( $name ) ? "name='dttheme[privacy-bar][{$name}][action]'" : '';
		$out = "<select class='button-select' {$name}>"; // name attribute will be added to this by jQuery menuAdd()
		foreach ( $actions as $key => $value ) :
			$s = selected ( $key, $selected, false );
			$v = $value;
			$out .= "<option value='{$key}' {$s} >{$v}</option>";
		endforeach;
		$out .= "</select>";
	
		return $out;
	}
}

/* ---------------------------------------------------------------------------
 * Create function to get theme options
 * --------------------------------------------------------------------------- */
function petsworld_option($key1, $key2 = '') {
	$options = get_option ( PETSWORLD_SETTINGS );
	$output = NULL;

	if (is_array ( $options )) {

		if (array_key_exists ( $key1, $options )) {
			$output = $options [$key1];
			if (is_array ( $output ) && ! empty ( $key2 )) {
				$output = (array_key_exists ( $key2, $output ) && (! empty ( $output [$key2] ))) ? $output [$key2] : NULL;
			}
		} else {
			$output = $output;
		}
	}
	return $output;
}

/* ---------------------------------------------------------------------------
 * Create admin panel image preview
 * --------------------------------------------------------------------------- */
function petsworld_adminpanel_image_preview($src, $backend = true, $default = "no-image.jpg") {
	$default = ($backend) ? PETSWORLD_THEME_URI . "/framework/theme-options/images/" . $default : PETSWORLD_THEME_URI . "/images/" . $default;
	$src = ! empty ( $src ) ? $src : $default;
	$output = "<div class='bpanel-option-help'>\n";
	$output .= "<a href='#' class='a_image_preivew'> <img src='" . PETSWORLD_THEME_URI . "/framework/theme-options/images/image-preview.png' alt='img' /> </a>\n";
	$output .= "\r<div class='bpanel-option-help-tooltip imagepreview'>\n";
	$output .= "\r<img src='{$src}' data-default='{$default}'/>";
	$output .= "\r</div>\n";
	$output .= "</div>\n";
	echo "{$output}";
}

/* ---------------------------------------------------------------------------
 * Types of Background option available
 * --------------------------------------------------------------------------- */
function petsworld_bgtypes($name, $parent, $child) {
	$args = array (
		"bg-patterns" => esc_html__ ( "Pattern", 'petsworld' ),
		"bg-custom" => esc_html__ ( "Custom Background", 'petsworld' ),
		"bg-none" => esc_html__ ( "None", 'petsworld' ) 
	);
	$out = '<div class="bpanel-option-set">';
	$out .= "<label>" . esc_html__ ( "Background Type", 'petsworld' ) . "</label>";
	$out .= "<div class='clear'></div>";
	$out .= "<select class='bg-type dt-chosen-select' name='{$name}'>";
	foreach ( $args as $k => $v ) :
		$rs = selected ( $k, petsworld_option ( $parent, $child ), false );
		$out .= "<option value='{$k}' {$rs}>{$v}</option>";
	endforeach;
	$out .= "</select>";
	$out .= '</div>';
	echo "{$out}";
}

/* ---------------------------------------------------------------------------
 * Getting color picker for color option
 * --------------------------------------------------------------------------- */
function petsworld_admin_color_picker($label, $name, $value, $tooltip = NULL) {
	$output = "<div class='bpanel-option-set'>\n";
	if (! empty ( $label )) :
		$output .= "<label>{$label}</label>";
		$output .= "<div class='hr_invisible'></div><div class='clear'></div>";
	endif;
	
	$output .= "<input type='text' class='dt-color-field medium' name='{$name}' value='{$value}' />";

	echo "{$output}";
	if ($tooltip != NULL)
		petsworld_adminpanel_tooltip ( $tooltip );

	echo "</div>\n";
}

/** dttheme_adminpanel_tooltip()
 * Objective:
 *		To place tooltip content in thme option page at back end.
 * args:
 *		1. $tooltip = content which is shown as tooltip
 **/
function petsworld_adminpanel_tooltip($tooltip) {
	$output = "<div class='bpanel-option-help'>\n";
	$output .= "<a href='#'> <img src='" . PETSWORLD_THEME_URI . "/framework/theme-options/images/help.png'/> </a>\n";
	$output .= "\r<div class='bpanel-option-help-tooltip'>\n";
	$output .= $tooltip;
	$output .= "\r</div>\n";
	$output .= "</div>\n";
	echo "{$output}";
}

/* ---------------------------------------------------------------------------
 * Getting color picker for color option
 * --------------------------------------------------------------------------- */
function petsworld_admin_color_picker_two($name, $value) {
	echo "<input type='text' class='dt-color-field small' name='{$name}' value='{$value}' />";
}

/* ---------------------------------------------------------------------------
 * Getting jquery ui slider
 * --------------------------------------------------------------------------- */
function petsworld_admin_jqueryuislider($label, $id = '', $value = '', $px = "px") {
	$div_value = (! empty ( $value ) && ($px == "px")) ? $value . "px" : $value;
	$output = "<label>{$label}</label>";
	$output .= "<div class='clear'></div>";
	$output .= "<div id='{$id}' class='dttheme-slider' data-for='{$px}'></div>";
	$output .= "<input type='hidden' class='' name='{$id}' value='{$value}'/>";
	$output .= "<div class='dttheme-slider-txt'>{$div_value}</div>";
	echo "{$output}";
}

/* ---------------------------------------------------------------------------
 * Getting theme switch button
 * --------------------------------------------------------------------------- */
function petsworld_switch($label, $parent, $name) {
	$checked = ("true" == petsworld_option ( $parent, $name )) ? ' checked="checked"' : '';
	$switchclass = ("true" == petsworld_option ( $parent, $name )) ? 'checkbox-switch-on' : 'checkbox-switch-off';
	$out = "<div data-for='dttheme-{$parent}-{$name}' class='checkbox-switch {$switchclass}'></div>";
	$out .= "<input id='dttheme-{$parent}-{$name}' class='hidden' name='dttheme[{$parent}][{$name}]' type='checkbox' value='true' {$checked} />";
	echo "{$out}";
}

/* ---------------------------------------------------------------------------
 * Return List of social icons
 * --------------------------------------------------------------------------- */
function petsworld_listSocial() {
	$sociables = array('fa-dribbble' => 'Dribble', 'fa-flickr' => 'Flickr', 'fa-github' => 'GitHub', 'fa-pinterest' => 'Pinterest', 'fa-stack-overflow' => 'Stack Overflow', 'fa-twitter' => 'Twitter', 'fa-youtube' => 'YouTube', 'fa-android' => 'Android', 'fa-dropbox' => 'Dropbox', 'fa-instagram' => 'Instagram', 'fa-windows' => 'Windows', 'fa-apple' => 'Apple', 'fa-facebook' => 'Facebook', 'fa-google-plus' => 'Google Plus', 'fa-linkedin' => 'LinkedIn', 'fa-skype' => 'Skype', 'fa-tumblr' => 'Tumblr', 'fa-vimeo-square' => 'Vimeo');
	
	return $sociables;
}

/* ---------------------------------------------------------------------------
 * Getting theme sociable selection box
 * --------------------------------------------------------------------------- */
function petsworld_sociables_selection($name = '', $selected = "") {
	$sociables = petsworld_listSocial();

	$name = ! empty ( $name ) ? "name='dttheme[social][{$name}][icon]'" : '';
	$out = "<select class='social-select' {$name}>"; // name attribute will be added to this by jQuery menuAdd()
	foreach ( $sociables as $key => $value ) :
		$s = selected ( $key, $selected, false );
		$v = ucwords ( $value );
		$out .= "<option value='{$key}' {$s} >{$v}</option>";
	endforeach;
	$out .= "</select>";

	return $out;
}

/* ---------------------------------------------------------------------------
 * Add new mimes to use custom font upload
 * --------------------------------------------------------------------------- */
add_filter('upload_mimes', 'petsworld_upload_mimes');
function petsworld_upload_mimes( $existing_mimes = array() ){
	$existing_mimes['woff'] = 'font/woff';
	$existing_mimes['ttf'] 	= 'font/ttf';
	$existing_mimes['svg'] 	= 'font/svg';
	$existing_mimes['eot'] 	= 'font/eot';
	return $existing_mimes;
} ?>