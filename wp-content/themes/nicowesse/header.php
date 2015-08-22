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
	<link rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/foundation.css'; ?>">
	<link rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/base.css'; ?>">
	

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,300,700,300italic,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Neuton:200,300,400,700,400italic' rel='stylesheet' type='text/css'>

	<!-- Plugin CSS -->
	<link type="text/css" rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/fluidbox.css'; ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/flexslider.css'; ?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/video-js.min.css'; ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/mnml-video-js.css'; ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo THEME_URL . '/assets/css/vendor/mnml-video-js.css'; ?>">

	<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo THEME_URL . '/assets/js/vendor/custom.modernizr.js'; ?>"></script>
	<script src="<?php echo THEME_URL . '/assets/js/video.js'; ?>"></script>

	<?php 
	// If post/page has thumbnail, set that as background
	if (has_post_thumbnail() && is_single()):
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

	<style>
		.site-header .header-line { background-image: url(<?php echo $url; ?>); }
	</style>

	<?php 
	// Else use default header image
	elseif (get_header_image() != '') :?>

	<style>
		.site-header .header-line { background-image: url(<?php echo get_header_image(); ?>); }
	</style>

	<?php else: ?>
	<style>
		.site-nav { position: relative; padding: 4rem 0; }
		.site-header { height: 0; }
	</style>

	<?php endif; ?>

</head>

<body <?php body_class(); ?>>

<?php get_template_part('analytics'); ?>

<nav class="site-nav">
	<section class="row">
		<div class="large-12 columns">
			<a href="<?php echo home_url( '/' ); ?>" class="site-name"><?php bloginfo('sitename'); ?></a>
		
		<?php wp_nav_menu( array( 
			'container' => false
		) ); ?>
		</div>
	</section>
</nav>

<?php if (is_single()): ?>
<!--<header class="site-header sticky">
		<div class="row">
			<div class="large-12 columns post-meta">
				<h1 class="post-title"><?php single_post_title(); ?></h1>
			</div>
		</div>
</header>-->
<?php endif; ?>

<header class="site-header">
	<?php if ( is_single() ): ?>
		<div class="row">
			<div class="large-12 columns post-meta">
				<h1 class="post-title"><?php single_post_title(); ?></h1>

				<figure class="header-line"></figure>
			</div>
			<div class="large-12 columns post-image" hidden>
				<img class="header-image" src="<?php echo $url; ?>"></img>
			</div>
		</div>
	<?php elseif ( is_page() OR is_category() ): ?>
		<div class="row">
			<div class="large-12 columns post-meta">
				<h1 class="post-title"><?php wp_title( '|', false, 'right' ); ?></h1>

				<figure class="header-line"></figure>
			</div>
		</div>
	<?php endif; ?>
</header>

<section class="row page-content">

