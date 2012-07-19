		</div>

		<!-- footer -->
		<div id="footer">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
			<?php endif; ?>

		</div>
	</div>

	<!-- sub footer -->
	<div id="sub-footer">
		<p id="sub-footer-cite">
			Steven Benner's Blog is proudly powered by <a href="http://wordpress.org/" rel="nofollow">WordPress</a><br />
			Social media icons provided by <a href="http://icondock.com/" rel="nofollow">IconDock</a><br />
			Please subscribe to my <a href="http://stevenbenner.com/feed/">Entries (RSS)</a>
		</p>
		<div id="copyright-image">
			<a href="http://creativecommons.org/licenses/by-sa/3.0/us/" rel="license nofollow"><img src="<?php echo IMAGE_FOLDER.'/cc_by-sa_88x31.png'; ?>" width="88" height="31" alt="Creative Commons License" /></a>
		</div>
		<p id="copyright">
			Copyright &copy; <?php echo(date('Y')); ?> Steven Benner. Except where otherwise noted, content on this site is licensed under a <a href="http://creativecommons.org/licenses/by-sa/3.0/us/" rel="license nofollow">Creative Commons Attribution-Share Alike 3.0 United States License</a>.
		</p>
	</div>

<?php wp_footer(); ?>

	<!-- global scripts -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<?php versioned_javascript($GLOBALS['TEMPLATE_RELATIVE_URL'].'js/scripts.js'); ?>

</body>

<!-- $ <?php echo $_SERVER['REQUEST_URI']; ?> - <?php echo get_num_queries(); ?> - <?php echo timer_stop(0, 5); ?> - <?php echo date(DATE_W3C); ?> $ -->

</html>
