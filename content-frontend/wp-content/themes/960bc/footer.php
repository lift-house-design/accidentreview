	</div><!-- end wrapper -->
	
	<!-- Placing the footer div outside the grid system allows for a full width footer -->
	<div id="footer">
	
		<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide -->
		<div class="container_12">
		
			<div id="footerContent" class="grid_12">
				<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
				<p>
					<?php bloginfo('name'); ?> is proudly powered by
					<a href="http://wordpress.org/">WordPress</a>
					<br /><a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
					and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.
					<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
				</p>
			</div><!-- end footerContent -->
			
		</div><!-- end container -->
		
		<!-- This clears all floats -->
		<div class="clear">&nbsp;</div>
		
	</div><!-- end footer -->

<?php wp_footer(); ?>

</div><!-- end page -->
	
</body>
</html>