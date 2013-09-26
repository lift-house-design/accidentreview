<?php
/**
 * Template Name: Default Template (DEV)
 */
?>
<?php get_header('default'); ?>
<?php //if(is_front_page()): ?>
<?php if(get_the_ID()==1015): // @TODO: Replace with line above before going to production ?>
	<?php if(have_posts()): the_post(); ?>
	<div class="content box">
		<?php the_content(); ?>
	</div>
		<?php
			$child_pages=get_posts(array(
				'post_parent'=>get_the_ID(),
				'post_type'=>'page',
				'post_status'=>'publish',
				'orderby'=>'id',
				'order'=>'asc',
			));
		?>
		<?php foreach($child_pages as $page): ?>
			<div class="heading box"><h2><a name="<?php echo $page->post_name ?>"></a><?php echo $page->post_title ?></h2></div>
			<div class="content box"><?php echo $page->post_content ?></div>
		<?php endforeach; ?>
	<?php endif; ?>
<?php else: ?>
	<?php if(have_posts()): while(have_posts()): the_post(); ?>
	<div class="heading box">
		<h2><?php the_title(); ?></h2>
	</div>
	<div class="content box">
		<?php the_content(); ?>
	</div>
	<?php endwhile; endif; ?>
<?php endif; ?>
<?php get_footer('default'); ?>