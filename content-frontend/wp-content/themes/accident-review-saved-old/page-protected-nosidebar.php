<?php
/**
 * Template Name: Protected Page Template (no sidebar)
 */
?>
<?php get_header('protected'); ?>
	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<style>
		#content {
			width: auto;
			position: inherit;
			float: none;
			display: block;
		}
	</style>
	<div id="main">
        <?php if (have_posts()): ?>
			<?php while (have_posts()): ?>
				<?php the_post(); ?>
				<div id="content">
					<div class="post" id="post-<?php the_ID(); ?>">
						<h2><?php the_title(); ?></h2>
						<div class="entry">
							<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
							<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						</div><!-- end entry -->
					</div><!-- end post -->
					<div class="cl"></div>
				</div><!-- end content -->
    		<?php endwhile; ?>
		<?php endif; ?>
		<br class="clear" />
		<div id="footer-push"></div>
<?php get_footer('protected'); ?>