<?php
/* ---------------------------------------------------------------------------
 * Hidden Products List : Used in BPanel
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_hidden_prodcuts')) {
function petsworld_hidden_prodcuts() {
	$products = array();
	$params = array( 'posts_per_page' => -1, 'post_type' => 'product', 'orderby' => 'menu-order', 'order' => 'asc',
		'meta_query' => array( array( 'key' => '_visibility', 'value' => 'hidden' ) ));
	
	$wc_query = new WP_Query($params);
	if ($wc_query->have_posts()) :
		while ($wc_query->have_posts()) :
			$wc_query->the_post();
			$products[ get_the_id() ] = get_the_title();
		endwhile;
	endif;
	
	return $products;
}
}
/* ---------------------------------------------------------------------------
 * Purchsed Products List for User
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_get_user_purchased_product_ids')) {
function petsworld_get_user_purchased_product_ids( $user_id = '' ) {
	
	$user_purchased_products = array();
	
	if($user_id == '') {		
		$user_id = get_current_user_id();		
	}
	
	$order_args = array( 'post_type' => 'shop_order', 'posts_per_page' => -1, 'post_status' => array( 'wc-completed' ),
		'meta_query' => array( array( 'key' => '_customer_user', 'value' => $user_id ) ), 'fields' => 'ids');
		
	$orders = get_posts( $order_args );
	
	foreach( $orders as $order_post_id ) {
		$order = new WC_Order( $order_post_id );
		$items = $order->get_items();

		foreach( $items as $item ) {
			$user_purchased_products[] = $item['product_id'];		
		}
		
	}

	return array_filter( $user_purchased_products );
}
}
/* ---------------------------------------------------------------------------
 * Helper : Append after to given index in array
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_append_to_array')) {
function petsworld_append_to_array( $items, $new_items, $after ) {
    // Search for the item position and +1 since is after the selected item key.
    $position = array_search( $after, array_keys( $items ) ) + 1;

    // Insert the new item.
    $array = array_slice( $items, 0, $position, true );
    $array += $new_items;
    $array += array_slice( $items, $position, count( $items ) - $position, true );

    return $array;
}
}

/* ---------------------------------------------------------------------------
 * Add capability to customer to upload media
 * --------------------------------------------------------------------------- */
add_action( 'admin_init', 'petsworld_customer_capability');
if (!function_exists('petsworld_customer_capability')) {
function petsworld_customer_capability() {
	
	$role = get_role( 'customer' );
	$role->add_cap( 'upload_files' ); 
	
	# Only show media based on user	
	add_filter( 'ajax_query_attachments_args', 'petsworld_filter_media_by_user' );
}
}
/* ---------------------------------------------------------------------------
 * Show logedin user media files only
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_filter_media_by_user')) {
function petsworld_filter_media_by_user( $query ) {
	
	$author = get_current_user_id();
	$meta = get_userdata($author);
	$role = $meta->roles;
	
	if( !in_array("administrator", $role) ) {
		$query['author'] = $author;
	}
	
	return $query;
}
}
/* ---------------------------------------------------------------------------
 * Flush rewrite rules
 * --------------------------------------------------------------------------- */
add_action( 'init', 'petsworld_woocommerce_endpoint_rewrite_rules' );
if (!function_exists('petsworld_woocommerce_endpoint_rewrite_rules')) {
function petsworld_woocommerce_endpoint_rewrite_rules() {
	
	# Pets End Point
    add_rewrite_endpoint( 'dt-pets-endpoint', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'dt-add-pet-endpoint', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'dt-edit-pet-endpoint', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'dt-delete-pet-endpoint', EP_ROOT | EP_PAGES );
	
	# Pet Sitter End Point
   	add_rewrite_endpoint( 'dt-petsitter-endpoint', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'dt-add-petsitter-endpoint', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'dt-edit-petsitter-endpoint', EP_ROOT | EP_PAGES );
    add_rewrite_endpoint( 'dt-delete-petsitter-endpoint', EP_ROOT | EP_PAGES );

    flush_rewrite_rules();
}
}

/* ---------------------------------------------------------------------------
 * Add Account Menu Items
 * --------------------------------------------------------------------------- */
add_action('woocommerce_account_menu_items', 'petsworld_woocommerce_account_menu_items', 10, 1 );
if (!function_exists('petsworld_woocommerce_account_menu_items')) {
function petsworld_woocommerce_account_menu_items( $items ) {
	
	$new_items = array();
	$pets = $pet_sitters = false;
	
	$purchased_product_ids = petsworld_get_user_purchased_product_ids();
	
	if( !is_null( petsworld_option('woo','for-both') ) && in_array( petsworld_option('woo','for-both'), $purchased_product_ids )  ) {
		$pets = $pet_sitters = true;
	}

	if( !is_null( petsworld_option('woo','pets-only') ) && in_array( petsworld_option('woo','pets-only'), $purchased_product_ids )  ) {
		$pets = true;
	}
	
	if( !is_null( petsworld_option('woo','pet-sitters-only') ) && in_array( petsworld_option('woo','pet-sitters-only'), $purchased_product_ids )  ) {
		$pet_sitters = true;
	}	
	
	if( $pets ) {
		$new_items['dt-pets-endpoint'] = esc_html__( 'Pets', 'petsworld' );
	}

	if( $pet_sitters ) {
		$new_items['dt-petsitter-endpoint'] = esc_html__( 'Pet Sitters', 'petsworld' );
	}
	
	return petsworld_append_to_array( $items, $new_items, 'edit-account' );
}
}
/* ---------------------------------------------------------------------------
 * All Pets Based on logged in user
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_get_pets')) {
function petsworld_get_pets( $args ){

	$wp_query_args = array(
		'post_type' => 'dt_cpt_pets',
		'post_status' => array( 'publish', 'pending', 'draft' ),
		'posts_per_page' => get_option( 'posts_per_page' ),
		'author' => 1,
		'orderby'  => 'date',
		'order'    => 'DESC',
		'return'   => 'objects',
		'paged'    => $args['page'],
		'paginate' => $args['paginate'],
		'meta_key' => '_pet_submitter',
		'meta_value' => $args['customer']
	);

	// Get results.
	$pets = new WP_Query( $wp_query_args );

	return (object) array(
		'pets' => $pets->posts,
		'total' => $pets->found_posts,
		'max_num_pages' => $pets->max_num_pages
	);
}
}
/* ---------------------------------------------------------------------------
 * All Pet Sitter Based on logged in user
 * --------------------------------------------------------------------------- */
if (!function_exists('petsworld_get_pet_sitters')) {
function petsworld_get_pet_sitters( $args ){
	
	$wp_query_args = array(
		'post_type' => 'dt_cpt_pet_sitters',
		'post_status' => array( 'publish', 'pending', 'draft' ),
		'posts_per_page' => get_option( 'posts_per_page' ),
		'author' => 1,
		'orderby'  => 'date',
		'order'    => 'DESC',
		'return'   => 'objects',
		'paged'    => $args['page'],
		'paginate' => $args['paginate'],
		'meta_key' => '_pet_sitter_submitter',
		'meta_value' => $args['customer']
	);

	// Get results.
	$pet_sitters = new WP_Query( $wp_query_args );

	return (object) array(
		'pet_sitters' => $pet_sitters->posts,
		'total' => $pet_sitters->found_posts,
		'max_num_pages' => $pet_sitters->max_num_pages
	);	
}
}
/* ---------------------------------------------------------------------------
 * Add New Pet End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-add-pet-endpoint_endpoint', 'petsworld_dt_add_pet_endpoint_content' );
if (!function_exists('petsworld_dt_add_pet_endpoint_content')) {
function petsworld_dt_add_pet_endpoint_content() {
	wc_get_template('myaccount/add-pet.php', array(
		'customer' => absint( get_current_user_id() )
	) );	
}
}
/* ---------------------------------------------------------------------------
 * Add New Pet Action
 * --------------------------------------------------------------------------- */
add_action( 'template_redirect', 'petsworld_add_new_pet');
if (!function_exists('petsworld_add_new_pet')) {
function petsworld_add_new_pet() {
	
	if ( empty( $_POST['action'] ) || 'add_pet' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-add_pet' ) ) {
		return;
	}

	$required_fields = array(
		'_pet_title' => esc_html__('Pet Title', 'petsworld'),
		'_pet_type' => esc_html__('Pet Type', 'petsworld'),
		'_pet_gender' => esc_html__('Pet Gender', 'petsworld'),
		'_pet_age' => esc_html__('Pet Age', 'petsworld'),
		'_pet_size' => esc_html__('Pet Size', 'petsworld'),
		'_pet_breed' => esc_html__('Pet Breed', 'petsworld'),
		'_pet_city' => esc_html__('Pet Location', 'petsworld'),
		'_pet_main_services' => esc_html__('Pet Service', 'petsworld'),
	);

	foreach ( $required_fields as $field_key => $field_name ) {

		$value = wc_clean( $_POST[ $field_key ] );

		if ( empty( $value ) ) {
			wc_add_notice( '<strong>' . esc_html( $field_name ) . '</strong> ' . esc_html__( 'is a required field.', 'petsworld' ), 'error' );
		}
	}

	if( wc_notice_count( 'error' ) === 0 ) {

		$post = array(
			'post_title' => wp_strip_all_tags ( $_POST['_pet_title'] ),
			'post_type' => 'dt_cpt_pets',
			'post_status' => 'draft',
			'post_content' => trim( $_POST['_pet_content'] ),
			'post_author' => 1);

		$pid = wp_insert_post( $post );

		if( $pid > 0 ) {

			update_post_meta ( $pid, "_pet_submitter",$_POST['customer']);

			# Set Post Thumbnail
			if( isset( $_REQUEST['_thumbnail_id'] ) ) {

				set_post_thumbnail( $pid , $_REQUEST['_thumbnail_id'] );				
			}
			
			# Gallery Image
			$pet_settings = get_post_meta ( $pid, "_custom_settings", true );
			$pet_settings = is_array ( $pet_settings ) ? $pet_settings : array ();
			
			$pet_settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
			$pet_settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
			$pet_settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";
			update_post_meta ( $pid, "_custom_settings", array_filter ( $pet_settings ) );			

			# Type
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_type'] ) ), 'dt_tax_pet_types' );

			# Gender
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_gender'] ) ), 'dt_tax_pet_genders' );

			# Age
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_age'] ) ), 'dt_tax_pet_ages' );

			# Size
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_size'] ) ), 'dt_tax_pet_sizes' );

			# Breed
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_breed'] ) ), 'dt_tax_pet_breeds' );

			# Location
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_city'] ) ), 'dt_tax_pet_cities' );

			# Required Services
			wp_set_object_terms( $pid, array_map('intval', array_filter ( $_POST['_pet_services'] ) ), 'dt_tax_pet_services' );
		}

		wc_add_notice( esc_html__( 'New Pet added successfully.', 'petsworld' ) );

		wp_safe_redirect( wc_get_endpoint_url('dt-pets-endpoint') );
		exit();	
	}
}
}
/* ---------------------------------------------------------------------------
 * Edit Pet End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-edit-pet-endpoint_endpoint', 'petsworld_dt_edit_pet_endpoint_content' );
if (!function_exists('petsworld_dt_edit_pet_endpoint_content')) {
function petsworld_dt_edit_pet_endpoint_content( $pet_id ) {

	$customer = absint( get_current_user_id() );
	$submitter = get_post_meta ( $pet_id, "_pet_submitter", $customer );
	$submitter = absint( $submitter );

	if( $submitter == $customer ) {

		wc_get_template('myaccount/edit-pet.php', array(
			'pet' => absint( $pet_id ),
			'customer' => $customer
		) );
	}
}
}
/* ---------------------------------------------------------------------------
 * Edit Pet Action
 * --------------------------------------------------------------------------- */
add_action( 'template_redirect', 'petsworld_edit_pet');
if (!function_exists('petsworld_edit_pet')) {
function petsworld_edit_pet() {
	
	if ( empty( $_POST['action'] ) || 'edit_pet' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-edit_pet' ) ) {
		return;
	}

	$required_fields = array(
		'_pet_title' => esc_html__('Pet Title', 'petsworld'),
		'_pet_type' => esc_html__('Pet Type', 'petsworld'),
		'_pet_gender' => esc_html__('Pet Gender', 'petsworld'),
		'_pet_age' => esc_html__('Pet Age', 'petsworld'),
		'_pet_size' => esc_html__('Pet Size', 'petsworld'),
		'_pet_breed' => esc_html__('Pet Breed', 'petsworld'),
		'_pet_city' => esc_html__('Pet Location', 'petsworld'),
	);

	foreach ( $required_fields as $field_key => $field_name ) {

		$value = wc_clean( $_POST[ $field_key ] );

		if ( empty( $value ) ) {
			wc_add_notice( '<strong>' . esc_html( $field_name ) . '</strong> ' . esc_html__( 'is a required field.', 'petsworld' ), 'error' );
		}
	}

	if( wc_notice_count( 'error' ) === 0 ) {

		$post = array(
			'ID' => $_REQUEST['id'],	
			'post_title' => wp_strip_all_tags ( $_REQUEST['_pet_title'] ),
			'post_type' => 'dt_cpt_pets',
			'post_status' => 'draft',
			'post_content' => trim( $_POST['_pet_content'] ),
			'post_author' => 1);

		$pid = wp_update_post( $post );

		# Set Post Thumbnail
		if( isset( $_REQUEST['_thumbnail_id'] ) ) {
			set_post_thumbnail( $pid , $_REQUEST['_thumbnail_id'] );				
		} else if( has_post_thumbnail( $pid ) ) {
			delete_post_thumbnail( $pid );
		}
		
		# Gallery Image
		$pet_settings = get_post_meta ( $pid, "_custom_settings", true );
		$pet_settings = is_array ( $pet_settings ) ? $pet_settings : array ();
		
		$pet_settings ['items'] = isset ( $_POST ['items'] ) ? $_POST ['items'] : "";
		$pet_settings ['items_thumbnail'] = isset ( $_POST ['items_thumbnail'] ) ? $_POST ['items_thumbnail'] : "";
		$pet_settings ['items_name'] = isset ( $_POST ['items_name'] ) ? $_POST ['items_name'] : "";
		update_post_meta ( $pid, "_custom_settings", array_filter ( $pet_settings ) );		

		# Type
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_type'] ) ), 'dt_tax_pet_types' );

		# Gender
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_gender'] ) ), 'dt_tax_pet_genders' );

		# Age
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_age'] ) ), 'dt_tax_pet_ages' );

		# Size
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_size'] ) ), 'dt_tax_pet_sizes' );

		# Breed
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_breed'] ) ), 'dt_tax_pet_breeds' );

		# Location
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_city'] ) ), 'dt_tax_pet_cities' );

		# Required Services
		wp_set_object_terms( $pid, array_map('intval', array_filter ( $_POST['_pet_services'] ) ), 'dt_tax_pet_services' );

		wc_add_notice(  wp_strip_all_tags ( $_REQUEST['_pet_title'] ).' '.esc_html__( 'Pet updated successfully.', 'petsworld' ) );

		wp_safe_redirect( wc_get_endpoint_url('dt-pets-endpoint') );
		exit();
	}
}
}
/* ---------------------------------------------------------------------------
 * Delete Pet End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-delete-pet-endpoint_endpoint', 'petsworld_dt_delete_pet_endpoint_content' );
if (!function_exists('petsworld_dt_delete_pet_endpoint_content')) {
function petsworld_dt_delete_pet_endpoint_content( $pet_id ) {

	$customer = absint( get_current_user_id() );
	$submitter = get_post_meta ( $pet_id, "_pet_submitter", $customer );
	$submitter = absint( $submitter );

	if( $submitter == $customer ) {

		wc_get_template('myaccount/delete-pet.php', array(
			'pet' => absint( $pet_id )
		) );
	}
}
}
/* ---------------------------------------------------------------------------
 * Delete Pet Action
 * --------------------------------------------------------------------------- */
add_action( 'template_redirect', 'petsworld_delete_pet');
if (!function_exists('petsworld_delete_pet')) {
function petsworld_delete_pet() {
	
	if ( empty( $_POST['action'] ) || 'delete_pet' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-delete_pet' ) ) {
		return;
	}

	wp_delete_post( $_POST['id'] );
	wc_add_notice( esc_html__( 'Pet removed successfully.', 'petsworld' ) );
	wp_safe_redirect( wc_get_endpoint_url('dt-pets-endpoint') );
	exit();	
} 
}
/* ---------------------------------------------------------------------------
 * All Pets End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-pets-endpoint_endpoint', 'petsworld_dt_pets_endpoint_content' );
if (!function_exists('petsworld_dt_pets_endpoint_content')) {
function petsworld_dt_pets_endpoint_content() {
	$current_page = empty( $current_page ) ? 1 : absint( $current_page );
	$customer_pets = petsworld_get_pets(array(
		'customer' => get_current_user_id(),
		'page' => $current_page,
		'paginate' => true,
	));	

	wc_get_template('myaccount/pets-list.php', array(
		'current_page' => absint( $current_page ),
		'customer_pets' => $customer_pets,
		'has_pets' => 0 < $customer_pets->total,
	) );	
}
}
/* ---------------------------------------------------------------------------
 * Add New Pet Sitter End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-add-petsitter-endpoint_endpoint', 'petsworld_dt_add_petsitter_endpoint_content' );
if (!function_exists('petsworld_dt_add_petsitter_endpoint_content')) {
function petsworld_dt_add_petsitter_endpoint_content() {
	wc_get_template('myaccount/add-pet-sitter.php', array(
		'customer' => absint( get_current_user_id() )
	) );	
}
}
/* ---------------------------------------------------------------------------
 * Add New Pet Sitter Action
 * --------------------------------------------------------------------------- */
add_action( 'template_redirect', 'petsworld_add_new_pet_sitter');
if (!function_exists('petsworld_add_new_pet_sitter')) {
function petsworld_add_new_pet_sitter() {
	
	if ( empty( $_POST['action'] ) || 'add_pet_sitter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-add_pet_sitter' ) ) {
		return;
	}

	$required_fields = array(
		'_pet_sitter_title' => esc_html__('Pet Sitter Title', 'petsworld'),
		'_pet_sitter_city' => esc_html__('Pet Sitter Location', 'petsworld'),
		'_pet_sitter_gender' => esc_html__('Pet Sitter Gender', 'petsworld'),
		'_pet_sitter_experiences' => esc_html__('Pet Sitter Experiences', 'petsworld'),
	);

	foreach ( $required_fields as $field_key => $field_name ) {

		$value = wc_clean( $_POST[ $field_key ] );

		if ( empty( $value ) ) {
			wc_add_notice( '<strong>' . esc_html( $field_name ) . '</strong> ' . esc_html__( 'is a required field.', 'petsworld' ), 'error' );
		}
	}

	if( wc_notice_count( 'error' ) === 0 ) {

		$post = array(
			'post_title' => wp_strip_all_tags ( $_POST['_pet_sitter_title'] ),
			'post_type' => 'dt_cpt_pet_sitters',
			'post_status' => 'draft',
			'post_content' => trim( $_POST['_pet_sitter_content'] ),
			'post_author' => 1);

		$pid = wp_insert_post( $post );
		
		if( $pid > 0 ) {
			
			update_post_meta ( $pid, "_pet_sitter_submitter",$_POST['customer']);
			
			$pet_sitter_settings = get_post_meta ( $pid, '_custom_settings', TRUE );
			$pet_sitter_settings = is_array ( $pet_sitter_settings ) ? $pet_sitter_settings : array ();
			
			if( isset( $_POST['_pet_sitter_price'] ) ) {
				$pet_sitter_settings['price'] = sanitize_text_field($_POST['_pet_sitter_price']);
			} else {
				$pet_sitter_settings['price'] = '';
			}

			if( isset( $_POST['_pet_sitter_google'] ) ) {
				$pet_sitter_settings['google_social_link'] = sanitize_text_field($_POST['_pet_sitter_google']);
			} else {
				$pet_sitter_settings['google_social_link'] = '';
			}

			if( isset( $_POST['_pet_sitter_fb'] ) ) {
				$pet_sitter_settings['facebook_social_link'] = sanitize_text_field($_POST['_pet_sitter_fb']);
			} else {
				$pet_sitter_settings['facebook_social_link'] = '';
			}

			if( isset( $_POST['_pet_sitter_twitter'] ) ) {
				$pet_sitter_settings['twitter_social_link'] = sanitize_text_field($_POST['_pet_sitter_twitter']);
			} else {
				$pet_sitter_settings['twitter_social_link'] = '';
			}
			
			update_post_meta ( $pid, "_custom_settings", array_filter ( $pet_sitter_settings ) );
		

			# Set Post Thumbnail
			if( isset( $_POST['_thumbnail_id'] ) ) {

				set_post_thumbnail( $pid , $_POST['_thumbnail_id'] );				
			}

			# City
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_city'] ) ), 'dt_tax_pet_sitter_cities' );

			# Gender
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_gender'] ) ), 'dt_tax_pet_sitter_genders' );

			# Age
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_age'] ) ), 'dt_tax_pet_sitter_ages' );

			# Experiences
			wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_experiences'] ) ), 'dt_tax_pet_sitter_experiences' );

			# Role
			wp_set_object_terms( $pid, array_map('intval', array_filter ( $_POST['_pet_sitter_services'] ) ), 'dt_tax_pet_sitter_roles' );
		}

		wc_add_notice( esc_html__( 'New Pet Sitter added successfully.', 'petsworld' ) );

		wp_safe_redirect( wc_get_endpoint_url('dt-petsitter-endpoint') );
		exit();	

	}	
}
}
/* ---------------------------------------------------------------------------
 * Edit Pet Sitter End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-edit-petsitter-endpoint_endpoint', 'petsworld_dt_edit_petsitter_endpoint_content' );
if (!function_exists('petsworld_dt_edit_petsitter_endpoint_content')) {
function petsworld_dt_edit_petsitter_endpoint_content( $pet_sitter_id ) {

	$customer = absint( get_current_user_id() );
	$submitter = get_post_meta ( $pet_sitter_id, "_pet_sitter_submitter", $customer );
	$submitter = absint( $submitter );

	if( $submitter == $customer ) {

		wc_get_template('myaccount/edit-pet-sitter.php', array(
			'pet_sitter' => absint( $pet_sitter_id ),
			'customer' => $customer
		) );
	}
}
}
/* ---------------------------------------------------------------------------
 * Edit Pet Sitter Action
 * --------------------------------------------------------------------------- */
add_action( 'template_redirect', 'petsworld_edit_pet_sitter');
if (!function_exists('petsworld_edit_pet_sitter')) {
function petsworld_edit_pet_sitter() {

	if ( empty( $_POST['action'] ) || 'edit_pet_sitter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-edit_pet_sitter' ) ) {
		return;
	}

	$required_fields = array(
		'_pet_sitter_title' => esc_html__('Pet Sitter Title', 'petsworld'),
		'_pet_sitter_city' => esc_html__('Pet Sitter Location', 'petsworld'),
		'_pet_sitter_gender' => esc_html__('Pet Sitter Gender', 'petsworld'),
		'_pet_sitter_experiences' => esc_html__('Pet Sitter Experiences', 'petsworld'),
	);

	foreach ( $required_fields as $field_key => $field_name ) {

		$value = wc_clean( $_POST[ $field_key ] );

		if ( empty( $value ) ) {
			wc_add_notice( '<strong>' . esc_html( $field_name ) . '</strong> ' . esc_html__( 'is a required field.', 'petsworld' ), 'error' );
		}
	}

	if( wc_notice_count( 'error' ) === 0 ) {

		$post = array(
			'ID' => $_REQUEST['id'],	
			'post_title' => wp_strip_all_tags ( $_REQUEST['_pet_sitter_title'] ),
			'post_type' => 'dt_cpt_pet_sitters',
			'post_status' => 'draft',
			'post_content' => trim( $_POST['_pet_sitter_content'] ),
			'post_author' => 1);

		$pid = wp_update_post( $post );
		
		$pet_sitter_settings = get_post_meta ( $pid, '_custom_settings', TRUE );
		$pet_sitter_settings = is_array ( $pet_sitter_settings ) ? $pet_sitter_settings : array ();
		
		if( isset( $_POST['_pet_sitter_price'] ) ) {
			$pet_sitter_settings['price'] = sanitize_text_field($_POST['_pet_sitter_price']);
		} else {
			$pet_sitter_settings['price'] = '';
		}
		
		
		if( isset( $_POST['_pet_sitter_google'] ) ) {
			$pet_sitter_settings['google_social_link'] = sanitize_text_field($_POST['_pet_sitter_google']);
		} else {
			$pet_sitter_settings['google_social_link'] = '';
		}
		
		if( isset( $_POST['_pet_sitter_fb'] ) ) {
			$pet_sitter_settings['facebook_social_link'] = sanitize_text_field($_POST['_pet_sitter_fb']);
		} else {
			$pet_sitter_settings['facebook_social_link'] = '';
		}
		
		if( isset( $_POST['_pet_sitter_twitter'] ) ) {
			$pet_sitter_settings['twitter_social_link'] = sanitize_text_field($_POST['_pet_sitter_twitter']);
		} else {
			$pet_sitter_settings['twitter_social_link'] = '';
		}
		
		update_post_meta ( $pid, "_custom_settings", array_filter ( $pet_sitter_settings ) );
		
		# Set Post Thumbnail
		if( isset( $_REQUEST['_thumbnail_id'] ) ) {
			set_post_thumbnail( $pid , $_REQUEST['_thumbnail_id'] );				
		} else if( has_post_thumbnail( $pid ) ) {
			delete_post_thumbnail( $pid );
		}

		# City
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_city'] ) ), 'dt_tax_pet_sitter_cities' );

		# Gender
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_gender'] ) ), 'dt_tax_pet_sitter_genders' );
		
		# Age
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_age'] ) ), 'dt_tax_pet_sitter_ages' );		

		# Experiences
		wp_set_object_terms( $pid, array_map('intval', array( $_POST['_pet_sitter_experiences'] ) ), 'dt_tax_pet_sitter_experiences' );

		# Role
		wp_set_object_terms( $pid, array_map('intval', array_filter ( $_POST['_pet_sitter_services'] ) ), 'dt_tax_pet_sitter_roles' );

		wc_add_notice(  wp_strip_all_tags ( $_REQUEST['_pet_sitter_title'] ).' '.esc_html__( 'Pet Sitter updated successfully.', 'petsworld' ) );

		wp_safe_redirect( wc_get_endpoint_url('dt-petsitter-endpoint') );
		exit();
	}	
}
}
/* ---------------------------------------------------------------------------
 * Delete Pet Sitter End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-delete-petsitter-endpoint_endpoint', 'petsworld_dt_delete_petsitter_endpoint_content' );
if (!function_exists('petsworld_dt_delete_petsitter_endpoint_content')) {
function petsworld_dt_delete_petsitter_endpoint_content( $pet_sitter_id ) {

	$customer = absint( get_current_user_id() );
	$submitter = get_post_meta ( $pet_sitter_id, "_pet_sitter_submitter", $customer );
	$submitter = absint( $submitter );

	if( $submitter == $customer ) {

		wc_get_template('myaccount/delete-pet-sitter.php', array(
			'pet_sitter' => absint( $pet_sitter_id )
		) );
	}
}
}
/* ---------------------------------------------------------------------------
 * Delete Pet Sitter Action
 * --------------------------------------------------------------------------- */
add_action( 'template_redirect', 'petsworld_delete_pet_sitter');
if (!function_exists('petsworld_delete_pet_sitter')) {
function petsworld_delete_pet_sitter() {
	
	if ( empty( $_POST['action'] ) || 'delete_pet_sitter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-delete_pet_sitter' ) ) {
		return;
	}

	wp_delete_post( $_REQUEST['id'] );

	wc_add_notice( esc_html__( 'Pet Sitter removed successfully.', 'petsworld' ) );
	wp_safe_redirect( wc_get_endpoint_url('dt-petsitter-endpoint') );
	exit();	
}
}

/* ---------------------------------------------------------------------------
 * All Pet Sitters End Point
 * --------------------------------------------------------------------------- */
add_action( 'woocommerce_account_dt-petsitter-endpoint_endpoint', 'petsworld_dt_petsitter_endpoint_content' );
if (!function_exists('petsworld_dt_petsitter_endpoint_content')) {
function petsworld_dt_petsitter_endpoint_content() {

	$current_page = empty( $current_page ) ? 1 : absint( $current_page );
	$customer_pet_sitters = petsworld_get_pet_sitters(array(
		'customer' => get_current_user_id(),
		'page' => $current_page,
		'paginate' => true,
	));	

	wc_get_template('myaccount/pet-sitter-list.php', array(
		'current_page' => absint( $current_page ),
		'customer_pet_sitters' => $customer_pet_sitters,
		'has_pet_sitters' => 0 < $customer_pet_sitters->total,
	) );	
}
}
/* ---------------------------------------------------------------------------
 * List Child Services based on Parent Service in Pet Add / Edit End Points
 * --------------------------------------------------------------------------- */
add_action( 'wp_ajax_dt_sc_pet_child_services', 'dt_sc_pet_child_services' );
add_action( 'wp_ajax_nopriv_dt_sc_pet_child_services', 'dt_sc_pet_child_services' );
if (!function_exists('dt_sc_pet_child_services')) {
function dt_sc_pet_child_services() {
	
	$dtThemeAjaxNonce = $_REQUEST['dtThemeAjaxNonce'];
	if(isset($dtThemeAjaxNonce) && wp_verify_nonce($dtThemeAjaxNonce, 'dtThemeAjaxNonce')) {

		$out = '';
		
		$data = $_REQUEST['data'];
		$data = array_filter($data);
		
		if( isset( $data['id'] ) ){
			
			$child = get_term_children( $data['id'], 'dt_tax_pet_services' );
			
			if( !empty( $child ) ) {
				$out .= '<ul>';
							
				foreach( $child as $c ) {
					
					$term = get_term_by( 'id', $c, 'dt_tax_pet_services' );
					$out .= "<li><label><input type='checkbox' name='_pet_services[]' value='{$c}'/> <span>{$term->name}</span></label></li>";
				}
				
				$out .= '</ul>';
			} else {
				$out .= '<input type="hidden" name="_pet_services[]" value="'.$data['id'].'" />';
			}
			
			echo "{$out}";
		}

	}
	
	die();
	
}
}