<?php get_header();
	$tpl_default_settings = get_post_meta($post->ID,'_custom_settings',TRUE);
	$tpl_default_settings = is_array( $tpl_default_settings ) ? $tpl_default_settings  : array();

	$page_layout  = array_key_exists( "layout", $tpl_default_settings ) ? $tpl_default_settings['layout'] : "content-full-width";
	$show_sidebar = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";
	
	$sidebars = array();
	
	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout = "page-with-sidebar with-left-sidebar";
			$show_sidebar = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";

			$sidebars = petsworld_check_sidebar( '', $post->ID, 'left' );
			$page_layout = isset( $sidebars['left'] ) ? $page_layout : 'content-full-width';
		break;

		case 'with-right-sidebar':
			$page_layout = "page-with-sidebar with-right-sidebar";
			$show_sidebar = $show_right_sidebar	= true;
			$sidebar_class = "secondary-has-right-sidebar";

			$sidebars = petsworld_check_sidebar( '', $post->ID, 'right' );
			$page_layout = isset( $sidebars['right'] ) ? $page_layout : 'content-full-width';
		break;
		
		case 'with-both-sidebar':
			$page_layout = "page-with-sidebar with-both-sidebar";
			$show_sidebar = $show_left_sidebar = $show_right_sidebar = true;
			$sidebar_class = "secondary-has-both-sidebar";

			$sidebars = array_merge( petsworld_check_sidebar( '', $post->ID, 'left' ) , petsworld_check_sidebar( '', $post->ID, 'right' ) );
			
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
			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('left');?></section><?php
		endif;
	endif;?>
    <section id="primary" class="<?php echo esc_attr( $page_layout );?>"><?php
	if( have_posts() ):
	
		while( have_posts() ):
		
			the_post();?>
            
            <!-- #post-<?php the_ID(); ?> -->
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
			
				$medias = array();
				
				$id = get_the_ID();
				$title = get_the_title();
				
				if( has_post_thumbnail( $id ) ) {
					
					$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "thumbnail" );
					$thumbnail = '<img src="'.$thumbnail[0].'" alt="'.$title.'"/>';
					
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "full" );
					$medias[ $thumbnail ] =  '<img src="'.$image[0].'" alt="'.$title.'"/>';
				}
				
				$pet_settings = get_post_meta ( $id, "_custom_settings", true );
				$pet_settings = is_array ( $pet_settings ) ? $pet_settings : array ();
				
				if (array_key_exists ( "items", $pet_settings )):
					foreach( $pet_settings['items'] as $key => $image ){
						
						$key = '<img src="'.$pet_settings['items_thumbnail'][$key].'" alt="'.$title.'"/>';;
						$image = '<img src="'.$image.'" alt="'.$title.'"/>';						
						
						$medias[ $key ] = $image;
					}
				endif;
				
				array_filter( $medias );
				
				the_title('<h2>','</h2>');
				
				# Type
				$type = get_the_terms( $id,'dt_tax_pet_types');
				$type = is_array( $type ) ? '<li>'.$type[0]->name.'</li>': "";
				
				# Breed
				$breed = get_the_terms( $id,'dt_tax_pet_breeds');
				$breed = is_array( $breed ) ? '<li>'.$breed[0]->name.'</li>' : "";
				
				# Gender
				$gender = get_the_terms( $id,'dt_tax_pet_genders');
				$gender = is_array( $gender ) ? '<li>'.$gender[0]->name.'</li>' : "";				
				
				# Size
				$size = get_the_terms( $id,'dt_tax_pet_sizes');
				$size = is_array( $size ) ? '<li>'.$size[0]->name.'</li>': "";				
				
				# Age
				$age = get_the_terms( $id,'dt_tax_pet_ages');
				$age = is_array( $age ) ? '<li>'.$age[0]->name.'</li>' : "";
				
				$data = $type.$breed.$gender.$size.$age;
				$data = !empty( $data ) ? '<div class="pets-meta"><ul>'.$data.'</ul></div>' : '';
				
				echo $data;

				if( !empty( $medias ) ) {
					
					echo '<div class="dt-pet-single-slider-wrapper">';
					
						# Slider
						echo '<ul class="dt-pet-single-slider">';
						foreach( $medias as $media ){
							echo '<li>'.$media.'</li>';
						}
						echo '</ul>';
						
						# Pager
						if( sizeof( $medias ) > 1 ) {
							echo '<div id="bx-pager">';
							$pagers = array_keys( $medias );
							foreach( $pagers as $key => $pager ){
								echo '<a data-slide-index="'.$key.'" href="#">'.$pager.'</a>';
							}
							echo '</div>';
						}
					
					echo '</div>';
				}
				
				the_content();
				
				wp_link_pages( array(	
					'before'	=>	'<div class="page-link">',
					'after'		=>	'</div>',
					'link_before'	=>	'<span>',
					'link_after'	=>	'</span>',
					'next_or_number' =>	'number',
					'pagelink' =>	'%',
					'echo'	=>	1 ) );
					
				edit_post_link( esc_html__( ' Edit ','petsworld-core' ) );?>
            </div><!-- #post-<?php the_ID(); ?> --><?php
		endwhile;
	endif;?>
    </section><!-- **Primary - End** --><?php
	
	if ( $show_sidebar && isset( $sidebars['right'] ) ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class );?>"><?php get_sidebar('right');?></section><?php
		endif;
	endif;
get_footer();?>