<?php
/**
 * Category cards and best sellers section.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories = babybloom_get_home_categories();
?>

<section class="babybloom-section">
	<div class="babybloom-container">
		<div class="babybloom-section-header">
			<div>
				<span class="babybloom-eyebrow"><?php esc_html_e( 'Shop by category', 'babybloom' ); ?></span>
				<h2><?php esc_html_e( 'Best Sellers & Popular Categories', 'babybloom' ); ?></h2>
				<p><?php esc_html_e( 'Use real WooCommerce category images when available and keep the rest editable from the dashboard.', 'babybloom' ); ?></p>
			</div>
			<a class="babybloom-outline-button" href="<?php echo esc_url( babybloom_get_shop_url() ); ?>">
				<?php esc_html_e( 'Visit Shop', 'babybloom' ); ?>
			</a>
		</div>

		<div class="babybloom-category-grid">
			<?php foreach ( $categories as $category ) : ?>
				<article class="babybloom-category-card<?php echo ! empty( $category['is_placeholder'] ) ? ' babybloom-category-card--placeholder' : ''; ?>">
					<a class="babybloom-category-card__image" href="<?php echo esc_url( $category['url'] ); ?>">
						<img src="<?php echo esc_url( $category['image_url'] ); ?>" alt="<?php echo esc_attr( $category['name'] ); ?>">
						<?php if ( ! empty( $category['is_placeholder'] ) ) : ?>
							<span class="babybloom-category-card__placeholder-note"><?php esc_html_e( 'Add category image', 'babybloom' ); ?></span>
						<?php endif; ?>
					</a>
					<div class="babybloom-category-card__meta">
						<span class="babybloom-category-card__tag"><?php echo esc_html( $category['label'] ); ?></span>
						<?php if ( ! empty( $category['term_count'] ) ) : ?>
							<span><?php echo esc_html( $category['term_count'] ); ?></span>
						<?php endif; ?>
					</div>
					<div>
						<h3><a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a></h3>
						<p><?php echo esc_html( $category['blurb'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="babybloom-products-shell">
			<div class="babybloom-section-header">
				<div>
					<span class="babybloom-eyebrow"><?php esc_html_e( 'Top picks', 'babybloom' ); ?></span>
					<h2><?php esc_html_e( 'Parents Are Loving These Favorites', 'babybloom' ); ?></h2>
				</div>
			</div>

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<?php echo do_shortcode( '[products limit="4" columns="4" orderby="popularity"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<p><?php esc_html_e( 'Install and activate WooCommerce to show live best-selling products here.', 'babybloom' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
