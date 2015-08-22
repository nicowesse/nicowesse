<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 define(THEME_URL, get_bloginfo('template_url'));
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="icon" href="<?php echo THEME_URL . '/assets/img/favicon.png'; ?>">

	<!-- Main stylesheets -->
	<link rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/normalize.css'; ?>">
	<link rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/main.css'; ?>">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/prism.css'; ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fluidbox/1.4.3.1/css/fluidbox.css">


	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
	<link type="text/css" rel="stylesheet" href="<?php echo THEME_URL . '/assets/fonts/material-icons/materialdesignicons.css'; ?>" />


	<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Vendor JS -->
	<script src="<?php echo THEME_URL . '/bower_components/jquery/dist/jquery.min.js'; ?>"></script>
	<script src="<?php echo THEME_URL . '/assets/js/vendor/modernizr-2.8.3.min.js'; ?>"></script>

	<?php $image = ( is_single() && has_post_thumbnail( $post->ID ) ? wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) : ''); ?>

</head>

<body <?php body_class(); ?>>

<div class="o-container">

	<div class="o-row">

		<header class="l-header">
			<div class="c-sitename">
				<h4 class="c-sitename__title"><a class="c-sitename__link" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><span class="c-sitename__tagline"><?php bloginfo('description'); ?></span></h4>
			</div>

			<nav class="c-nav">
				<?php wp_nav_menu( array(
					'container' 	=> false,
					'menu_class'    => 'c-nav__menu',
					'depth'			=> 2,
				) ); ?>
			</nav>

			<div class="c-nav-search">
				<?php get_search_form(); ?>
			</div>
		</header>
