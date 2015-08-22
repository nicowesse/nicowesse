<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<section class="c-comments">

<?php if ( comments_open() ) : ?>

	<h2 class="c-comment__title">Comments</h2>

	<?php if ( have_comments() ) : ?>

		<ul class="c-comment__list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'avatar_size'=> 0,
					'reply_text' => 'Reply',
					'login_text' => 'Log in to reply',
					'max_depth' => 3,
				) );
			?>
		</ul>

	<?php endif; // have_comments()

	$comment_args = array(
		'title_reply'=> __( 'Write a comment' ),
		'title_reply_to' => __( 'Reply %s' ),
		'cancel_reply_link' => __( 'Cancel reply' ),
		'label_submit' => __( 'Post comment' ),
		'comment_notes_before' => '<p class="c-comment__notes">Your email stays private. Fields in red is required.</p>',
    	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="c-comment__field c-comment__field--author"><label class="c-comment__label" for="author">Name</label><input class="c-comment__input" id="author" name="author" placeholder="Name" pattern=".{2,}" type="text" required value="' . esc_attr( $commenter['comment_author'] ) . '" size="999"' . $aria_req . ' /></div>',
    		'email'  => '<div class="c-comment__field c-comment__field--email"><label class="c-comment__label" for="email">Email</label><input class="c-comment__input" id="email" name="email" placeholder="E-mail" type="email" required value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="999"' . $aria_req . ' />'.'</div>',
    		'url'    => '' ) ),
		'comment_field' => '<div class="c-comment__field c-comment__field--comment"><label class="c-comment__label" for="comment">Comment</label><textarea class="c-comment__input c-comment__input--textarea" id="comment" name="comment" rows="4" pattern=".{2,}" aria-required="true" placeholder="Write a nice comment here" required></textarea></div>',
    	'comment_notes_after' => ''
	);

	comment_form($comment_args);

endif; ?>

<?php if ( comments_open() == false ) : ?>

<h2 class="c-comment__title">The comments are closed :(</h2>

<?php endif; ?>

</section><!-- #comments -->
