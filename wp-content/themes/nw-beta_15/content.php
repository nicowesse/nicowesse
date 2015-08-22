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

if (has_post_thumbnail( $post->ID ) ) {
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
    $thumbnail_url = $thumbnail[0];
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-content c-content--post mix'); ?>>
	<figure class="c-content__thumbnail" style="background-image: url('<?= $thumbnail_url; ?>')">
		<a class="c-content__thumbnail-link" href="<?php the_permalink(); ?>">
			<span class="c-content__thumbnail-title"><?php the_title(); ?></span>
		</a>
	</figure>
</article>
