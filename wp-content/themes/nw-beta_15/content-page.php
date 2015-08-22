<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-page c-content--page'); ?>>
    <header class="c-page-header">
        <h1 class="c-page-header__title"><?php the_title(); ?></h1>
    </header>


	<?php
		the_content();
		edit_post_link( __( 'Rediger', 'twentyfourteen' ), '<span class="edit-link">', '</span>' );
	?>
</article><!-- #post-## -->
