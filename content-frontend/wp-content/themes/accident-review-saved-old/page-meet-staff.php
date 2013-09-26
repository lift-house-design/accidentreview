<?php
/**
 * Template Name: Meet Staff Page Template
 */
?>
<?php get_header(); ?>

	<div id="meet-staff-content-page" >


	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="meet-staff-content-top">
				<?php the_content(); ?>
			</div><!-- end entry -->		
		<?php endwhile; endif; ?>


       <div class="meet-staff-content">

             <?php 
                $content_block = get_page_by_path('meet-our-experts/meet-our-experts-dennis-lyons-summary'); 
                 echo get_the_post_thumbnail(  $content_block->ID ); ?>
                 <div class="meet-staff-content-text">                                 
                <?php echo $content_block->post_content ; ?>
                </div>
                 
       </div>

        <div class="meet-staff-content">
          <?php 
                $content_block = get_page_by_path('meet-our-experts/meet-our-experts-christopher-borelli-summary');                   
                echo get_the_post_thumbnail(  $content_block->ID );  ?> 
               <div class="meet-staff-content-text">                                 
                <?php echo $content_block->post_content ; ?>
                </div>
                          
        </div>    
    <div class="clear" > </div>



 <div class="meet-staff-content">

             <?php 
                $content_block = get_page_by_path('meet-our-experts/meet-our-experts-robert-j-paulino-summary'); 
                 echo get_the_post_thumbnail(  $content_block->ID ); ?>
                 <div class="meet-staff-content-text">                                 
                <?php echo $content_block->post_content ; ?>
                </div>
                 
       </div>

        <div class="meet-staff-content">
          <?php 
                $content_block = get_page_by_path('meet-our-experts/meet-our-experts-louis-peck-summary');                   
                echo get_the_post_thumbnail(  $content_block->ID );  ?> 
               <div class="meet-staff-content-text">                                 
                <?php echo $content_block->post_content ; ?>
                </div>
                          
        </div>    
    <div class="clear" > </div>



 <div class="meet-staff-content">

             <?php 
                $content_block = get_page_by_path('meet-our-experts/meet-our-experts-james-siegfried-summary'); 
                 echo get_the_post_thumbnail(  $content_block->ID ); ?>
                 <div class="meet-staff-content-text">                                 
                <?php echo $content_block->post_content ; ?>
                </div>
                 
       </div>

       
    <div class="clear" > </div>


       
	</div><!-- end  content -->
<div class="clear" ></div>
<?php get_footer(); ?>