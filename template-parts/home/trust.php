<?php
/**
 * Trust section.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trust_items = array(
	array(
		'icon'  => 'safe',
		'title' => __( 'Safe & Baby-Friendly', 'babybloom' ),
		'text'  => __( 'Design each message around comfort, ingredient quality, and thoughtful sourcing.', 'babybloom' ),
	),
	array(
		'icon'  => 'comfort',
		'title' => __( 'Soft & Comfortable', 'babybloom' ),
		'text'  => __( 'The soft palette and plush card styling reinforce a cozy, nurturing brand presence.', 'babybloom' ),
	),
	array(
		'icon'  => 'parents',
		'title' => __( 'Designed for Parents', 'babybloom' ),
		'text'  => __( 'Clear product groupings and trust cues help tired parents shop with less friction.', 'babybloom' ),
	),
	array(
		'icon'  => 'world',
		'title' => __( 'Loved Worldwide', 'babybloom' ),
		'text'  => __( 'This section works well for reviews, shipping coverage, or social proof later.', 'babybloom' ),
	),
);
?>

<section class="babybloom-section">
	<div class="babybloom-container">
		<div class="babybloom-section-header">
			<div>
				<span class="babybloom-eyebrow"><?php esc_html_e( 'Trust builders', 'babybloom' ); ?></span>
				<h2><?php esc_html_e( 'Why Parents Love BabyBloom', 'babybloom' ); ?></h2>
				<p><?php esc_html_e( 'Use these four trust cards as editable proof points, feature promises, or review highlights.', 'babybloom' ); ?></p>
			</div>
		</div>

		<div class="babybloom-trust-grid">
			<?php foreach ( $trust_items as $item ) : ?>
				<article class="babybloom-card babybloom-trust-card">
					<div class="babybloom-card__icon">
						<?php echo babybloom_get_icon( $item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<div>
						<h3><?php echo esc_html( $item['title'] ); ?></h3>
						<p><?php echo esc_html( $item['text'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
