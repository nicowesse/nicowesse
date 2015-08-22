
$(document).ready(function() {



    $('.c-comment__input').on({
        focus: function() {
            $(this).siblings('.c-comment__label').addClass('is-focused');
        },
        blur: function() {
            if ($(this).val().length === 0 ) { $(this).siblings('.c-comment__label').removeClass('is-focused'); }
        }

    });

    $('.l-page').mixItUp({
        layout: {
            display: 'block'
        },
        animation: {
            enable: true,
            effects: 'fade translateY stagger'
        }
    });

    $('.c-filter__item').click(function() {
        var category = $(this).text().toLowerCase();
        $('.c-filter__selected').text(category);
        $('.c-filter').addClass('active');
    });

    $('.c-filter__reset').click(function() { $('.c-filter').removeClass('active'); });

    $(".c-post__content").fitVids();

    $('.c-post__content a').fluidbox();

    BackgroundCheck.init({
        targets: '.c-post__header',
        images: '.c-post__header',
        debug: true
    });

});

$(window).load(function() {
    $('.flexslider').flexslider({
        selector: ".slides > .c-gallery__element",
        animation: "slide",
        useCSS: false,
        easing: 'easeInOutQuint',
        controlNav: "thumbnails",
        smoothHeight: true,
        directionNav: false,
        touch: true,
        slideshow: false,
    });
});
