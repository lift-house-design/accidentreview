<?php /* Smarty version 2.6.16, created on 2012-08-30 16:19:14
         compiled from /var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'wrap', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 2, false),array('block', 'label', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 3, false),array('block', 'editor_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 9, false),array('block', 'lang', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 14, false),array('function', 'text_field', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 4, false),array('function', 'attach_files', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 18, false),array('function', 'select_assignees_inline', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 358, false),array('function', 'select_category', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 365, false),array('function', 'select_milestone', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 371, false),array('function', 'select_priority', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 377, false),array('function', 'select_tags', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 382, false),array('function', 'select_date', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 387, false),array('function', 'select_visibility', '/var/www/vhosts/accidentreview.com/content-backend/activecollab/application/modules/tickets/views/tickets/_ticket_form.tpl', 393, false),)), $this); ?>
<div class="form_left_col">
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'name')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketSummary','required' => true)); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_text_field(array('name' => 'ticket[name]','value' => $this->_tpl_vars['ticket_data']['name'],'id' => 'ticketSummary','class' => 'title required validate_minlength 3'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'body')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketBody')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Full description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php $this->_tag_stack[] = array('editor_field', array('name' => 'ticket[body]','id' => 'ticketBody','inline_attachments' => $this->_tpl_vars['ticket_data']['inline_attachments'])); $_block_repeat=true;smarty_block_editor_field($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start();  echo $this->_tpl_vars['ticket_data']['body'];  $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_editor_field($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php if ($this->_tpl_vars['active_ticket']->isNew()): ?>
    <div class="ctrlHolderContainer">
      <a href="#" class="ctrlHolderToggler button_add attachments"><?php $this->_tag_stack[] = array('lang', array()); $_block_repeat=true;smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attach Files<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_lang($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>...</a>
      <div class="strlHolderToggled">
      <?php $this->_tag_stack[] = array('wrap', array('field' => 'attachments')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <?php $this->_tag_stack[] = array('label', array()); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Attachments<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php echo smarty_function_attach_files(array('max_files' => 5), $this);?>

      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_job_id() != false || $this->_tpl_vars['active_ticket']->isNew()): ?>
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'accident')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <a class="toggleAccident hidden button_add" href="#">Show Accident Form</a>
    <br class="clear"/>
    <?php echo '
    <script>
        $(document).ready(function(){
            $(".toggleAccident").live("click", function(event){
                event.preventDefault();
                if($(this).hasClass("shown")){
                    $(".accident-form").hide(\'slow\');
                    $(this).html("Show Accident Form");
                }
                else{
                    $(".accident-form").show(\'slow\');
                    $(this).html("Hide Accident Form");
                }
                $(this).toggleClass("shown");
                $(this).toggleClass("hidden");
            })
        });
    </script>
    '; ?>

    <div class="accident-form" style="display:none">
    <br class="clear" />
    <div class="job_type_form">
        <label>Service Type Requested</label>
		<select name="job_type">
            <option value="0">Select a Service</option>
    		<option value="1" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis'): ?>selected="selected"<?php endif; ?>>
                Vehicle Theft Analysis
            </option>
    		<option value="2" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Accident Reconstruction'): ?>selected="selected"<?php endif; ?>>
                Accident Reconstruction
            </option>
    		<option value="3" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Fire Analysis'): ?>selected="selected"<?php endif; ?>>
                Fire Analysis
            </option>
    		<option value="4" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Mechanical Analysis'): ?>selected="selected"<?php endif; ?>>
                Mechanical Analysis
            </option>
    		<option value="5" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Physical Damage Comparison'): ?>selected="selected"<?php endif; ?>>
                Physical Damage Comparison
            </option>
    		<option value="6" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Report Review'): ?>selected="selected"<?php endif; ?>>
                Report Review
            </option>
    		<option value="7" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Other'): ?>selected="selected"<?php endif; ?>>
                Other
            </option>
		</select>
        <?php echo '
        <script type="text/javascript">
            $(function(){
                $(\'select[name="job_type"]\').bind(\'change\',function(){
                    var found_id = -1;
                    var sel_val = $(this).val();
                    var sel_text = $(this).find(\'option[value="\'+sel_val+\'"]\').text();
                    sel_text = $.trim(sel_text);
                    console.log(\'Val: \'+sel_val+\' Text: \'+sel_text);
                    $(\'#ticketParent > option\').each(function(){
                        console.log(\'Checking: \'+$(this).text());
                        if(sel_text == $(this).text()) found_id = $(this).val();    
                    });  
                    if(found_id != -1) $(\'#ticketParent\').val(found_id); 
                    else{
                        $(\'#ticketParent > option\').attr(\'selected\',\'\');
                        $(\'#ticketParent > option:eq(0)\').attr(\'selected\',\'selected\');
                    } 
                });  
            });
        </script>        
        '; ?>

    </div>
  
    <div class="common_questions">
        <h3 class="gen_info">General Information</h3>
        <div style="float:left;">
            <label for="client_file_id">Client File ID</label>
            <input type="text" name="client_file_id" id="client_file_id" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('client_file_id'); ?>
" />
        </div>
        <div style="float:left;margin-left: 20px;" class="select_date">
            <label for="date_of_loss">Date of Loss</label>
            <input name="date_of_loss" id="date_of_loss" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('date_of_loss'); ?>
" />
            <script type="text/javascript">
                Date.firstDayOfWeek = 0; 
                Date.format = 'yyyy-mm-dd'; 
                $("#date_of_loss").datePicker().dpSetStartDate("2000-01-01").dpSetEndDate("2050-01-01");
            </script>
        </div>
        <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis' || $this->_tpl_vars['active_ticket']->isNew()): ?>
        <div style="float:left;margin-left: 20px;" class="select_date">
            <label for="date_of_recovery">Date of Recovery</label>
            <input name="date_of_recovery" id="date_of_recovery" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('date_of_recovery'); ?>
" />

            <script type="text/javascript">
                Date.firstDayOfWeek = 0; 
                Date.format = 'yyyy-mm-dd'; 
                $("#date_of_recovery").datePicker().dpSetStartDate("2000-01-01").dpSetEndDate("2050-01-01");
            </script>
        </div>
        <br class="clear" />
        <label for="location_of_loss">Location of Loss</label>
        <textarea name="location_of_loss"><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('location_of_loss'); ?>
</textarea>
        <?php endif; ?>
        <br class="clear" />
        
        <label for="loss_description">Description of Loss</label>
        <textarea name="loss_description"><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('loss_description'); ?>
</textarea>
        
        <label for="services_requested">Services Requested</label>
        <textarea name="services_requested"><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('services_requested'); ?>
</textarea>       
    </div>
    <br class="clear" />
    <div class="request_form">
        <div class="claimant_form_a">
           <h3>Vehicle Information</h3>
           <div class="cl_a_year">
    	       <label for="claimant_a_year">Year:</label>
    	       <select name="claimant_a_year" id="claimant_a_year"> 
    	           <option>Select a Year</option> 
            <?php $_from = $this->_tpl_vars['valid_years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_year']):
?>
                   <option value="<?php echo $this->_tpl_vars['a_year']; ?>
" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_year') == $this->_tpl_vars['a_year']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['a_year']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
	           </select>
            </div>
            <div class="cl_a_make">
	           <label for="claimant_a_make">Make:</label>
                <select name="claimant_a_make"> 
                    <option value="Select a Make">Select a Make</option>
                <?php $this->assign('claimant_a_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_make')); ?>
                <?php $_from = $this->_tpl_vars['accident_makes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['car_make']):
?>
                    <option value="<?php echo $this->_tpl_vars['car_make']; ?>
" <?php if ($this->_tpl_vars['car_make'] == $this->_tpl_vars['claimant_a_make']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['car_make']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
	           </select>
            </div>
        	<label for="claimant_a_model">Model: </label>
            <input name="claimant_a_model" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_model'); ?>
" />
        	<label for="claimant_a_color">Color: </label>
            <input name="claimant_a_color" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_color'); ?>
" />
            <label for="claimant_a_owner_name">Owner's Name</label>
            <input name="claimant_a_owner_name" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_owner_name'); ?>
" />
            <label for="claimant_a_owner_type">Owner Type</label>
            <input name="claimant_a_owner_type" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_owner_type'); ?>
" />
        	<label for="claimant_a_vin">VIN: </label>
            <input name="claimant_a_vin" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_vin'); ?>
" />
        	<label for="claimant_a_plate">Plate Number: </label>
            <input name="claimant_a_plate" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_plate'); ?>
" />
        	<label for="claimant_a_aftermarket">Modifications/Aftermarket: </label>
            <input name="claimant_a_aftermarket" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_aftermarket'); ?>
" />
        	<label for="claimant_a_additional">Additional Information: </label>
            <textarea name="claimant_a_additional"><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_a_additional'); ?>
</textarea>            
        </div>
    <?php $this->assign('claimant_b_year', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_year')); ?>
    <?php $this->assign('claimant_b_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_make')); ?>
    <?php $this->assign('claimant_b_model', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_model')); ?>
    
        <div class="claimant_form_b" style="<?php if ($this->_tpl_vars['claimant_b_year'] != '' && $this->_tpl_vars['claimant_b_make'] != '' && $this->_tpl_vars['claimant_b_model'] != ''): ?>display:inline-block;<?php else: ?>display:none;<?php endif; ?>">
           <h3>Second Vehicle Information</h3>
           <div class="cl_a_year">
    	       <label for="claimant_b_year">Year:</label>
    	       <select name="claimant_b_year" id="claimant_b_year"> 
    	           <option>Select a Year</option> 
            <?php $_from = $this->_tpl_vars['valid_years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_year']):
?>
                   <option value="<?php echo $this->_tpl_vars['a_year']; ?>
" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_year') == $this->_tpl_vars['a_year']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['a_year']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
	           </select>
            </div>
            <div class="cl_a_make">
	           <label for="claimant_b_make">Make:</label>
                <select name="claimant_b_make"> 
                    <option value="Select a Make">Select a Make</option>
                <?php $this->assign('claimant_b_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_make')); ?>
                <?php $_from = $this->_tpl_vars['accident_makes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['car_make']):
?>
                    <option value="<?php echo $this->_tpl_vars['car_make']; ?>
" <?php if ($this->_tpl_vars['car_make'] == $this->_tpl_vars['claimant_b_make']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['car_make']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
	           </select>
            </div>
        	<label for="claimant_b_model">Model: </label>
            <input name="claimant_b_model" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_model'); ?>
" />
        	<label for="claimant_b_color">Color: </label>
            <input name="claimant_b_color" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_color'); ?>
" />
            <label for="claimant_b_owner_name">Owner's Name</label>
            <input name="claimant_b_owner_name" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_owner_name'); ?>
" />
            <label for="claimant_b_owner_type">Owner Type</label>
            <input name="claimant_b_owner_type" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_owner_type'); ?>
" />
        	<label for="claimant_b_vin">VIN: </label>
            <input name="claimant_b_vin" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_vin'); ?>
" />
        	<label for="claimant_b_plate">Plate Number: </label>
            <input name="claimant_b_plate" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_plate'); ?>
" />
        	<label for="claimant_b_aftermarket">Modifications/Aftermarket: </label>
            <input name="claimant_b_aftermarket" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_aftermarket'); ?>
" />
        	<label for="claimant_b_additional">Additional Information: </label>
            <textarea name="claimant_b_additional"><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_b_additional'); ?>
</textarea>            
        </div>
    <?php $this->assign('claimant_c_year', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_year')); ?>
    <?php $this->assign('claimant_c_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_make')); ?>
    <?php $this->assign('claimant_c_model', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_model')); ?>
    
        <div class="claimant_form_c" style="<?php if ($this->_tpl_vars['claimant_c_year'] != '' && $this->_tpl_vars['claimant_c_make'] != '' && $this->_tpl_vars['claimant_c_model'] != ''): ?>display:inline-block;<?php else: ?>display:none;<?php endif; ?>">
           <h3>Third Vehicle Information</h3>
           <div class="cl_a_year">
    	       <label for="claimant_c_year">Year:</label>
    	       <select name="claimant_c_year" id="claimant_c_year"> 
    	           <option>Select a Year</option> 
            <?php $_from = $this->_tpl_vars['valid_years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a_year']):
?>
                   <option value="<?php echo $this->_tpl_vars['a_year']; ?>
" <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_year') == $this->_tpl_vars['a_year']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['a_year']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
	           </select>
            </div>
            <div class="cl_a_make">
	           <label for="claimant_c_make">Make:</label>
                <select name="claimant_c_make"> 
                    <option value="Select a Make">Select a Make</option>
                <?php $this->assign('claimant_c_make', $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_make')); ?>
                <?php $_from = $this->_tpl_vars['accident_makes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['car_make']):
?>
                    <option value="<?php echo $this->_tpl_vars['car_make']; ?>
" <?php if ($this->_tpl_vars['car_make'] == $this->_tpl_vars['claimant_c_make']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['car_make']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
	           </select>
            </div>
        	<label for="claimant_c_model">Model: </label>
            <input name="claimant_c_model" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_model'); ?>
" />
        	<label for="claimant_c_color">Color: </label>
            <input name="claimant_c_color" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_color'); ?>
" />
            <label for="claimant_c_owner_name">Owner's Name</label>
            <input name="claimant_c_owner_name" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_owner_name'); ?>
" />
            <label for="claimant_c_owner_type">Owner Type</label>
            <input name="claimant_c_owner_type" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_owner_type'); ?>
" />
        	<label for="claimant_c_vin">VIN: </label>
            <input name="claimant_c_vin" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_vin'); ?>
" />
        	<label for="claimant_c_plate">Plate Number: </label>
            <input name="claimant_c_plate" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_plate'); ?>
" />
        	<label for="claimant_c_aftermarket">Modifications/Aftermarket: </label>
            <input name="claimant_c_aftermarket" type="text" value="<?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_aftermarket'); ?>
" />
        	<label for="claimant_c_additional">Additional Information: </label>
            <textarea name="claimant_c_additional"><?php echo $this->_tpl_vars['active_ticket']->get_ticket_accident_data('claimant_c_additional'); ?>
</textarea>            
        </div>
    <div class="job_specific_forms_a">
        <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis' || $this->_tpl_vars['active_ticket']->isNew()): ?>
        <div class="vehicle_theft_form">
            <h3>Vehicle Theft</h3>
            <label for="vehicle_theft_security-system">Is the vehicle equipped with a factory perimeter security system?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_yes" type="radio" value="yes" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system') == 'yes'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_no" type="radio" value="no" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system') == 'no'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_no">No</label>
                <br />
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_optional" type="radio" value="optional" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system') == 'optional'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_optional">Optional</label>
                <br />
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_unknown" type="radio" value="unknown" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system') == 'unknown'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_unknown">Unknown</label>
            </div>
            <br class="clear" />
            <label for="vehicle_theft_security_system_after">Is the vehicle equipped with an aftermarket security system?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_yes" type="radio" value="yes" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system_after') == 'yes'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_after_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_no" type="radio" value="no" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system_after') == 'no'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_after_no">No</label>
                <br />
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_unknown" type="radio" value="unknown" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_security_system_after') == 'unknown'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_security_system_after_unknown">Unknown</label>
            </div>
            <br class="clear" />
            <label for="vehicle_theft_remote">Is the vehicle equipped with a remote start system?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_yes" type="radio" value="yes" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote') == 'yes'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_remote_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_no" type="radio" value="no" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote') == 'no'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_remote_no">No</label>
                <br />
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_unknown" type="radio" value="unknown" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote') == 'unknown'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_remote_unknown">Unknown</label>
            </div>
            <br class="clear" />
            <label for="vehicle_theft_remote_after">Is the remote start system factory or aftermarket?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_yes" type="radio" value="yes" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote_after') == 'yes'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_remote_after_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_no" type="radio" value="no" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote_after') == 'no'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_remote_after_no">No</label>
                <br />
        		<input name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_unknown" type="radio" value="unknown" 
                    <?php if ($this->_tpl_vars['active_ticket']->get_ticket_accident_data('vehicle_theft_remote_after') == 'unknown'): ?>checked="checked"<?php endif; ?> />
                <label for="vehicle_theft_remote_after_unknown">Unknown</label>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div id="responsible_client_user_block">
        <h3>Responsible Client User</h3>
        <ul>
        <?php $_from = $this->_tpl_vars['accident_client_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['client_user']):
?>
            <li>
                <input type="radio" name="responsible_client_user" value="<?php echo $this->_tpl_vars['client_user']['id']; ?>
" id="responsible_client_user_<?php echo $this->_tpl_vars['client_user']['id']; ?>
" />
                <label for="responsible_client_user_<?php echo $this->_tpl_vars['client_user']['id']; ?>
"><?php echo $this->_tpl_vars['client_user']['first_name']; ?>
 <?php echo $this->_tpl_vars['client_user']['last_name']; ?>
</label>
            </li>
        <?php endforeach; endif; unset($_from); ?>
        </ul>
    </div>

    <?php echo '
    <script>
        $(document).ready(function(){
            if (!$("input[name=\'responsible_client_user\']:checked").val()) {
                $("input[name=responsible_client_user]:first").attr(\'checked\', true);
            }
        });
    </script>
    '; ?>

</div>
</div>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php endif; ?>
    
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'assignees')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketAssignees')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Assignees<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_assignees_inline(array('name' => 'ticket[assignees]','value' => $this->_tpl_vars['ticket_data']['assignees'],'object' => $this->_tpl_vars['active_ticket'],'project' => $this->_tpl_vars['active_project'],'choose_responsible' => true), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<div class="form_right_col">
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'parent_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketParent')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Category<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_category(array('name' => 'ticket[parent_id]','value' => $this->_tpl_vars['ticket_data']['parent_id'],'id' => 'ticketParent','module' => 'tickets','controller' => 'tickets','project' => $this->_tpl_vars['active_project'],'user' => $this->_tpl_vars['logged_user']), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if ($this->_tpl_vars['logged_user']->canSeeMilestones($this->_tpl_vars['active_project'])): ?>
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'milestone_id')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketMilestone')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Milestone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_milestone(array('name' => 'ticket[milestone_id]','value' => $this->_tpl_vars['ticket_data']['milestone_id'],'project' => $this->_tpl_vars['active_project'],'id' => 'ticketMilestone'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack);  endif; ?>

  <?php $this->_tag_stack[] = array('wrap', array('field' => 'priority')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketPriority')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Priority<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_priority(array('name' => 'ticket[priority]','value' => $this->_tpl_vars['ticket_data']['priority'],'id' => 'ticketPriority'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'tags')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketTags')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_tags(array('name' => 'ticket[tags]','value' => $this->_tpl_vars['ticket_data']['tags'],'project' => $this->_tpl_vars['active_project'],'id' => 'ticketTags'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php $this->_tag_stack[] = array('wrap', array('field' => 'due_on')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('label', array('for' => 'ticketDueOn')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Due on<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php echo smarty_function_select_date(array('name' => 'ticket[due_on]','value' => $this->_tpl_vars['ticket_data']['due_on'],'id' => 'ticketDueOn'), $this);?>

  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php if ($this->_tpl_vars['logged_user']->canSeePrivate()): ?>
    <?php $this->_tag_stack[] = array('wrap', array('field' => 'visibility')); $_block_repeat=true;smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $this->_tag_stack[] = array('label', array('for' => 'ticketVisibility')); $_block_repeat=true;smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Visibility<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_label($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php echo smarty_function_select_visibility(array('name' => "ticket[visibility]",'value' => $this->_tpl_vars['ticket_data']['visibility'],'project' => $this->_tpl_vars['active_project'],'short_description' => true), $this);?>

    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_wrap($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <?php else: ?>
    <input type="hidden" name="ticket[visibility]" value="1" />
  <?php endif; ?>
</div>

<div class="clear"></div>