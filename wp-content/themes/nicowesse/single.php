<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

$categories = get_the_category();
get_header(); ?>

	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			?>
			
			<article class="large-12 columns post">

				<section class="post-content">
					<?php echo the_content(); ?>
				</section>
				
				<nav class="post-navigation">
					<?php if ( get_next_post() ) : ?>
					<figure class="prev-post">
						<?php
						$next_post = get_next_post( '14');
						$next_post_meta = array();
						$next_post_meta['thumbnail'] = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID) );
						$next_post_meta['title'] = $next_post->post_title;
						$next_post_meta['url'] = get_permalink($next_post->ID);
						?>
						<img src="<?php echo $next_post_meta['thumbnail']; ?>" alt="">
						<figcaption>
							<a href="<?php echo $next_post_meta['url']; ?>">← <?php echo $next_post_meta['title']; ?></a>
						</figcaption>
					</figure>
					<?php endif; ?>
					<?php if ( get_previous_post() ) : ?>
					<figure class="next-post">
						<?php
						$prev_post = get_previous_post( '14');
						$prev_post_meta = array();
						$prev_post_meta['thumbnail'] = wp_get_attachment_url( get_post_thumbnail_id($prev_post->ID) );
						$prev_post_meta['title'] = $prev_post->post_title;
						$prev_post_meta['url'] = get_permalink($prev_post->ID);
						?>
						<img src="<?php echo $prev_post_meta['thumbnail']; ?>" alt="">
						<figcaption>
							<a href="<?php echo $prev_post_meta['url']; ?>"><?php echo $prev_post_meta['title']; ?> →</a>
						</figcaption>
					</figure>
					<?php endif; ?>
				</nav>
			</article>
				
<?php if ( comments_open() ) : ?>
	<section class="large-12 columns comments">
		<?php comments_template(); ?>
	</section>
<?php endif; ?>

			
	<?php endwhile; ?>

<?php get_footer();
