<?php
/*
Plugin Name: Clickheat
Plugin URI: http://www.impressionengineers.com/wordpress/clickheat
Description: Clickheat tracking code integration for Wordpress by Impression Engineers.
Author: Impression Engineers
Author URI: http://www.impressionengineers.com/
Version: 1.0
*/ 

define('clickheat_id', 'clickheat_id', true);

function clickheat_conf() {
	if ( isset($_POST['submit']) ) {
		if ( function_exists('current_user_can') && !current_user_can('manage_options') )
			die(__('You do not have access this feature'));
			
		$clickheat_id = strip_tags(stripslashes($_POST['clickheat_id']));
			
		update_option('clickheat_id', $clickheat_id);
			
		if ( isset($_POST['clickheat_https']) )
        		update_option('clickheat_https', '1');
		else
			update_option('clickheat_https', '0');

		echo "<div id='message' class='updated fade'><p><strong>" . __('Options saved.') . "</strong></p></div>";		
	}
?>
		<form method="post" action="options-general.php?page=clickheat.php">
		<div class="wrap">
			<h2>Clickheat Options</h2>
			<fieldset class="options">
				<p><label><input name="clickheat_https" id="clickheat_https" value="1" type="checkbox" <?php if ( get_option('clickheat_https') == '1' ) echo ' checked="checked" '; ?> /> Use HTTPS tracking script (SSL enabled)</label></p>    
			</fieldset>
			<p class="submit">
				<input type="submit" name="submit" value="Update options &raquo;" />
			</p>
		</div>
		</form>
<?php }

function clickheat_config_page() {
	add_submenu_page('options-general.php', __('Clickheat'), __('Clickheat'), 5, basename(__FILE__), 'clickheat_conf');
}

add_action('admin_menu', 'clickheat_config_page');

// The Clickheat code
function add_clickheat() {
	if ( !is_user_logged_in() ) { 
?>
<!-- Clickheat code by http://www.impressionengineers.com -->
<script type="text/javascript" src="<?php if ( get_option('clickheat_https') == '1' ) echo "https://".$_SERVER['SERVER_NAME']; else echo "http://".$_SERVER['SERVER_NAME']; ?>/clickheat/js/clickheat.js"></script>
<script type="text/javascript"><!--
clickHeatSite = '<?php echo $_SERVER['SERVER_NAME']; ?>';clickHeatGroup = '<?php echo $_SERVER['REQUEST_URI']; ?>';clickHeatServer = '<?php if ( get_option('clickheat_https') == '1' ) echo "https://".$_SERVER['SERVER_NAME']; else echo "http://".$_SERVER['SERVER_NAME']; ?>/clickheat/click.php';initClickHeat(); //-->
</script>
<?php } }

add_action('wp_footer', 'add_clickheat');
?>
