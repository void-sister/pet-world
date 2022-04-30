<?php get_header();
	$page_layout = petsworld_option('pageoptions','post-archives-page-layout');
	$page_layout = !empty( $page_layout ) ? $page_layout : "content-full-width";
	
	$show_sidebar  = $show_left_sidebar = $show_right_sidebar = false;
	$sidebar_class = "";
	$sidebars      = array();

	$left = petsworld_option('pageoptions','show-standard-left-sidebar-for-post-archives');
	$sidebars['left'] = ( $left && is_active_sidebar('standard-sidebar-left') ) ? 'Left' : '';
	
	$right = petsworld_option('pageoptions','show-standard-right-sidebar-for-post-archives');
	$sidebars['right'] = ( $right && is_active_sidebar('standard-sidebar-right') ) ? 'Right' : '';
	
	$sidebars = array_filter( $sidebars );	
	
	switch ( $page_layout ) {
		case 'with-left-sidebar':
			$page_layout   = "page-with-sidebar with-left-sidebar";
			$show_sidebar  = $show_left_sidebar = true;
			$sidebar_class = "secondary-has-left-sidebar";

			$page_layout   = isset( $sidebars['left'] ) ? $page_layout : 'content-full-width';
		break;

		case 'with-right-sidebar':
			$page_layout   = "page-with-sidebar with-right-sidebar";
			$show_sidebar  = $show_right_sidebar = true;
			$sidebar_class = "secondary-has-right-sidebar";

			$page_layout   = isset( $sidebars['right'] ) ? $page_layout : 'content-full-width';
		break;
		
		case 'with-both-sidebar':
			$page_layout   = "page-with-sidebar with-both-sidebar";
			$show_sidebar  = $show_left_sidebar = $show_right_sidebar = true;
			$sidebar_class = "secondary-has-both-sidebar";
			
			# LHS
			if( isset( $sidebars['left'] ) && !isset( $sidebars['right']) ) {
				$page_layout   = "page-with-sidebar with-left-sidebar";
				$sidebar_class = "secondary-has-left-sidebar";
			}

			# RHS
			if( isset( $sidebars['right'] ) && !isset( $sidebars['left']) ) {
				$page_layout   = "page-with-sidebar with-right-sidebar";
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
			<section id="secondary-left" class="secondary-sidebar <?php echo esc_attr( $sidebar_class ); ?>"><?php get_sidebar('left'); ?></section>
			<!-- Secondary Left --><?php
		endif;
	endif;?>
    <section id="primary" class="<?php echo esc_attr( $page_layout ); ?>">
    
    	<?php # Pet Sitters Search Result 
			$post_type = isset( $_POST['post_type'] ) ? sanitize_text_field($_POST['post_type']) : '';
			if ( isset( $post_type ) && locate_template( 'search-' . $post_type . '.php' ) ) {
				 get_template_part( 'search', $post_type );
			} else {
				get_template_part('functions/loops/content', 'archive');
			}
		?>
    </section><!-- **Primary - End** --><?php
	
	if ( $show_sidebar && isset( $sidebars['right'] ) ):
		if ( $show_right_sidebar ): ?>
			<!-- Secondary Right -->
			<section id="secondary-right" class="secondary-sidebar <?php echo esc_attr( $sidebar_class ); ?>"><?php get_sidebar('right'); ?></section>
			<!-- Secondary Right --><?php
		endif;
	endif;
get_footer(); ?>