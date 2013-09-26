	</div><!-- end wrapper -->
</div><!-- end page -->	
</div>


	<!-- Placing the footer div outside the grid system allows for a full width footer -->
	<div id="footer" class="shell">
	
		<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide -->
		<?php $footermenu = explode('|',wp_nav_menu( array( 'before' => '|', 'after' => '|', 'container' => '', 'theme_location' => 'footer', 'echo' => '0', 'items_wrap' => '%3$s' ) )); 
                echo '<p class="footercontact">'.$footermenu[1].'&nbsp&nbsp|&nbsp&nbsp'.$footermenu[3].'&nbsp&nbsp|&nbsp&nbsp'.$footermenu[5].'</p>'
                        
                        
                ?>
                <p class="footercopy">Copyright &copy; <?php echo date('Y'); ?> Accident Review.</p>
            
		<!-- end container -->
		<script type="text/javascript">
            $(function(){ 
                $('#footer .footermenu ul li:last-child').css({'borderRight':'none'}); 
            });
        </script>
		<!-- This clears all floats -->
		<div class="clear">&nbsp;</div>
		
	</div><!-- end footer -->

<?php wp_footer(); ?>
    <!-- Start of Woopra Code -->
    <script type="text/javascript">
    function woopraReady(tracker) {
        tracker.setDomain('accident-review.hollisint.com');
        tracker.setIdleTimeout(600000);
        tracker.track();
        return false;
    }
    (function() {
        var wsc = document.createElement('script');
        wsc.src = document.location.protocol+'//static.woopra.com/js/woopra.js';
        wsc.type = 'text/javascript';
        wsc.async = true;
        var ssc = document.getElementsByTagName('script')[0];
        ssc.parentNode.insertBefore(wsc, ssc);
    })();
    </script>
    <!-- End of Woopra Code -->
    <script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-27665022-1']);
      _gaq.push(['_trackPageview']);
    
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>	
</body>
</html>