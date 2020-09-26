<?php
/**
 * Integer Theme Customizer
 *
 * @package Integer
 */

/**
 * Add theme-specific Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function integer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Rounded Corners.
	$wp_customize->add_setting( 'rounded_logo', array(
		'default' => 1,
		'sanitize_callback' => 'integer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'rounded_logo', array(
		'type' => 'checkbox',
		'label' => __( 'Use rounded corners', 'integer' ),
		'section' => 'title_tagline',
		'priority' => 8,
	) );

	// Gravatar as Site logo.
	$wp_customize->add_setting( 'use_gravatar_as_logo', array(
		'default' => 0,
		'sanitize_callback' => 'integer_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'use_gravatar_as_logo', array(
		'type' => 'checkbox',
		'label' => __( 'Use Gravatar as Logo', 'integer' ),
		'section' => 'title_tagline',
		// Translators: placeholder shows the site admin email.
		'description' => sprintf( __( 'Use your gravatar associated with <strong>%s</strong> as a site logo image. This will override the logo set manually.', 'integer' ), esc_html( get_bloginfo( 'admin_email' ) ) ) . '<br />' . sprintf( '<a href="%s" target="_blank">%s</a>', esc_url( __( 'https://en.gravatar.com/support/what-is-gravatar/', 'integer' ) ), __( 'What is Gravatar?', 'integer' ) ),
		'priority' => 9,
	) );

}
add_action( 'customize_register', 'integer_customize_register' );

/**
 * Sanitizes checkbox.
 *
 * @param string|int $input Potentially harmful data.
 */
function integer_sanitize_checkbox( $input ) {
	return 1 == $input ? 1 : 0;
}

/**
 * Add lite version Customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function integer_lite_customize_register( $wp_customize ) {

	// Extra Features.
	$wp_customize->add_section( 'upgrade', array(
		'title' => __( 'Extra Features', 'integer' ),
		'priority' => 300,
		'description' => __( 'Like Integer? Then check out the Pro version! It has some extra features to help you level-up your blog.', 'integer' ),
	) );

	$wp_customize->add_control(
		new Integer_Customize_Control_Message(
			$wp_customize,
			'colors',
			array(
				'label' => __( '1. Custom Colors', 'integer' ),
				'section' => 'upgrade',
				'settings' => array(),
				'description' => __( 'Pro version allows you to set your own colors for text, headings, links, and background.', 'integer' ),
			)
		)
	);

	$wp_customize->add_control(
		new Integer_Customize_Control_Message(
			$wp_customize,
			'layout',
			array(
				'label' => __( '2. Two-column Layout', 'integer' ),
				'section' => 'upgrade',
				'settings' => array(),
				'description' => __( 'With the pro version, you can set the blog layout to display posts in a two-column grid.', 'integer' ),
			)
		)
	);

	$wp_customize->add_control(
		new Integer_Customize_Control_Message(
			$wp_customize,
			'message',
			array(
				'label' => __( '3. Custom Footer Message', 'integer' ),
				'section' => 'upgrade',
				'settings' => array(),
				'description' => __( 'With Integer Pro, you can set your own footer message.', 'integer' ),
				'link_url' => 'https://themepatio.com/themes/integer?utm_source=integer-lite&utm_medium=upgrade-section',
				'link_text' => __( 'Learn More', 'integer' ),
				'link_class' => 'button button-primary',
			)
		)
	);

}
add_action( 'customize_register', 'integer_lite_customize_register' );
