<?php
/**
 * The footer for the BabyBloom child theme.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$footer_email_default   = 'support@babybloomonline.com';
$footer_phone_default   = '+94 11 745 7450';
$footer_address_default = __( 'BabyBloom Online Support, Colombo, Sri Lanka', 'babybloom' );

$footer_email   = babybloom_get_setting( 'footer_email', $footer_email_default );
$footer_phone   = babybloom_get_setting( 'footer_phone', $footer_phone_default );
$footer_address = babybloom_get_setting( 'footer_address', $footer_address_default );

if ( 'hello@babybloom.com' === $footer_email ) {
	$footer_email = $footer_email_default;
}

if ( '+1 (800) 555-0188' === $footer_phone ) {
	$footer_phone = $footer_phone_default;
}

if ( '123 BabyBloom Lane, Suite 4, Your City, State' === $footer_address ) {
	$footer_address = $footer_address_default;
}
?>
	</div>

	<footer class="babybloom-footer" role="contentinfo">
		<div class="babybloom-container">
			<div class="babybloom-footer__shell">
				<div class="babybloom-footer__brand">
					<h2><?php bloginfo( 'name' ); ?></h2>
					<p><?php esc_html_e( 'Baby-friendly essentials with a calm, modern feel for everyday parenting.', 'babybloom' ); ?></p>
					<div class="babybloom-footer__meta">
						<?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Soft essentials for tiny beginnings', 'babybloom' ) ); ?>
					</div>
				</div>

				<div>
					<h3 class="babybloom-footer__heading"><?php esc_html_e( 'Shop', 'babybloom' ); ?></h3>
					<nav class="babybloom-footer__menu" aria-label="<?php esc_attr_e( 'Footer menu', 'babybloom' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'container'      => false,
								'fallback_cb'    => 'babybloom_menu_fallback',
							)
						);
						?>
					</nav>
				</div>

				<div>
					<h3 class="babybloom-footer__heading"><?php esc_html_e( 'Customer Care', 'babybloom' ); ?></h3>
					<ul class="babybloom-footer__contact">
						<li><a href="<?php echo esc_url( babybloom_get_account_url() ); ?>"><?php esc_html_e( 'My Account', 'babybloom' ); ?></a></li>
						<li><a href="<?php echo esc_url( babybloom_get_cart_url() ); ?>"><?php esc_html_e( 'Cart', 'babybloom' ); ?></a></li>
						<li><a href="<?php echo esc_url( function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : home_url( '/checkout/' ) ); ?>"><?php esc_html_e( 'Checkout', 'babybloom' ); ?></a></li>
						<li><a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : babybloom_get_page_url_by_path( 'contact' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'babybloom' ); ?></a></li>
					</ul>
				</div>

				<div>
					<h3 class="babybloom-footer__heading"><?php esc_html_e( 'Contact', 'babybloom' ); ?></h3>
					<ul class="babybloom-footer__contact">
						<li><a href="mailto:<?php echo esc_attr( $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a></li>
						<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>"><?php echo esc_html( $footer_phone ); ?></a></li>
						<li><?php echo wp_kses_post( nl2br( esc_html( $footer_address ) ) ); ?></li>
					</ul>
				</div>
			</div>

			<div class="babybloom-footer__copyright">
				<?php
				printf(
					esc_html__( 'Copyright %s BabyBloom. All rights reserved.', 'babybloom' ),
					esc_html( gmdate( 'Y' ) )
				);
				?>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
