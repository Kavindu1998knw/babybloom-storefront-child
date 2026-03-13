<?php
/**
 * The header for the BabyBloom child theme.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<header class="babybloom-header" role="banner">
		<div class="babybloom-container">
			<div class="babybloom-header__inner">
				<div class="babybloom-logo">
					<?php if ( has_custom_logo() ) : ?>
						<div class="babybloom-logo__custom"><?php the_custom_logo(); ?></div>
					<?php else : ?>
						<span class="babybloom-logo__mark" aria-hidden="true"></span>
					<?php endif; ?>

					<div class="babybloom-logo__text">
						<a class="babybloom-logo__title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<span class="babybloom-logo__tagline"><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Soft essentials for tiny beginnings', 'babybloom' ) ); ?></span>
					</div>
				</div>

				<button class="babybloom-icon-button babybloom-mobile-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
					<span class="babybloom-screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'babybloom' ); ?></span>
					<?php echo babybloom_get_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>

				<nav id="primary-navigation" class="babybloom-header__menu" aria-label="<?php esc_attr_e( 'Primary menu', 'babybloom' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'fallback_cb'    => 'babybloom_menu_fallback',
						)
					);
					?>
				</nav>

				<div class="babybloom-header__actions">
					<a class="babybloom-icon-button babybloom-header__cart" href="<?php echo esc_url( babybloom_get_cart_url() ); ?>">
						<span class="babybloom-screen-reader-text"><?php esc_html_e( 'View cart', 'babybloom' ); ?></span>
						<?php echo babybloom_get_icon( 'cart' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php echo babybloom_get_cart_count_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>

					<a class="babybloom-outline-button babybloom-header__account" href="<?php echo esc_url( babybloom_get_account_url() ); ?>">
						<?php echo esc_html( is_user_logged_in() ? __( 'My Account', 'babybloom' ) : __( 'Sign In / Register', 'babybloom' ) ); ?>
					</a>
				</div>
			</div>
		</div>
	</header>

	<div id="content" class="site-content">
