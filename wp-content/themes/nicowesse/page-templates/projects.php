<?php
/**
 * Template Name: Projects Template
 *
 * @package WordPress
 * @subpackage Nico Wesse
 * @since Nico Wesse 1.0
 */

get_header(); ?>

<?php
// Start the Loop.
while ( have_posts() ) : the_post(); 
?>
	<?php
	if (is_page()) :

		$posts = query_posts("cat=-14");
		if ($posts) :
		    foreach ($posts as $post):
		  	setup_postdata($post); 

				get_template_part( 'content', get_post_format() );

			endforeach;
		endif;

		twentyfourteen_paging_nav();

	endif;
	?>

<?php 
endwhile; ?>
<?php
get_footer();
