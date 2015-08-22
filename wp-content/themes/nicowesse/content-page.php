<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		the_title( '<h1 class="page-title">', '</h1>' );
	?>

	<?php
		the_content();
		edit_post_link( __( 'Rediger', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
	?>
</article><!-- #post-## -->
