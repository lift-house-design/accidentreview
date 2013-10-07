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
	<?php if(preg_match('/dashboard\/assignments\/new-assignment/',$_SERVER['REQUEST_URI'],$matches)): ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory') ?>/style.css" />
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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
	<?php endif; ?>
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
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/style.css" />
	<meta name="author" content="Nick Niebaum (nickniebaum@gmail.com)" />
</head>
<body>


		<div id="header">
	<div class="wrapper">
			<a id="logo" href="/"><h1>Accident Review</h1></a>



<div id="header-login">	
	
	<?php if(is_user_logged_in()): ?>
<div class="text">			Welcome, <a href="/dashboard/account-info" class="username"><?php echo $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']; ?></a></div>
		<?php else: ?>

<div class="text">
Secure Log In
</div>
	<?php endif; ?>

<div class="agent-login-form">
<form class="accident-form" action="/dashboard/login" method="post">

<input class="ui-corner-all" type="text" value="E-mail" name="email" onfocus="if (this.value == 'E-mail') {this.value = '';}" onblur="if (this.value == '') {this.value = 'E-mail';}" />
<span id="div1">

<input class="ui-corner-all" name="pass_temp" type="text" value="Password" onfocus="changeBox()" />
</span>
<span id="div2" style="display:none">

<input class="ui-corner-all" name="password" id="password" type="password" value="" onfocus="changeBox()" />
</span>

<input type="hidden" name="submit_login" />

<input id="submit_login_image" value="" name="submit_login_image" type="submit" />
</form>
<?php if(isset($_SESSION['agent_user_id'])) : ?>
<a href="/dashboard/login?do=logout">Logout</a>
<?php endif; ?>
</div>
</div>



</div>
		
		
		</div><!-- End Header -->

	<div class="wrapper">

<!-- This clears all floats -->
			<div class="clear"></div>
			<div id="access" class="omega">
                <?php wp_nav_menu( array( 'container_class' => 'menu', 'menu_class' => 'sf-menu', 'theme_location' => 'primary' ) ); ?>
            </div><!-- #access -->







		<div id="content">