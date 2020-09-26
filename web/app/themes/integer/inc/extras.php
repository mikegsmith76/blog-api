<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Integer
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function integer_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add index class.
	if ( integer_is_blog() || is_archive() || is_search() ) {
		$classes[] = 'index';
	}

	// Add class if the site title and tagline is hidden.
	if ( 0 == get_theme_mod( 'header_text', 1 ) ) {
		$classes[] = 'title-tagline-hidden';
	}

	// Add sticky header class if it is enabled.
	if ( get_theme_mod( 'sticky_header', 1 ) ) {
		$classes[] = 'sticky-header';
	}

	return $classes;
}
add_filter( 'body_class', 'integer_body_classes' );

/**
 * Detects blog index page.
 */
function integer_is_blog() {
	if ( is_front_page() && is_home() ) {
		return true;
	} elseif ( is_front_page() ) {
		return false;
	} elseif ( is_home() ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Outputs the grid class.
 */
function integer_grid_class() {
	if ( 'grid' == get_theme_mod( 'blog_layout' ) ) {
		echo 'grid';
	} else {
		echo 'column';
	}
}

/**
 * Better excerpt.
 *
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param string $link Excerpt link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function integer_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'integer' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'integer_excerpt_more' );

/**
 * Filters the_category() to output HTML5 valid rel tag.
 *
 * @param string $text markup containing list of categories.
 */
function integer_category_rel( $text ) {
	$search  = array( 'rel="category"', 'rel="category tag"' );
	$replace = 'rel="tag"';
	$text    = str_replace( $search, $replace, $text );
	return $text;
}
add_filter( 'the_category', 'integer_category_rel' );

/**
 * Update maximum srcset image width.
 *
 * @param int $max_width Maximum allowed image width.
 */
function integer_remove_max_srcset_image_width( $max_width ) {
	return 2880;
}
add_filter( 'max_srcset_image_width', 'integer_remove_max_srcset_image_width' );


/**
 * Add image sizes registered with the theme to Media Library select.
 *
 * @param array $sizes Image sizes.
 */
function integer_add_image_sizes_to_media_library_select( $sizes ) {
	return array_merge( $sizes, array(
		'integer-blog-thumbnail' => _x( 'Integer Thumbnail', 'Do not translate "Integer". It\'s a theme name.', 'integer' ),
		'integer-blog-thumbnail-2x' => _x( 'Integer Thumbnail 2x', 'Do not translate "Integer". It\'s a theme name.', 'integer' ),
	) );
}
add_filter( 'image_size_names_choose', 'integer_add_image_sizes_to_media_library_select' );

/**
 * Add SVG sprite to the footer.
 */
function integer_include_svg_sprite() {
	// Define SVG sprite file.
	$svg_sprite = get_parent_theme_file_path( '/assets/images/svg-sprite.svg' );

	// If it exists, include it.
	if ( file_exists( $svg_sprite ) ) {
		require_once( $svg_sprite );
	}
}
add_action( 'wp_footer', 'integer_include_svg_sprite', 9999 );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function integer_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'integer' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'integer' );
	}

	// Set defaults.
	$defaults = array(
		'icon' => '',
		'title' => '',
		'desc' => '',
		'class' => '',
		'fallback' => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	/*
	 * Integer doesn't use the SVG title or description attributes;
	 * non-decorative icons are described with .screen-reader-text. However,
	 * child themes can use the title and description to add information to
	 * non-decorative SVG icons to improve accessibility.
	 *
	 * Example 1 with title: <?php echo integer_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
	 *
	 * Example 2 with title and description: <?php echo integer_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
	 *
	 * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
	 */
	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}

	// Begin SVG markup.
	$svg = '<svg class="' . esc_attr( $args['class'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

		// Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
	 *
	 * See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Adds class to all menu items.
 *
 * @param  array   $classes Current menu item classes.
 * @param  WP_Post $item    The current menu item.
 * @param  object  $args    Menu item args.
 * @return array            Menu item classes with a new class.
 */
function integer_menu_item_classes( $classes, $item, $args ) {
	if ( 'primary' === $args->theme_location ) {
		$classes[] = 'primary-menu__list-item';
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'integer_menu_item_classes', 10, 3 );


/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string  $title The menu item's title.
 * @param  WP_Post $item  The current menu item.
 * @param  array   $args  An array of wp_nav_menu() arguments.
 * @param  int     $depth Depth of menu item. Used for padding.
 * @return string  $title The menu item's title with dropdown icon.
 */
function integer_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . integer_get_svg( array(
					'icon' => 'arrow-down',
					'class' => 'primary-menu__arrow-down',
				) );
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'integer_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function integer_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$icons = integer_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'footer' === $args->theme_location ) {
		foreach ( $icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_before, integer_get_svg( array( 'icon' => esc_attr( $value ) ) ) . '<span>', $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'integer_nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $icons
 */
function integer_social_links_icons() {
	// Supported social links icons.
	$icons = array(
		'500px.com' => '500px',
		'amazon.com' => 'amazon',
		'behance.net' => 'behance',
		'bitbucket.org' => 'bitbucket',
		'codepen.io' => 'codepen',
		'deviantart.com' => 'deviantart',
		'digg.com' => 'digg',
		'discordapp.com' => 'discord',
		'dribbble.com' => 'dribbble',
		'etsy.com' => 'etsy',
		'facebook.com' => 'facebook',
		'flickr.com' => 'flickr',
		'foursquare.com' => 'foursquare',
		'github.com' => 'github',
		'gitlab.com' => 'gitlab',
		'goodreads.com' => 'goodreads',
		'instagram.com' => 'instagram',
		'kickstarter.com' => 'kickstarter',
		'last.fm' => 'lastfm',
		'linkedin.com' => 'linkedin',
		'medium.com' => 'medium',
		'meetup.com' => 'meetup',
		'ok.ru' => 'odnoklassniki',
		'pinterest.com' => 'pinterest',
		'producthunt.com' => 'producthunt',
		'quora.com' => 'quora',
		'reddit.com' => 'reddit',
		'skype.com' => 'skype',
		'slack.com' => 'slack',
		'snapchat.com' => 'snapchat',
		'soundcloud.com' => 'soundcloud',
		'stackexchange.com' => 'stackexchange',
		'stackoverflow.com' => 'stackoverflow',
		'strava.com' => 'strava',
		'telegram.org' => 'telegram',
		'telegram.me' => 'telegram',
		'tumblr.com' => 'tumblr',
		'twitch.tv' => 'twitch',
		'twitter.com' => 'twitter',
		'vimeo.com' => 'vimeo',
		'vk.com' => 'vk',
		'wordpress.com' => 'wordpress',
		'wordpress.org' => 'wordpress',
		'yelp.com' => 'yelp',
		'youtube.com' => 'youtube',
	);

	/**
	 * Filter Twenty Seventeen social links icons.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param array $icons Array of social links icons.
	 */
	return apply_filters( 'integer_social_links_icons', $icons );
}

