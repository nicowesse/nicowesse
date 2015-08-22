<?php
/*
Template Name: Homepage
*/

get_header(); ?>

<section class="l-page l-page--homepage">

<?php get_template_part('filter'); ?>

<?php

if (have_posts()) :
    $posts_per_page = get_option('posts_per_page');
    query_posts("showposts=" . $posts_per_page); // show one latest post only
    while (have_posts()) : the_post();
        /*
         * Include the post format-specific template for the content. If you want to
         * use this in a child theme, then include a file called called content-___.php
         * (where ___ is the post format) and that will be used instead.
         */
        get_template_part( 'content', get_post_format() );

    endwhile;

    wp_reset_query();

else :
    // If no content, include the "No posts found" template.
    get_template_part( 'content', 'none' );

endif;
?>

<div class="c-read-more">
    <a href="<?php echo get_permalink( get_option('page_for_posts' ) ); ?>" class="c-read-more__link btn">See more</a>
</div>

</section>

<?php
get_footer();