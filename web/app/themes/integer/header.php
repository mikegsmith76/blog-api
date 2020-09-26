<?php
/**
 * The template for displaying the header.
 *
 * @package Integer
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<a class="skip-link btn btn-accent screen-reader-text" href="#main">
		<?php esc_html_e( 'Skip to content', 'integer' ); ?>
	</a>

	<header id="masthead" class="site-header">

		<div class="site-header__branding site-branding">
			<?php integer_site_logo(); ?>
			<?php integer_site_title(); ?>
		</div>

		<?php if ( has_nav_menu( 'primary' ) ) : ?>

			<nav class="site-header__menu primary-menu" role="navigation">
				<button class="primary-menu__toggle menu-toggle" aria-haspopup="true" aria-expanded="false" aria-label="<?php esc_html_e( 'Menu', 'integer' ); ?>">
					<?php
						echo integer_get_svg( // wpcs: xss ok.
							array(
								'icon' => 'menu',
								'class' => 'menu-toggle__icon menu-toggle__icon--menu',
							)
						);

						echo integer_get_svg( // wpcs: xss ok.
							array(
								'icon' => 'close',
								'class' => 'menu-toggle__icon menu-toggle__icon--close',
							)
						);
					?>
					<span class="menu-toggle__text"><?php esc_html_e( 'Menu', 'integer' ); ?></span>
				</button>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class' => 'primary-menu__list',
							'container' => false,
						)
					);
				?>
			</nav>

		<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>

			<p class="no-main-navigation">
				<span><?php esc_html_e( 'No menu assigned.', 'integer' ); ?> </span>
				<a href="<?php echo esc_url( get_admin_url( null, '/customize.php?autofocus[panel]=nav_menus' ) ); ?>"><?php esc_html_e( 'Add now.', 'integer' ); ?></a>
			</p>

		<?php endif; ?>

	</header>
