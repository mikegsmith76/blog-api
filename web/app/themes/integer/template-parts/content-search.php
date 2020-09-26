<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package Integer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blogroll-item' ); ?>>

	<header class="blogroll-item__header">

		<?php the_title( sprintf( '<h2 class="blogroll-item__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header>

	<div class="blogroll-item__content">

		<?php the_excerpt(); ?>

	</div>

</article>
