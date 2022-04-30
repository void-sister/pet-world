<?php
/**
 * Gutenberg Editor CSS
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     PetsWorld
 * @author      PetsWorld
 * @copyright   Copyright (c) 2019, PetsWorld
 * @link        https://dtpetworld.wpengine.com/home-landing-page/
 * @since       PetsWorld 1.0
 */

if ( ! class_exists( 'Gutenberg_Editor_CSS' ) ) :
	/**
	 * Admin Helper
	 */
	class Gutenberg_Editor_CSS {

		function __construct() {

			add_action('after_setup_theme', array( $this,  'petsworld_after_setup_theme' ) );

			add_action( 'current_screen', array( $this,  'petsworld_current_screen_hook' ), 10, 1 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'petsworld_backend_editor_styles' ), 10 );
			if ( class_exists( 'Classic_Editor' ) ) {
				add_filter( 'tiny_mce_before_init', array( $this, 'petsworld_theme_editor_dynamic_styles' ) );
			}

			add_action( 'wp_enqueue_scripts', array( $this, 'petsworld_editor_enqueue_styles'), 110 );

		}

		public function petsworld_after_setup_theme() {

			# Gutenberg Compatible
			add_theme_support( 'align-wide' );
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'editor-styles' );
				
			# Add support for responsive embedded content.
			add_theme_support( 'responsive-embeds' );

			add_theme_support( 'editor-color-palette', array(
				array(
					'name'  => esc_html__( 'Primary Color', 'petsworld' ),
					'slug'  => 'primary',
					'color' => '#f2eee5',
				),
				array(
					'name'  => esc_html__( 'Secondary Color', 'petsworld' ),
					'slug'  => 'secondary',
					'color' => '#4b1c0e',
				),
				array(
					'name'  => esc_html__( 'Tertiary Color', 'petsworld' ),
					'slug'  => 'tertiary',
					'color' => '#40bdc8',
				)
			));

		}

		public function petsworld_current_screen_hook( $current_screen ) {
			
			if ( 'post' == $current_screen->base ) {

				$google_fonts = petsworld_fonts();
				$google_fonts = $google_fonts['all'];

				$subset = petsworld_option('fonts', 'font-subset');
				if( $subset ) $subset = str_replace(' ', '', $subset);

				if( $weight = petsworld_option('fonts', 'font-style') )
					$weight = ':'. implode( ',', $weight );

				$fonts = petsworld_fonts_selected();
				$fonts = array_unique($fonts);
				$fonts_url = ''; $font_families = array ();
				foreach( $fonts as $font ){
					if( in_array( $font, $google_fonts ) ){
						$font_families[] .= $font . $weight;
					}
				}
				$query_args = array( 'family' => urlencode( implode( '|', $font_families ) ), 'subset' => urlencode( $subset ) );
				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

				add_editor_style( $fonts_url );
				add_editor_style( 'css/editor-style.css' );

			}

		}

		public function petsworld_generate_editor_styles( $editor_type = 'block' ) {
			
			if($editor_type == 'tinymce') {
				$wrapper_class = 'body#tinymce.wp-editor.content';
				$header_wrapper_class = $wrapper_class;
				$header1_add_class = '';
			} else {
				$wrapper_class = '.editor-styles-wrapper';
				$header_wrapper_class = $wrapper_class.' .wp-block';
				$header1_add_class = '.editor-post-title__block .editor-post-title__input, ';
			}
			

			$styles = '';

			$styles .= $wrapper_class.' pre { font-family:monospace; }';


			$styles .= $wrapper_class.' > * { ';

				$content_font = petsworld_option('fonts', 'content-font');
				if( $content_font != '' ) {
					$styles .= 'font-family: '.$content_font.';';
				}

				$content_font_size = petsworld_option('fonts', 'content-font-size');
				if( $content_font_size != '' ) {
					$styles .= 'font-size: '.$content_font_size.'px;';
				}

				$body_line_height = petsworld_option('fonts', 'body-line-height');
				if( $body_line_height != '' ) {
					$styles .= 'line-height: '.$body_line_height.'px;';
				}

			$styles .= ' }';


			$body_bg_color = '#f2eee5';
			if( $body_bg_color != '' ) {
				$styles .= $wrapper_class.' { background-color: '.$body_bg_color.'; } ';
			}

			$content_text_color = '#818181';
			if( $content_text_color != '' ) {
				$styles .= $wrapper_class.' > *, '.$wrapper_class.' pre { color: '.$content_text_color.'; } ';
			}

			$content_link_color = '#4b1c0e';
			if( $content_link_color != '' ) {
				$styles .= $wrapper_class.' a { color: '.$content_link_color.'; } ';
			}

			$content_link_hcolor = '#60990f';
			if( $content_link_hcolor != '' ) {
				$styles .= $wrapper_class.' a:focus, '.$wrapper_class.' a:hover { color: '.$content_link_hcolor.'; } ';
			}


			for( $i = 1; $i <= 6; $i++ ) {

				if($i == 1) {
					$header_wrapper_final_class = $header1_add_class.$header_wrapper_class;
				} else {
					$header_wrapper_final_class = $header_wrapper_class;
				}


				$styles .= $header_wrapper_final_class.' h'.$i.' { ';

					$styles .= 'color: #4b1c0e;';

					$heading_font = petsworld_option('fonts', 'h'.$i.'-font');
					if( $heading_font != '' ) {
						$styles .= 'font-family: '.$heading_font.';';
					}

					$heading_font_size = petsworld_option('fonts', 'h'.$i.'-font-size');
					if( $heading_font_size != '' ) {
						$styles .= 'font-size: '.$heading_font_size.'px;';
					}

					$heading_font_weight = petsworld_option('fonts', 'h'.$i.'-weight');
					if( $heading_font_weight != '' ) {
						$styles .= 'font-weight: '.$heading_font_weight.';';
					}

					$heading_letter_spacing = petsworld_option('fonts', 'h'.$i.'-letter-spacing');
					if( $heading_letter_spacing != '' ) {
						$styles .= 'letter-spacing: '.$heading_letter_spacing.';';
					}

				$styles .= ' }';

			}
			
			return $styles;

		}

		public function petsworld_backend_editor_styles() {
			
			wp_enqueue_style( 'petsworld-gutenberg', get_theme_file_uri('/css/admin-gutenberg.css'), false, THEME_VERSION, 'all' );
			wp_add_inline_style( 'petsworld-gutenberg', petsworld_styles_custom_font() );
						
			$styles = $this->petsworld_generate_editor_styles('block');
			
			wp_add_inline_style( 'petsworld-gutenberg', $styles );

		}
			
		public function petsworld_theme_editor_dynamic_styles( $mceInit ) {

			$styles = petsworld_styles_custom_font();

			$styles .= $this->petsworld_generate_editor_styles('tinymce');

			if ( isset( $mceInit['content_style'] ) ) {
				$mceInit['content_style'] .= ' ' . $styles . ' ';
			} else {
				$mceInit['content_style'] = $styles . ' ';
			}
			
			return $mceInit;
		}

		public function petsworld_editor_enqueue_styles( ) {

			$styles = '';

			$primary_color   = '#f2eee5';
			$secondary_color = '#4b1c0e';
			$tertiary_color  = '#40bdc8';


			# Primary Color
			$styles .= '.has-primary-background-color { background-color:'.$primary_color.'; }';
			$styles .= '.has-primary-color { color:'.$primary_color.'; }';
	
			# Secondary Color
			$styles .= '.has-secondary-background-color { background-color:'.$secondary_color.'; }';
			$styles .= '.has-secondary-color { color:'.$secondary_color.'; }';
	
			# Tertiary Color
			$styles .= '.has-tertiary-background-color { background-color:'.$tertiary_color.'; }';
			$styles .= '.has-tertiary-color { color:'.$tertiary_color.'; }';

			wp_add_inline_style('petsworld-gutenberg', $styles );

		}

	}

	new Gutenberg_Editor_CSS();

endif;