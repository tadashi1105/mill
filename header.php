<?php
/**
 *
 *
 * @package WordPress
 * @since Mill 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
<?php wp_head(); ?>
</head>
<body <?php body_class( [ 'drawer', 'drawer--left' ] ); ?>>
<a class="skip-link screen-reader-text" href="#content">
	<?php esc_html_e( 'Skip to content', 'mill' ); ?>
</a>
<a id="top" name="top"></a>
<div id="page" class="site">
	<header id="header" class="site-l-header" role="banner">
		<?php get_template_part( 'components/header-navbar' ); ?>
		<?php get_template_part( 'components/header-main-nav' ); ?>
		<?php get_template_part( 'components/page-header' ); ?>
	</header><!-- .site-l-header -->
