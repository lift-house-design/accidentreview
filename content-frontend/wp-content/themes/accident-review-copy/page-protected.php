<?php
/**
 * Template Name: Protected Page Template
 */
?>
<?php get_header('protected'); ?>

	<!-- The class "grid_7" restricts the div to 7 columns wide -->
	<div id="main">
            <p class="breadcrumb" id="replaceme"></p>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div id="sidebar"><?php 
            //$location = get_permalink();
            $location = $_SERVER['REQUEST_URI'];
            $urlchunks = explode('/',$location);
            if($urlchunks['1'] == 'reps' && $urlchunks['2'] == 'tech-aar') $location = '/reps/tech-aar/';


            switch ($location){
                
                case "/reps/home/":
                    dynamic_sidebar('rep-home-left-sidebar');
                    break;
                
                case '/reps/support/':
                    echo '<div id="infobar">';
                    dynamic_sidebar('rep-support-left-sidebar');
                    echo '</div>';
                    
                    break;
                case '/reps/tech-aar/':
                    $info = get_post_meta($post->ID,'Sidebar-Info');
                    echo '<div id="infobar">';
                    if(!empty($info)) echo '<ul class="bio-sidebar">'.$info[0].'</ul>';
                    echo '</div>';
                    
                    break;
                case "/reps/dashboard/":
					var_dump($_SERVER);
					break;
            }
            ?>

</div>
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