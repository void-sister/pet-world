<?php
$wtstyle = petsworld_opts_get('wtitle-style', '');
if(!empty($wtstyle)):
	echo "<div class='{$wtstyle}'>";
endif;
	wp_reset_postdata();
	$post = petsworld_global_variables('post');
	
	if( is_page() ):
		$page_id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
		petsworld_show_sidebar('page',$page_id, 'left');
	elseif( is_single() ):
	
		if( is_singular('post') ) {
	
			$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
			petsworld_show_sidebar('post',$id, 'left');
		} elseif( is_singular('dt_portfolios') ) {
	
			$id = ($post->ID == 0) ? get_queried_object_id() : $post->ID;
			petsworld_show_sidebar('dt_portfolios',$id, 'left');
		} elseif( is_singular('product') ) {
	
			if( is_active_sidebar('product-detail-sidebar-left') ):
				dynamic_sidebar('product-detail-sidebar-left');
			endif;
	
			$enable = petsworld_option('woo','show-shop-standard-left-sidebar-for-product-layout');
			if( $enable ):
				if( is_active_sidebar('shop-everywhere-sidebar-left') ):
					dynamic_sidebar('shop-everywhere-sidebar-left');
				endif;
			endif;		
		} else {
			petsworld_show_sidebar('',$id, 'left');
		}
	elseif( class_exists('woocommerce') && is_post_type_archive('product') ):
	
		petsworld_show_sidebar('page',get_option('woocommerce_shop_page_id'), 'left');

		$page_id = get_option('page_for_posts');
        petsworld_show_sidebar('page',$page_id,'left');
	
	elseif( class_exists('woocommerce') && is_product_category() ):
	
		if( is_active_sidebar('product-category-sidebar-left') ):
			dynamic_sidebar('product-category-sidebar-left');
		endif;
	
		$enable = petsworld_option('woo','show-shop-standard-left-sidebar-for-product-category-layout');
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar-left') ):
				dynamic_sidebar('shop-everywhere-sidebar-left');
			endif;
		endif;	
	elseif( class_exists('woocommerce') && is_product_tag() ):
	
		if( is_active_sidebar('product-tag-sidebar-left') ):
			dynamic_sidebar('product-tag-sidebar-left');
		endif;
	
		$enable = petsworld_option('woo','show-shop-standard-left-sidebar-for-product-tag-layout');
		if( $enable ):
			if( is_active_sidebar('shop-everywhere-sidebar-left') ):
				dynamic_sidebar('shop-everywhere-sidebar-left');
			endif;
		endif;	
	elseif( is_tax() ):
	
		$tax = get_query_var( 'taxonomy' );
		if( $tax == 'portfolio_entries' ) {
	
			if( is_active_sidebar('custom-post-portfolio-archives-sidebar-left') ):
				dynamic_sidebar('custom-post-portfolio-archives-sidebar-left');
			endif;
	
			$enable = petsworld_option('pageoptions','show-standard-left-sidebar-for-portfolio-archives');
			if( $enable ):
				if( is_active_sidebar('standard-sidebar-left') ):
					dynamic_sidebar('standard-sidebar-left');
				endif;
			endif;
		}elseif( $tax == 'dt_tax_pet_sitter_roles' || $tax == 'dt_tax_pet_sitter_genders' || $tax == 'dt_tax_pet_sitter_experiences' || $tax == 'dt_tax_pet_sitter_cities' || $tax == 'dt_tax_pet_sitter_ages'  ){
			
			if( is_active_sidebar('custom-post-pet-sitter-archives-sidebar-left') ):
				dynamic_sidebar('custom-post-pet-sitter-archives-sidebar-left');
			endif;
	
			$enable = petsworld_option('pageoptions','show-standard-left-sidebar-for-pet-sitter-archives');
			if( $enable ):
				if( is_active_sidebar('standard-sidebar-left') ):
					dynamic_sidebar('standard-sidebar-left');
				endif;
			endif;
		}elseif( $tax == 'dt_tax_pet_ages' || $tax == 'dt_tax_pet_breeds' || $tax == 'dt_tax_pet_cities' || $tax == 'dt_tax_pet_genders' || $tax == 'dt_tax_pet_sizes' || $tax == 'dt_tax_pet_types' || $tax == 'dt_pet_services' ) {
			
			if( is_active_sidebar('custom-post-pet-archives-sidebar-left') ):
				dynamic_sidebar('custom-post-pet-archives-sidebar-left');
			endif;
	
			$enable = petsworld_option('pageoptions','show-standard-left-sidebar-for-pets-archives');
			if( $enable ):
				if( is_active_sidebar('standard-sidebar-left') ):
					dynamic_sidebar('standard-sidebar-left');
				endif;
			endif;
		} else {
			if( is_active_sidebar($tax.'-archives-sidebar-left') ):
				dynamic_sidebar($tax.'-archives-sidebar-left');
			endif;
	
			$standard = 'disable-standard-left-sidebar-for-'.$tax;
			$disable = petsworld_option('pageoptions',$standard);
			if( is_null($disable) ):
				if( is_active_sidebar('standard-sidebar-left') ):
					dynamic_sidebar('standard-sidebar-left');
				endif;
			endif;		
		}
	elseif( is_archive() || is_search() ):
	
		if( is_active_sidebar('post-archives-sidebar-left') ):
			dynamic_sidebar('post-archives-sidebar-left');
		endif;
	
		$enable = petsworld_option('pageoptions','show-standard-left-sidebar-for-post-archives');
		if($enable):
			if( is_active_sidebar('standard-sidebar-left') ):
				dynamic_sidebar('standard-sidebar-left');
			endif;
		endif;
	elseif( is_home() ):
	
		$page_id = get_option('page_for_posts');
		petsworld_show_sidebar('page',$page_id, 'left');

		$enable = petsworld_option('pageoptions','show-standard-left-sidebar-for-post-archives');
		if($enable):
			if( is_active_sidebar('standard-sidebar-left') ):
				dynamic_sidebar('standard-sidebar-left');
			endif;
		endif;	

	elseif( function_exists('bp_is_active') ):

	$page_id = '';
	$current_component = bp_current_component();
  
	global $bp;
	if( $current_component === "members" ){
		$page_id = $bp->pages->members->id;
	} elseif( $current_component === "activity"){
		$page_id = $bp->pages->activity->id;
	} elseif( $current_component === "groups" ){
		$page_id = $bp->pages->groups->id;
	} elseif( $current_component === "register" ){
		$page_id = $bp->pages->register->id;
	} elseif( $current_component === "activate" ){
		$page_id = $bp->pages->activate->id;
	}
  
	petsworld_show_sidebar('page',$page_id, 'left');
		
	else:
		if( is_active_sidebar('standard-sidebar-left') ):
			dynamic_sidebar('standard-sidebar-left');
		endif;
	endif;
if(!empty($wtstyle)):	
	echo "</div>";
endif;