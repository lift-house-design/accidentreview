<?php
/**
 * Template Name: Page 3 Column Template
 */
?>
<?php get_header(); ?>

	<?php if(have_posts()): the_post(); ?>
	<div class="content box">
		<?php echo '<h2>'.get_the_content().'</h2>'; ?>
	</div>

<div class="page-col-left">
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'wpcf-page-left-column', true));?>
</div>

<div class="page-col-center">
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'wpcf-page-center-column', true)); ?>
</div>

<div class="page-col-right">
<?php echo apply_filters('the_content',get_post_meta($post->ID, 'wpcf-page-right-column', true)); ?>
</div>

<?php endif; ?>
<?php get_footer(); ?>