<?php
/**
 * Template Name: The Experts Page Template
 */
?>
<?php get_header(); ?>
	<div class="content box">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="the-experts-content-top">
				<?php the_content(); ?>
			</div><!-- end entry -->		
		<?php endwhile; endif; ?>
     </div>
	<div id="the-experts-content-page" >
       <div class="the-experts-content">

             <?php 
                $content_block = get_page_by_path('the-experts/the-experts-dennis-lyons-summary'); 
                 echo get_the_post_thumbnail(  $content_block->ID ); ?>
                 <div class="the-experts-content-text">   
                 <?php echo '<strong>'.$content_block->post_title.'</strong>' ; ?>                              
                <?php echo $content_block->post_content ; ?>
                </div>
                 
       </div>

        <div class="the-experts-content">
          <?php 
                $content_block = get_page_by_path('the-experts/the-experts-christopher-borelli-summary');                   
                echo get_the_post_thumbnail(  $content_block->ID );  ?> 
               <div class="the-experts-content-text">  
                <?php echo '<strong>'.$content_block->post_title.'</strong>' ; ?>                              
                <?php echo $content_block->post_content ; ?>
                </div>
                          
        </div>    
    <div class="clear" > </div>



 <div class="the-experts-content">

             <?php 
                $content_block = get_page_by_path('the-experts/the-experts-robert-j-paulino-summary'); 
                 echo get_the_post_thumbnail(  $content_block->ID ); ?>
                 <div class="the-experts-content-text">   
                  <?php echo '<strong>'.$content_block->post_title.'</strong>' ; ?>                             
                <?php echo $content_block->post_content ; ?>
                </div>
                 
       </div>

        <div class="the-experts-content">
          <?php 
                $content_block = get_page_by_path('the-experts/the-experts-louis-peck-summary');                   
                echo get_the_post_thumbnail(  $content_block->ID );  ?> 
               <div class="the-experts-content-text"> 
                <?php echo '<strong>'.$content_block->post_title.'</strong>' ; ?>                               
                <?php echo $content_block->post_content ; ?>
                </div>
                          
        </div>    
    <div class="clear" > </div>



 <div class="the-experts-content">

             <?php 
                $content_block = get_page_by_path('the-experts/the-experts-james-siegfried-summary'); 
                 echo get_the_post_thumbnail(  $content_block->ID ); ?>
                 <div class="the-experts-content-text"> 
                  <?php echo '<strong>'.$content_block->post_title.'</strong>' ; ?>                               
                <?php echo $content_block->post_content ; ?>
                </div>
                 
       </div>

       
    <div class="clear" > </div>


       
	</div><!-- end  content -->
<div class="clear" ></div>
<?php get_footer(); ?>