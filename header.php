<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
	<?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?>

</title>
<?php versioned_stylesheet($GLOBALS['TEMPLATE_RELATIVE_URL'].'style.css'); ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('wpurl'); ?>/favicon.ico" />
<?php
if ( is_singular() )
{
	wp_enqueue_script('comment-reply');
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(50, 50) );
	$url = $thumb['0'];
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:image" content="<?php echo $url; ?>" />
<meta property="og:type" content="article" />
<?php
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">

		<!-- header -->
		<div id="header">
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<p>
				<?php bloginfo('description'); ?>

			</p>
			<div id="categories">
				<ul>
					<?php wp_list_categories('title_li=&depth=1&title_li='); ?>

					<li><a href="<?php echo RSSURL; ?>" id="header-subscribe-link">Subscribe</a></li>
				</ul>
			</div>
			<div id="pages">
				<ul>
					<li class="page_item"><a class="home" href="<?php echo get_settings('home'); ?>/" title="Home">Home</a></li>
					<?php
					$frontpage_id = get_option('page_on_front');
					wp_list_pages('sort_column=menu_order&exclude='.$frontpage_id.'&depth=1&title_li=');
					?>

				</ul>
			</div>
		</div>

		<!-- page content -->
		<div id="content">
			<div id="shadow"></div>
