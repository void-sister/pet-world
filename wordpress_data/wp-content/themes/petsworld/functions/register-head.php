<?php
/* ---------------------------------------------------------------------------
 * Loading Theme Scripts
 * --------------------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'petsworld_enqueue_scripts');
if (!function_exists('petsworld_enqueue_scripts')) {
	function petsworld_enqueue_scripts() {

		$library_uri = PETSWORLD_THEME_URI.'/functions';

		// ie scripts ----------------------------------------------------------------
		wp_enqueue_script('jq-html5', $library_uri.'/js/html5shiv.min.js', array(), '3.7.2', true);
		wp_script_add_data('jq-html5', 'conditional', 'lt IE 9');

		wp_enqueue_script('jq-canvas', $library_uri.'/js/excanvas.js', array(), '2.0', true);
		wp_script_add_data('jq-canvas', 'conditional', 'lt IE 8');

		// comment reply script ------------------------------------------------------
		if (is_singular() AND comments_open()):
			 wp_enqueue_script( 'comment-reply' );
		endif;

		// scipts variable -----------------------------------------------------------
		$stickynav = ( petsworld_option("layout","layout-stickynav") ) ? "enable" : "disable";
		$loadingbar = ( petsworld_option("general","enable-loader") ) ? "enable" : "disable";
		$nicescroll = ( petsworld_option("general","enable-nicescroll") ) ? "enable" : "disable";
		if(is_rtl()) $rtl = true; else $rtl = false;

		$htype = petsworld_option('layout','header-type');
		$stickyele = "";
		switch( $htype ){
			case 'fullwidth-header':
			case 'boxed-header':
			case 'split-header fullwidth-header':
			case 'split-header boxed-header':
			case 'two-color-header':
				$stickyele = ".main-header-wrapper";
			break;

			case 'fullwidth-header header-align-center fullwidth-menu-header':
			case 'fullwidth-header header-align-left fullwidth-menu-header':
				$stickyele = ".menu-wrapper";
			break;

			case 'left-header':
			case 'left-header-boxed':
			case 'creative-header':
			case 'overlay-header':
				$stickyele = ".menu-wrapper";
				$stickynav = "disable";
			break;
		}

		$cookiebar = petsworld_option('privacy', 'enable-cookie-msgbar');
			if( isset($cookiebar) ) {
				wp_enqueue_script('jq-cookie-js', $library_uri.'/js/cookieconsent.js', array(), false, true);
			}

			wp_enqueue_script('jq-popup-js', $library_uri.'/js/magnific/jquery.magnific-popup.min.js', array(), false, true);

		wp_enqueue_script('jq-easetotop', $library_uri.'/js/jquery.ui.totop.min.js', array(), false, true);
		wp_enqueue_script('jquery-isotope', $library_uri.'/js/isotope.pkgd.min.js', array(), false, true);
		wp_enqueue_script('jquery-caroufredsel', $library_uri.'/js/jquery.caroufredsel.js', array(), false, true);
		wp_enqueue_script('jquery-debouncedresize', $library_uri.'/js/jquery.debouncedresize.js', array(), false, true);
		wp_enqueue_script('jquery-prettyphoto', $library_uri.'/js/jquery.prettyphoto.js', array(), false, true);
		wp_enqueue_script('jquery-touchswipe', $library_uri.'/js/jquery.touchswipe.js', array(), false, true);
		wp_enqueue_script('waypoints', $library_uri.'/js/waypoint.js', array(), false, true);
		wp_enqueue_script('retina', $library_uri.'/js/retina.js', array(), false, true);
		wp_enqueue_script('easypiechart', $library_uri.'/js/easypiechart.js', array(), false, true);
		wp_enqueue_script('stellar', $library_uri.'/js/Stellar.js', array(), false, true);
		wp_enqueue_script('jquery-simple-sidebar', $library_uri.'/js/jquery.simple-sidebar.js', array(), false, true);
		wp_enqueue_script('jquery-uitotop', $library_uri.'/js/jquery.ui.totop.js', array(), false, true);
		wp_enqueue_script('jquery-parallax', $library_uri.'/js/jquery.parallax.js', array(), false, true);
		wp_enqueue_script('jquery-downcount', $library_uri.'/js/jquery.downcount.js', array(), false, true);
		wp_enqueue_script('jquery-nicescroll', $library_uri.'/js/jquery.nicescroll.min.js', array(), false, true);
		wp_enqueue_script('jquery-bxslider', $library_uri.'/js/jquery.bxslider.js', array(), false, true);
		wp_enqueue_script('jquery-fitvids', $library_uri.'/js/jquery.fitvids.js', array(), false, true);
		wp_enqueue_script('jquery-sticky', $library_uri.'/js/jquery.sticky.js', array(), false, true);
		wp_enqueue_script('jquery-classie', $library_uri.'/js/jquery.classie.js', array(), false, true);
		wp_enqueue_script('jquery-placeholder', $library_uri.'/js/jquery.placeholder.js', array(), false, true);
		wp_enqueue_script('jq-visualnav', $library_uri.'/js/jquery.visualNav.min.js', array(), false, true);

		if( $loadingbar == 'enable' ) {
			wp_enqueue_script('jq-pacemin', $library_uri.'/js/pace.min.js',array(),false,true);
			wp_localize_script('jq-pacemin', 'paceOptions', array(
				'restartOnRequestAfter' => 'false',
				'restartOnPushState' => 'false'
			));
		}

		wp_enqueue_script('jq-custom', $library_uri.'/js/custom.js', array(), false, true);

		wp_localize_script('jq-custom', 'dttheme_urls', array(
			'theme_base_url' => esc_js(PETSWORLD_THEME_URI),
			'framework_base_url' => esc_js(PETSWORLD_THEME_URI).'/framework/',
			'ajaxurl' => esc_url( admin_url('admin-ajax.php') ),
			'url' => esc_url( get_site_url() ),
			'stickynav' => esc_js($stickynav),
			'stickyele' => esc_js($stickyele),
			'isRTL' => esc_js($rtl),
			'loadingbar' => esc_js($loadingbar),
			'nicescroll' => esc_js($nicescroll),
			'dtThemeAjaxNonce' => wp_create_nonce('dtThemeAjaxNonce')
		));
	}
}

/* ---------------------------------------------------------------------------
 * Meta tag for viewport scale
* --------------------------------------------------------------------------- */
if (!function_exists('petsworld_viewport')) {
	function petsworld_viewport() {
		if(petsworld_option('general', 'enable-responsive')){
			echo "<meta name='viewport' content='width=device-width, initial-scale=1'>\r";
		}
	}
}
/* ---------------------------------------------------------------------------
 * Scripts of Custom JS from Theme Back-End
* --------------------------------------------------------------------------- */
if (!function_exists('petsworld_scripts_custom')) {
	function petsworld_scripts_custom() {
		if( ($custom_js = petsworld_option('layout', 'customjs-content')) && petsworld_option('layout','enable-customjs') ){
			wp_add_inline_script('jq-custom', petsworld_wp_kses(stripslashes($custom_js)) ,'after');
		}
	}
}
add_action('wp_enqueue_scripts', 'petsworld_scripts_custom', 100);

/* ---------------------------------------------------------------------------
 * Loading Theme Styles
 * --------------------------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'petsworld_enqueue_styles', 100 );
if (!function_exists('petsworld_enqueue_styles')) {
	function petsworld_enqueue_styles() {

		$layout_opts = petsworld_option('layout');
		$general_opts = petsworld_option('general');
		$colors_opts = petsworld_option('colors');
		$pageopt_opts = petsworld_option('pageoptions');

		// site icons ---------------------------------------------------------------
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ):
			$url = ! empty ( $layout_opts ['favicon-url'] ) ? $layout_opts ['favicon-url'] : PETSWORLD_THEME_URI . "/images/favicon.ico";
			echo "<link href='$url' rel='shortcut icon' type='image/x-icon' />\n";

			$phone_url = ! empty ( $layout_opts ['apple-favicon'] ) ? $layout_opts ['apple-favicon'] : PETSWORLD_THEME_URI . "/images/apple-touch-icon.png";
			echo "<link href='$phone_url' rel='apple-touch-icon-precomposed'/>\n";

			$phone_retina_url = ! empty ( $layout_opts ['apple-retina-favicon'] ) ? $layout_opts ['apple-retina-favicon'] : PETSWORLD_THEME_URI. "/images/apple-touch-icon-114x114.png";
			echo "<link href='$phone_retina_url' sizes='114x114' rel='apple-touch-icon-precomposed'/>\n";

			$ipad_url = ! empty ( $layout_opts ['apple-ipad-favicon'] ) ? $layout_opts ['apple-ipad-favicon'] : PETSWORLD_THEME_URI . "/images/apple-touch-icon-72x72.png";
			echo "<link href='$ipad_url' sizes='72x72' rel='apple-touch-icon-precomposed'/>\n";

			$ipad_retina_url = ! empty ( $layout_opts ['apple-ipad-retina-favicon'] ) ? $layout_opts ['apple-ipad-retina-favicon'] : PETSWORLD_THEME_URI . "/images/apple-touch-icon-144x144.png";
			echo "<link href='$ipad_retina_url' sizes='144x144' rel='apple-touch-icon-precomposed'/>\n";
		endif;

		// wp_enqueue_style ---------------------------------------------------------------
		wp_enqueue_style( 'reset',	PETSWORLD_THEME_URI .'/css/reset.css', false, THEME_VERSION, 'all' );
		wp_enqueue_style( 'petsworld',				get_stylesheet_uri(), false, THEME_VERSION, 'all' );
		wp_enqueue_style( 'prettyphoto',	PETSWORLD_THEME_URI .'/css/prettyPhoto.css', false, THEME_VERSION, 'all' );

		if (function_exists('bp_add_cover_image_inline_css')) {
			$inline_css = bp_add_cover_image_inline_css( true );
			wp_add_inline_style( 'bp-parent-css', strip_tags( $inline_css['css_rules'] ) );
		}

		// icon fonts ---------------------------------------------------------------------
		wp_enqueue_style ( 'custom-font-awesome',	PETSWORLD_THEME_URI . '/css/font-awesome.min.css', array (), '4.3.0' );
		wp_enqueue_style ( 'pe-icon-7-stroke',		PETSWORLD_THEME_URI . '/css/pe-icon-7-stroke.css', array () );
		wp_enqueue_style ( 'stroke-gap-icons-style',PETSWORLD_THEME_URI . '/css/stroke-gap-icons-style.css', array () );

		// comingsoon css
		if(isset($pageopt_opts['enable-comingsoon']))
			wp_enqueue_style("comingsoon",  	PETSWORLD_THEME_URI . "/css/comingsoon.css", false, THEME_VERSION, 'all' );

		// notfound css
		if ( is_404() )
			wp_enqueue_style("notfound",	  	PETSWORLD_THEME_URI . "/css/notfound.css", false, THEME_VERSION, 'all' );

		// loader css
		if(isset($general_opts['enable-loader']))
			wp_enqueue_style("loader",	  		PETSWORLD_THEME_URI . "/css/loaders.css", false, THEME_VERSION, 'all' );

		// show mobile slider
	    if(empty($general_opts['show-mobileslider'])):
			$out =	'@media only screen and (max-width:320px), (max-width: 479px), (min-width: 480px) and (max-width: 767px), (min-width: 768px) and (max-width: 959px),
			 (max-width:1200px) { #slider { display:none !important; } }';
			wp_add_inline_style('petsworld', $out);
		endif;

		// woocommerce css
		if( function_exists( 'is_woocommerce' ) )
			wp_enqueue_style( 'woo-style', 		PETSWORLD_THEME_URI .'/css/woocommerce.css', 'woocommerce-general-css', THEME_VERSION, 'all' );

		// vc css
		if( class_exists( 'Vc_Manager' ) )
			wp_enqueue_style( 'vc-style', 		PETSWORLD_THEME_URI .'/css/js_composer.css', array('js_composer_front'), THEME_VERSION, 'all' );

		// static css
		if(isset($general_opts['enable-staticcss'])) :
			wp_enqueue_style("static",  		PETSWORLD_THEME_URI . "/style-static.css", false, THEME_VERSION, 'all' );
		endif;

		// tribe-events -------------------------------------------------------------------
		wp_enqueue_style( 'custom-event', 		PETSWORLD_THEME_URI .'/tribe-events/custom.css', false, THEME_VERSION, 'all' );

		// responsive ---------------------------------------------------------------------
		if(petsworld_option('general', 'enable-responsive'))
			wp_enqueue_style("responsive",  	PETSWORLD_THEME_URI . "/css/responsive.css", false, THEME_VERSION, 'all' );

		if( ! isset( $_COOKIE['dtPrivacyGoogleWebfontsDisabled'] ) ):

			// google fonts -----------------------------------------------------------------
			$google_fonts = petsworld_fonts();
			$google_fonts = $google_fonts['all'];

			$subset 	  = petsworld_option('fonts','font-subset');
			if( $subset ) $subset = str_replace(' ', '', $subset);

			// style & weight  --------------------------------------------------------------
			if( $weight = petsworld_option('fonts', 'font-style') )
				$weight = ':'. implode( ',', $weight );

			$fonts = petsworld_fonts_selected();
			$fonts = array_unique($fonts);
			$fonts_url = ''; $font_families = array();
			foreach( $fonts as $font ){
				if( in_array( $font, $google_fonts ) ){
					// if google fonts
					$font_families[] .= $font . $weight;
				}
			}
			$query_args = array( 'family' => urlencode( implode( '|', $font_families ) ), 'subset' => urlencode( $subset ) );
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			if( ! isset( $_COOKIE['dtPrivacyGoogleWebfontsDisabled'] ) ) {
				wp_enqueue_style( 'petsworld-fonts', 		esc_url_raw($fonts_url), false, THEME_VERSION );
			}

		endif;

		$cookie_bar = petsworld_option('privacy', 'enable-cookie-msgbar');
		if( isset($cookie_bar) ) {
			wp_enqueue_style( 'petsworld-cookie-css', PETSWORLD_THEME_URI .'/css/cookieconsent.css', false, THEME_VERSION, 'all' );
		}

		wp_enqueue_style( 'petsworld-popup-css', PETSWORLD_THEME_URI .'/functions/js/magnific/magnific-popup.css', false, THEME_VERSION, 'all' );

		// custom css ---------------------------------------------------------------------
		wp_enqueue_style( 'dt-custom', 			PETSWORLD_THEME_URI .'/css/custom.css', false, THEME_VERSION, 'all' );

		// jquery scripts --------------------------------------------
		wp_enqueue_script('modernizr-custom', 	PETSWORLD_THEME_URI . '/functions/js/modernizr.custom.js', array('jquery'));

		// rtl ----------------------------------------------------------------------------
		if(is_rtl()) wp_enqueue_style('rtl', 	PETSWORLD_THEME_URI . '/css/rtl.css', false, THEME_VERSION, 'all' );

		// gutenberg css ---------------------------------------------------------------------
		wp_enqueue_style( 'petsworld-gutenberg', PETSWORLD_THEME_URI. '/css/gutenberg.css', false, THEME_VERSION, 'all' );
	}
}
/* ---------------------------------------------------------------------------
 * Styles Minify
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_styles_minify')) {
	function petsworld_styles_minify( $css ){

		// remove comments
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );

		// remove whitespace
		$css = str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css );

		return $css;
	}
}
/* ---------------------------------------------------------------------------
 * Styles Dynamic
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_styles_dynamic')) {
	function petsworld_styles_dynamic() {

		ob_start();

		if( ! petsworld_opts_get( 'enable-staticcss' ) ){

			// fonts.php
			include_once PETSWORLD_THEME_DIR . '/css/style-fonts.php';
		}

		// custom optons css.php
		if( ($custom_css = petsworld_option('layout','customcss-content')) &&  petsworld_option('layout','enable-customcss')):
			include_once PETSWORLD_THEME_DIR . '/css/dt-theme-option-custom-css.php';
		endif;

		$css = ob_get_contents();

		ob_get_clean();

		$css = petsworld_styles_minify( $css );

		wp_register_style( 'petsworld-combined', '', false, THEME_VERSION, 'all'  );
		wp_enqueue_style( 'petsworld-combined' );

		wp_add_inline_style('petsworld-combined', $css);
	}
}
add_action( 'wp_enqueue_scripts', 'petsworld_styles_dynamic', 100 );

/* ---------------------------------------------------------------------------
 * Styles of Custom Font
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_styles_custom_font')) {
	function petsworld_styles_custom_font() {
		$fonts 		  = petsworld_fonts_selected();
		$font_custom  = petsworld_option('fonts','customfont-name');
		$font_custom2 = petsworld_option('fonts','customfont2-name');

		$out = '';

		if( $font_custom && in_array( $font_custom, $fonts ) ){
			$out .= '@font-face {';
				$out .= 'font-family: "'. $font_custom .'";';
				$out .= 'src: url("'. petsworld_option('fonts','customfont-eot') .'");';
				$out .= 'src: url("'. petsworld_option('fonts','customfont-eot') .'#iefix") format("embedded-opentype"),';
					$out .= 'url("'. petsworld_option('fonts','customfont-woff') .'") format("woff"),';
					$out .= 'url("'. petsworld_option('fonts','customfont-ttf') .'") format("truetype"),';
					$out .= 'url("'. petsworld_option('fonts','customfont-svg') . $font_custom .'") format("svg");';
				$out .= 'font-weight: normal;';
				$out .= 'font-style: normal;';
			$out .= '}';
		}

		if( $font_custom2 && in_array( $font_custom2, $fonts ) ){
			$out .= '@font-face {';
				$out .= 'font-family: "'. $font_custom2 .'";';
				$out .= 'src: url("'. petsworld_option('fonts','customfont2-eot') .'");';
				$out .= 'src: url("'. petsworld_option('fonts','customfont2-eot') .'#iefix") format("embedded-opentype"),';
					$out .= 'url("'. petsworld_option('fonts','customfont2-woff') .'") format("woff"),';
					$out .= 'url("'. petsworld_option('fonts','customfont2-ttf') .'") format("truetype"),';
					$out .= 'url("'. petsworld_option('fonts','customfont2-svg') . $font_custom2 .'") format("svg");';
				$out .= 'font-weight: normal;';
				$out .= 'font-style: normal;';
			$out .= '}';
		}

		return $out;
	}
	add_action('wp_enqueue_scripts', 'petsworld_styles_custom_font', 103);
}
/* ---------------------------------------------------------------------------
 * Fonts Selected in Theme Options Panel
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_fonts_selected')) {
	function petsworld_fonts_selected(){
		$fonts = array();

		$font_opts = petsworld_option('fonts');

		$fonts['content'] 	= !empty ( $font_opts['content-font'] ) 	? 	$font_opts['content-font'] 		: 'Oswald';
		$fonts['menu'] 		= !empty ( $font_opts['menu-font'] ) 		? 	$font_opts['menu-font'] 		: 'Oswald';
		$fonts['title'] 	= !empty ( $font_opts['pagetitle-font'] ) 	? 	$font_opts['pagetitle-font'] 	: 'Oswald';
		$fonts['h1'] 		= !empty ( $font_opts['h1-font'] ) 	? 	$font_opts['h1-font'] 		: 'Oswald';
		$fonts['h2'] 		= !empty ( $font_opts['h2-font'] ) 	? 	$font_opts['h2-font'] 		: 'Oswald';
		$fonts['h3'] 		= !empty ( $font_opts['h3-font'] ) 	? 	$font_opts['h3-font'] 		: 'Oswald';
		$fonts['h4'] 		= !empty ( $font_opts['h4-font'] ) 	? 	$font_opts['h4-font'] 		: 'Oswald';
		$fonts['h5'] 		= !empty ( $font_opts['h5-font'] ) 	? 	$font_opts['h5-font'] 		: 'Oswald';
		$fonts['h6'] 		= !empty ( $font_opts['h6-font'] ) 	? 	$font_opts['h6-font'] 		: 'Oswald';

		return $fonts;
	}
}
/* ---------------------------------------------------------------------------
 * Site SSL Compatibility
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_ssl')) {
	function petsworld_ssl( $echo = false ){
		$ssl = '';
		if( is_ssl() ) $ssl = 's';
		if( $echo ){
			echo "{$ssl}";
		}
		return $ssl;
	}
}

/* ---------------------------------------------------------------------------
 * Body Class Filter for layout changes
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_body_classes')) {
	function petsworld_body_classes( $classes ) {

		// layout
		$classes[] 		= 	'layout-wide';

		// header
		$header_type 	= 	petsworld_option('layout','header-type');
		if( isset($header_type) && ($header_type == 'left-header-boxed') ):
			$classes[]	=	'left-header left-header-boxed';
		elseif( isset($header_type) && ($header_type == 'creative-header') ):
			$classes[]	=	'left-header left-header-creative';
		else:
			$classes[]	=	$header_type;
		endif;

		$htrans 		= 	petsworld_option('layout', 'header-transparant');
		if(isset($htrans)):
			$classes[]	=	petsworld_option('layout', 'header-transparant');
		endif;

		$stickyhead		=	petsworld_option('layout','layout-stickynav');
		if(isset($stickyhead)):
			$classes[]	=	'sticky-header';
		endif;

		$standard		=	petsworld_option('layout','header-position');
		if( isset($standard) && ($standard == 'above slider') ):
			$classes[]	=	'standard-header';
		elseif( isset($standard) && ($standard == 'below slider') ):
			$classes[]	=	'standard-header header-below-slider';
		elseif ( isset($standard) && ($standard == 'on slider') ):
			$classes[]	=	'header-on-slider';
		endif;

		$topbar			=	petsworld_option('layout','layout-topbar');
		if(isset($topbar)):
			$classes[]	=	'header-with-topbar';
		endif;

		$wootype		=	petsworld_option('woo','product-style');
		$wootype		= 	!empty($wootype) ? 'woo-'.$wootype : 'woo-type1';
		$classes[]		=	$wootype;

		if( is_page() ) {
			$pageid = petsworld_ID();
			if(($slider_key = get_post_meta( $pageid, '_tpl_default_settings', true )) && (array_key_exists( 'show_slider', $slider_key )) ) {
				$classes[] = "page-with-slider";
			}
		} elseif( is_home() ) {
			$pageid = get_option('page_for_posts');
			if(($slider_key = get_post_meta( $pageid, '_tpl_default_settings', true )) && (array_key_exists( 'show_slider', $slider_key )) ) {
				$classes[] = "page-with-slider";
			}
		}

		if( is_404() ){

			$type = petsworld_opts_get('notfound-style', 'type1');
			$classes[] = $type;

			$darkbg = petsworld_opts_get('notfound-darkbg', '');
			$darkbg = !empty( $darkbg ) ? ' notfound-darkbg' : '';

			$classes[] = $darkbg;
		}

		if( petsworld_option('pageoptions','enable-comingsoon') ) {

			$classes[] = 'under-construction';

			$type = petsworld_opts_get('comingsoon-style', 'type1');
			$classes[] = $type;

			$darkbg = petsworld_opts_get('uc-darkbg', '');
			$darkbg = !empty( $darkbg ) ? ' uc-darkbg' : '';

			$classes[] = $darkbg;
		}

		# Gutenberg Class
		if ( is_singular() && function_exists('has_blocks') && has_blocks()) {
			$classes[] = 'has-gutenberg-blocks';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'petsworld_body_classes' ); ?>