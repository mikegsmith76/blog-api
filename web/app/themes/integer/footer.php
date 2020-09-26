<?php
/**
 * The template for displaying the footer.
 *
 * @package Integer
 */

?>
	<footer id="colophon" class="site-footer" role="contentinfo">

			<?php if ( has_nav_menu( 'footer' ) ) : ?>

				<nav class="site-footer__menu footer-menu" role="navigation">

					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'depth' => 1,
								'fallback_cb' => false,
								'menu_class' => 'footer-menu__list',
								'container' => false,
								'link_before' => integer_get_svg( array( 'icon' => 'chain' ) ) . '<span>',
								'link_after' => '</span>',
							)
						);
					?>

				</nav>

			<?php endif; ?>

			<div class="site-footer__copy site-copy">

				<?php integer_footer_text(); ?>

			</div>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
