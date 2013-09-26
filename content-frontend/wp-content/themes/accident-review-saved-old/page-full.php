<?php
/**
 * Template Name: Full Width Page Template
 */
?>
<?php get_header(); ?>

  <div id="full-width-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content(); ?>
			</div><!-- end entry -->
		
		<?php endwhile; endif; ?>



<?php // get_sidebar('about'); ?>
</div>
<div class="clear" ></div>
<?php get_footer(); ?>