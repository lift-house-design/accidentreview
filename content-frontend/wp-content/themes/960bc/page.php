<?php get_header(); ?>

	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<div id="content" class="grid_7">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div><!-- end entry -->
			
		</div><!-- end post -->
		
		<?php endwhile; endif; ?>
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		
	</div><!-- end content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>