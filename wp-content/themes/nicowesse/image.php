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

get_header( 'nomenu' );
?>

<a href="javascript:javascript:history.go(-1)" class="back" title="Back">←</a>

<div class="large-12 columns"></div>
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_title( '<h1 class="post-header">', '</h1>' ); ?>

				<figure class="post-thumbnail">
					<?php twentyfourteen_the_attached_image(); ?>
				</figure>
			</article><!-- #post-## -->
			<?php if ( has_excerpt() ) : ?>
			<blockquote>
				<?php the_excerpt(); ?>
			</blockquote><!-- .entry-caption -->
			<?php endif; ?>

			<nav id="image-navigation" class="navigation image-navigation">
				<div class="nav-links">
				<?php previous_image_link( false, '<div class="previous-image">' . __( 'Previous Image', 'twentyfourteen' ) . '</div>' ); ?>
				<?php next_image_link( false, '<div class="next-image">' . __( 'Next Image', 'twentyfourteen' ) . '</div>' ); ?>
				</div><!-- .nav-links -->
			</nav><!-- #image-navigation -->

		<?php endwhile; // end of the loop. ?>

</div><!-- #content -->

<?php
get_footer();
