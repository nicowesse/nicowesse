<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="l-page">
    <section class="c-404">

    	<header class="c-page-header">
            <h1 class="c-page-header__title">Aw man, 404 :/</h1>
        </header><!-- .page-header -->

    	<div class="c-page-content">
    		<p>Looks like we can't find anything here. But you could try searching for it?</p>

    		<?php get_search_form(); ?>
    	</div><!-- .page-content -->
    </section>
</section><!-- #primary -->

<?php
get_footer();
