<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

$thumb = get_the_post_thumbnail(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('large-6 medium-6 columns'); ?>>
	<figure class="post-thumbnail">
		<a href="<?php the_permalink(); ?>" class="post-link <?php echo $thumbnail; ?>"><span class="post-title"><?php the_title(); ?></span></a>
		<?php the_post_thumbnail('thumbnail'); ?>
	</figure>
</article>
