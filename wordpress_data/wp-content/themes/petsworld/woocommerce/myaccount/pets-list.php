<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>

<a href="<?php echo wc_get_endpoint_url( 'dt-add-pet-endpoint','', wc_get_page_permalink( 'myaccount' ) ); ?>" class="button"><?php esc_html_e('Add New Pet','petsworld'); ?></a>

<?php
if ( $has_pets ) : ?>

	<table class="woocommerce-MyAccount-pets shop_table shop_table_responsive my_account_pets account-pets-table">
		<thead>
			<tr>
				<th class="pet-number"> <span class="nobr"><?php echo esc_html__('ID','petsworld'); ?></span> </th>
                <th class="pet-featured-image"> <span class="nobr"><?php echo esc_html__('Image','petsworld'); ?></span> </th>
				<th class="pet-name"> <span class="nobr"><?php echo esc_html__('Name','petsworld'); ?></span> </th>
                <th class="pet-created-date"> <span class="nobr"><?php echo esc_html__('Created','petsworld'); ?></span> </th>
				<th class="pet-status"> <span class="nobr"><?php echo esc_html__('Status','petsworld'); ?></span> </th>
				<th class="pet-action"> <span class="nobr"><?php echo esc_html__('Action','petsworld'); ?></span> </th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $customer_pets->pets as $customer_pet ):?>
			<tr>
				<td class="pet-number"><?php echo esc_html($customer_pet->ID); ?></td>
                <td class="pet-featured-image">
                	<?php if( has_post_thumbnail( $customer_pet->ID ) ): ?>
                    	<div class="thumbnail-holder">
                        	<?php echo get_the_post_thumbnail( $customer_pet->ID , 'thumbnail' ); ?>
                        </div>
                    <?php endif;?>
                </td>                
				<td class="pet-name"><?php echo esc_html($customer_pet->post_title); ?></td>
                <td class="pet-created-date"><?php echo get_the_date( get_option('date_format') , $customer_pet->ID); ?></td>
				<td class="pet-status"><?php echo esc_html($customer_pet->post_status); ?></td>
				<td class="pet-action">
					<?php if( 'publish' == $customer_pet->post_status ) : ?>
						<a target="_blank" href="<?php echo get_permalink( $customer_pet->ID ); ?>" class="button"><?php esc_html_e('View','petsworld'); ?></a>
					<?php endif; ?>
					<a href="<?php echo wc_get_endpoint_url( 'dt-edit-pet-endpoint', $customer_pet->ID, wc_get_page_permalink( 'myaccount' ) ); ?>" class="fa fa-pencil"></a>
					<a href="<?php echo wc_get_endpoint_url( 'dt-delete-pet-endpoint', $customer_pet->ID, wc_get_page_permalink( 'myaccount' ) ); ?>" class="fa fa-trash"></a>
				</td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table><?php

	if ( 1 < $customer_pets->max_num_pages ) :?>
		<div class="woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'dt-pets-endpoint', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'petsworld' ); ?></a>
			<?php endif; ?>

			<?php if ( $current_page !== intval( $customer_pets->max_num_pages ) ) : ?>
				<a class="woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'dt-pets-endpoint', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'petsworld' ); ?></a>
			<?php endif; ?>
		</div><?php
	endif;
else :
	esc_html_e( 'No pet has been added yet.', 'petsworld' );
endif;