<?php
/**
 * The template for displaying search results pages.
 *
 * @package Integer
 */

get_header(); ?>

<div id="main" class="site-main blogroll">

	<?php if ( have_posts() ) : ?>

		<header class="blogroll__header blogroll__header--column page-header">

			<h1 class="page-header__title">
				<?php
					printf(
						/* Translators: %s: search term. */
						esc_html__( 'Search Results for: %s', 'integer' ),
						'<span>' . get_search_query() . '</span>'
					);
				?>
			</h1>

			<?php get_search_form(); ?>

		</header>

		<div class="blogroll__wrap blogroll__wrap--column">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'search' ); ?>

			<?php endwhile; ?>

		</div>

		<?php integer_posts_pagination( 'blogroll__pagination' ); ?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

</div>

<?php get_footer();
