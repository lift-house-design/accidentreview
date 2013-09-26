<?php
/**
 * Template Name: User Login Page Template
 */
?>
<?php get_header(); ?>

  <div id="full-width-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
			<div class="entry">

<?php $status = $_GET['do'];
if ($status != 'logoutsuccess') {  ?>



				<?php the_content(); ?>

<?php } else { ?>
<h3>You are now logged out.</h3>
<?php }  ?>
			</div><!-- end entry -->
		
		<?php endwhile; endif; ?>



<?php // get_sidebar('about'); ?>
</div>
<div class="clear" ></div>
<?php get_footer(); ?>