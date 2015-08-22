<?php

function setup() {

    // Enable support for Post Thumbnails, and declare two sizes.
    add_theme_support( 'post-thumbnails' );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'image', 'gallery', 'video', 'audio',
    ) );

    add_theme_support( 'custom-header' );

    add_theme_support( 'menus' );

    // This theme uses its own gallery styles.
    add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'setup' );

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}

add_filter( 'img_caption_shortcode', 'nw_post_caption', 10, 3 );
function nw_post_caption( $current_html, $attr, $content ) {
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ), $attr));
    if ( 1 > (int) $width || empty($caption) )
        return $content;

    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

    return '<figure ' . $id . 'class="post-caption ' . esc_attr($align) . '">'
. do_shortcode( $content ) . '<figcaption>' . $caption . '</figcaption></figure>';
}

//add_shortcode('gallery', 'nw_gallery_shortcode');
function nw_gallery_shortcode($attr) {
    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'figure',
        'icontag'    => 'dt',
        'captiontag' => 'figcaption',
        'columns'    => 3,
        'size'       => 'large',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $icontag = tag_escape($icontag);
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) )
        $itemtag = 'dl';
    if ( ! isset( $valid_tags[ $captiontag ] ) )
        $captiontag = 'dd';
    if ( ! isset( $valid_tags[ $icontag ] ) )
        $icontag = 'dt';

    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "
        <style type='text/css'>

        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, true) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }

    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;
}

add_filter('post_gallery', 'nw_post_gallery', 10, 2);
function nw_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    $image_count = count($attachments);
    // Here's your actual output, you may customize it to your need
    $output = '<section class="c-gallery">';
    $output .= '<div id="#slider" class="flexslider">';
    $output .= "<article class='c-gallery__container slides slide-count-{$image_count}' data-slide-count='{$image_count}'>";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        $title = $attachment->post_title;
        $caption = $attachment->post_excerpt;
        // Fetch the thumbnail (or full image, it's up to you)
        $img_thumb = wp_get_attachment_image_src($id, 'thumbnail');
    //                  $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, 'full');

        //$output .= "<li>";
        $output .= "<figure class='c-gallery__element' data-thumb='{$img_thumb[0]}'>";
        $output .= "<img class='c-gallery__image' src='{$img[0]}'' alt='' />";

        if ($caption || $title) {
        $output .= "<figcaption class='c-gallery__caption'>";

        if ($title) {
        $output .= "<span class='c-gallery__image-title'>{$title}</span>";
        }
        if ($caption) {
        $output .= "<span class='c-gallery__image-caption'>{$caption}</span>";
        }

        $output .= "</figcaption>";
        }

        $output .= "</figure>";
        //$output .= "</li>";
    }

    $output .= "</article>";
    $output .= "</div>";

    $output .= "</section>";

    return $output;
}

function nw_post_gallery_alt($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    $image_count = count($attachments);
    // Here's your actual output, you may customize it to your need
    $output = '<section class="c-gallery">';

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
        $img_thumb = wp_get_attachment_image_src($id, 'thumbnail');
    //                  $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
        $img = wp_get_attachment_image_src($id, 'full');

        $output .= "<figure class='c-gallery__cell'>";
        $output .= "<img src='{$img[0]}'' alt='' />";
        $output .= "</figure>";
    }

    $output .= "</section>";

    return $output;
}



function nw_video_shortcode( $attr, $content = '' ) {
        global $content_width;
        $post_id = get_post() ? get_the_ID() : 0;

        static $instances = 0;
        $instances++;

        /**
         * Override the default video shortcode.
         *
         * @since 3.7.0
         *
         * @param null              Empty variable to be replaced with shortcode markup.
         * @param array  $attr      Attributes of the shortcode.
         * @param string $content   Shortcode content.
         * @param int    $instances Unique numeric ID of this video shortcode instance.
         */
        $html = apply_filters( 'wp_video_shortcode_override', '', $attr, $content, $instances );
        if ( '' !== $html )
                return $html;

        $video = null;

        $default_types = wp_get_video_extensions();
        $defaults_atts = array(
                'src'      => '',
                'poster'   => '',
                'loop'     => '',
                'autoplay' => '',
                'preload'  => 'metadata',
                'height'   => 1080,
                'width'    => empty( $content_width ) ? 1920 : $content_width,
                'size'	   => ''
        );

        foreach ( $default_types as $type )
                $defaults_atts[$type] = '';

        $atts = shortcode_atts( $defaults_atts, $attr, 'video' );
        extract( $atts );

        $w = $width;
        $h = $height;
        if ( is_admin() && $width > 600 )
                $w = 1920;
        elseif ( ! is_admin() && $w > $defaults_atts['width'] )
                $w = $defaults_atts['width'];

        if ( $w < $width )
                $height = round( ( $h * $w ) / $width );

        $width = $w;

        $primary = false;
        if ( ! empty( $src ) ) {
                $type = wp_check_filetype( $src, wp_get_mime_types() );
                if ( ! in_array( strtolower( $type['ext'] ), $default_types ) )
                        return sprintf( '<a class="wp-embedded-video" href="%s">%s</a>', esc_url( $src ), esc_html( $src ) );
                $primary = true;
                array_unshift( $default_types, 'src' );
        } else {
                foreach ( $default_types as $ext ) {
                        if ( ! empty( $$ext ) ) {
                                $type = wp_check_filetype( $$ext, wp_get_mime_types() );
                                if ( strtolower( $type['ext'] ) === $ext )
                                        $primary = true;
                        }
                }
        }

        if ( ! $primary ) {
                $videos = get_attached_media( 'video', $post_id );
                if ( empty( $videos ) )
                        return;

                $video = reset( $videos );
                $src = wp_get_attachment_url( $video->ID );
                if ( empty( $src ) )
                        return;

                array_unshift( $default_types, 'src' );
        }

        $library = apply_filters( 'wp_video_shortcode_library', 'mediaelement' );
        /*if ( 'mediaelement' === $library && did_action( 'init' ) ) {
                wp_enqueue_style( 'wp-mediaelement' );
                wp_enqueue_script( 'wp-mediaelement' );
        }

        /*$atts = array(
                'class'    => apply_filters( 'wp_video_shortcode_class', 'wp-video-shortcode' ),
                'id'       => sprintf( 'video-%d-%d', $post_id, $instances ),
                'width'    => absint( $width ),
                'height'   => absint( $height ),
                'poster'   => esc_url( $poster ),
                'loop'     => $loop,
                'autoplay' => $autoplay,
                'preload'  => $preload,
        );*/

        // These ones should just be omitted altogether if they are blank
        foreach ( array( 'poster', 'loop', 'autoplay', 'preload' ) as $a ) {
                if ( empty( $atts[$a] ) )
                        unset( $atts[$a] );
        }

        $attr_strings = array();
        foreach ( $atts as $k => $v ) {
                $attr_strings[] = $k . '="' . esc_attr( $v ) . '"';
        }

        $html .= '<video id="videoplayer" class="video-js vjs-mnml '.$size.'" controls="controls" data-setup>';

        $fileurl = '';
        $source = '<source type="%s" src="%s" />';
        foreach ( $default_types as $fallback ) {
                if ( ! empty( $$fallback ) ) {
                        if ( empty( $fileurl ) )
                                $fileurl = $$fallback;
                        $type = wp_check_filetype( $$fallback, wp_get_mime_types() );
                        // m4v sometimes shows up as video/mpeg which collides with mp4
                        if ( 'm4v' === $type['ext'] )
                                $type['type'] = 'video/m4v';
                        $html .= sprintf( $source, $type['type'], esc_url( $$fallback ) );
                }
        }
        if ( 'mediaelement' === $library )
                $html .= wp_mediaelement_fallback( $fileurl );
        $html .= '</video>';

        $html = sprintf( '<div class="wp-video">%s</div>', $html );
        return apply_filters( 'wp_video_shortcode', $html, $atts, $video, $post_id, $library );
}
add_shortcode( 'video', 'nw_video_shortcode' );

function the_paging_nav() {
    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
        return;
    }

    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
        'base'     => $pagenum_link,
        'format'   => $format,
        'total'    => $GLOBALS['wp_query']->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => __( '&larr; Previous', 'twentyfourteen' ),
        'next_text' => __( 'Next &rarr;', 'twentyfourteen' ),
    ) );

    if ( $links ) :

    ?>
    <nav class="c-pagination" role="navigation">
        <h1 class="screen-reader-text" hidden>Posts navigation</h1>
        <div class="c-pagination__links c-pagination--loop-pagination">
            <?php echo $links; ?>
        </div><!-- .c-pagination__links -->
    </nav><!-- .c-pagination -->
    <?php
    endif;
}

