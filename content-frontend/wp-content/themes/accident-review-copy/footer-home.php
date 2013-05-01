	</div><!-- end wrapper -->
</div><!-- end page -->	
</div>
	<!-- Placing the footer div outside the grid system allows for a full width footer -->
	<div id="footer">
	
		<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide -->
		<div class="container_12">
            <div id="copyright">
                Copyright &copy; <?php echo date('Y'); ?>. Accident Review. 
            </div>
			<?php wp_nav_menu( array( 'container_class' => 'footermenu', 'theme_location' => 'footer' ) ); ?>
		</div><!-- end container -->
		<script type="text/javascript">
            $(function(){ 
                $('#footer .footermenu ul li:last-child').css({'borderRight':'none'}); 
                
                $('#home-content #home-content-right .callout-content').jScrollPane();
            });
        </script>
		<!-- This clears all floats -->
		<div class="clear">&nbsp;</div>
		
	</div><!-- end footer -->

<?php wp_footer(); ?>


	
</body>
</html>