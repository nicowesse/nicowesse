<?php
/**
 * The template for displaying the footer
 *
 */
 define(THEME_URL, get_bloginfo('template_url'));
?>

<footer class="l-footer">
    <h4 class="l-footer__copyright">© NICO <?= date('Y'); ?></h4>
</footer>

</div><!-- Ends .o-row -->

</div><!-- End .o-container -->

<script src="<?php echo THEME_URL . "/bower_components/jquery/dist/jquery.min.js"; ?>"></script>

<!-- Vendor JS -->
<script src="<?php echo THEME_URL . "/bower_components/background-check/background-check.min.js"; ?>"></script>
<script src="<?php echo THEME_URL . "/bower_components/flexslider/jquery.flexslider-min.js"; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.1.0/jquery.fitvids.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fluidbox/1.4.3.1/jquery.fluidbox.min.js"></script>
<script src="<?php echo THEME_URL . "/assets/js/vendor/prism.js"; ?>"></script>

<script src="<?php echo THEME_URL . "/assets/js/main.js"; ?>"></script>

<script>
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
e=o.createElement(i);r=o.getElementsByTagName(i)[0];
e.src='//www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>

<?php //wp_footer(); ?>
</body>
</html>