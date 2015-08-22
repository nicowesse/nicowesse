<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

?>

<div class="col-12">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('c-content c-content--image'); ?>>
				<header class="c-content__header">
					<h1 class="c-content__header"><?php the_title(); ?></h1>
				</header>

				<figure class="c-content__thumbnail">
					<?php twentyfourteen_the_attached_image(); ?>

					<?php if ( has_excerpt() ) : ?>

					<figcaption class="c-content__caption">
						<?php the_excerpt(); ?>
					</figcaption><!-- .c-post__caption -->

					<?php endif; ?>
				</figure>
			</article><!-- c-post--image -->


			<nav id="image-navigation" class="c-content__nav">
				<div class="c-content__nav-links">
				<?php previous_image_link( false, '<div class="previous-image">Previous Image</div>' ); ?>
				<?php next_image_link( false, '<div class="next-image">Next Image</div>' ); ?>
				</div><!-- .c-image-nav__links -->
			</nav><!-- .c-image-nav -->

		<?php endwhile; // end of the loop. ?>

</div><!-- columns -->

<?php
get_footer();
