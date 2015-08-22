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
				<h3 class="c-post__title"><?php the_title(); ?></h3>

			</header><!-- .c-post__header -->

			<section class="c-post__content">
				<?php echo the_content(); ?>
			</section>

			<section class="c-post__meta">
				<span class="c-post__meta-publish">Published: <?php the_date('d.m.y'); ?></span>
				<span class="c-post__meta-category">in <?php the_category(','); ?></span>
				<span class="c-post__meta-modified">Updated: <?php the_modified_date('d.m.y'); ?></span>
			</section>

			<nav class="c-post__nav">

				<?php 
				$next_post = get_adjacent_post( false, '', false );
				$prev_post = get_adjacent_post( false, '', true ); 
				$single = ( $next_post && $prev_post ) ? '' : ' c-post__nav-link--single';
				?>

				<?php if ( $next_post ) : ?>
				<a class="c-post__nav-link c-post__nav-link--next<?php echo $single; ?>" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_title( $next_post->ID ); ?></a>
				<?php endif; ?>
				
				<?php if ( $prev_post ) : ?>
				<a class="c-post__nav-link c-post__nav-link--prev<?php echo $single; ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_title( $prev_post->ID ); ?></a>
				<?php endif; ?>
				
			</nav>


			<?php if ( comments_open() ) : ?>

				<?php comments_template(); ?>

			<?php endif; ?>

	</article>


<?php endwhile; ?>

</section>

<?php get_footer();
