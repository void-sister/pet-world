<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}?>
<p> Are you sure To delete pet ? </p>
	<a href="<?php echo wc_get_endpoint_url('dt-pets-endpoint'); ?>">No</a>
	<form method="post">
		<p>
			<input type="submit" class="button" name="delete_pet" value="<?php esc_attr_e( 'Yes', 'petsworld' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-delete_pet' ); ?>
            <input type="hidden" name="id" value="<?php echo esc_attr( $pet ); ?>" />
			<input type="hidden" name="action" value="delete_pet" />
		</p>
	</form>