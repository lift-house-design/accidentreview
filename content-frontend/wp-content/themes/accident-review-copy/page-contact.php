<?php
/**
 * Template Name: Contact Us Page Template
 */
?>
<?php get_header(); ?>

  <div id="with-sidebar-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
			<div class="entry">
				<?php the_content(); ?>
			</div><!-- end entry -->
		
		<?php endwhile; endif; ?>
<?php get_sidebar('contact'); ?>
</div>


<div class="clear" ></div>
<?php get_footer(); ?>