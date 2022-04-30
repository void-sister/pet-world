<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>
<p> Are you sure To delete pet Sitter ? </p>
	<a href="<?php echo wc_get_endpoint_url('dt-petsitter-endpoint'); ?>">No</a>
	<form method="post">
		<p>
			<input type="submit" class="button" name="delete_pet_sitter" value="<?php esc_attr_e( 'Yes', 'petsworld' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-delete_pet_sitter' ); ?>
			<input type="hidden" name="id" value="<?php echo esc_attr( $pet_sitter ); ?>" />
			<input type="hidden" name="action" value="delete_pet_sitter" />
		</p>
	</form>