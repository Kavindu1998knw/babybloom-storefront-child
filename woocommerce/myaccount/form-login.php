<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_customer_login_form' );

$registration_enabled = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
?>
<div class="u-columns col2-set babybloom-auth-forms <?php echo esc_attr( $registration_enabled ? 'is-register-enabled' : 'is-login-only' ); ?>" id="customer_login">
	<div class="u-column1 col-1 babybloom-auth-form-card babybloom-auth-form-card--login">
		<div class="babybloom-auth-form-card__header">
			<span class="babybloom-auth-form-card__eyebrow"><?php esc_html_e( 'Secure Sign In', 'babybloom' ); ?></span>
			<h3><?php esc_html_e( 'Welcome back', 'babybloom' ); ?></h3>
			<p><?php esc_html_e( 'Sign in to track orders, manage addresses, and continue checkout with your saved details.', 'babybloom' ); ?></p>
		</div>

		<form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Email address or username', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ! empty( $_POST['username'] ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="babybloom-auth-form-card__trust" aria-label="<?php esc_attr_e( 'Sign in benefits', 'babybloom' ); ?>">
				<div class="babybloom-auth-form-card__trust-item">
					<span class="babybloom-auth-form-card__trust-icon" aria-hidden="true"><?php echo babybloom_get_icon( 'safe' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span><?php esc_html_e( 'Secure access to your orders and account details', 'babybloom' ); ?></span>
				</div>
				<div class="babybloom-auth-form-card__trust-item">
					<span class="babybloom-auth-form-card__trust-icon" aria-hidden="true"><?php echo babybloom_get_icon( 'shipping' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<span><?php esc_html_e( 'Quick reordering for your everyday essentials', 'babybloom' ); ?></span>
				</div>
			</div>

			<p class="form-row babybloom-auth-form-card__remember-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					<span><?php esc_html_e( 'Keep me signed in on this device', 'babybloom' ); ?></span>
				</label>
			</p>

			<p class="form-row babybloom-auth-form-card__submit-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>

			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Forgot your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</form>
	</div>

	<?php if ( $registration_enabled ) : ?>
		<div class="u-column2 col-2 babybloom-auth-form-card babybloom-auth-form-card--register">
			<div class="babybloom-auth-form-card__header">
				<span class="babybloom-auth-form-card__eyebrow"><?php esc_html_e( 'Create Your Account', 'babybloom' ); ?></span>
				<h3><?php esc_html_e( 'Join BabyBloom', 'babybloom' ); ?></h3>
				<p><?php esc_html_e( 'Create an account for faster checkout, saved details, and a calmer shopping experience for every order.', 'babybloom' ); ?></p>
			</div>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ! empty( $_POST['username'] ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</p>
				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ! empty( $_POST['email'] ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>
				<?php else : ?>
					<p class="babybloom-auth-form-card__hint"><?php esc_html_e( 'We will send a secure password setup link to your email after registration.', 'babybloom' ); ?></p>
				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<div class="babybloom-auth-form-card__trust" aria-label="<?php esc_attr_e( 'Registration benefits', 'babybloom' ); ?>">
					<div class="babybloom-auth-form-card__trust-item">
						<span class="babybloom-auth-form-card__trust-icon" aria-hidden="true"><?php echo babybloom_get_icon( 'gift' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span><?php esc_html_e( 'Save baby favorites and reorder in a few taps', 'babybloom' ); ?></span>
					</div>
					<div class="babybloom-auth-form-card__trust-item">
						<span class="babybloom-auth-form-card__trust-icon" aria-hidden="true"><?php echo babybloom_get_icon( 'safe' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<span><?php esc_html_e( 'Your account details stay private and secure', 'babybloom' ); ?></span>
					</div>
				</div>

				<p class="woocommerce-privacy-policy-text babybloom-auth-form-card__hint"><?php esc_html_e( 'By creating an account, you can check out faster and manage your orders in one place.', 'babybloom' ); ?></p>

				<p class="woocommerce-form-row form-row babybloom-auth-form-card__submit-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>
			</form>
		</div>
	<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
