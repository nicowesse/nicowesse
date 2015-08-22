<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 define(THEME_URL, get_bloginfo('template_url'));
?>

</section>

<footer class="row site-footer">
	<div class="large-12 columns">
		<div class="footer-content">
			<a class="footer-name" href="mailto: me@nicowesse.com">hello@nicowesse.com</a>
		</div>
	</div>
</footer>

<!--<script src="//code.jquery.com/jquery-latest.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.min.js"></script>
<script src="<?php echo THEME_URL . "/assets/js/background-check.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo THEME_URL . "/assets/js/jquery.fluidbox.min.js"; ?>"></script>
<script type="text/javascript" src="<?php echo THEME_URL . "/assets/js/jquery.flexslider.js"; ?>"></script>
<script type="text/javascript" src="<?php echo THEME_URL . "/assets/js/jquery.sticky.js"; ?>"></script>

<script src="<?php echo THEME_URL . "/assets/js/script.js"; ?>"></script>

<?php wp_footer(); ?>
</body>
</html>