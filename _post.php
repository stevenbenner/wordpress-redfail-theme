<?php

if (have_posts()) :

	if (is_category() || is_tag() || is_day() || is_month() || is_year() || is_author() || (isset($_GET['paged']) && !empty($_GET['paged']))) {
		$heading = 'h3';
	} else {
		$heading = 'h2';
	}

?>

	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h2 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h2 class="pagetitle">Author Archive</h2>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h2 class="pagetitle">Blog Archives</h2>
	<?php } ?>

	<?php while (have_posts()) : the_post(); ?>

		<!-- blog post -->
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<<?php echo($heading); ?> class="entry-title"><?php if(!is_single()):?><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php endif; ?><?php the_title(); ?><?php if(!is_single()):?></a><?php endif; ?></<?php echo($heading); ?>>
			<div class="postmetadata" style="overflow:hidden;">
				<span class="post-meta-info">
					<abbr class="published" title="<?php the_time('c') ?>"><?php the_time('F jS, Y') ?></abbr>
					&ndash;
					<?php the_category(', ') ?>

					<?php the_tags('(', ', ', ')'); ?>

				</span>
				<span class="post-comment-link">
					<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>

				</span>
			</div>

			<div class="entry entry-content">
				<?php if(function_exists('the_post_thumbnail') && has_post_thumbnail()) : ?>

				<!-- thumbnail -->
				<div class="post-thumbnail">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e('Permanent Link To', TDOMAIN);?> <?php the_title_attribute();?>">
						<?php the_post_thumbnail('thumbnail');?>

					</a>
				</div>
				<?php endif; ?>

				<!-- content -->
<?php the_content('Read more...'); ?>

			<?php if(is_single()):?>

				<?php if(function_exists('wp_related_posts')) wp_related_posts(); ?>

				<p id="byline">
					By: <span class="author vcard"><a class="url fn" href="https://stevenbenner.com/" rel="author">Steven Benner</a></span><br />
					Updated: <abbr class="updated" title="<?php the_modified_date('c') ?>"><?php the_modified_date('M jS, Y') ?></abbr>
				</p>

			<?php endif; ?>

			</div>

		</div>

			<?php if(is_single()):?>

				<div id="social-links">
					<p>Did you like this article? Share it with others:</p>
					<ul>
						<li><a href="https://www.facebook.com/share.php?u=<?php the_permalink();?>" class="facebook-link" rel="nofollow">Share</a></li>
						<?php
						$short_url = get_post_meta(get_the_ID(), 'short_url', true);
						if (!empty($short_url)) :
						?>

						<li><a href="https://twitter.com/?status=<?php echo(urlencode(get_the_title())); ?>+-+<?php echo($short_url); ?>+via+@stevenbenner" class="twitter-link" rel="nofollow">Retweet</a></li>
						<?php else : ?>

						<li><a href="https://twitter.com/?status=<?php the_permalink(); ?>+via+@stevenbenner" class="twitter-link" rel="nofollow">Retweet</a></li>
						<?php endif; ?>

						<li><a href="https://del.icio.us/post?url=<?php the_permalink(); ?>&title=<?php echo(urlencode(get_the_title())); ?>" class="delicious-link" rel="nofollow">Bookmark</a></li>
						<li><a href="https://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php echo(urlencode(get_the_title())); ?>" class="stumbleupon-link" rel="nofollow">Vote up</a></li>
						<li><a href="https://digg.com/submit?url=<?php the_permalink(); ?>&title=<?php echo(urlencode(get_the_title())); ?>" class="digg-link" rel="nofollow">Digg</a></li>
						<li><a href="https://reddit.com/submit?url=<?php the_permalink(); ?>&title=<?php echo(urlencode(get_the_title())); ?>" class="reddit-link" rel="nofollow">Reddit</a></li>
					</ul>
				</div>

				<?php comments_template(); ?>

			<?php endif; ?>

	<?php endwhile; ?>

<?php else :

	if ( is_category() ) { // If this is a category archive
		printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
	} else if ( is_date() ) { // If this is a date archive
		echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
	} else if ( is_author() ) { // If this is a category archive
		$userdata = get_userdatabylogin(get_query_var('author_name'));
		printf("<h2>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
	} else {
		echo("<h2>No posts found.</h2>");
	}
	get_search_form();

endif; ?>
