<?php
/* ---------------------------------------------------------------------------
 * Custom CSS from THeme option panel
 * --------------------------------------------------------------------------- */

if ( ! defined( 'ABSPATH' ) ) exit;

if( ($custom_css = petsworld_option('layout','customcss-content')) &&  petsworld_option('layout','enable-customcss')){
	echo stripcslashes( $custom_css )."\n";
}?>