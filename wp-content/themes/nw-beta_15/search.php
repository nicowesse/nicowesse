<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="l-page">

<?php if ( get_search_query() ) : ?>

	<header class="c-page-header c-page-header--search">
		<h2 class="c-page-header__title">You searched for: <em><?php echo get_search_query() ?></em></h2>
	</header><!-- .page-header -->


	<?php if ( have_posts() ) : ?>

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
			// Previous/next post navigation.
			the_paging_nav();

			get_search_form();

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

			get_search_form();

		endif;
	?>

<?php else : ?>

	<header class="c-page-header c-page-header--search">
		<h2 class="c-page-header__title">You didn't search for anything...</h2>
	</header><!-- .page-header -->

	<?php get_search_form(); ?>

<?php endif; ?>

</section>

<?php
get_footer();
