<?php
/**
 * Template Name: Report Page Template
 */
?>
<?php
            if((isset($_GET['report'])) && (isset($_GET['id'])) && ($_GET['report'] == 'print')){
                $id = $_GET['id'];
                $filename = str_replace(' ','',str_replace('--', '_', accident_get_job_name($id))).'.pdf';

                $the_pdf = accident_get_pdf($id,$filename); 
            }

            get_header('report'); 

            ?>

	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<div id="main">
            <p class="breadcrumb" id="replaceme"></p>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="sidebar"><?php 

            ?></div>
            <div id="content">
		
		<div class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<div class="entry">
                            
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                            
			</div><!-- end entry -->                
		</div><!-- end post -->
            </div>
                <div class="cl"></div>
		
	</div><!-- end content -->
    <?php endwhile; endif; ?>

<br class="clear" />
<div id="footer-push"></div>
<?php get_footer('protected'); ?>