	</div><!-- end wrapper -->
</div><!-- end page -->	
</div>
	<!-- Placing the footer div outside the grid system allows for a full width footer -->
	<div id="footer">
	
		<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide -->
		<div class="container_12">
            <div id="copyright">
                Copyright &copy; <?php echo date('Y'); ?>. Accident Review.com 
            </div>
			<span>Questions?</span><?php wp_nav_menu( array( 'container_class' => 'footermenu', 'theme_location' => 'footer' ) ); ?>
		</div><!-- end container -->
		<script type="text/javascript">
            $(function(){ 
                $('#footer .footermenu ul li:last-child').css({'borderRight':'none'}); 
            });
        </script>
		<!-- This clears all floats -->
		<div class="clear">&nbsp;</div>
		
	</div><!-- end footer -->


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
	<?php
		$olark_site_id='6050-363-10-7773';
	?>
	<!-- begin olark code -->
	<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
	f[z]=function(){
	(a.s=a.s||[]).push(arguments)};var a=f[z]._={
	},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
	f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
	0:+new Date};a.P=function(u){
	a.p[u]=new Date-a.p[0]};function s(){
	a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
	hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
	return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
	b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
	b.contentWindow[g].open()}catch(w){
	c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
	var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
	b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
	loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('<?php echo $olark_site_id ?>');/*]]>*/</script><noscript><a href="https://www.olark.com/site/<?php echo $olark_site_id ?>/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
	<!-- end olark code -->
</body>
</html>