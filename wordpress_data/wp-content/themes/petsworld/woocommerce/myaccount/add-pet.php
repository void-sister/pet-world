<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_media();
wp_enqueue_script('dt-pets', get_template_directory_uri().'/woocommerce/js/pets.js',  array( 'jquery' ), '', false); ?>

<form method="post"><?php

	woocommerce_form_field( 'customer', array(
		'class' =>  array( 'hidden' ),
		'required' => true,
		'default' => $customer
	) );

	# Pet Name
	woocommerce_form_field( '_pet_title',
		array( 
			"placeholder" => esc_html__("Pet's Name",'petsworld'),
			'required' => true
		),
		!empty( $_POST['_pet_title'] ) ? wc_clean( $_POST['_pet_title'] ) : ''
	 );

	# Type
	$ftypes = array( '' => esc_html__('Select Pet Type','petsworld') );
	$types = get_categories('taxonomy=dt_tax_pet_types&hide_empty=0');
	foreach ( $types as $type ) {
		$ftypes[$type->term_id] = $type->name;
	}
	woocommerce_form_field( '_pet_type',
		array(
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-first' ),
			'options' => $ftypes
		),
		!empty( $_POST['_pet_type'] ) ? wc_clean(  $_POST['_pet_type'] ) : ''
	);

	# Gender
	$fgenders = array( '' => esc_html__('Select Gender','petsworld') );
	$genders = get_categories('taxonomy=dt_tax_pet_genders&hide_empty=0');
	foreach ( $genders as $gender ) {
		$fgenders[$gender->term_id] = $gender->name;
	}
	woocommerce_form_field( '_pet_gender',
		array(
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-last' ),
			'options' => $fgenders
		),
		!empty( $_POST['_pet_gender'] ) ? wc_clean(  $_POST['_pet_gender'] ) : ''
	);

	# Age
	$fage = array( '' => esc_html__('Age','petsworld') );
	$ages = get_categories('taxonomy=dt_tax_pet_ages&hide_empty=0');
	foreach( $ages as $age ){
		$fage[$age->term_id] = $age->name;
	}
	woocommerce_form_field( '_pet_age',
		array(
			'required' => true,
			'type' => 'select',
			'class' => array('form-row-first'),
			'options' => $fage
		),
		!empty( $_POST['_pet_gender'] ) ? wc_clean(  $_POST['_pet_gender'] ) : ''
	);

	# Size
	$fsize = array( '' => esc_html__('Size','petsworld') );
	$sizes = get_categories('taxonomy=dt_tax_pet_sizes&hide_empty=0');
	foreach( $sizes as $size ){
		$fsize[$size->term_id] = $size->name;
	}
	woocommerce_form_field( '_pet_size',
		array(
			'required' => true,
			'type' => 'select',
			'class' => array('form-row-last'),
			'options' => $fsize
		),
		!empty( $_POST['_pet_size'] ) ? wc_clean(  $_POST['_pet_size'] ) : ''
	);

	# Breeds
	$fbreed = array( '' => esc_html__('Breed','petsworld') );
	$breeds = get_categories('taxonomy=dt_tax_pet_breeds&hide_empty=0');
	foreach( $breeds as $breed ){
		$fbreed[$breed->term_id] = $breed->name;
	}
	woocommerce_form_field( '_pet_breed',
		array(
			'required' => true,
			'type' => 'select',
			'options' => $fbreed
		),
		!empty( $_POST['_pet_breed'] ) ? wc_clean(  $_POST['_pet_breed'] ) : ''
	);

	# City
	$locations = get_categories('taxonomy=dt_tax_pet_cities&hide_empty=0&parent=0');
	
	$slected_location = !empty( $_POST['_pet_city'] ) ? wc_clean(  $_POST['_pet_city'] ) : '';
	
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
											$location_module .= '<option value="'.$c.'" '.selected( $slected_location, $c, false ).'>'.$term->name.'</option>';										
										}
										
										$location_module .= '</optgroup>';
									}
									
								}
	$location_module .= '	</select>';
	$location_module .= '</p>';
		
	echo "{$location_module}";

	# Main Services
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
		!empty( $_POST['_pet_main_services'] ) ? wc_clean(  $_POST['_pet_main_services'] ) : ''
	);
	
	# Child Services
	echo '<div id="_pet_child_services"></div>';?>

	<!-- Set Featured Image -->
	<p>
	<a id="dt-set-featured-image" href="#">
		<?php esc_html_e('Set Featured Image','petsworld'); ?>
	</a>
	</p>
	<!-- Set Featured Image -->

	<!-- Set Gallery Image -->
	<div>
        <a id="dt-set-gallery-image" href="#">
            <?php esc_html_e('Set Gallery Image','petsworld'); ?>
        </a>
        <ul class="dt-items-holder"></ul>
	</div>    
	<!-- Set Gallery Image -->
    

	<!-- Content -->
	<?php $content = !empty( $_POST['_pet_content'] ) ? wc_clean(  $_POST['_pet_content'] ) : '';
	wp_editor( $content , '_pet_content_area', array(
		'media_buttons' => false,
		'textarea_name' => '_pet_content',
		) ); ?>
	<!-- Content -->

	<div class="clear"></div>
	<p>
		<input type="submit" class="button" name="add_pet" value="<?php esc_attr_e( 'Add Pet', 'petsworld' ); ?>" />
		<?php wp_nonce_field( 'woocommerce-add_pet' ); ?>
		<input type="hidden" name="action" value="add_pet" />
	</p>
</form>