<?php
/**
 * Template Name: Full Width (No Title) Page Template
 */
?>
<?php get_header(); ?>

  <div id="full-width-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			<div class="entry">
				<?php the_content(); ?>
			</div><!-- end entry -->
		
		<?php endwhile; endif; ?>

</div>

<?php // get_sidebar('about'); ?>
<div class="clear" ></div>
<?php get_footer(); ?>