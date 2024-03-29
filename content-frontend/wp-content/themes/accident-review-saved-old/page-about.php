<?php
/**
 * Template Name: About Page Template
 */
?>
<?php get_header(); ?>

	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<div id="about-us-content" >

       
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="about-us-content-top">	
				<?php the_content(); ?>
			</div><!-- end entry -->		
		<?php endwhile; endif; ?>



        <div id="about-us-content-left">
            
            <?php 
                $left_block = get_page_by_path('about-us/block-left');

               
                    
                    echo '<div class="callout-content">';
                echo $left_block->post_content .'</div>';

            ?>  

            
        </div>

            <div id="about-us-content-center">
            
            <?php 
                $center_block = get_page_by_path('about-us/block-center');

                                 
                    echo '<div class="callout-content">';
                echo $center_block->post_content .'</div>';
            ?>  

            
        </div>
            <div id="about-us-content-right">
            
            <?php 
                $right_block = get_page_by_path('about-us/block-right');

                                
                    echo '<div class="callout-content">';
                echo $right_block->post_content .'</div>';
            ?>             
        </div>



        

    <div class="clear" > </div>
       <div id="about-us-content-bottom">

<?php 
                $bottom_block = get_page_by_path('about-us/block-bottom');
                //echo '<h4>'.$bottom_block->post_title.'</h4>';                    
                    echo '<div class="callout-content">';
                echo $bottom_block->post_content .'</div>';
            ?>             
</div>

	</div><!-- end  content -->
<?php // get_sidebar('about'); ?>
<div class="clear" ></div>
<?php get_footer(); ?>