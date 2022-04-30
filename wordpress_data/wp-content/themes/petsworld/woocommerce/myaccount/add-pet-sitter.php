<?php
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

	# Title
	woocommerce_form_field( '_pet_sitter_title',
		array( 
			'required' => true,
			"placeholder" => esc_html__("Pet Sitter's Name",'petsworld')
		),
		!empty( $_POST['_pet_sitter_title'] ) ? wc_clean( $_POST['_pet_sitter_title'] ) : ''
	);

	# City
	$fcities = array( '' => esc_html__('Select Location','petsworld') );
	$cities = get_categories('taxonomy=dt_tax_pet_sitter_cities&hide_empty=0');
	foreach( $cities as $city ){
		$fcities[$city->term_id] = $city->name;
	}
	woocommerce_form_field( '_pet_sitter_city',
		array(
			'required' => true,
			'type' => 'select',
			'placeholder' => esc_html__("Location",'petsworld'),
			'options' => $fcities
		),
		!empty( $_POST['_pet_sitter_city'] ) ? wc_clean(  $_POST['_pet_sitter_city'] ) : ''
	);	

	# Gender
	$fgenders = array( '' => esc_html__('Select Gender','petsworld') );
	$genders = get_categories('taxonomy=dt_tax_pet_sitter_genders&hide_empty=0');
	foreach ( $genders as $gender ) {
		$fgenders[$gender->term_id] = $gender->name;
	}
	woocommerce_form_field( '_pet_sitter_gender',
		array(
			'placeholder' => esc_html__('Gender','petsworld'),
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-first' ),
			'options' => $fgenders
		),
		!empty( $_POST['_pet_sitter_gender'] ) ? wc_clean(  $_POST['_pet_sitter_gender'] ) : ''
	);

	# Age
	$fages = array( '' => esc_html__('Select Age','petsworld') );
	$ages = get_categories('taxonomy=dt_tax_pet_sitter_ages&hide_empty=0');
	foreach ( $ages as $age ) {
		$fages[$age->term_id] = $age->name;
	}
	woocommerce_form_field( '_pet_sitter_age',
		array(
			'placeholder' => esc_html__('Age','petsworld'),
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-last' ),
			'options' => $fages
		),
		!empty( $_POST['_pet_sitter_age'] ) ? wc_clean(  $_POST['_pet_sitter_age'] ) : ''
	);
		

	# Experiences
	$fexperiences = array( '' => esc_html__('Select Experiences','petsworld') );
	$experiences = get_categories('taxonomy=dt_tax_pet_sitter_experiences&hide_empty=0');
	foreach ( $experiences as $experience ) {
		$fexperiences[$experience->term_id] = $experience->name;
	}
	woocommerce_form_field( '_pet_sitter_experiences',
		array(
			'placeholder' => esc_html__('Experiences','petsworld'),
			'required' => true,
			'type' => 'select',
			'class' => array( 'form-row-first' ),
			'options' => $fexperiences
		),
		!empty( $_POST['_pet_sitter_experiences'] ) ? wc_clean(  $_POST['_pet_sitter_experiences'] ) : ''
	);
	
	# Price
	woocommerce_form_field( '_pet_sitter_price',
		array( 
			'label' => esc_html__('Price','petsworld') .' ('. get_woocommerce_currency_symbol().')',
			'class' => array( 'form-row-last' ),
			'required' => true,
			'placeholder' => 10.5,
		),
		!empty( $_POST['_pet_sitter_price'] ) ? wc_clean( $_POST['_pet_sitter_price'] ) : ''
	);
	
	# Social Profile
	echo '<div class="clear"></div>';
	
		woocommerce_form_field( '_pet_sitter_google',
			array( 
				'label' => esc_html__('Google Plus Link','petsworld'),
				'placeholder' => esc_html__('Google Plus Link Here','petsworld'),
				'class' => array( 'form-row-first' ),
			),
			!empty( $_POST['_pet_sitter_google'] ) ? wc_clean( $_POST['_pet_sitter_google'] ) : ''
		);
	
		woocommerce_form_field( '_pet_sitter_fb',
			array( 
				'label' => esc_html__('Facebook Profile Link','petsworld'),
				'placeholder' => esc_html__('Facebook Profile Link','petsworld'),
				'class' => array( 'form-row-last' ),
			),
			!empty( $_POST['_pet_sitter_fb'] ) ? wc_clean( $_POST['_pet_sitter_fb'] ) : ''
		);

		woocommerce_form_field( '_pet_sitter_twitter',
			array( 
				'label' => esc_html__('Twitter Link','petsworld'),
				'placeholder' => esc_html__('Twitter Profile Link','petsworld'),
				'class' => array( 'form-row-first' ),
			),
			!empty( $_POST['_pet_sitter_twitter'] ) ? wc_clean( $_POST['_pet_sitter_twitter'] ) : ''
		);		
	
	# Area of Interest
	echo '<div class="clear"></div>';
	echo '<p class="form-row form-row _pet_services_field">';			
	echo '<label>'.esc_html__('Area of Interest','petsworld').'</label>';
	echo '<ul>';

	$services = get_categories('taxonomy=dt_tax_pet_sitter_roles&hide_empty=0');
	foreach( $services as $service ){
		$id = $service->term_id;
		$name = $service->name;
		echo "<li><label><input type='checkbox' name='_pet_sitter_services[]' value='{$id}'/> <span>{$name}</span></label></li>";
	}
	echo '</ul>';
	echo '</p>';?>


	<!-- Set Featured Image -->
	<p>
		<a id="dt-set-featured-image" href="#"><?php esc_html_e('Set Featured Image','petsworld'); ?></a>
	</p>
	<!-- Set Featured Image -->

	<!-- Content -->
	<?php $content = !empty( $_POST['_pet_sitter_content'] ) ? wc_clean(  $_POST['_pet_sitter_content'] ) : '';
		wp_editor( $content , '_pet_sitter_contentarea', array(
			'media_buttons' => false,
			'textarea_name' => '_pet_sitter_content',
		) ); ?>
	<!-- Content -->
	<div class="clear"></div>
	<p>
		<input type="submit" class="button" name="add_pet_sitter" value="<?php esc_attr_e( 'Add Pet Sitter', 'petsworld' ); ?>" />
		<?php wp_nonce_field( 'woocommerce-add_pet_sitter' ); ?>
		<input type="hidden" name="action" value="add_pet_sitter" />
	</p>
</form>