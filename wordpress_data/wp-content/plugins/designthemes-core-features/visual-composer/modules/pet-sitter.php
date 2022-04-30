<?php
function pet_sitter_title_filter( $where, &$wp_query ) {
	global $wpdb;
	if ( $search_term = $wp_query->get( 's' ) ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
    }
    return $where;
} 

# vc_autocomplete_[shortcode_name]_[param_name]_callback
add_filter( 'vc_autocomplete_dt_sc_pet_sitter_id_callback','dt_pet_sitter_id_callback');
function dt_pet_sitter_id_callback( $search_string ) {

	$query = $search_string;
	$data = array();
	$args = array(
		's' => $query,
		'post_type' => 'dt_cpt_pet_sitters',
	);
	$args['numberposts'] = - 1;
	$args['suppress_filters'] = false;

	if( strlen( $args['s'] ) > 0 ) {
		add_filter( 'posts_where', 'pet_sitter_title_filter', 10, 2 );
	}

	$posts = get_posts( $args );	

	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = array(
				'value' => $post->ID,
				'label' => $post->post_title
			);
		}
	}

	return $data;
}

# vc_autocomplete_[shortcode_name]_[param_name]_render
add_filter( 'vc_autocomplete_dt_sc_pet_sitter_id_render','dt_pet_sitter_id_render');
function dt_pet_sitter_id_render( $value ) {

	$post = get_post( $value['value'] );

	return is_null( $post ) ? false : array(
		'label' => $post->post_title,
		'value' => $post->ID,
	);
}

add_action( 'vc_before_init', 'dt_sc_pet_sitter_vc_map' );
function dt_sc_pet_sitter_vc_map() {

	vc_map( array( 

		"name" => esc_html__( "Pet Sitter", 'petsworld-core' ),
		"base" => "dt_sc_pet_sitter",
		"icon" => "dt_sc_pet_sitter",
		"category" => DT_VC_CATEGORY,
		"params" => array(
		
			# Pet Sitter		
			array( 'type' => 'autocomplete',
				'heading' => __( 'Select identification', 'js_composer' ),
				'param_name' => 'id',
				'description' => __( 'Input product ID or product SKU or product title to see suggestions', 'js_composer' ),
			),
		
			# Type
      		array( 'type' => 'dropdown',
      			'heading' => esc_html__( 'Type', 'petsworld-core' ),
      			'param_name' => 'type',
      			'value' => array( 
      				esc_html__('Type 1','petsworld-core') => 'type1',
      				esc_html__('Type 2','petsworld-core') => 'type2'),
      			'description' => esc_html__( 'Select pet sitter display type', 'petsworld-core' ),
      		),

			# Hover Text
      		array( 'type' => 'textfield',
      			'heading' => esc_html__( 'Hover Text', 'petsworld-core' ),
      			'param_name' => 'hover_text',
      			'value' => 'View Profile'
      		),      		

			# Extra Class
      		array( 'type' => 'textfield',
      			'heading' => esc_html__( 'Extra Class', 'petsworld-core' ),
      			'param_name' => 'el_class',
      			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'petsworld-core' ),
      		)		
		)
	) );
}?>