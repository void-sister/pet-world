<?php

	# Query
	$pet_sitters_query = new WP_Query();
	
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$sitters_arg = array(
		'post_type'	=>	'dt_cpt_pet_sitters',
		'posts_per_page'	=>	get_option( 'posts_per_page' ),
		'paged'	=>	$paged,
		'tax_query'=>array(),
		'meta_query'=>array(),
		'suppress_filters' => false,
		'order_by'=> 'published');
		
	
	# Gender
	if( isset( $_POST['gender'] ) && $_POST['gender'] > 0  ) {
		
		$sitters_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_sitter_genders',
			'field' => 'id',
			'terms' => (int) $_POST['gender'],
			'operator' => 'IN'
		);		
	}
	
	# Age
	if( isset( $_POST['age'] ) && $_POST['age'] > 0 ) {
		
		$sitters_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_sitter_ages',
			'field' => 'id',
			'terms' => (int) $_POST['age'],
			'operator' => 'IN'
		);		
	}
	
	
	# Location
	if( isset( $_POST['location'] ) && $_POST['location'] > 0 ) {
		
		$sitters_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_sitter_cities',
			'field' => 'id',
			'terms' => (int) $_POST['location'],
			'operator' => 'IN'
		);		
	}
	
	# Experiences
	if( isset( $_POST['experience'] ) && $_POST['experience'] > 0 ) {
		$sitters_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_sitter_experiences',
			'field' => 'id',
			'terms' => (int) $_POST['experience'],
			'operator' => 'IN'
		);		
	}

	# Roles
	if( isset( $_POST['role'] ) && $_POST['role'] > 0 ) {
		$sitters_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_sitter_roles',
			'field' => 'id',
			'terms' => (int) $_POST['role'],
			'operator' => 'IN'
		);		
	}
	
	
	# Result Layout
	$column  = sanitize_text_field($_POST['column']);
	switch ( $column ) {
		case '2':
			$class = 'column dt-sc-one-hlaf';
		break;
		
		case '3':
			$class = 'column dt-sc-one-third';
		break;
		
		case '4':
			$class = 'column dt-sc-one-fourth';
		break;
	}

	
	
	$pet_sitters_query->query( $sitters_arg );
	
	if( $pet_sitters_query->have_posts() ):
	
		$i = 1;
	
		while( $pet_sitters_query->have_posts() ):
		
			$pet_sitters_query->the_post();
			
			$temp_class = "";			
			
			if($i == 1) $temp_class = $class." first"; else $temp_class = $class;
			if($i == $column) $i = 1; else $i = $i + 1;
			
			$the_id = get_the_ID();
			$permalink = get_permalink($the_id);
			$title = get_the_title($the_id);

			$image = has_post_thumbnail( $the_id ) ? get_the_post_thumbnail( $the_id, 'full' ) : '';

			$selected_roles = array();
			$roles = get_the_terms( $the_id,'dt_tax_pet_sitter_roles');
			if( is_array( $roles ) ) {
				foreach( $roles as $role ) {
					$selected_roles[$role->term_id] = '<a href="'.get_term_link( $role->term_id ).'">'.$role->name.'</a>';
				}
			}
			$selected_roles = implode(",", $selected_roles );
			
			$experience = get_the_terms( $the_id,'dt_tax_pet_sitter_experiences');

			$age = get_the_terms( $the_id,'dt_tax_pet_sitter_ages');
			$age = is_array( $age ) ? '<li> <span>'.esc_html__('Age','petsworld').'</span>'. $age[0]->name .'</li>' : "";
			
			$price = get_post_meta ( $the_id, 'pet_sitter_price', TRUE );
			if( !empty( $price ) ) {
				$oprice  = '<li>';
				$oprice .= '<span>'.esc_html__('Price','petsworld').'</span>';
				$oprice .=  function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '';
				$oprice .= $price;
				$oprice .= '</li>';					
			}
			
			$exp = is_array( $experience ) ?  '<li> <span>'.esc_html__('Exp','petsworld').'</span>'. $experience[0]->name .'</li>' : "";
			
			$data = $age.$oprice.$exp;
			$data = !empty($data)? '<ul>'.$data.'</ul>' : ''; 
			
			$city = get_the_terms( $the_id,'dt_tax_pet_sitter_cities');

			$ocity = '';
			if( is_array( $city ) ) {
				
				$ocity .= '<span class="city">';
				$ocity .= '	<i class="fa fa-home"></i>';
				$ocity .= '	<a href="'.get_term_link( $city[0]->term_id ).'">'.$city[0]->name;
							if( $city[0]->parent > 0 ) {
								$ocity .= ' ,';
								$parent = get_term( $city[0]->parent );
								$ocity .= $parent->name;
							}
				$ocity .= '	</a>';
				$ocity .= '</span>';
			}
			
			echo '<div class="'.esc_attr( $temp_class).'">';
			
			echo '	<div class="dt-sc-single-pet-sitter dt-sc-single-pet-sitter-type1">';
			echo '		<div class="dt-sc-single-pet-sitter-wrapper">';
			echo '			<div class="dt-sc-team-thumb">'.$image.'</div>';
			echo '			<div class="dt-sc-single-pet-sitter-details">';
			echo '				<h4><a href="'.$permalink.'">'.$title.'</a></h4>';
			echo '				<h5>'.$selected_roles.'</h5>';
			echo  				"{$ocity}".$data;
			echo '			</div>';
			echo '			<div class="dt-sc-single-pet-sitter-wrapper-overlay">';
			echo '				<a href="'.$permalink.'">'.esc_html__('View Profile','petsworld').'</a>';
			echo '			</div>';
			echo '		</div>';
			echo '	</div>';
			
			echo '</div>';
		
		endwhile;
			
			echo '<div class="pagination blog-pagination">';
			echo petsworld_pagination();
			echo '</div>';
	else:?>
    	<h2><?php esc_html_e('Pet Sitters Not Found.', 'petsworld'); ?></h2>
        <p><?php esc_html_e('Apologies, but no results were found for the requested archive.', 'petsworld'); ?></p><?php	
	endif;