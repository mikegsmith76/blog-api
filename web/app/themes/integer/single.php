<?php
/**
 * The template for displaying all single posts.
 *
 * @package Integer
 */

get_header(); ?>

<div id="main" class="site-main">

	<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php integer_post_navigation(); ?>

			<?php if ( comments_open() || get_comments_number() ) : ?>

				<?php comments_template(); ?>

			<?php endif; ?>

	<?php endwhile; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer();
