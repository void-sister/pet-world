<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>
<a href="<?php echo wc_get_endpoint_url( 'dt-add-petsitter-endpoint','', wc_get_page_permalink( 'myaccount' ) ); ?>" class="button">
	<?php esc_html_e('Add New Pet Sitter','petsworld'); ?></a>
<hr/>
<?php
if ( $has_pet_sitters ) : ?>
	<table class="woocommerce-MyAccount-pet-sitters shop_table shop_table_responsive my_account_pet_sitters account-pet-sitters-table">
		<thead>
			<tr>
				<th class="pet-sitter-number"> <span class="nobr"><?php echo esc_html__('ID','petsworld'); ?></span> </th>
                <th class="pet-sitter-featured-image"> <span class="nobr"><?php echo esc_html__('Image','petsworld'); ?></span> </th>
				<th class="pet-sitter-name"> <span class="nobr"><?php echo esc_html__('Name','petsworld'); ?></span> </th>
                <th class="pet-sitter-created-date"> <span class="nobr"><?php echo esc_html__('Created','petsworld'); ?></span> </th>
				<th class="pet-sitter-status"> <span class="nobr"><?php echo esc_html__('Status','petsworld'); ?></span> </th>
				<th class="pet-sitter-action"> <span class="nobr"><?php echo esc_html__('Action','petsworld'); ?></span> </th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $customer_pet_sitters->pet_sitters as $customer_pet_sitter ):?>
				<tr>
					<td class="pet-sitter-number"><?php echo esc_html( $customer_pet_sitter->ID ); ?></td>
                    <td class="pet-sitter-featured-image">
						<?php if( has_post_thumbnail( $customer_pet_sitter->ID ) ): ?>
                        	<div class="thumbnail-holder">
                            	<?php echo get_the_post_thumbnail( $customer_pet_sitter->ID , 'thumbnail' ); ?>
                            </div>
                        <?php endif;?>
                    </td>
					<td class="pet-sitter-name"><?php echo esc_html($customer_pet_sitter->post_title); ?></td>
                    <td class="pet-sitter-created-date"><?php echo get_the_date( get_option('date_format') , $customer_pet_sitter->ID); ?></td>
					<td class="pet-sitter-status"><?php echo esc_html($customer_pet_sitter->post_status); ?></td>
					<td class="pet-sitter-action">
						<?php if( 'publish' == $customer_pet_sitter->post_status ) : ?>
							<a target="_blank" href="<?php echo get_permalink( $customer_pet_sitter->ID ); ?>" class="button"><?php esc_html_e('View','petsworld'); ?></a>
						<?php endif; ?>
						<a href="<?php echo wc_get_endpoint_url( 'dt-edit-petsitter-endpoint', $customer_pet_sitter->ID, wc_get_page_permalink( 'myaccount' ) ); ?>" class="button"><?php esc_html_e('Edit','petsworld'); ?></a>
						<a href="<?php echo wc_get_endpoint_url( 'dt-delete-petsitter-endpoint', $customer_pet_sitter->ID, wc_get_page_permalink( 'myaccount' ) ); ?>" class="button"><?php esc_html_e('Delete','petsworld'); ?></a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table><?php

	if ( 1 < $customer_pet_sitters->max_num_pages ) :?>
		<div class="woocommerce-Pagination">
			<?php if ( 1 !== $current_page ) : ?>
				<a class="woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'dt-petsitter-endpoint', $current_page - 1 ) ); ?>"><?php esc_html_e( 'Previous', 'petsworld' ); ?></a>
			<?php endif; ?>

			<?php if ( $current_page !== intval( $customer_pet_sitters->max_num_pages ) ) : ?>
				<a class="woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'dt-petsitter-endpoint', $current_page + 1 ) ); ?>"><?php esc_html_e( 'Next', 'petsworld' ); ?></a>
			<?php endif; ?>
		</div><?php
	endif;	
	else :
	_e( 'No pet sitters has been added yet.', 'petsworld' );
endif;