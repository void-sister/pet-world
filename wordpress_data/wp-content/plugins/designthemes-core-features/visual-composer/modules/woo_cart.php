<?php add_action( 'vc_before_init', 'dt_sc_woo_cart_vc_map' );
function dt_sc_woo_cart_vc_map() {
	vc_map( array(
		"name" => esc_html__( "Petsworld Cart", 'petsworld-core' ),
		"base" => "dt_sc_woo_cart",
		"icon" => "dt_sc_woo_cart",
		"category" => esc_html__( 'WooCommerce', 'petsworld-core' ),
		"show_settings_on_create" => false
	) );
}?>