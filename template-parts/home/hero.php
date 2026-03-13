<?php
/**
 * Hero section.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$primary_url       = babybloom_get_setting( 'hero_button_url', '' );
$secondary_url     = babybloom_get_setting( 'hero_secondary_url', '' );
$custom_hero_image = babybloom_get_setting( 'hero_image', '' );
$hero_image        = $custom_hero_image;

if ( ! $primary_url ) {
	$primary_url = babybloom_get_shop_url();
}

if ( ! $secondary_url ) {
	$secondary_url = babybloom_get_shop_url();
}

if ( ! $hero_image ) {
	$hero_image = BABYBLOOM_URI . '/assets/images/hero-placeholder.svg';
}
?>

<section class="babybloom-section babybloom-hero">
	<div class="babybloom-container">
		<div class="babybloom-hero__wrap">
			<div class="babybloom-hero__content">
				<span class="babybloom-eyebrow"><?php esc_html_e( 'Curated for growing families', 'babybloom' ); ?></span>
				<h1><?php echo esc_html( babybloom_get_setting( 'hero_heading', __( 'Everything Your Baby Needs for a Happy Start', 'babybloom' ) ) ); ?></h1>
				<p><?php echo wp_kses_post( babybloom_get_setting( 'hero_text', __( 'Discover premium baby clothing, soft essentials, playful toys, and thoughtful accessories curated to make everyday parenting feel lighter, sweeter, and more organized.', 'babybloom' ) ) ); ?></p>

				<div class="babybloom-hero__actions">
					<a class="babybloom-button" href="<?php echo esc_url( $primary_url ); ?>">
						<?php echo esc_html( babybloom_get_setting( 'hero_button_text', __( 'Shop Now', 'babybloom' ) ) ); ?>
						<?php echo babybloom_get_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
					<a class="babybloom-outline-button" href="<?php echo esc_url( $secondary_url ); ?>">
						<?php echo esc_html( babybloom_get_setting( 'hero_secondary_text', __( 'Browse Gift Sets', 'babybloom' ) ) ); ?>
					</a>
				</div>

				<div class="babybloom-hero__highlights">
					<div class="babybloom-hero__stat">
						<strong><?php esc_html_e( '1,000+', 'babybloom' ); ?></strong>
						<span><?php esc_html_e( 'gentle products for everyday routines', 'babybloom' ); ?></span>
					</div>
					<div class="babybloom-hero__stat">
						<strong><?php esc_html_e( 'Premium', 'babybloom' ); ?></strong>
						<span><?php esc_html_e( 'materials chosen for softness and safety', 'babybloom' ); ?></span>
					</div>
					<div class="babybloom-hero__stat">
						<strong><?php esc_html_e( 'Fast', 'babybloom' ); ?></strong>
						<span><?php esc_html_e( 'shipping and parent-friendly support', 'babybloom' ); ?></span>
					</div>
				</div>
			</div>

			<div class="babybloom-hero__media<?php echo $custom_hero_image ? '' : ' babybloom-hero__media--placeholder'; ?>">
				<div class="babybloom-floating-pill babybloom-floating-pill--top">
					<span class="babybloom-pill-dot" aria-hidden="true"></span>
					<?php esc_html_e( 'Trusted by modern parents', 'babybloom' ); ?>
				</div>

				<div class="babybloom-hero__image-card">
					<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'BabyBloom hero placeholder', 'babybloom' ); ?>">
				</div>

				<div class="babybloom-floating-pill babybloom-floating-pill--bottom">
					<span class="babybloom-pill-dot" aria-hidden="true"></span>
					<?php esc_html_e( 'Soft picks. Sweet gifting. Daily essentials.', 'babybloom' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>
