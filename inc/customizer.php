<?php
/**
 * Theme Customizer additions.
 *
 * @package BabyBloom
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function babybloom_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'babybloom_homepage',
		array(
			'title'       => __( 'BabyBloom Homepage', 'babybloom' ),
			'description' => __( 'Edit homepage copy, links, and hero imagery without changing template files.', 'babybloom' ),
			'priority'    => 30,
		)
	);

	$settings = array(
		'announcement_text'  => array(
			'label'   => __( 'Announcement Text', 'babybloom' ),
			'type'    => 'text',
			'default' => __( 'Free shipping on orders over $50 + gentle essentials delivered to your doorstep.', 'babybloom' ),
		),
		'hero_heading'       => array(
			'label'   => __( 'Hero Heading', 'babybloom' ),
			'type'    => 'text',
			'default' => __( 'Everything Your Baby Needs for a Happy Start', 'babybloom' ),
		),
		'hero_text'          => array(
			'label'   => __( 'Hero Supporting Text', 'babybloom' ),
			'type'    => 'textarea',
			'default' => __( 'Discover premium baby clothing, soft essentials, playful toys, and thoughtful accessories curated to make everyday parenting feel lighter, sweeter, and more organized.', 'babybloom' ),
		),
		'hero_button_text'   => array(
			'label'   => __( 'Hero Button Text', 'babybloom' ),
			'type'    => 'text',
			'default' => __( 'Shop Now', 'babybloom' ),
		),
		'hero_button_url'    => array(
			'label'   => __( 'Hero Button URL', 'babybloom' ),
			'type'    => 'url',
			'default' => '',
		),
		'hero_secondary_text' => array(
			'label'   => __( 'Secondary Button Text', 'babybloom' ),
			'type'    => 'text',
			'default' => __( 'Browse Gift Sets', 'babybloom' ),
		),
		'hero_secondary_url' => array(
			'label'   => __( 'Secondary Button URL', 'babybloom' ),
			'type'    => 'url',
			'default' => '',
		),
		'hero_image'         => array(
			'label'   => __( 'Hero Image', 'babybloom' ),
			'type'    => 'image',
			'default' => '',
		),
		'cta_heading'        => array(
			'label'   => __( 'CTA Heading', 'babybloom' ),
			'type'    => 'text',
			'default' => __( 'Create a softer, sweeter shopping experience for modern parents.', 'babybloom' ),
		),
		'cta_text'           => array(
			'label'   => __( 'CTA Text', 'babybloom' ),
			'type'    => 'textarea',
			'default' => __( 'Use this section to guide visitors to your best collections, seasonal drops, or baby shower gift bundles.', 'babybloom' ),
		),
		'cta_button_text'    => array(
			'label'   => __( 'CTA Button Text', 'babybloom' ),
			'type'    => 'text',
			'default' => __( 'Explore the Collection', 'babybloom' ),
		),
		'cta_button_url'     => array(
			'label'   => __( 'CTA Button URL', 'babybloom' ),
			'type'    => 'url',
			'default' => '',
		),
		'footer_email'       => array(
			'label'   => __( 'Footer Email', 'babybloom' ),
			'type'    => 'text',
			'default' => 'support@babybloomonline.com',
		),
		'footer_phone'       => array(
			'label'   => __( 'Footer Phone', 'babybloom' ),
			'type'    => 'text',
			'default' => '+94 11 745 7450',
		),
		'footer_address'     => array(
			'label'   => __( 'Footer Address', 'babybloom' ),
			'type'    => 'textarea',
			'default' => __( 'BabyBloom Online Support, Colombo, Sri Lanka', 'babybloom' ),
		),
	);

	foreach ( $settings as $id => $setting ) {
		$sanitize_callback = 'babybloom_sanitize_text_value';

		if ( 'textarea' === $setting['type'] ) {
			$sanitize_callback = 'babybloom_sanitize_textarea_value';
		} elseif ( 'url' === $setting['type'] || 'image' === $setting['type'] ) {
			$sanitize_callback = 'babybloom_sanitize_url_value';
		}

		$wp_customize->add_setting(
			'babybloom_' . $id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $sanitize_callback,
				'transport'         => 'refresh',
			)
		);

		if ( 'image' === $setting['type'] ) {
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'babybloom_' . $id,
					array(
						'label'   => $setting['label'],
						'section' => 'babybloom_homepage',
					)
				)
			);
			continue;
		}

		$wp_customize->add_control(
			'babybloom_' . $id,
			array(
				'label'   => $setting['label'],
				'section' => 'babybloom_homepage',
				'type'    => $setting['type'],
			)
		);
	}
}
add_action( 'customize_register', 'babybloom_customize_register' );

/**
 * Sanitize Customizer text inputs.
 *
 * @param string $value Raw value.
 * @return string
 */
function babybloom_sanitize_text_value( $value ) {
	return sanitize_text_field( (string) $value );
}

/**
 * Sanitize Customizer textarea inputs.
 *
 * @param string $value Raw value.
 * @return string
 */
function babybloom_sanitize_textarea_value( $value ) {
	return wp_kses_post( (string) $value );
}

/**
 * Sanitize Customizer URL inputs.
 *
 * @param string $value Raw value.
 * @return string
 */
function babybloom_sanitize_url_value( $value ) {
	return esc_url_raw( (string) $value );
}
