<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>
	<!-- The class "grid_4" sets the sidebar to be 4 columns wide and "prefix_1" sets one empty column before the sidebar for spacing -->
    <div id="sidebar-primary" class="sidebar grid_4">
    
    	<?php if ( is_active_sidebar( 'contact-sidebar' ) ) : ?>
    
    		<?php dynamic_sidebar( 'contact-sidebar' ); ?>
    
    	<?php else : ?>
    
    		<!-- Create some custom HTML or call the_widget().  It's up to you. -->
    
    	<?php endif; ?>
    
    </div>
	<div class="clear">&nbsp;</div>

