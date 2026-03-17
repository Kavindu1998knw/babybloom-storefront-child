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

ob_start();
do_action( 'woocommerce_shop_loop_header' );
$header_html = ob_get_clean();

echo babybloom_get_product_catalog_markup(
	null,
	array(
		'header_html' => $header_html,
	)
); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
