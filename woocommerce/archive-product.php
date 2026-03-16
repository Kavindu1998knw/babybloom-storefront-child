<?php
/**
 * Product archives, including the main shop page.
 *
 * @package BabyBloom
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );
?>
<section class="babybloom-shop-archive" aria-label="<?php esc_attr_e( 'Product catalog', 'babybloom' ); ?>">
	<div class="babybloom-container babybloom-shop-archive__inner">
		<?php do_action( 'woocommerce_shop_loop_header' ); ?>
		<?php if ( function_exists( 'woocommerce_output_all_notices' ) ) : ?>
			<?php woocommerce_output_all_notices(); ?>
		<?php endif; ?>

		<?php if ( woocommerce_product_loop() ) : ?>
			<div class="babybloom-shop-archive__toolbar" aria-label="<?php esc_attr_e( 'Catalog controls', 'babybloom' ); ?>">
				<div class="babybloom-shop-archive__result">
					<?php woocommerce_result_count(); ?>
				</div>
				<div class="babybloom-shop-archive__ordering">
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>

			<?php woocommerce_product_loop_start(); ?>
				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php do_action( 'woocommerce_shop_loop' ); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			<?php woocommerce_product_loop_end(); ?>

			<div class="babybloom-shop-archive__pagination">
				<?php woocommerce_pagination(); ?>
			</div>
		<?php else : ?>
			<?php do_action( 'woocommerce_no_products_found' ); ?>
		<?php endif; ?>
	</div>
</section>
<?php

do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
