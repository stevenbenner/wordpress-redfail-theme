<?php
	// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<?php
$has_comments = false;
if ( have_comments() ) {
	$has_comments = true;
	$comments_by_type = &separate_comments(get_comments('status=approve&post_id='.get_the_ID()));
}
?>

<?php if ( $has_comments && !empty($comments_by_type['comment']) ) : ?>
	<!-- comments -->

	<h3 id="comments">Comments</h3>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">

<?php wp_list_comments('type=comment&callback=print_comment'); ?>

	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : //If comments are open, but there are no comments. ?>

	<?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>
	<?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>
	<!-- comment form -->
	<div id="respond">

		<h3><?php comment_form_title( 'Leave a reply', 'Leave a reply to %s' ); ?></h3>

		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php comment_id_fields(); ?>

		<?php if ( is_user_logged_in() ) : ?>

		<p>
			Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a>
		</p>

		<?php else : ?>

		<p>
			<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
			<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="30" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
		</p>

		<p>
			<label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
			<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="30" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
		</p>

		<p>
			<label for="url">Website</label>
			<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="30" tabindex="3" />
		</p>

		<?php endif; ?>

		<p>
			<label for="comment">Message</label>
			<textarea name="comment" id="comment" cols="58" rows="11" tabindex="4"></textarea>
		</p>

		<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p>

		<?php do_action('comment_form', $post->ID); ?>


		</form>

		<?php endif; // If registration required and not logged in ?>

	</div>

<?php if ( $has_comments && !empty($comments_by_type['pings']) ) : ?>
	<!-- pingbacks and trackbacks -->

	<h3>Pages linking to this article</h3>

	<ul class="pinglist">

<?php wp_list_comments('type=pings&callback=print_trackback'); ?>

	</ul>

<?php endif; ?>


<?php endif; // if you delete this the sky will fall on your head ?>
