<?php
/**
 * Template Name: Full Width Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

</section>

<?php
// Start the Loop.
while ( have_posts() ) : the_post(); 
?>
	<?php
	if (is_page()) :

		$cat = 1; //use page title to get a category ID
		$posts = get_posts( "showposts=6" );
		if ($posts) :
		    foreach ($posts as $post):
		  	setup_postdata($post); ?>
			<article id="post-<?php the_ID(); ?>" class="frontpage">
				<figure class="post-thumbnail">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
					<figcaption>
						<h1 class="post-title"><?php the_title(); ?></h1>
						<p class="post-excerpt">
							<?php echo get_the_excerpt(); ?>
						</p>
						<a href="<?php the_permalink(); ?>" class="post-link">Explore</a>
					</figcaption>
				</figure>
			</article>
		<?php endforeach;
		endif;

	endif;
	?>

<?php 
endwhile; ?>
<?php
get_footer();
