<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_media();
wp_enqueue_script('dt-pets', get_template_directory_uri().'/woocommerce/js/pets.js',  array( 'jquery' ), '', false);

$pet_sitter = get_post($pet_sitter); ?>
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
		'default' => $pet_sitter->ID
	) );		

	# Title
	woocommerce_form_field( '_pet_sitter_title', array( 
		"placeholder" => esc_html__("Pet Sitter's Name",'petsworld'),
		'required' => true
		),
		$pet_sitter->post_title
	);

	# City
	$fcities = array( '' => esc_html__('Select Location','petsworld') );
	$cities = get_categories('taxonomy=dt_tax_pet_sitter_cities&hide_empty=0');
	foreach( $cities as $city ){
		$fcities[$city->term_id] = $city->name;
	}

	$city = get_the_terms( $pet_sitter->ID,'dt_tax_pet_sitter_cities');
	$city = is_array( $city ) ? $city[0]->term_id : "";

	woocommerce_form_field( '_pet_sitter_city', array(
		'required' => true,
		'type' => 'select',
		'options' => $fcities
		),
		$city
	);	

	# Gender
	$fgenders = array( '' => esc_html__('Select Gender','petsworld') );
	$genders = get_categories('taxonomy=dt_tax_pet_sitter_genders&hide_empty=0');
	foreach ( $genders as $gender ) {
		$fgenders[$gender->term_id] = $gender->name;
	}

	$gender = get_the_terms( $pet_sitter->ID,'dt_tax_pet_sitter_genders');
	$gender = is_array( $gender ) ? $gender[0]->term_id : "";

	woocommerce_form_field( '_pet_sitter_gender', array(
		'required' => true,
		'type' => 'select',
		'class' => array( 'form-row-first' ),
		'options' => $fgenders
		),
		$gender
	);

	# Age
	$fages = array( '' => esc_html__('Select Age','petsworld') );
	$ages = get_categories('taxonomy=dt_tax_pet_sitter_ages&hide_empty=0');
	foreach ( $ages as $age ) {
		$fages[$age->term_id] = $age->name;
	}

	$age = get_the_terms( $pet_sitter->ID,'dt_tax_pet_sitter_ages');
	$age = is_array( $age ) ? $age[0]->term_id : "";

	woocommerce_form_field( '_pet_sitter_age', array(
		'required' => true,
		'type' => 'select',
		'class' => array( 'form-row-last' ),
		'options' => $fages
		),
		$age
	);
		

	# Experiences
	$fexperiences = array( '' => esc_html__('Select Experiences','petsworld') );
	$experiences = get_categories('taxonomy=dt_tax_pet_sitter_experiences&hide_empty=0');
	foreach ( $experiences as $experience ) {
		$fexperiences[$experience->term_id] = $experience->name;
	}

	$exp = get_the_terms( $pet_sitter->ID,'dt_tax_pet_sitter_experiences');
	$exp = is_array( $exp ) ? $exp[0]->term_id : "";

	woocommerce_form_field( '_pet_sitter_experiences',array(
		'required' => true,
		'type' => 'select',
		'class' => array( 'form-row-first' ),
		'options' => $fexperiences
		),
		$exp
	);
	
	# Meta Settings
	$pet_sitter_settings = get_post_meta ( $post->ID, '_custom_settings', TRUE );
	$pet_sitter_settings = is_array ( $pet_sitter_settings ) ? $pet_sitter_settings : array ();


	# Price
	$price = array_key_exists ( 'price', $pet_sitter_settings ) ? $pet_sitter_settings ['price'] : '';
	woocommerce_form_field( '_pet_sitter_price',
		array( 
			'label' => esc_html__('Price','petsworld') .' ('. get_woocommerce_currency_symbol().')',
			'class' => array( 'form-row-last' ),
			'placeholder' => 10.5,
			'default' => $price
		)		
	);

	# Social Profile
	echo '<div class="clear"></div>';
		$default = array_key_exists ( 'google_social_link', $pet_sitter_settings ) ? $pet_sitter_settings ['google_social_link'] : '';
		woocommerce_form_field( '_pet_sitter_google',
			array( 
				'label' => esc_html__('Google Plus Link','petsworld'),
				'placeholder' => esc_html__('Google Plus Link Here','petsworld'),
				'class' => array( 'form-row-first' ),
				'default' => $default
			)
		);
		
		$default = array_key_exists ( 'facebook_social_link', $pet_sitter_settings ) ? $pet_sitter_settings ['facebook_social_link'] : '';	
		woocommerce_form_field( '_pet_sitter_fb',
			array( 
				'label' => esc_html__('Facebook Profile Link','petsworld'),
				'placeholder' => esc_html__('Facebook Profile Link','petsworld'),
				'class' => array( 'form-row-last' ),
				'default' => $default
			)
		);
		
		$default = array_key_exists ( 'twitter_social_link', $pet_sitter_settings ) ? $pet_sitter_settings ['twitter_social_link'] : '';		
		woocommerce_form_field( '_pet_sitter_twitter',
			array( 
				'label' => esc_html__('Twitter Link','petsworld'),
				'placeholder' => esc_html__('Twitter Profile Link','petsworld'),
				'class' => array( 'form-row-first' ),
				'default' => $default
			)
		);		
	

	# Area of Interest
	echo '<div class="clear"></div>';
	echo '<p class="form-row form-row _pet_services_field">';			
	echo '<label>'.esc_html__('Area of Interest','petsworld').'</label>';
	echo '<ul>';

	$selected_services = array();
	$selected = get_the_terms( $pet_sitter->ID,'dt_tax_pet_sitter_roles');
	if( is_array( $selected ) ) {
		foreach ($selected as $selected ) {
			array_push($selected_services, $selected->term_id);
		}
	}

	$services = get_categories('taxonomy=dt_tax_pet_sitter_roles&hide_empty=0');
	foreach( $services as $service ){
		$id = $service->term_id;
		$name = $service->name;
		$checked = in_array($id, $selected_services) ? " checked " : "";
		echo "<li><label><input type='radio' name='_pet_sitter_services[]' value='{$id}' {$checked}/> <span>{$name}</span></label></li>";
	}
	echo '</ul>';
	echo '</p>';?>


	<!-- Set Featured Image -->
	<p><?php
		if( has_post_thumbnail( $pet_sitter->ID ) ) : ?>
			<a id="dt-set-featured-image" href="#" style="display: none;">
				<?php esc_html_e('Set Featured Image','petsworld'); ?>
			</a>

			<div class="thumbnail-holder">
				<?php echo get_the_post_thumbnail( $pet_sitter->ID , 'thumbnail' ); ?>
				<input name="_thumbnail_id" value="<?php echo get_post_thumbnail_id( $pet_sitter->ID ); ?>" type="hidden">
				<span class="my_delete"> - </span>
			</div><?php
		else:?>
			<a id="dt-set-featured-image" href="#">
				<?php esc_html_e('Set Featured Image','petsworld'); ?>
			</a><?php
		endif; ?>
	</p>
	<!-- Set Featured Image -->

	<!-- Content -->
	<?php $content = $pet_sitter->post_content;
		wp_editor( $content , '_pet_sitter_contentarea', array(
			'media_buttons' => false,
			'textarea_name' => '_pet_sitter_content',
		) ); ?>
	<!-- Content -->
	<div class="clear"></div>
	<p>
		<input type="submit" class="button" name="edit_pet_sitter" value="<?php esc_attr_e( 'Update Pet Sitter', 'petsworld' ); ?>" />
		<?php wp_nonce_field( 'woocommerce-edit_pet_sitter' ); ?>
		<input type="hidden" name="action" value="edit_pet_sitter" />
	</p>
</form>