<?php
/**
 * Announcement section.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="babybloom-section babybloom-announcement" aria-label="<?php esc_attr_e( 'Announcement', 'babybloom' ); ?>">
	<div class="babybloom-container">
		<div class="babybloom-announcement__inner">
			<span class="babybloom-announcement__badge"><?php esc_html_e( 'New', 'babybloom' ); ?></span>
			<p><?php echo wp_kses_post( babybloom_get_setting( 'announcement_text', __( 'Free shipping on orders over $50 + gentle essentials delivered to your doorstep.', 'babybloom' ) ) ); ?></p>
		</div>
	</div>
</section>
