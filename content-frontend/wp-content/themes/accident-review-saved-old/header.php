<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Dynamic Title Tag Optimized for Search Engine Visibility -->
<title><?php if (is_front_page()) {
		bloginfo('description');
		} elseif (is_search()) {
		bloginfo('name');?> &raquo; Search Results for: <?php echo wp_specialchars($s, 1);
		} else {
		wp_title('',true); ?> &#8212; <?php bloginfo('name');
		} ?></title>


<!-- These two lines call the css files essential for the 960 grid system - DO NOT REMOVE!! -->


<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Sans+Mono|Droid+Serif:400,700,400italic,700italic|Muli:300,400,300italic,400italic" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!-- Conditional comments for IE. Use ie7.css and ie6.css for custom css for Internet Explorer version 7 and 6 if necessary. -->
	<!--[if IE 7]>
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_directory'); ?>/ie7.css );
	</style>
	<![endif]-->	
	<!--[if IE 6]>
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_directory'); ?>/ie6.css );
	</style>
	<![endif]-->	
	
<!-- uncomment the following style to view the grid as a background image -->
	<!--
	<style type="text/css" media="all">
	.container_12
	{
		background: #fff url(<?php bloginfo('stylesheet_directory'); ?>/images/12_col.gif) repeat-y;
	}
	.container_16
	{
		background: #fff url(<?php bloginfo('stylesheet_directory'); ?>/images/16_col.gif) repeat-y;
	}
	</style>
	-->

<script language="javascript">
 function changeBox()
 {
    document.getElementById('div1').style.display='none';
    document.getElementById('div2').style.display='';
    document.getElementById('password').focus();
 }
 function restoreBox()
 {
    if(document.getElementById('password').value=='')
    {
      document.getElementById('div1').style.display='';
      document.getElementById('div2').style.display='none';
    }
 }
</script>	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>	
<?php wp_head(); ?>
</head>
<body>
<div id="whitewrapper">
<div id="page">

	<!-- Placing the header div outside the grid system allows for a full width header -->
	<div id="header">
		
		<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide -->
		<!-- If you need a 16 column grid use the class "container_16" to restrict the grid to 16 columns and a total of 960px wide and adjust the rest of your divs accordingly -->
		<!-- EG: If you change this div "conatiner_16" then the #wrapper div and the div between #footer and #footerContent should also be "grid_16". Your main content and sidebar divs should then equal 16 columns including any prefix and/or suffix columns -->
		<div class="container_12">
        <?php if(isset($_SESSION['agent_user_id'])) : ?>
             <div id="welcomelink">
                <a href="/reps/home/">
                    Welcome, <?php echo $_SESSION['agent_user_name']; ?>
                </a>
            </div> 
            <?php endif; ?>



           <!-- <div id="loginlink">
                <?php if(isset($_SESSION['agent_user_id'])) : ?>
                <a href="/reps/login?do=logout">Logout&nbsp;<strong>&gt;</strong></a>
                <?php else : ?>
                <a href="/reps/login">Login&nbsp;<strong>&gt;</strong></a>
                <?php endif; ?>
            </div> -->


<div id="header-login">	
Secure Log In
<?php //echo do_shortcode('[agent-login-form type=login]'); ?>
<div class="agent-login-form">
<form class="accident-form" action="http://www.accidentreview.com/reps/login" method="post">
<input class="ui-corner-all" type="text" value="Username" name="username" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}" />


<span id="div1">
<input class="ui-corner-all" name="pass_temp" type="text" value="Password" onfocus="changeBox()" />
</span>
<span id="div2" style="display:none">
<input class="ui-corner-all" name="password" id="password" type="password" value=""onBlur="restoreBox()" />
</span>

<input type="hidden" name="submit_login" />
<input id="submit_login_image" value="" name="submit_login_image" type="submit" />
</form>
<?php if(isset($_SESSION['agent_user_id'])) : ?>
<a href="/reps/login?do=logout">Logout</a>
<?php endif; ?>
</div>
</div>







			<!-- The class "grid_12" restricts the div to 12 columns wide -->
			<div id="headerimg" class="grid_4 alpha">
				<h2><a href="<?php echo get_option('home'); ?>/"><span><?php bloginfo('name'); ?></span></a></h2>				
			</div><!-- end headerimg -->
			
			<!-- skip to content and menu links - these are hidden with screen reader friendly css for accessibility -->
			<div id="skip">
			<p><a href="#wrapper" title="skip to main content">skip to main content</a></p>
			<p><a href="#main-menu" title="skip to main menu">skip to main menu</a></p>
			</div><!-- end skip -->
            
            


			<!-- This clears all floats -->
			<div class="clear"></div>
		
		</div><!-- end headerContainer -->
		
	</div><!-- end header -->
<!-- This clears all floats -->
			<div class="clear">;</div>
			<div id="access" class="omega">
                <?php wp_nav_menu( array( 'container_class' => 'menu', 'menu_class' => 'sf-menu', 'theme_location' => 'primary' ) ); ?>
            </div><!-- #access -->

	<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide. Placing the wrapper div in the header.php file allows for easy editing of individual page templates without upsetting the grid. This div is closed in the footer.php file -->
	<div id="wrapper" class="container_12">