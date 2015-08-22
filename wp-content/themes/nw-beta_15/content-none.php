<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('c-content c-content--none'); ?>>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready for some writing? <a href="%1$s">Start here</a>.' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>
	
	<header class="c-page-header">
        <h2 class="c-page-header__title">Oh my..nothing here</h2>
    </header>

	<p>I guess the search went wrong. At least we couldn't find <strong><?php echo $_GET['s']; ?></strong>. You could try searching for something else?</p>
	
	<?php get_search_form(); ?>

	<?php else : ?>

	<header class="c-page-header">
        <h2 class="c-page-header__title">Oh my..nothing here</h2>
    </header>

	<p>Can't seem to find what you are looking for. You could try searching for it or dive into my other pages.</p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</article><!-- #post-## -->
