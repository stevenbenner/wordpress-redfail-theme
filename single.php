<?php get_header(); ?>

	<div id="content-main" class="hfeed">

		<?php include (TEMPLATEPATH . '/_post.php'); ?>

		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
