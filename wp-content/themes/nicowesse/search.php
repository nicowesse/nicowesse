<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 

if ( have_posts() ) : ?>

	<header class="page-header large-12 columns">
		<h1 class="page-title"><?php printf( __( 'You searched for: <em>%s</em>', 'twentyfourteen' ), get_search_query() ); ?></h1>
	</header><!-- .page-header -->

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
			twentyfourteen_paging_nav();

		else :
			// If no content, include the "No posts found" template.
			get_template_part( 'content', 'none' );

		endif;
	?>

</section><!-- #content -->

<?php
get_footer();
