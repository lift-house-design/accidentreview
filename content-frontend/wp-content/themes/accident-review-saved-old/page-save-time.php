<?php
/**
 * Template Name: Save Time Page Template
 */
?>
<?php get_header(); ?>

	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<div id="save-time-and-money-content" >

       
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div id="save-time-and-money-content-top">
				<?php the_content(); ?>
			</div><!-- end entry -->		
		<?php endwhile; endif; ?>

        <div id="save-time-and-money-content-left">
            
            <?php 
                $left_block = get_page_by_path('save-time-and-money/block-left');
                echo '<h4>'.$left_block->post_title;
                echo '</h4>
                    
                    <div class="callout-content">';
                echo $left_block->post_content .'</div>';

            ?>  

            
        </div>

            <div id="save-time-and-money-content-center">
            
            <?php 
                $center_block = get_page_by_path('save-time-and-money/block-center');
                echo '<h4>'.$center_block->post_title;
                echo '</h4>                    
                    <div class="callout-content">';
                echo $center_block->post_content .'</div>';
            ?>  

            
        </div>
            <div id="save-time-and-money-content-right">
            
            <?php 
                $right_block = get_page_by_path('save-time-and-money/block-right');
                echo '<h4>'.$right_block->post_title;
                echo '</h4>                    
                    <div class="callout-content">';
                echo $right_block->post_content .'</div>';
            ?>             
        </div>



        

    <div class="clear" > </div>
       <div id="save-time-and-money-content-bottom">

<?php 
                $bottom_block = get_page_by_path('save-time-and-money/block-bottom');
                //echo '<h4>'.$bottom_block->post_title;
                echo '</h4>                    
                    <div class="callout-content">';
                echo $bottom_block->post_content .'</div>';
            ?>             
</div>

	</div><!-- end  content -->


<?php //get_sidebar(); ?>

<?php get_footer(); ?>