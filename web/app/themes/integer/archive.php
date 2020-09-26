<?php
/**
 * The template for displaying archive pages.
 *
 * @package Integer
 */

get_header(); ?>

<div id="main" class="site-main blogroll">

	<?php if ( have_posts() ) : ?>

		<header class="blogroll__header blogroll__header--<?php integer_grid_class(); ?> page-header">

			<?php the_archive_title( '<h1 class="page-header__title">', '</h1>' ); ?>

			<?php the_archive_description( '<div class="page-header__description">', '</div>' ); ?>

		</header>

		<div class="blogroll__wrap blogroll__wrap--<?php integer_grid_class(); ?>">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content' ); ?>

			<?php endwhile; ?>

		</div>

		<?php integer_posts_pagination( 'blogroll__pagination' ); ?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer();
