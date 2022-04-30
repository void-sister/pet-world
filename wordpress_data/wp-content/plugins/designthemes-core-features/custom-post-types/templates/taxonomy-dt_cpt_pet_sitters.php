<?php get_header(); 
  $page_layout = petsworld_option('pageoptions','pet-sitter-archives-page-layout');
  $page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";
  
  $show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
  $sidebar_class = $sidebars = "";
  
  $left = petsworld_option('pageoptions','show-standard-left-sidebar-for-pet-sitter-archives');
  $sidebars['left'] = ( $left && is_active_sidebar('standard-sidebar-left') ) ? 'Standard Left' : '';
  
  $right = petsworld_option('pageoptions','show-standard-right-sidebar-for-pet-sitter-archives');
  $sidebars['right'] = ( $right && is_active_sidebar('standard-sidebar-right') ) ? 'Standard Right' : '';
  
  if( is_active_sidebar('custom-post-pet-sitter-archives-sidebar-left') ) {
	  array_push( $sidebars['left'], 'Custom Left' );
  }
  
  if( is_active_sidebar('custom-post-pet-sitter-archives-sidebar-right') ) {
	  array_push( $sidebars['left'], 'Custom Right' );
  }
  
  $sidebars = array_filter( $sidebars );
  
  switch ( $page_layout ) {
    case 'with-left-sidebar':
      $page_layout = "page-with-sidebar with-left-sidebar";
      $show_sidebar = $show_left_sidebar = true;
      $sidebar_class = "secondary-has-left-sidebar";
	  
	  $page_layout = isset( $sidebars['left'] ) ? $page_layout : 'content-full-width';
    break;

    case 'with-right-sidebar':
      $page_layout = "page-with-sidebar with-right-sidebar";
      $show_sidebar = $show_right_sidebar = true;
      $sidebar_class = "secondary-has-right-sidebar";
	  
	  $page_layout = isset( $sidebars['right'] ) ? $page_layout : 'content-full-width';
    break;
    
    case 'with-both-sidebar':
      $page_layout = "page-with-sidebar with-both-sidebar";
      $show_sidebar = $show_left_sidebar = $show_right_sidebar  = true;
      $sidebar_class = "secondary-has-both-sidebar";
	  
	  # LHS
	  if( isset( $sidebars['left'] ) && !isset( $sidebars['right']) ) {
		  $page_layout = "page-with-sidebar with-left-sidebar";
		  $sidebar_class = "secondary-has-left-sidebar";
	  }
	  
	  # RHS
	  if( isset( $sidebars['right'] ) && !isset( $sidebars['left']) ) {
		  $page_layout = "page-with-sidebar with-right-sidebar";
		  $sidebar_class = "secondary-has-right-sidebar";
	  }
	  
	  if( empty( $sidebars ) ) {
		  $page_layout = 'content-full-width';
	  }	  
    break;

    case 'content-full-width':
    default:
      $page_layout = "content-full-width";
    break;
  }

  if ( $show_sidebar && isset( $sidebars['left'] ) ):
    if ( $show_left_sidebar ): ?>
      <!-- Secondary Left -->
      <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('left');?></section>
      <!-- Secondary Left --><?php
    endif;
  endif;?>
  <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
  
  	$post_layout = petsworld_option('pageoptions','pet-sitter-archives-post-layout');
	$post_layout = isset( $post_layout ) ? $post_layout : 'one-half-column';
	
	switch($post_layout):

		case 'one-column':
			$post_class = $show_sidebar ? " column dt-sc-one-column with-sidebar" : " column dt-sc-one-column";
			$columns = 1;
        break;
	
	
		case 'one-fourth-column':
			$post_class = $show_sidebar ? " column dt-sc-one-fourth with-sidebar" : " column dt-sc-one-fourth";
			$columns = 4;
        break;
		
		case 'one-third-column':
			$post_class = $show_sidebar ? " column dt-sc-one-third with-sidebar" : " column dt-sc-one-third";
			$columns = 3;
		break;
		
		default:
        case 'one-half-column':
			$post_class = $show_sidebar ? " column dt-sc-one-half with-sidebar" : " column dt-sc-one-half";
			$columns = 2;
		break;
    endswitch;
	
  
  
  	if( have_posts() ):
	
		$i = 1;
		
		echo '<div class="dt-sc-pet-sitter-container">';
		
		while( have_posts() ):

            the_post();
            $the_id = get_the_ID();
			$permalink = get_permalink($the_id);
			$title = get_the_title($the_id);
			
			$temp_class ='';
			if($i == 1) $temp_class .= $post_class." first "; else $temp_class .= $post_class;
			if($i == $columns) $i = 1; else $i = $i + 1;
			
			$image = has_post_thumbnail( $the_id ) ? get_the_post_thumbnail( $the_id, 'full' ) : '';
			
			# Role
			$selected_roles = array();
			$roles = get_the_terms( $the_id,'dt_tax_pet_sitter_roles');
			if( is_array( $roles ) ) {
				foreach( $roles as $role ) {
					$selected_roles[$role->term_id] = '<a href="'.get_term_link( $role->term_id ).'">'.$role->name.'</a>';
				}
			}
			$selected_roles = implode(",", $selected_roles );
			
			# Experience
			$experience = get_the_terms( $the_id,'dt_tax_pet_sitter_experiences');
			$exp = is_array( $experience ) ?  '<li> <span>'.__('Exp','petsworld-core').'</span>'. $experience[0]->name .'</li>' : "";
			
			# Age
			$age = get_the_terms( $the_id,'dt_tax_pet_sitter_ages');
			$age = is_array( $age ) ? '<li> <span>'.__('Age','petsworld-core').'</span>'. $age[0]->name .'</li>' : "";
			
			# Price
			$price = get_post_meta ( $the_id, 'pet_sitter_price', TRUE );
			if( !empty( $price ) ) {
				$oprice  = '<li>';
				$oprice .= '<span>'.__('Price','petsworld-core').'</span>';
				$oprice .=  function_exists('get_woocommerce_currency_symbol') ? get_woocommerce_currency_symbol() : '';
				$oprice .= $price;
				$oprice .= '</li>';					
			}
			
			$data = $age.$oprice.$exp;
			$data = !empty($data)? '<ul>'.$data.'</ul>' : ''; 
			
			# City
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
			echo '				<h4><a href="'.get_the_permalink( $id ).'">'.get_the_title( $id ).'</a></h4>';
			echo '				<h5>'.$selected_roles.'</h5>';
			echo 				$ocity.$data;
			echo '			</div>';
			echo '			<div class="dt-sc-single-pet-sitter-wrapper-overlay">';
			echo '				<a href="'.get_the_permalink( $id ).'">'.__('View Profile','petsworld-core').'</a>';
			echo '			</div>';
			echo '		</div>';
			
			echo '	</div>';			
			echo '</div>';
		endwhile;
		
		echo '</div>';
	
	endif;?>
    
    <!-- **Pagination** -->
    <div class="pagination blog-pagination">
    	<?php echo petsworld_pagination(); ?>
    </div><!-- **Pagination** -->
  </section><!-- **Primary - End** --><?php  
  if ( $show_sidebar && isset( $sidebars['right'] ) ):
    if ( $show_right_sidebar ): ?>
      <!-- Secondary Right -->
      <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section>
      <!-- Secondary Right --><?php
    endif;
  endif;
get_footer();?>