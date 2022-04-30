<?php
/* ---------------------------------------------------------------------------
 * Hook of Top
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_hook_top')) {
function petsworld_hook_top() {
	if( petsworld_option( 'pageoptions','enable-top-hook' ) ) :
		echo '<!-- petsworld_hook_top -->';
			$hook = stripslashes(wp_specialchars_decode(petsworld_option('pageoptions','top-hook'),ENT_QUOTES));
			$$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
                echo apply_filters( 'petworld_top_hook', $hook );
		echo '<!-- petsworld_hook_top -->';
	endif;	
}
}
add_action( 'petsworld_hook_top', 'petsworld_hook_top' );


/* ---------------------------------------------------------------------------
 * Hook of Content before
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_hook_content_before')) {
function petsworld_hook_content_before() {
	if( petsworld_option( 'pageoptions','enable-content-before-hook' ) ) :
		echo '<!-- petsworld_hook_content_before -->';
			$hook = stripslashes(wp_specialchars_decode(petsworld_option('pageoptions','content-before-hook'),ENT_QUOTES));
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
                echo apply_filters( 'petworld_hook_content_before', $hook );
		echo '<!-- petsworld_hook_content_before -->';
	endif;
}
}
add_action( 'petsworld_hook_content_before', 'petsworld_hook_content_before' );


/* ---------------------------------------------------------------------------
 * Hook of Content after
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_hook_content_after')) {
function petsworld_hook_content_after() {
	if( petsworld_option( 'pageoptions','enable-content-after-hook' ) ) :
		echo '<!-- petsworld_hook_content_after -->';
			$hook = stripslashes(wp_specialchars_decode(petsworld_option('pageoptions','content-after-hook'),ENT_QUOTES));
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
                echo apply_filters( 'petworld_hook_content_after', $hook );
		echo '<!-- petsworld_hook_content_after -->';
	endif;
}
}
add_action( 'petsworld_hook_content_after', 'petsworld_hook_content_after' );


/* ---------------------------------------------------------------------------
 * Hook of Bottom
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_hook_bottom')) {
function petsworld_hook_bottom() {
	if( petsworld_option( 'pageoptions','enable-bottom-hook' ) ) :
		echo '<!-- petsworld_hook_bottom -->';
			$hook = stripslashes(wp_specialchars_decode(petsworld_option('pageoptions','bottom-hook'),ENT_QUOTES));
			$hook = do_shortcode( stripslashes($hook) );
			if (!empty($hook))
                echo apply_filters( 'petworld_hook_bottom', $hook );
		echo '<!-- petsworld_hook_bottom -->';
	endif;
}
}
add_action( 'petsworld_hook_bottom', 'petsworld_hook_bottom' ); ?>