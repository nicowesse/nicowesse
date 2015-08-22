<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="l-page">

	<?php if ( have_posts() ) : ?>

	<header class="c-page-header c-page-header--category">
		<h1 class="c-page-header__title"><?php printf(single_cat_title( '', false ) ); ?></h1>

	</header><!-- .archive-header -->

	<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			endwhile;
			// Previous/next page navigation.
			the_paging_nav();

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

		endif;
	?>

</section>

<?php

get_footer();
