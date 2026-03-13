<?php
/**
 * Feature cards section.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$features = array(
	array(
		'icon'  => 'shipping',
		'title' => __( 'Free Shipping', 'babybloom' ),
		'text'  => __( 'Delight parents with smooth delivery thresholds and clear shipping reassurance.', 'babybloom' ),
	),
	array(
		'icon'  => 'offer',
		'title' => __( 'Special Offers', 'babybloom' ),
		'text'  => __( 'Highlight bundle deals, seasonal drops, and discount moments in a premium way.', 'babybloom' ),
	),
	array(
		'icon'  => 'gift',
		'title' => __( 'Gift Sets', 'babybloom' ),
		'text'  => __( 'Showcase baby shower bundles and ready-to-wrap essentials for gifting.', 'babybloom' ),
	),
	array(
		'icon'  => 'support',
		'title' => __( '24/7 Support', 'babybloom' ),
		'text'  => __( 'A calm support promise builds trust quickly for first-time shoppers and parents.', 'babybloom' ),
	),
);
?>

<section class="babybloom-section">
	<div class="babybloom-container">
		<div class="babybloom-grid babybloom-grid--four">
			<?php foreach ( $features as $feature ) : ?>
				<article class="babybloom-card">
					<div class="babybloom-card__icon">
						<?php echo babybloom_get_icon( $feature['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<h3><?php echo esc_html( $feature['title'] ); ?></h3>
					<p><?php echo esc_html( $feature['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
