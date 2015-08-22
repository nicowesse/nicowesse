<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div class="large-12 columns fourofour">
	<div class="error-image">
		<img src="<?php echo THEME_URL . '/assets/img/icons/confused.svg'; ?>" alt="Sick" title="Sick by Julien Deveaux from The Noun">
	</div>
	
	<h1 class="page-title">Lost your way, huh?</h1>

	<div class="page-content">
		<p><?php _e( "Looks like we can't find anything here. But you could try searching for it?", "twentyfourteen" ); ?></p>

		<?php get_search_form(); ?>
	</div><!-- .page-content -->

</div><!-- #primary -->

<?php
get_footer();
