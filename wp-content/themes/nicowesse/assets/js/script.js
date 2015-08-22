$(document).ready(function() {
    console.log('Hey');
    // Animate the search-bar
    $('.search-toggle').click(function() {
        $('.search-area').slideToggle(1000, 'easeOutBack');
        $(this).toggleClass('active');
        $('body').toggleClass('search-visible');
    });

    // Post thumbnails
    var thumbWidth = $('.post-thumbnail').width(),
        thumbRatio = 2.35,
        thumbHeight = thumbWidth / thumbRatio;
    $('.post-thumbnail').css('max-height', parseInt(thumbHeight));

    $(".comment-form :input").focus(function() {
      $("label[for='" + this.name + "']").addClass("focus");
    }).blur(function() {
      $("label").removeClass("focus");
    });

    // Fluidbox
    $('a').fluidbox();

    // 16/9 videos fix
    var ratio = 16 / 9;
    $('video').each(function() {
        var vWidth = $(this).width();
        $(this).css('min-height', vWidth / ratio);
    });

    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        smoothHeight: true,
        directionNav: false,
        useCSS: true,
    });
});

