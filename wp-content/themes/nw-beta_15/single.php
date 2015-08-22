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

<section class="l-page">

<?php
	// Start the Loop.
	while ( have_posts() ) : the_post();

		?>
		<article <?php post_class('c-post'); ?>>

			<header class="c-post__header">
				<h1 class="c-post__title"><?php echo the_title(); ?></h1>

			</header><!-- .c-post__header -->

			<section class="c-post__content">
				<?php echo the_content(); ?>
			</section>

			<!--<nav class="c-post__nav">
				<pre>

				<?php $prev_post = get_adjacent_post( false, '', true ); ?>
				<?php if ( is_a( $prev_post, 'WP_Post' ) ) { ?>
				<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_title( $prev_post->ID ); ?></a>
				<?php } ?>

				</pre>
			</nav>-->


			<?php if ( comments_open() ) : ?>

				<?php comments_template(); ?>

			<?php endif; ?>

	</article>


<?php endwhile; ?>

</section>

<?php get_footer();
