<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package Integer
 */

?>

<div class="not-found">

	<header class="not-found__header page-header">

		<h1 class="page-header__title"><?php esc_html_e( 'Nothing Found', 'integer' ); ?></h1>

	</header>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p class="not-found__content"><?php integer_first_post_link(); ?></p>

	<?php elseif ( is_search() ) : ?>

		<p class="not-found__content"><?php esc_html_e( 'Nothing matched your search terms. Try again with different keywords.', 'integer' ); ?></p>

		<div class="not-found__search">
			<?php get_search_form(); ?>
		</div>

	<?php elseif ( is_404() ) : ?>

		<p class="not-found__content"><?php esc_html_e( 'Looks like the page you are looking for has been moved or does not exist. Click on the site logo to go to the homepage or try searching.', 'integer' ); ?></p>

		<div class="not-found__search">
			<?php get_search_form(); ?>
		</div>

	<?php else : ?>

		<p class="not-found__content"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'integer' ); ?></p>

		<div class="not-found__search">
			<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

</div>
