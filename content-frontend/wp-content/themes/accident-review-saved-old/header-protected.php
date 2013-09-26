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


<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-protected.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style-protected-print.css" type="text/css" media="print" />

<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Sans+Mono|Droid+Serif:400,700,400italic,700italic|Muli:300,400,300italic,400italic" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script type='text/javascript' src='/wp-content/themes/accident-review/lib/plupload/plupload.full.js?ver=3.1.1'></script>


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
        
        <!--test test test-->
	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' );?>	
<?php wp_head(); ?>
</head>
<body>
<div id="whitewrapper">
<div id="page">
	
	<!-- Placing the header div outside the grid system allows for a full width header -->
	<div id="header" class="shell">
            <h1 id="logo"><a href="/reps/home" title="">AccidentReview</a></h1>
		
		<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide -->
		<!-- If you need a 16 column grid use the class "container_16" to restrict the grid to 16 columns and a total of 960px wide and adjust the rest of your divs accordingly -->
		<!-- EG: If you change this div "conatiner_16" then the #wrapper div and the div between #footer and #footerContent should also be "grid_16". Your main content and sidebar divs should then equal 16 columns including any prefix and/or suffix columns -->
		<!--<div class="shell">-->
                    <div id="header-right">
                        <p class="top-nav"><a href="/reps/account/">Account »</a><span>|</span><a href="/reps/support/">Support »</a><?php if($_SESSION['agent_user_admin']){
                                echo '<span>|</span><a href="/reps/users/">Manage Reps »</a>';
                            } ?>
                           </p>
                      <p><strong><?php echo $_SESSION['agent_rep_data']['name'].'<br />'.$_SESSION['agent_rep_data']['company_name'].'</strong>';
//echo '<br />'.$_SESSION['agent_rep_data']['street'];
                       // if(!empty($_SESSION['agent_rep_data']['state'])){
                        //	echo '<br />'.$_SESSION['agent_rep_data']['city'].', '.$_SESSION['agent_rep_data']['state'].' '.$_SESSION['agent_rep_data']['zip'];
                       // }

                        // ?>

               <!--  </p>  -->  
            <div id="loginlink">
                <?php if(isset($_SESSION['agent_user_id'])) : ?>
                <a class="logout" href="/reps/login?do=logout" >Logout&nbsp;<strong>»</strong></a>
                <?php else : ?>
                <a class="logout" href="/reps/login" >Login&nbsp;<strong>»</strong></a>
                <?php endif; ?>
            </div>

                    </div>
                </div> 	<!--end headerContainer -->   

 <div class="clear"></div>


			<div id="access" class="omega">
                <?php wp_nav_menu( array( 'container_class' => 'menu', 'menu_class' => 'sf-menu', 'theme_location' => 'protected' ) ); ?>
            </div><!-- #access -->


		
	</div><!-- end header -->
         <div class="clear"></div> 
	<div id="wrapper" class="shell">
	<!-- The class "container_12" restricts the grid to 12 columns and a total of 960px wide. Placing the wrapper div in the header.php file allows for easy editing of individual page templates without upsetting the grid. This div is closed in the footer.php file -->
