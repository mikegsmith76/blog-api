<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Integer
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				$comment_count = get_comments_number();
				if ( 1 == $comment_count ) {
					printf( esc_html_e( 'One Reply', 'integer' ) );
				} else {
					printf( // wpcs: xss ok.
						/* Translators: %s: number of replies. */
						esc_html( _nx( '%1$s Reply', '%1$s Replies', $comment_count, 'comments title', 'integer' ) ),
						number_format_i18n( $comment_count ),
						'<span>' . get_the_title() . '</span>'
					);
				}
			?>
		</h3>

		<ul class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style'       => 'ul',
						'short_ping'  => true,
						'avatar_size' => '96',
					)
				);
			?>
		</ul>

		<?php integer_comments_pagination(); ?>

	<?php endif; ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
			printf( '<p class="no-comments">%s</p>', esc_html_e( 'Comments are closed.', 'integer' ) );
		}

		// Display comment form.
		comment_form(
			array(
				/* Translators: %s: comment author name. */
				'title_reply_to' => __( 'Reply to %s', 'integer' ),
				'cancel_reply_link' => __( 'Cancel', 'integer' ),
			)
		);
	?>

</div>
