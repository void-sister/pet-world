<?php

	# Query
	$pets_query = new WP_Query();
	
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	
	$pets_arg = array(
		'post_type'	=>	'dt_cpt_pets',
		'posts_per_page'	=>	get_option( 'posts_per_page' ),
		'paged'	=>	$paged,
		'tax_query'=>array(),
		'meta_query'=>array(),
		'suppress_filters' => false,
		'order_by'=> 'published');
	
	# Type
	if( isset( $_POST['type'] ) && $_POST['type'] > 0  ) {
		
		$pets_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_types',
			'field' => 'id',
			'terms' => (int) $_POST['type'],
			'operator' => 'IN'
		);
	}
	
	# Location
	if( isset( $_POST['location'] ) && $_POST['location'] > 0  ) {
		
		$pets_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_cities',
			'field' => 'id',
			'terms' => (int) $_POST['location'],
			'operator' => 'IN'
		);
	}
	
	# Size
	if( isset( $_POST['size'] ) && $_POST['size'] > 0  ) {
		
		$pets_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_sizes',
			'field' => 'id',
			'terms' => (int) $_POST['size'],
			'operator' => 'IN'
		);
	}
	
	# Gender
	if( isset( $_POST['gender'] ) && $_POST['gender'] > 0  ) {
		
		$pets_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_genders',
			'field' => 'id',
			'terms' => (int) $_POST['gender'],
			'operator' => 'IN'
		);
	}
	
	# Age
	if( isset( $_POST['age'] ) && $_POST['age'] > 0  ) {
		
		$pets_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_ages',
			'field' => 'id',
			'terms' => (int) $_POST['age'],
			'operator' => 'IN'
		);
	}
	
	# Service
	if( isset( $_POST['service'] ) && $_POST['service'] > 0  ) {
		
		$pets_arg['tax_query'][] = array(
			'taxonomy' => 'dt_tax_pet_services',
			'field' => 'id',
			'terms' => (int) $_POST['service'],
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

	$pets_query->query( $pets_arg );
	
	if( $pets_query->have_posts() ):
	
		$i = 1;
	
		while( $pets_query->have_posts() ):
		
			$pets_query->the_post();
			
			$temp_class = "";			
			
			if($i == 1) $temp_class = $class." first"; else $temp_class = $class;
			if($i == $column) $i = 1; else $i = $i + 1;

			$the_id = get_the_ID();
			$permalink = get_permalink($the_id);
			$title = get_the_title($the_id);

			$image = has_post_thumbnail( $the_id ) ? get_the_post_thumbnail( $the_id, 'full' ) : '';
			
			# Age
			$age = get_the_terms( $the_id,'dt_tax_pet_ages');
			if( is_array( $age ) ) {
				$id = $age[0]->term_id;
				$name = $age[0]->name;				
				$age = '<a href="'.get_term_link( $id ).'"><span>'.esc_html__('Age','petsworld').'</span>'.$name.'</a>';
			} else {
				$age = '';
			}

			
			$data = '';			
			# Breed
			$breed = get_the_terms( $the_id ,'dt_tax_pet_breeds');
			if( is_array( $breed ) ) {
				$id = $breed[0]->term_id;
				$name = $breed[0]->name;
				$data .=  '<li><span>'.esc_html__('Breed','petsworld').'</span>'.'<a href="'.get_term_link( $id ).'">'.$name.'</a></li>';				
			}

			# City
			$city = get_the_terms( $the_id ,'dt_tax_pet_cities');
			if( is_array( $city ) ) {
				$id = $city[0]->term_id;
				$name = $city[0]->name;
				$data .= '<li><span>'.esc_html__('City','petsworld').'</span>'.'<a href="'.get_term_link( $id ).'">'.$name.'</a></li>';				
			}
			
			$data = !empty( $data ) ? '<ul>'.$data.'</ul>' : '';
			
			
			echo '<div class="'.esc_attr( $temp_class).'">';
			
			echo '	<div class="dt-sc-single-pet dt-sc-single-pet">';
			echo '		<div class="dt-sc-single-pet-wrapper">';
			echo '			<div class="dt-sc-pet-thumb">'.$image.$age.'</div>';
			echo '			<div class="dt-sc-single-pet-details">';
			echo '				<h4><a href="'.$permalink.'">'.$title.'</a></h4>';
			echo 				"{$data}";			
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
			
	