<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Integer
 */

if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area widget-area-secondary" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

		<div class="widget-area-secondary__wrap">

			<?php dynamic_sidebar( 'sidebar-1' ); ?>

		</div>

	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>

		<div class="widget-area-secondary__wrap">

			<?php dynamic_sidebar( 'sidebar-2' ); ?>

		</div>

	<?php endif; ?>

</div><!-- #secondary -->
