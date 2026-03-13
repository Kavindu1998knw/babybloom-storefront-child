<?php
/**
 * Front page template.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main babybloom-front-page">
	<?php get_template_part( 'template-parts/home/announcement' ); ?>
	<?php get_template_part( 'template-parts/home/hero' ); ?>
	<?php get_template_part( 'template-parts/home/features' ); ?>
	<?php get_template_part( 'template-parts/home/categories' ); ?>
	<?php get_template_part( 'template-parts/home/trust' ); ?>
	<?php get_template_part( 'template-parts/home/cta' ); ?>
</main>

<?php
get_footer();
