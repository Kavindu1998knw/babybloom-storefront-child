<?php
/**
 * BabyBloom child theme functions.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BABYBLOOM_VERSION', '1.0.0' );
define( 'BABYBLOOM_DIR', get_stylesheet_directory() );
define( 'BABYBLOOM_URI', get_stylesheet_directory_uri() );

require_once BABYBLOOM_DIR . '/inc/customizer.php';

/**
 * Theme setup.
 */
function babybloom_theme_setup() {
	load_child_theme_textdomain( 'babybloom', BABYBLOOM_DIR . '/languages' );

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support(
		'custom-logo',
		array(
			'height'     => 100,
			'width'      => 260,
			'flex-width' => true,
		)
	);
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'babybloom' ),
			'footer'  => __( 'Footer Menu', 'babybloom' ),
		)
	);
}
add_action( 'after_setup_theme', 'babybloom_theme_setup' );

/**
 * Enqueue theme assets.
 */
function babybloom_enqueue_assets() {
	$parent_handle = 'storefront-style';
	$style_version = file_exists( BABYBLOOM_DIR . '/style.css' ) ? filemtime( BABYBLOOM_DIR . '/style.css' ) : BABYBLOOM_VERSION;
	$script_version = file_exists( BABYBLOOM_DIR . '/assets/js/theme.js' ) ? filemtime( BABYBLOOM_DIR . '/assets/js/theme.js' ) : BABYBLOOM_VERSION;

	wp_enqueue_style(
		$parent_handle,
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);
	wp_enqueue_style(
		'babybloom-fonts',
		'https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'babybloom-style',
		get_stylesheet_uri(),
		array( $parent_handle, 'babybloom-fonts' ),
		$style_version
	);
	wp_enqueue_script(
		'babybloom-theme',
		BABYBLOOM_URI . '/assets/js/theme.js',
		array(),
		$script_version,
		true
	);
	wp_localize_script(
		'babybloom-theme',
		'babybloomTheme',
		array(
			'menuOpen'  => __( 'Open menu', 'babybloom' ),
			'menuClose' => __( 'Close menu', 'babybloom' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'babybloom_enqueue_assets' );

/**
 * Remove Storefront chrome that clashes with the custom layout.
 */
function babybloom_cleanup_storefront() {
	remove_action( 'storefront_header', 'storefront_header_container', 0 );
	remove_action( 'storefront_header', 'storefront_skip_links', 5 );
	remove_action( 'storefront_header', 'storefront_site_branding', 20 );
	remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
	remove_action( 'storefront_header', 'storefront_product_search', 40 );
	remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
	remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
	remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
	remove_action( 'storefront_header', 'storefront_header_cart', 60 );
	remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );
	remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
	remove_action( 'storefront_footer', 'storefront_credit', 20 );
}
add_action( 'init', 'babybloom_cleanup_storefront' );

/**
 * Add menu fallbacks.
 */
function babybloom_menu_fallback() {
	echo '<ul class="menu">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
		)
	);
	echo '</ul>';
}

/**
 * Return the preferred shop URL.
 *
 * @return string
 */
function babybloom_get_shop_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		return wc_get_page_permalink( 'shop' );
	}

	return home_url( '/shop/' );
}

/**
 * Return the account URL.
 *
 * @return string
 */
function babybloom_get_account_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		return wc_get_page_permalink( 'myaccount' );
	}

	return wp_login_url();
}

/**
 * Return the cart URL.
 *
 * @return string
 */
function babybloom_get_cart_url() {
	if ( function_exists( 'wc_get_cart_url' ) ) {
		return wc_get_cart_url();
	}

	return home_url( '/cart/' );
}

/**
 * Return a page URL by path with fallback.
 *
 * @param string $path     Page path.
 * @param string $fallback Fallback URL.
 * @return string
 */
function babybloom_get_page_url_by_path( $path, $fallback = '' ) {
	$page = get_page_by_path( $path );

	if ( $page instanceof WP_Post ) {
		$url = get_permalink( $page );
		if ( $url ) {
			return $url;
		}
	}

	return $fallback ? $fallback : home_url( '/' . trim( $path, '/' ) . '/' );
}

/**
 * Return the theme's WooCommerce placeholder image URL.
 *
 * @return string
 */
function babybloom_get_product_placeholder_url() {
	return BABYBLOOM_URI . '/assets/images/category-placeholder.svg';
}

/**
 * Return header cart count markup.
 *
 * @return string
 */
function babybloom_get_cart_count_markup() {
	$count = 0;

	if ( function_exists( 'WC' ) && WC()->cart ) {
		$count = (int) WC()->cart->get_cart_contents_count();
	}

	return '<span class="babybloom-cart-count">' . esc_html( $count ) . '</span>';
}

/**
 * Get theme mod with default value.
 *
 * @param string $key     Theme mod key without prefix.
 * @param mixed  $default Default value.
 * @return mixed
 */
function babybloom_get_setting( $key, $default = '' ) {
	return get_theme_mod( 'babybloom_' . $key, $default );
}

/**
 * Render icon markup.
 *
 * @param string $name Icon slug.
 * @return string
 */
function babybloom_get_icon( $name ) {
	$icons = array(
		'shipping' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 7.5a2.5 2.5 0 0 1 2.5-2.5h7A2.5 2.5 0 0 1 15 7.5V9h2.59a2 2 0 0 1 1.62.82l1.39 1.88c.26.35.4.78.4 1.22V16a1 1 0 0 1-1 1h-.76a2.75 2.75 0 0 1-5.48 0H10.2a2.75 2.75 0 0 1-5.48 0H4a1 1 0 0 1-1-1V7.5Zm12 2.5v2h4.13l-1.02-1.38a.5.5 0 0 0-.4-.2H15Z" fill="currentColor"/></svg>',
		'offer'    => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6.38 4.5a1.88 1.88 0 0 0-1.88 1.88v3.17c0 .5-.2.98-.55 1.33L2.6 12.23a.75.75 0 0 0 0 1.06l1.35 1.35c.35.35.55.83.55 1.33v3.17c0 1.04.84 1.88 1.88 1.88h3.17c.5 0 .98.2 1.33.55l1.35 1.35a.75.75 0 0 0 1.06 0l1.35-1.35c.35-.35.83-.55 1.33-.55h3.17c1.04 0 1.88-.84 1.88-1.88v-3.17c0-.5.2-.98.55-1.33l1.35-1.35a.75.75 0 0 0 0-1.06l-1.35-1.35a1.88 1.88 0 0 1-.55-1.33V6.38A1.88 1.88 0 0 0 19.62 4.5h-3.17c-.5 0-.98-.2-1.33-.55L13.77 2.6a.75.75 0 0 0-1.06 0l-1.35 1.35c-.35.35-.83.55-1.33.55H6.38Zm3.12 9.75a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm5-2.5a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm-5.53 4.03 6.06-7.56 1 .8-6.06 7.56-1-.8Z" fill="currentColor"/></svg>',
		'gift'     => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4.5 8.5h15a1.5 1.5 0 0 1 1.5 1.5v2h-18v-2A1.5 1.5 0 0 1 4.5 8.5Zm0 5h7v7h-5A2.5 2.5 0 0 1 4 18v-4.5h.5Zm8.5 0h7V18a2.5 2.5 0 0 1-2.5 2.5h-4.5v-7Zm-3.75-7A2.75 2.75 0 0 1 6.5 3.75C6.5 2.78 7.28 2 8.25 2c1.21 0 2.2.72 3.2 2.31.22.35.4.69.55 1.01.15-.32.33-.66.55-1.01C13.55 2.72 14.54 2 15.75 2c.97 0 1.75.78 1.75 1.75A2.75 2.75 0 0 1 14.75 6.5H12.5v2h-1v-2H9.25Z" fill="currentColor"/></svg>',
		'support'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3.5A8.5 8.5 0 0 0 3.5 12v4A2.5 2.5 0 0 0 6 18.5h1a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H5.03A7 7 0 0 1 19 12.5H17a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h1a2.5 2.5 0 0 0 2.5-2.5v-4A8.5 8.5 0 0 0 12 3.5Zm5.37 16.5a3.25 3.25 0 0 1-2.87 1.75H12.5a.75.75 0 0 1 0-1.5h2a1.75 1.75 0 0 0 1.55-.93l1.32.68Z" fill="currentColor"/></svg>',
		'safe'     => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 2.5 4.5 5.3v5.1c0 5.06 3.22 9.79 7.5 11.1 4.28-1.31 7.5-6.04 7.5-11.1V5.3L12 2.5Zm3.45 7.3-4.13 4.74a1 1 0 0 1-1.46.07l-1.93-1.93 1.06-1.06 1.17 1.17 3.37-3.86 1.92.87Z" fill="currentColor"/></svg>',
		'comfort'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21.5c-.63 0-1.1-.36-1.5-.75C6.22 16.8 3.5 14.35 3.5 10.75A4.75 4.75 0 0 1 8.25 6c1.52 0 2.9.71 3.75 1.83A4.86 4.86 0 0 1 15.75 6a4.75 4.75 0 0 1 4.75 4.75c0 3.6-2.72 6.05-7 10-.4.39-.87.75-1.5.75Z" fill="currentColor"/></svg>',
		'parents'  => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M7.25 11A3.25 3.25 0 1 0 7.25 4.5 3.25 3.25 0 0 0 7.25 11Zm9.5 0A3.25 3.25 0 1 0 16.75 4.5 3.25 3.25 0 0 0 16.75 11ZM2.5 19.75c0-2.62 2.13-4.75 4.75-4.75h1.5c2.62 0 4.75 2.13 4.75 4.75v.75h-11v-.75Zm12 0c0-1.01-.26-1.97-.72-2.8a4.73 4.73 0 0 1 3-.95h1.47c2.62 0 4.75 2.13 4.75 4.75v.75h-8.5v-.75Z" fill="currentColor"/></svg>',
		'world'    => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18Zm5.87 5h-2.43a14.23 14.23 0 0 0-1.16-2.75A7.53 7.53 0 0 1 17.87 8ZM12 4.53c.65.87 1.52 2.15 2.1 3.47H9.9A13.23 13.23 0 0 1 12 4.53ZM8.72 5.25A14.23 14.23 0 0 0 7.56 8H5.13a7.53 7.53 0 0 1 3.59-2.75ZM4.53 12c0-.52.05-1.02.15-1.5h2.53c-.1.5-.16 1-.17 1.5 0 .5.06 1 .17 1.5H4.68a7.53 7.53 0 0 1-.15-1.5Zm.6 3h2.43c.28.96.67 1.88 1.16 2.75A7.53 7.53 0 0 1 5.13 15Zm6.87 4.47A13.23 13.23 0 0 1 9.9 16h4.2A13.23 13.23 0 0 1 12 19.47Zm3.28-1.72c.49-.87.88-1.79 1.16-2.75h2.43a7.53 7.53 0 0 1-3.59 2.75Zm1.51-4.25c.11-.5.16-1 .17-1.5a7.8 7.8 0 0 0-.17-1.5h2.53c.1.48.15.98.15 1.5s-.05 1.02-.15 1.5h-2.53Z" fill="currentColor"/></svg>',
		'search'   => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M10.5 4a6.5 6.5 0 1 0 4.08 11.56l4.43 4.44 1.06-1.06-4.44-4.43A6.5 6.5 0 0 0 10.5 4Zm0 1.5a5 5 0 1 1 0 10 5 5 0 0 1 0-10Z" fill="currentColor"/></svg>',
		'cart'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 4.75h1.72c.46 0 .85.32.96.77l.39 1.73H20a.75.75 0 0 1 .73.92l-1.33 6a1.75 1.75 0 0 1-1.71 1.38H9a1.75 1.75 0 0 1-1.7-1.34L5.15 6.25H3v-1.5Zm6.2 12.75a1.8 1.8 0 1 0 0 3.6 1.8 1.8 0 0 0 0-3.6Zm7.6 0a1.8 1.8 0 1 0 0 3.6 1.8 1.8 0 0 0 0-3.6Z" fill="currentColor"/></svg>',
		'menu'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7.25h16v1.5H4v-1.5Zm0 8h16v1.5H4v-1.5Zm0-4h16v1.5H4v-1.5Z" fill="currentColor"/></svg>',
		'arrow'    => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m12.9 6.4 5.6 5.6-5.6 5.6-1.06-1.06 3.8-3.79H5.5v-1.5h10.08l-3.74-3.75 1.06-1.06Z" fill="currentColor"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Return category data for the homepage cards.
 *
 * @return array<int, array<string, mixed>>
 */
function babybloom_get_home_categories() {
	$targets = array(
		array(
			'slug'  => 'baby-clothing',
			'name'  => __( 'Baby Clothing', 'babybloom' ),
			'blurb' => __( 'Gentle fabrics and everyday essentials for every stage.', 'babybloom' ),
			'label' => __( 'Soft picks', 'babybloom' ),
		),
		array(
			'slug'  => 'toys-games',
			'name'  => __( 'Toys & Games', 'babybloom' ),
			'blurb' => __( 'Playful finds that support happy, curious little minds.', 'babybloom' ),
			'label' => __( 'Play time', 'babybloom' ),
		),
		array(
			'slug'  => 'accessories',
			'name'  => __( 'Accessories', 'babybloom' ),
			'blurb' => __( 'Feeding, stroller, and nursery add-ons parents rely on daily.', 'babybloom' ),
			'label' => __( 'Daily must-haves', 'babybloom' ),
		),
	);

	$cards = array();

	foreach ( $targets as $target ) {
		$card = $target;
		$card['url']        = babybloom_get_shop_url();
		$card['image_url']  = BABYBLOOM_URI . '/assets/images/category-placeholder.svg';
		$card['is_placeholder'] = true;
		$card['term_count'] = '';

		if ( taxonomy_exists( 'product_cat' ) ) {
			$term = get_term_by( 'slug', $target['slug'], 'product_cat' );

			if ( $term && ! is_wp_error( $term ) ) {
				$card['name']  = $term->name;
				$card['blurb'] = $term->description
					? wp_trim_words( wp_strip_all_tags( $term->description ), 18 )
					: $target['blurb'];
				$term_link = get_term_link( $term );
				if ( ! is_wp_error( $term_link ) ) {
					$card['url'] = $term_link;
				}
				$card['term_count'] = sprintf(
					_n( '%d product', '%d products', (int) $term->count, 'babybloom' ),
					(int) $term->count
				);

				$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
				if ( $thumbnail_id ) {
					$image = wp_get_attachment_image_url( $thumbnail_id, 'woocommerce_thumbnail' );
					if ( $image ) {
						$card['image_url'] = $image;
						$card['is_placeholder'] = false;
					}
				}
			}
		}

		$cards[] = $card;
	}

	return $cards;
}

/**
 * Add body classes.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function babybloom_body_classes( $classes ) {
	$classes[] = 'babybloom-theme';

	if ( is_front_page() ) {
		$classes[] = 'babybloom-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'babybloom_body_classes' );

/**
 * Adjust products per row to match the design.
 *
 * @return int
 */
function babybloom_loop_columns() {
	return 4;
}
add_filter( 'loop_shop_columns', 'babybloom_loop_columns' );

/**
 * Add helper classes to WooCommerce products for placeholder styling.
 *
 * @param array        $classes Existing classes.
 * @param string|array $class   Additional classes.
 * @param int          $post_id Post ID.
 * @return array
 */
function babybloom_product_post_classes( $classes, $class, $post_id ) {
	if ( 'product' !== get_post_type( $post_id ) ) {
		return $classes;
	}

	if ( ! has_post_thumbnail( $post_id ) ) {
		$classes[] = 'babybloom-product--placeholder';
	}

	return $classes;
}
add_filter( 'post_class', 'babybloom_product_post_classes', 10, 3 );

/**
 * Use the theme placeholder for products without images.
 *
 * @return string
 */
function babybloom_product_placeholder() {
	return babybloom_get_product_placeholder_url();
}
add_filter( 'woocommerce_placeholder_img_src', 'babybloom_product_placeholder' );

/**
 * Refresh the header cart count when WooCommerce updates cart fragments.
 *
 * @param array $fragments Existing fragments.
 * @return array
 */
function babybloom_cart_fragments( $fragments ) {
	$fragments['.babybloom-cart-count'] = babybloom_get_cart_count_markup();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'babybloom_cart_fragments' );

/**
 * Render a branded intro for the WooCommerce login/register screen.
 */
function babybloom_account_auth_intro_open() {
	if ( is_user_logged_in() || ! function_exists( 'is_account_page' ) || ! is_account_page() ) {
		return;
	}
	?>
	<section class="babybloom-auth-shell" aria-label="<?php esc_attr_e( 'Account access', 'babybloom' ); ?>">
		<div class="babybloom-auth-intro">
			<span class="babybloom-eyebrow"><?php esc_html_e( 'Welcome to BabyBloom', 'babybloom' ); ?></span>
			<h2><?php esc_html_e( 'Sign in for a softer, faster shopping experience', 'babybloom' ); ?></h2>
			<p><?php esc_html_e( 'Manage orders, save your details for quicker checkout, and keep your family favorites in one calm, easy-to-reach place.', 'babybloom' ); ?></p>

			<div class="babybloom-auth-benefits">
				<div class="babybloom-auth-benefit">
					<span class="babybloom-auth-benefit__icon" aria-hidden="true"><?php echo babybloom_get_icon( 'shipping' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<strong><?php esc_html_e( 'Track every order', 'babybloom' ); ?></strong>
						<span><?php esc_html_e( 'Check delivery progress and recent purchases at a glance.', 'babybloom' ); ?></span>
					</div>
				</div>
				<div class="babybloom-auth-benefit">
					<span class="babybloom-auth-benefit__icon" aria-hidden="true"><?php echo babybloom_get_icon( 'gift' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<strong><?php esc_html_e( 'Save favorites', 'babybloom' ); ?></strong>
						<span><?php esc_html_e( 'Keep your go-to baby essentials ready for gifting or reordering.', 'babybloom' ); ?></span>
					</div>
				</div>
				<div class="babybloom-auth-benefit">
					<span class="babybloom-auth-benefit__icon" aria-hidden="true"><?php echo babybloom_get_icon( 'safe' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<strong><?php esc_html_e( 'Secure account access', 'babybloom' ); ?></strong>
						<span><?php esc_html_e( 'Manage addresses, billing details, and account preferences securely.', 'babybloom' ); ?></span>
					</div>
				</div>
			</div>

			<a class="babybloom-outline-button" href="<?php echo esc_url( babybloom_get_shop_url() ); ?>">
				<?php esc_html_e( 'Browse the Shop', 'babybloom' ); ?>
				<?php echo babybloom_get_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>

		<div class="babybloom-auth-panel">
	<?php
}
add_action( 'woocommerce_before_customer_login_form', 'babybloom_account_auth_intro_open', 5 );

/**
 * Close the branded wrapper for the WooCommerce login/register screen.
 */
function babybloom_account_auth_intro_close() {
	if ( is_user_logged_in() || ! function_exists( 'is_account_page' ) || ! is_account_page() ) {
		return;
	}
	?>
		</div>
	</section>
	<?php
}
add_action( 'woocommerce_after_customer_login_form', 'babybloom_account_auth_intro_close', 50 );
