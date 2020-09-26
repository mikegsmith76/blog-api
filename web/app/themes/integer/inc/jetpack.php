<?php
/**
 * Jetpack Compatibility File.
 *
 * @package Integer
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function integer_jetpack_setup() {
	add_theme_support(
		 'infinite-scroll', array(
			 'container'      => 'primary',
			 'render'         => 'integer_infinite_scroll_render',
			 'type'           => 'scroll',
			 'wrapper'        => false,
			 'footer_widgets' => false,
			 'footer'         => false,
		 )
		);

	add_filter( 'infinite_scroll_js_settings', 'integer_load_more_text' );
}
add_action( 'after_setup_theme', 'integer_jetpack_setup' );

/**
 * Loads necessary template part during infinite scroll.
 */
function integer_infinite_scroll_render() {
	while ( have_posts() ) : the_post();
		if ( is_search() ) {
			get_template_part( 'template-parts/content-search' );
		} else {
			get_template_part( 'template-parts/content' );
		}
	endwhile;
}

/**
 * Change Older Posts to Load More.
 *
 * @param array $settings array of Infinite Scroll settings.
 */
function integer_load_more_text( $settings ) {
	$settings['text'] = __( 'Load More', 'integer' );

	return $settings;
}
