<?php get_header(); 
  $page_layout = petsworld_option('pageoptions','pets-archives-page-layout');
  $page_layout  = !empty( $page_layout ) ? $page_layout : "content-full-width";
  
  $show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
  $sidebar_class = $sidebars = "";

  $left = petsworld_option('pageoptions','show-standard-left-sidebar-for-pets-archives');
  $sidebars['left'] = ( $left && is_active_sidebar('standard-sidebar-left') ) ? 'Standard Left' : '';
  
  $right = petsworld_option('pageoptions','show-standard-right-sidebar-for-pets-archives');
  $sidebars['right'] = ( $right && is_active_sidebar('standard-sidebar-right') ) ? 'Standard Right' : '';
  
  if( is_active_sidebar('custom-post-pet-archives-sidebar-left') ) {
	  array_push( $sidebars['left'], 'Custom Left' );
  }
  
  if( is_active_sidebar('custom-post-pet-archives-sidebar-right') ) {
	  array_push( $sidebars['left'], 'Custom Right' );
  }
  
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

	  $page_layout = isset( $sidebars['left'] ) ? $page_layout : 'content-full-width';
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

  if ( $show_sidebar && isset( $sidebars['left'] )):
    if ( $show_left_sidebar ): ?>
      <!-- Secondary Left -->
      <section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('left');?></section>
      <!-- Secondary Left --><?php
    endif;
  endif;?>
  <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
  
  	$post_layout = petsworld_option('pageoptions','pets-archives-post-layout');
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
		
		echo '<div class="dt-sc-pet-taxonomy-container">';
		
		while( have_posts() ):

            the_post();
            $the_id = get_the_ID();
			$permalink = get_permalink($the_id);
			$title = get_the_title($the_id);
			
			$temp_class ='';
			if($i == 1) $temp_class .= $post_class." first "; else $temp_class .= $post_class;
			if($i == $columns) $i = 1; else $i = $i + 1;
			
			$image = has_post_thumbnail( $the_id ) ? get_the_post_thumbnail( $the_id, 'full' ) : '';
			
			# Age
			$age = get_the_terms( $the_id,'dt_tax_pet_ages');
			if( is_array( $age ) ) {
				$id = $age[0]->term_id;
				$name = $age[0]->name;				
				$age = '<a href="'.get_term_link( $id ).'"><span>'.__('Age','petsworld-core').'</span>'.$name.'</a>';
			} else {
				$age = '';
			}
			
			$data = '';
			# Breed
			$breed = get_the_terms( $the_id ,'dt_tax_pet_breeds');
			if( is_array( $breed ) ) {
				$id = $breed[0]->term_id;
				$name = $breed[0]->name;
				$data .=  '<li><span>'.__('Breed','petsworld-core').'</span>'.'<a href="'.get_term_link( $id ).'">'.$name.'</a></li>';				
			}
			
			# City
			$city = get_the_terms( $the_id ,'dt_tax_pet_cities');
			if( is_array( $city ) ) {
				$id = $city[0]->term_id;
				$name = $city[0]->name;
				$data .= '<li><span>'.__('City','petsworld-core').'</span>'.'<a href="'.get_term_link( $id ).'">'.$name.'</a></li>';
			}
			
			$data = !empty( $data ) ? '<ul>'.$data.'</ul>' : '';
			
			echo '<div class="'.esc_attr( $temp_class).'">';

			echo '	<div class="dt-sc-single-pet dt-sc-single-pet">';
			echo '		<div class="dt-sc-single-pet-wrapper">';
			echo '			<div class="dt-sc-pet-thumb">'.$image.$age.'</div>';
			echo '			<div class=dt-sc-single-pet-details">';
			echo '				<h4><a href="'.$permalink.'">'.$title.'</a></h4>';
			echo 				$data;			
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
  if ( $show_sidebar && isset( $sidebars['left'] ) ):
    if ( $show_right_sidebar ): ?>
      <!-- Secondary Right -->
      <section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section>
      <!-- Secondary Right --><?php
    endif;
  endif;
get_footer();?>