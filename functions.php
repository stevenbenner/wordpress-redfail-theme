<?php

// Theme
define('THEMENAME', 'RedFail');
define('THEMENAMESHORT', 'RedFail');

// names and stuff
define('SITENAME', get_bloginfo('name'));
define('RSSURL', get_bloginfo('rss2_url'));

// Define folder constants
define('ROOT', get_bloginfo('template_url'));
define('CSS_FOLDER', ROOT . '/css');
define('JS_FOLDER', ROOT . '/js');
define('IMAGE_FOLDER', ROOT . '/images');

automatic_feed_links();

add_editor_style();

// remove useless head elements
add_action('init', 'remove_head_links');
function remove_head_links() {
	remove_action('wp_head', 'rsd_link');
	//remove_action('wp_head', 'wp_generator');
	//remove_action('wp_head', 'feed_links', 2);
	//remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	//remove_action('wp_head', 'feed_links_extra', 3);
	//remove_action('wp_head', 'start_post_rel_link', 10, 0);
	//remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	//remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
}

// register sidebars
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Right Column',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
}

// post thumbnails support
if ( function_exists( 'add_theme_support' ) ) add_theme_support('post-thumbnails');

// kill role attribute in search widget
function valid_search_form ($form) {
    return str_replace('role="search" ', '', $form);
}
add_filter('get_search_form', 'valid_search_form');

// change the "view more" link to not go to a specific section
function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// custom comment format
function print_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
		<!-- comment -->
		<li <?php comment_class('comment'); ?>>
			<div id="comment-<?php comment_ID(); ?>">
				<div class="comment-author vcard">
					<?php echo get_avatar($comment, 32); ?>

					<cite class="fn">
						<?php comment_author_link() ?>

					</cite>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
					<?php comment_date() ?> at <?php comment_time() ?><?php edit_comment_link('(Edit)', ' ', '') ?>

				</div>

				<div id="comment-content">
				<?php comment_text() ?>

				</div>

				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

				</div>
			</div>
		<?php
}

function print_trackback($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
		<li class="trackback">
			<?php comment_author_link() ?>

		<?php
}

?>
