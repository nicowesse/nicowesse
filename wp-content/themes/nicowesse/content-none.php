<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<div class="large-12 columns">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="error-image">
			<img src="<?php echo THEME_URL . '/assets/img/icons/search.svg'; ?>" alt="Sick" title="Sick by Julien Deveaux from The Noun">
		</div>

		<h1 class="page-title">Oh my..nothing here</h1>

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( __( 'Ready for some writing? <a href="%1$s">Start here</a>.', 'twentyfourteen' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p>I guess the search went wrong. Atleast we couldn't find anything containing <strong><?php echo $_GET['s']; ?></strong>. You could try searching for something else?</p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p>Can't seem to find what you are looking for. You could try searching for it or dive into my other pages.</p>
		<?php get_search_form(); ?>

		<?php endif; ?>
	</article><!-- #post-## -->
</div>