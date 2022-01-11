<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
wc_print_notices(); ?>

<form class="woocommerce-form woocommerce-form-login login form" method="post" id="register-form">
	<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-group">
		<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" required
		       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) :
			       ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
	</div>
	<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide form-group">
		<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" required
		       id="password"/>
	</div>
	<div class="form-row form-group button">
		<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
		<button type="submit" class="woocommerce-Button button btn" name="login"
		        value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
	</div>
	<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

</form>