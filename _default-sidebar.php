
	<!--sidebox start -->
	<div class="widget_categories widget">
		<h3 class="wtitle"><?php _e('Categories'); ?></h3>
		<ul>
		<?php wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
		</ul>
	</div>
	<!--sidebox end -->

	<!--sidebox start -->
	<div class="widget_tag_cloud widget">
		<h3 class="wtitle"><?php _e('Tags'); ?></h3>
		<ul>
		<?php wp_tag_cloud('smallest=8&largest=17&number=30'); ?>
		</ul>
	</div>
	<!--sidebox end -->

	<!--sidebox start -->
	<div class="widget_archive widget">
		<h3 class="wtitle"><?php _e('Articles'); ?></h3>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</div>
	<!--sidebox end -->

	<!--sidebox start -->
	<div class="widget_links widget">
		<h3 class="wtitle"><?php _e('Links'); ?></h3>
		<ul>
		<?php get_links('-1', '<li>', '</li>', '<br />', FALSE, 'id', FALSE, FALSE, -1, FALSE); ?>
		</ul>
	</div>
	<!--sidebox end -->

	<!--sidebox start -->
	<div id="dmeta" class="widget_meta widget">
		<h3 class="wtitle"><?php _e('Meta'); ?></h3>
		<ul>
			<?php wp_register(); ?>
			<li class="login"><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
			<li class="rss"><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
			<li class="wordpress"><a href="http://www.wordpress.org" title="Powered by WordPress">WordPress</a></li>
		</ul>
	</div>
	<!--sidebox end -->
