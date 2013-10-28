<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
	<?php bloginfo('name'); ?> |
	<?php
		if(is_front_page()) bloginfo('description');
		elseif(is_search()) echo 'Search results for "'.wp_specialchars($s, 1).'"';
		else wp_title('');
	?>
	</title>

	<!-- 2013 and Internet Explorer is still terrible -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/normalize.css" />
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/style.css" />
	<!--[if IE]><script src="<?php bloginfo('stylesheet_directory') ?>/js/IE9.js"></script><![endif]-->

	<?php if(preg_match('/dashboard\/assignments\/new-assignment/',$_SERVER['REQUEST_URI'],$matches)): ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/style-protected.css" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/accident-jqueryui-theme/jquery-ui-1.8.15.custom.css?ver=3.2.1" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/chosen/chosen.css?ver=3.2.1" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/chosen/chosen.jquery.min.js?ver=3.2.1" />
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/lib/uploadify/uploadify.css?ver=3.2.1" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js?ver=3.2.1"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.15/jquery-ui.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/js/accident-review.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/tablesorter/jquery.metadata.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/tablesorter/jquery.tablesorter.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/js/autoresize.jquery.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/uploadify/swfobject.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/uploadify/jquery.uploadify.min.js?ver=3.2.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/lib/plupload/plupload.full.js?ver=3.1.1"></script>
		<script src="<?php bloginfo('stylesheet_directory') ?>/js/plupload.js?ver=3.2.1"></script>
		
	<?php else: ?>
		<script src="/wp-content/themes/accident-review/js/jquery-1.9.1.min.js"></script>
		<script src="/wp-content/themes/accident-review/js/jquery-ui-1.10.2.min.js"></script>
	<?php endif; ?>
	
	<script src="/wp-content/themes/accident-review/js/placeholder-shiv.jquery.js"></script>
</head>
<body id='home'>

<? if(!empty($_SESSION['user']['first_name'])){ ?>
	<div id="top-panel">
		<div class="wrapper">
			Welcome, 
			<a href="/dashboard/account-info" class="username" style="margin-right:10px">
				<?php echo $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']; ?>
			</a>
		</div>
	</div>
<? } ?>

<div style="display:none" class="debug">
	is_logged_in(): <?var_dump(is_logged_in());?>
	is_user_logged_in(): <?var_dump(is_user_logged_in());?>
	$_SESSION: <?var_dump($_SESSION['user']);?>
</div>

<div id="header">
	<div class="wrapper">
		<a id="logo" href="/"><h1>Accident Review</h1></a>
		<? if(!empty($_SESSION['user']['first_name'])){ ?>
			<div id="account-options" style="margin-right:10px">
				<a href="/dashboard/">Dashboard</a>
				<a href="/dashboard/assignments">Assignments</a>
				<a href="/dashboard/account-info">Manage Account</a>
				<a href="/dashboard/logout">Logout</a>
			</div>
		<? }else{ ?>
			<div id="header-login">	
				<div class="text">
					Secure Log In
					<a href="/dashboard/login/?reset_form=1" style="font-size:12px;float:right;border-bottom:1px solid color:rgb(10, 44, 121)">Forgot Your Password?</a>
				</div>
				<div class="agent-login-form">
					<form class="accident-form" action="/dashboard/login" method="post">
						<!--input class="ui-corner-all" type="text" value="E-mail" name="email" onfocus="placeHolder(this,'E-mail','text')" onblur="placeHolder(this,'E-mail','text')" style="top:0px;left:0px;height: 21px;width:152px;padding: 0px 4px;line-height:21px;"/-->
						<input placeholder="E-mail" class="ui-corner-all" type="text" name="email" style="top:0px;left:0px;height: 21px;width:152px;padding: 0px 4px;line-height:21px;"/>
						<!--input class="ui-corner-all" name="password" id="password" type="password" value="Password" onfocus="placeHolder(this,'Password','password')" onblur="placeHolder(this,'Password','text')" style="top:0px;left:170px;height: 21px;width:152px;padding: 0px 4px;line-height:21px;"/-->
						<input placeholder="Password" class="ui-corner-all" name="password" id="password" type="password" style="top:0px;left:170px;height: 21px;width:152px;padding: 0px 4px;line-height:21px;"/>
						<input type="hidden" name="submit_login" />
						<input id="submit_login_image" value="" name="submit_login_image" type="submit" style="top:0px;left:340px;width:71px"/>
					</form>
				</div>
			</div>
		<? } ?>
	</div>		
</div><!-- end header -->

<div class="wrapper">
	<!-- This clears all floats -->
	<div class="clear"></div>
		<div id="access" class="omega">
            <?php wp_nav_menu( array( 'container_class' => 'menu', 'menu_class' => 'sf-menu', 'theme_location' => 'primary' ) ); ?>
        </div><!-- #access -->


		<div id="home-top" class="container_12">        
        	<div id="home-top-copy" class="">
				<!-- For using the page content rather than the sldier -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div id="home-top-content">
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>
				<div id="home-top-image"></div>
			</div>
			<div id="home-sidebar">
            	<? $home_sidebar = get_page_by_path('home/homesidebar'); ?>
                <h4><?= $home_sidebar->post_title ?></h4>
                <div id="homesidebar-text">
                	<?= do_shortcode( $home_sidebar->post_content ) ?>
               	</div>
        	</div>
        </div>
		<div class="clear"></div>