<?php
$pet = get_post($pet);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_media();
wp_enqueue_script('dt-pets', get_template_directory_uri().'/woocommerce/js/pets.js',  array( 'jquery' ), '', false); ?>

<form method="post"><?php

	# Customer
		woocommerce_form_field( 'customer', array(
			'class' =>  array( 'hidden' ),
			'required' => true,
			'default' => $customer
		) );

	# ID
		woocommerce_form_field( 'id', array(
			'class' =>  array( 'hidden' ),
			'required' => true,
			'default' => $pet->ID
		) );		


	# Title
		woocommerce_form_field( '_pet_title',array( 
			"placeholder" => esc_html__("Pet's Name",'petsworld'),
			'required' => true
			),
			$pet->post_title
		);

	# Type
		$ftypes = array( '' => esc_html__('Select Pet Type','petsworld') );
		$types = get_categories('taxonomy=dt_tax_pet_types&hide_empty=0');
		foreach ( $types as $type ) {
			$ftypes[$type->term_id] = $type->name;
		}

		$type = get_the_terms( $pet->ID,'dt_tax_pet_types');
		$type = is_array( $type ) ? $type[0]->term_id : "";
		woocommerce_form_field( '_pet_type', array(
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-first' ),
			'options' => $ftypes
			),
			$type
		);

	# Gender
		$fgenders = array( '' => esc_html__('Select Gender','petsworld') );
		$genders = get_categories('taxonomy=dt_tax_pet_genders&hide_empty=0');
		foreach ( $genders as $gender ) {
			$fgenders[$gender->term_id] = $gender->name;
		}

		$gender = get_the_terms( $pet->ID,'dt_tax_pet_genders');
		$gender = is_array( $gender ) ? $gender[0]->term_id : "";
		woocommerce_form_field( '_pet_gender', 	array(
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-last' ),
			'options' => $fgenders
			),
			$gender
		);

	# Age
		$fage = array( '' => esc_html__('Age','petsworld') );
		$ages = get_categories('taxonomy=dt_tax_pet_ages&hide_empty=0');
		foreach( $ages as $age ){
			$fage[$age->term_id] = $age->name;
		}

		$age = get_the_terms( $pet->ID,'dt_tax_pet_ages');
		$age = is_array( $age ) ? $age[0]->term_id : "";

		woocommerce_form_field( '_pet_age', array(
			'required' => true,
			'type' => 'select',
			'class' => array('form-row-first'),
			'options' => $fage
			),
			$age
		);

	# Size
		$fsize = array( '' => esc_html__('Size','petsworld') );
		$sizes = get_categories('taxonomy=dt_tax_pet_sizes&hide_empty=0');
		foreach( $sizes as $size ){
			$fsize[$size->term_id] = $size->name;
		}

		$size = get_the_terms( $pet,'dt_tax_pet_sizes');
		$size = is_array( $size ) ? $size[0]->term_id : "";

		woocommerce_form_field( '_pet_size', array(
			'required' => true,
			'type' => 'select',
			'class' => array('form-row-last'),
			'options' => $fsize
			),
			$size
		);				

	# Breeds
		$fbreed = array( '' => esc_html__('Breed','petsworld') );
		$breeds = get_categories('taxonomy=dt_tax_pet_breeds&hide_empty=0');
		foreach( $breeds as $breed ){
			$fbreed[$breed->term_id] = $breed->name;
		}

		$breed = get_the_terms( $pet->ID,'dt_tax_pet_breeds');
		$breed = is_array( $breed ) ? $breed[0]->term_id : "";

		woocommerce_form_field( '_pet_breed', array(
			'required' => true,
			'type' => 'select',
			'options' => $fbreed
			),
			$breed
		);

	# City
		$city = get_the_terms( $pet->ID,'dt_tax_pet_cities');
		$city = is_array( $city ) ? $city[0]->term_id : "";

		$locations = get_categories('taxonomy=dt_tax_pet_cities&hide_empty=0&parent=0');
		$location_module  = '<p class="form-row form-row validate-required" id="_pet_city_field">';
		$location_module .= '	<select name="_pet_city" id="_pet_city" class="select " data-allow_clear="true" data-placeholder="'.esc_attr__('Location','petsworld').'">';
		$location_module .= '		<option value="0">'.esc_html__('Choose Location','petsworld').'</option>';
								foreach( $locations as  $location ) {
									
									$id = $location->term_id;
									$child = get_term_children( $id, 'dt_tax_pet_cities' );
									
									if( !empty( $child ) ) {
										
										$location_module .= '<optgroup label="'.$location->name.'">';
										
										foreach( $child as $c ) {
											$term = get_term_by( 'id', $c, 'dt_tax_pet_cities' );
											$location_module .= '<option value="'.$c.'" '.selected( $city, $c, false ).'>'.$term->name.'</option>';										
										}
										
										$location_module .= '</optgroup>';
									}
									
								}
		$location_module .= '	</select>';
		$location_module .= '</p>';
		echo "{$location_module}";

	# Main Services
	$show_child = false;	
	$main = get_the_terms( $pet->ID,'dt_tax_pet_services');
	
	if(  is_array( $main ) ) {
		$main = $main[0];
		if( $main->parent == 0 ){
			
			$main = $main->term_id;
			$show_child = false;	
		} else {
			$main = $main->parent;
			$show_child = true;
		}
	} else {
		$main = '';
	}
	
	$fmain_services = array( '' => esc_html__('Choose Service','petsworld') );
	$main_services = get_categories('taxonomy=dt_tax_pet_services&hide_empty=0&parent=0');
	foreach( $main_services as $service ){
		$fmain_services[$service->term_id] = $service->name;
	}
	woocommerce_form_field( '_pet_main_services',
		array(
			'required' => true,
			'type' => 'select',
			'input_class' => array( 'pet_main_services' ),
			'options' => $fmain_services
		),
		$main
	);
	
	echo '<div id="_pet_child_services">';
	
	if( $show_child ) :	

		$selected_services = array();
		$selected = get_the_terms( $pet->ID,'dt_tax_pet_services');
		if( is_array( $selected ) ) {
			foreach ($selected as $selected ) {
				array_push($selected_services, $selected->term_id);
			}
		}
	
	
		# Child Services
		$child = get_term_children( $main, 'dt_tax_pet_services' );
		
		echo '	<ul>';
				foreach( $child as $c ) {
					
					$term = get_term_by( 'id', $c, 'dt_tax_pet_services' );
					$checked = in_array($c, $selected_services) ? " checked " : "";
					
				 	echo "<li><label><input type='checkbox' name='_pet_services[]' value='{$c}' {$checked}/> <span>{$term->name}</span></label></li>";
				}		
		echo '	</ul>';		
	endif;
	echo '</div>';?>
	
	<!-- Set Featured Image -->
	<p>
	<?php if( has_post_thumbnail( $pet->ID ) ) : ?>

			<a id="dt-set-featured-image" href="#" style="display: none;">
				<?php esc_html_e('Set Featured Image','petsworld'); ?>
			</a>

			<div class="thumbnail-holder">
				<?php echo get_the_post_thumbnail( $pet->ID , 'thumbnail' ); ?>
				<input name="_thumbnail_id" value="<?php echo get_post_thumbnail_id( $pet->ID ); ?>" type="hidden">
				<span class="my_delete"> - </span>
			</div>
	<?php else:?>
			<a id="dt-set-featured-image" href="#">
				<?php esc_html_e('Set Featured Image','petsworld'); ?>
			</a>		
	<?php endif; ?>
	</p>
	<!-- Set Featured Image -->

	<!-- Set Gallery Image -->
	<div>
    
    	<a id="dt-set-gallery-image" href="#"><?php esc_html_e('Set Gallery Image','petsworld'); ?></a>
		<ul class="dt-items-holder"><?php
		
		$pet_settings = get_post_meta ( $pet->ID, "_custom_settings", true );
		$pet_settings = is_array ( $pet_settings ) ? $pet_settings : array ();
		
		if (array_key_exists ( "items", $pet_settings )):
		
			
			
			foreach ( $pet_settings["items_thumbnail"] as $key => $thumbnail ) {
				
				$item = $pet_settings ['items'] [$key];
				$name = "";
				$foramts = array ( 'jpg', 'jpeg', 'gif', 'png');
				$parts = explode ( '.', $item );
				$ext = strtolower ( $parts [count ( $parts ) - 1] );
				
				if (in_array ( $ext, $foramts )) {
					$name = $pet_settings ['items_name'] [$key];
					echo "<li>";
					echo "<img src='{$thumbnail}' alt='' />";
					echo "<span class='dt-image-name'>{$name}</span>";
					echo "<input type='hidden' name='items[]' value='{$item}' />";
				} else {
					$name = "video";
					echo"<li>";
					echo"<span class='dt-video'></span>";
					echo"<input type='text' name='items[]' value='{$item}' />";
				}
				
				echo "<input class='dt-image-name' type='hidden' name='items_name[]' value='{$name}' />";
				echo "<input type='hidden' name='items_thumbnail[]' value='{$thumbnail}' />";
				echo "<span class='my_delete'> - </span>";
				echo "</li>";
			}
		endif;?>
        </ul>	
	</div>    
	<!-- Set Gallery Image -->
    

	<!-- Content -->
	<?php $content = $pet->post_content;
	wp_editor( $content , '_pet_content_area', array(
		'media_buttons' => false,
		'textarea_name' => '_pet_content',
		) ); ?>
	<!-- Content -->	

	<div class="clear"></div>


<p>
	<input type="submit" class="button" name="edit_pet" value="<?php esc_attr_e( 'Update Pet', 'petsworld' ); ?>" />
	<?php wp_nonce_field( 'woocommerce-edit_pet' ); ?>
	<input type="hidden" name="action" value="edit_pet" />
</p>

</form>