<?php
class PetsWorld_Pets_Widget extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array('classname'=>'widget_pets', 'description'=> __('To list out pets', 'petsworld'));
		parent::__construct(false,THEME_NAME.' '.__('Pets','petsworld'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array('title'=>'','_post_count'=>'','_post_categories'=>'') );
		$title = strip_tags($instance['title']);
		$_post_count = !empty($instance['_post_count']) ? strip_tags($instance['_post_count']) : "-1";
	    $_post_categories = !empty($instance['_post_categories']) ? $instance['_post_categories']: array();?>
        
        <!-- Form -->
        <p><label for="<?php echo ($this->get_field_id('title')); ?>"><?php _e('Title:','petsworld');?> 
		   <input class="widefat" id="<?php echo ($this->get_field_id('title')); ?>" name="<?php echo ($this->get_field_name('title')); ?>" 
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
           
	    <p><label for="<?php echo ($this->get_field_id('_post_categories')); ?>">
			<?php _e('Choose Service:','petsworld');?></label>
            
            <?php $fservices = array();
			
				$services = get_categories('taxonomy=dt_tax_pet_services&parent=0');
				foreach ( $services as $service ) {
					$fservices[$service->term_id] = $service->name;
				}?>
                
                <select class="widefat pet-parent-service" id="<?php echo ($this->get_field_id('_post_categories'));?>"  name="<?php echo ($this->get_field_name('_post_categories'));?>">
					<option class="parent parent-0" value=""><?php _e("Select",'petsworld');?></option><?php
						 foreach( $fservices as $id => $name ) {
							 
							 echo '<option class="parent parent-'.$id.'" value="'.$id.'">'.$name.'</option>';
							 
							  $child = get_term_children( $id, 'dt_tax_pet_services' );
							  
							  if( !empty( $child ) ) {
								  
								  foreach( $child as $c ) {
									  $term = get_term_by( 'id', $c, 'dt_tax_pet_services' );
									  echo '<option value="'.$c.'">&nbsp;&nbsp;&nbsp;'.$term->name.'</option>';											 
								  }								  
							  }
						 }?>					
            </select></p>

	    <p><label for="<?php echo ($this->get_field_id('_post_count')); ?>"><?php _e('No.of posts to show:','petsworld');?></label>
		   <input id="<?php echo ($this->get_field_id('_post_count')); ?>" name="<?php echo ($this->get_field_name('_post_count')); ?>" value="<?php echo esc_attr($_post_count);?>" /></p>
        <!-- Form end-->
<?php
	}
	#3.processes & saves the twitter widget option
	function update( $new_instance,$old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['_post_count'] = strip_tags($new_instance['_post_count']);
		$instance['_post_categories'] = $new_instance['_post_categories'];
	return $instance;
	}
	
	#4.output in front-end
	function widget($args, $instance) {
		
		extract($args);
		
		global $post;
		
		$title = empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$_post_count = empty($instance['_post_count']) ?  -1 : (int) $instance['_post_count'];
		
		$pets_query = new WP_Query();
		$pets_arg = array(	'post_type'	=>	'dt_cpt_pets',
			'posts_per_page'	=>	$_post_count,
			'tax_query'=>array(),
			'suppress_filters' => false,
			'order_by'=> 'published');
		
		# Service
		if( isset( $instance['_post_categories'] ) && $instance['_post_categories'] > 0  ) {
			$pets_arg['tax_query'][] = array(
				'taxonomy' => 'dt_tax_pet_services',
				'field' => 'id',
				'terms' => (int) $instance['_post_categories'],
				'operator' => 'IN'
			);
		}
		
		echo ($before_widget);
 	    if ( !empty( $title ) ) echo ($before_title.$title.$after_title);
		
		$pets_query->query( $pets_arg );
		if( $pets_query->have_posts() ):
			echo "<div class='pets-widget'>";
			echo "	<ul>";
			while( $pets_query->have_posts() ):
			
				$pets_query->the_post();
				
				$the_id = get_the_ID();
				$permalink = get_permalink($the_id);
				$title = get_the_title($the_id);
				$image = has_post_thumbnail( $the_id ) ? get_the_post_thumbnail( $the_id, 'full' ) : '';

				# Age
				$age = get_the_terms( $the_id,'dt_tax_pet_ages');
				if( is_array( $age ) ) {
					$id = $age[0]->term_id;
					$name = $age[0]->name;				
					$age ='<a href="'.get_term_link( $id ).'"><span>'.__('Age','petsworld').'</span>'.$name.'</a>';
				} else {
					$age = '';
				}

			
				$data = '';			
				# Breed
				$breed = get_the_terms( $the_id ,'dt_tax_pet_breeds');
				if( is_array( $breed ) ) {
					$id = $breed[0]->term_id;
					$name = $breed[0]->name;
					$data .=  '<li><span>'.__('Breed','petsworld').'</span>'.'<a href="'.get_term_link( $id ).'">'.$name.'</a></li>';				
				}

				# City
				$city = get_the_terms( $the_id ,'dt_tax_pet_cities');
				if( is_array( $city ) ) {
					$id = $city[0]->term_id;
					$name = $city[0]->name;
					$data .= '<li><span>'.__('City','petsworld').'</span>'.'<a href="'.get_term_link( $id ).'">'.$name.'</a></li>';				
				}
				
				$data = !empty( $data ) ? '<ul>'.$data.'</ul>' : '';
				
				echo '<li>';
				echo '	<div class="dt-sc-single-pet dt-sc-single-pet">';
				echo '		<div class="dt-sc-single-pet-wrapper">';
				echo '			<div class="dt-sc-pet-thumb">'.$image.$age.'</div>';
				echo '			<div class="dt-sc-single-pet-details">';
				echo '				<h4><a href="'.$permalink.'">'.$title.'</a></h4>';
				echo 				$data;			
				echo '			</div>';			
				echo '		</div>';
				echo '	</div>';
				echo '</li>';				

			endwhile;
			echo "	</ul>";
			echo "</div>";
		endif;

		echo ($after_widget);
	}
}?>