<?php
/**
 * CTA section.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cta_url = babybloom_get_setting( 'cta_button_url', '' );

if ( ! $cta_url ) {
	$cta_url = babybloom_get_shop_url();
}
?>

<section class="babybloom-cta">
	<div class="babybloom-container">
		<div class="babybloom-cta__shell">
			<div class="babybloom-cta__content">
				<span class="babybloom-eyebrow"><?php esc_html_e( 'Ready to launch', 'babybloom' ); ?></span>
				<h2><?php echo esc_html( babybloom_get_setting( 'cta_heading', __( 'Create a softer, sweeter shopping experience for modern parents.', 'babybloom' ) ) ); ?></h2>
				<p><?php echo wp_kses_post( babybloom_get_setting( 'cta_text', __( 'Use this section to guide visitors to your best collections, seasonal drops, or baby shower gift bundles.', 'babybloom' ) ) ); ?></p>
				<div class="babybloom-cta__actions">
					<a class="babybloom-button" href="<?php echo esc_url( $cta_url ); ?>">
						<?php echo esc_html( babybloom_get_setting( 'cta_button_text', __( 'Explore the Collection', 'babybloom' ) ) ); ?>
						<?php echo babybloom_get_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
					<a class="babybloom-outline-button" href="<?php echo esc_url( babybloom_get_account_url() ); ?>">
						<?php esc_html_e( 'Create Account', 'babybloom' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
