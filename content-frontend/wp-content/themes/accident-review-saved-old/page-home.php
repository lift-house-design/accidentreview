<?php
/**
 * Template Name: Home Page Template
 */
?>
<?php get_header('home'); ?>

	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<div id="home-content" class="grid_12 container_12 alpha omega">
        <div id="home-content-left">
            
            <?php 
                $left_block = get_page_by_path('home/block-left');
                echo '<h4>'.$left_block->post_title;
                echo '</h4>
                    <div class="callout-background"></div>
                    <div class="callout-content">';
                echo $left_block->post_content .'</div>';

            ?>  

            <div class="overlay"></div>
        </div>

            <div id="home-content-centerleft">
            
            <?php 
                $centerleft_block = get_page_by_path('home/block-centerleft');
                echo '<h4>'.$centerleft_block->post_title;
                echo '</h4>
                    <div class="callout-background"></div>
                    <div class="callout-content">';
                echo $centerleft_block->post_content .'</div>';
            ?>  

            <div class="overlay"></div>
        </div>
            <div id="home-content-centerright">
            
            <?php 
                $centerright_block = get_page_by_path('home/block-centerright');
                echo '<h4>'.$centerright_block->post_title;
                echo '</h4>
                    <div class="callout-background"></div>
                    <div class="callout-content">';
                echo $centerright_block->post_content .'</div>';
            ?>  

            <div class="overlay"></div>
        </div>
        <div id="home-content-right">
            
            <?php 
                $right_block = get_page_by_path('home/block-right');
                echo '<h4>'.$right_block->post_title;
                echo '</h4>
                    <div class="callout-background"></div>
                    <div class="overlay"></div>
                    <div class="callout-content">';
                echo $right_block->post_content .'</div>';
            ?>           
            
        </div>
	</div><!-- end content -->
   <div class="clear" ></div>
<?php //get_sidebar(); ?>

<?php get_footer(); ?>