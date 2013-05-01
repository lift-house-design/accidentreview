<?

add_action('admin_menu', 'accident_theme_page');
function accident_theme_page ()
{
	if ( count($_POST) > 0 && isset($_POST['accident_settings']) )
	{
		$options = array (
		'start_page',
		'job_type_page',
        'file_upload_page',
        'home_page_copy',
        'bios_page',
        'contact_addresses'
		);

		foreach ( $options as $opt )
		{
			delete_option ( 'hi_accident_'.$opt, $_POST['hi_accident_'.$opt] );
			add_option ( 'hi_accident_'.$opt, $_POST['hi_accident_'.$opt] );
		}

	}
	add_menu_page(__('Accident Options'), __('Accident Options'), 'edit_themes', basename(__FILE__), 'accident_settings');
	add_submenu_page(__('Accident Options'), __('Accident Options'), 'edit_themes', basename(__FILE__), 'accident_settings');
}
function accident_settings(){
?>
<div class="wrap">
	<h2>Accident Review Options Panel</h2>
	
<form method="post" action="">
    <input type="hidden" name="accident_settings" value="1" />
	<?php  ?>

	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>General Settings</strong></legend>
	<table class="form-table">
		<!-- General settings -->
		<tr valign="top">
			<th scope="row"><label for="hi_sippican_home_images">No Settings Yet</label></th>
			<td>
                &nbsp;
			</td>
		</tr>
		
	</table>
	</fieldset>
	
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="sippican_settings" value="save" style="display:none;" />
		</p>
    
    
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Submit Assignment Content</strong></legend>
	<table class="form-table">
		<!-- General settings -->
		<tr valign="top">
			<th scope="row"><label for="hi_accident_start_page">Start Page</label></th>
			<td>
				<?php wp_dropdown_pages("name=hi_accident_start_page&show_option_none=".__('- Select -')."&selected=" .get_option('hi_accident_start_page')); ?>
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="hi_accident_job_type_page">Assignment Type Page</label></th>
			<td>
				<?php wp_dropdown_pages("name=hi_accident_job_type_page&show_option_none=".__('- Select -')."&selected=" .get_option('hi_accident_job_type_page')); ?>
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="hi_accident_job_type_page">File Upload Page</label></th>
			<td>
				<?php wp_dropdown_pages("name=hi_accident_file_upload_page&show_option_none=".__('- Select -')."&selected=" .get_option('hi_accident_file_upload_page')); ?>
			</td>
		</tr>
        <tr valign="top">
			<th scope="row"><label for="hi_accident_bios_page">Bios Folder</label></th>
			<td>
				<?php wp_dropdown_pages("name=hi_accident_bios_page&show_option_none=".__('- Select -')."&selected=" .get_option('hi_accident_bios_page')); ?>
			</td>
		</tr>
	</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="boldy_settings" value="save" style="display:none;" />
	</p>
        
        
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Support/Contact Settings</strong></legend>
	<table class="form-table">
		<!-- General settings -->
		<tr valign="top">
			<th scope="row"><label for="hi_accident_contact_addresses">Comma-separated List of Email Addresses to Contact</label></th>
			<td>
				<textarea name="hi_accident_contact_addresses" cols="100" rows="3"><?php echo stripslashes(get_option('hi_accident_contact_addresses')); ?></textarea>
			</td>
		</tr>
	</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="boldy_settings" value="save" style="display:none;" />
	</p>
    
    
    <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
	<legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>Home Page Settings</strong></legend>
	<table class="form-table">
		<!-- General settings -->
		<tr valign="top">
			<th scope="row"><label for="hi_accident_home_page_copy">Home Page Copy</label></th>
			<td>
                <textarea name="hi_accident_home_page_copy" cols="100" rows="5"><?php echo stripslashes(get_option('hi_accident_home_page_copy')); ?></textarea>
			</td>
		</tr>
	</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="Save Changes" />
		<input type="hidden" name="boldy_settings" value="save" style="display:none;" />
	</p>
</form>
</div>
<?    
}


add_action('admin_head','fix_hidden_quicktags');

function fix_hidden_quicktags(){
    ?>
    <script type="text/javascript">
        (function($,undefined){
            setTimeout(function(){
                $('#quicktags').show();
            },1500)
        })(jQuery);
    </script>
    <?
}
?>