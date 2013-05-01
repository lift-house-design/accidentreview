<div class="form_left_col">
  {wrap field=name}
    {label for=ticketSummary required=yes}Summary{/label}
    {text_field name='ticket[name]' value=$ticket_data.name id=ticketSummary class='title required validate_minlength 3'}
  {/wrap}
  
  {wrap field=body}
    {label for=ticketBody}Full description{/label}
    {editor_field name='ticket[body]' id=ticketBody inline_attachments=$ticket_data.inline_attachments}{$ticket_data.body}{/editor_field}
  {/wrap}
  
  {if $active_ticket->isNew()}
    <div class="ctrlHolderContainer">
      <a href="#" class="ctrlHolderToggler button_add attachments">{lang}Attach Files{/lang}...</a>
      <div class="strlHolderToggled">
      {wrap field=attachments}
        {label}Attachments{/label}
        {attach_files max_files=5}
      {/wrap}
      </div>
    </div>
  {/if}
  {if $active_ticket->get_ticket_accident_job_id() != false || $active_ticket->isNew()}
  {wrap field=accident}
    <a class="toggleAccident hidden button_add" href="#">Show Accident Form</a>
    <br class="clear"/>
    {literal}
    <script>
        $(document).ready(function(){
            $(".toggleAccident").live("click", function(event){
                event.preventDefault();
                if($(this).hasClass("shown")){
                    $(".accident-form").hide('slow');
                    $(this).html("Show Accident Form");
                }
                else{
                    $(".accident-form").show('slow');
                    $(this).html("Hide Accident Form");
                }
                $(this).toggleClass("shown");
                $(this).toggleClass("hidden");
            })
        });
    </script>
    {/literal}
    <div class="accident-form" style="display:none">
    <br class="clear" />
    <div class="job_type_form">
        <label>Service Type Requested</label>
		<select name="job_type">
            <option value="0">Select a Service</option>
    		<option value="1" {if $active_ticket->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis'}selected="selected"{/if}>
                Vehicle Theft Analysis
            </option>
    		<option value="2" {if $active_ticket->get_ticket_accident_data('job_type') == 'Accident Reconstruction'}selected="selected"{/if}>
                Accident Reconstruction
            </option>
    		<option value="3" {if $active_ticket->get_ticket_accident_data('job_type') == 'Fire Analysis'}selected="selected"{/if}>
                Fire Analysis
            </option>
    		<option value="4" {if $active_ticket->get_ticket_accident_data('job_type') == 'Mechanical Analysis'}selected="selected"{/if}>
                Mechanical Analysis
            </option>
    		<option value="5" {if $active_ticket->get_ticket_accident_data('job_type') == 'Physical Damage Comparison'}selected="selected"{/if}>
                Physical Damage Comparison
            </option>
    		<option value="6" {if $active_ticket->get_ticket_accident_data('job_type') == 'Report Review'}selected="selected"{/if}>
                Report Review
            </option>
    		<option value="7" {if $active_ticket->get_ticket_accident_data('job_type') == 'Other'}selected="selected"{/if}>
                Other
            </option>
		</select>
        {literal}
        <script type="text/javascript">
            $(function(){
                $('select[name="job_type"]').bind('change',function(){
                    var found_id = -1;
                    var sel_val = $(this).val();
                    var sel_text = $(this).find('option[value="'+sel_val+'"]').text();
                    sel_text = $.trim(sel_text);
                    console.log('Val: '+sel_val+' Text: '+sel_text);
                    $('#ticketParent > option').each(function(){
                        console.log('Checking: '+$(this).text());
                        if(sel_text == $(this).text()) found_id = $(this).val();    
                    });  
                    if(found_id != -1) $('#ticketParent').val(found_id); 
                    else{
                        $('#ticketParent > option').attr('selected','');
                        $('#ticketParent > option:eq(0)').attr('selected','selected');
                    } 
                });  
            });
        </script>        
        {/literal}
    </div>
  
    <div class="common_questions">
        <h3 class="gen_info">General Information</h3>
        <div style="float:left;">
            <label for="client_file_id">Client File ID</label>
            <input type="text" name="client_file_id" id="client_file_id" value="{$active_ticket->get_ticket_accident_data('client_file_id')}" />
        </div>
        <div style="float:left;margin-left: 20px;" class="select_date">
            <label for="date_of_loss">Date of Loss</label>
            <input name="date_of_loss" id="date_of_loss" type="text" value="{$active_ticket->get_ticket_accident_data('date_of_loss')}" />
            <script type="text/javascript">
                Date.firstDayOfWeek = 0; 
                Date.format = 'yyyy-mm-dd'; 
                $("#date_of_loss").datePicker().dpSetStartDate("2000-01-01").dpSetEndDate("2050-01-01");
            </script>
        </div>
        {if $active_ticket->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis' || $active_ticket->isNew() }
        <div style="float:left;margin-left: 20px;" class="select_date">
            <label for="date_of_recovery">Date of Recovery</label>
            <input name="date_of_recovery" id="date_of_recovery" type="text" value="{$active_ticket->get_ticket_accident_data('date_of_recovery')}" />

            <script type="text/javascript">
                Date.firstDayOfWeek = 0; 
                Date.format = 'yyyy-mm-dd'; 
                $("#date_of_recovery").datePicker().dpSetStartDate("2000-01-01").dpSetEndDate("2050-01-01");
            </script>
        </div>
        <br class="clear" />
        <label for="location_of_loss">Location of Loss</label>
        <textarea name="location_of_loss">{$active_ticket->get_ticket_accident_data('location_of_loss')}</textarea>
        {/if}
        <br class="clear" />
        
        <label for="loss_description">Description of Loss</label>
        <textarea name="loss_description">{$active_ticket->get_ticket_accident_data('loss_description')}</textarea>
        
        <label for="services_requested">Services Requested</label>
        <textarea name="services_requested">{$active_ticket->get_ticket_accident_data('services_requested')}</textarea>       
    </div>
    <br class="clear" />
    <div class="request_form">
        <div class="claimant_form_a">
           <h3>Vehicle Information</h3>
           <div class="cl_a_year">
    	       <label for="claimant_a_year">Year:</label>
    	       <select name="claimant_a_year" id="claimant_a_year"> 
    	           <option>Select a Year</option> 
            {foreach from=$valid_years item=a_year}
                   <option value="{$a_year}" {if $active_ticket->get_ticket_accident_data('claimant_a_year') == $a_year}selected="selected"{/if}>{$a_year}</option>
            {/foreach}
	           </select>
            </div>
            <div class="cl_a_make">
	           <label for="claimant_a_make">Make:</label>
                <select name="claimant_a_make"> 
                    <option value="Select a Make">Select a Make</option>
                {assign var="claimant_a_make" value=$active_ticket->get_ticket_accident_data('claimant_a_make')}
                {foreach from=$accident_makes item=car_make}
                    <option value="{$car_make}" {if $car_make == $claimant_a_make}selected="selected"{/if}>{$car_make}</option>
                {/foreach}
	           </select>
            </div>
        	<label for="claimant_a_model">Model: </label>
            <input name="claimant_a_model" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_model')}" />
        	<label for="claimant_a_color">Color: </label>
            <input name="claimant_a_color" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_color')}" />
            <label for="claimant_a_owner_name">Owner's Name</label>
            <input name="claimant_a_owner_name" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_owner_name')}" />
            <label for="claimant_a_owner_type">Owner Type</label>
            <input name="claimant_a_owner_type" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_owner_type')}" />
        	<label for="claimant_a_vin">VIN: </label>
            <input name="claimant_a_vin" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_vin')}" />
        	<label for="claimant_a_plate">Plate Number: </label>
            <input name="claimant_a_plate" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_plate')}" />
        	<label for="claimant_a_aftermarket">Modifications/Aftermarket: </label>
            <input name="claimant_a_aftermarket" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_a_aftermarket')}" />
        	<label for="claimant_a_additional">Additional Information: </label>
            <textarea name="claimant_a_additional">{$active_ticket->get_ticket_accident_data('claimant_a_additional')}</textarea>            
        </div>
    {assign var="claimant_b_year" value=$active_ticket->get_ticket_accident_data('claimant_b_year') }
    {assign var="claimant_b_make" value=$active_ticket->get_ticket_accident_data('claimant_b_make') }
    {assign var="claimant_b_model" value=$active_ticket->get_ticket_accident_data('claimant_b_model') }
    
        <div class="claimant_form_b" style="{if $claimant_b_year != '' && $claimant_b_make != '' && $claimant_b_model != '' }display:inline-block;{else}display:none;{/if}">
           <h3>Second Vehicle Information</h3>
           <div class="cl_a_year">
    	       <label for="claimant_b_year">Year:</label>
    	       <select name="claimant_b_year" id="claimant_b_year"> 
    	           <option>Select a Year</option> 
            {foreach from=$valid_years item=a_year}
                   <option value="{$a_year}" {if $active_ticket->get_ticket_accident_data('claimant_b_year') == $a_year}selected="selected"{/if}>{$a_year}</option>
            {/foreach}
	           </select>
            </div>
            <div class="cl_a_make">
	           <label for="claimant_b_make">Make:</label>
                <select name="claimant_b_make"> 
                    <option value="Select a Make">Select a Make</option>
                {assign var="claimant_b_make" value=$active_ticket->get_ticket_accident_data('claimant_b_make')}
                {foreach from=$accident_makes item=car_make}
                    <option value="{$car_make}" {if $car_make == $claimant_b_make}selected="selected"{/if}>{$car_make}</option>
                {/foreach}
	           </select>
            </div>
        	<label for="claimant_b_model">Model: </label>
            <input name="claimant_b_model" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_model')}" />
        	<label for="claimant_b_color">Color: </label>
            <input name="claimant_b_color" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_color')}" />
            <label for="claimant_b_owner_name">Owner's Name</label>
            <input name="claimant_b_owner_name" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_owner_name')}" />
            <label for="claimant_b_owner_type">Owner Type</label>
            <input name="claimant_b_owner_type" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_owner_type')}" />
        	<label for="claimant_b_vin">VIN: </label>
            <input name="claimant_b_vin" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_vin')}" />
        	<label for="claimant_b_plate">Plate Number: </label>
            <input name="claimant_b_plate" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_plate')}" />
        	<label for="claimant_b_aftermarket">Modifications/Aftermarket: </label>
            <input name="claimant_b_aftermarket" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_b_aftermarket')}" />
        	<label for="claimant_b_additional">Additional Information: </label>
            <textarea name="claimant_b_additional">{$active_ticket->get_ticket_accident_data('claimant_b_additional')}</textarea>            
        </div>
    {assign var="claimant_c_year" value=$active_ticket->get_ticket_accident_data('claimant_c_year') }
    {assign var="claimant_c_make" value=$active_ticket->get_ticket_accident_data('claimant_c_make') }
    {assign var="claimant_c_model" value=$active_ticket->get_ticket_accident_data('claimant_c_model') }
    
        <div class="claimant_form_c" style="{if $claimant_c_year != '' && $claimant_c_make != '' && $claimant_c_model != '' }display:inline-block;{else}display:none;{/if}">
           <h3>Third Vehicle Information</h3>
           <div class="cl_a_year">
    	       <label for="claimant_c_year">Year:</label>
    	       <select name="claimant_c_year" id="claimant_c_year"> 
    	           <option>Select a Year</option> 
            {foreach from=$valid_years item=a_year}
                   <option value="{$a_year}" {if $active_ticket->get_ticket_accident_data('claimant_c_year') == $a_year}selected="selected"{/if}>{$a_year}</option>
            {/foreach}
	           </select>
            </div>
            <div class="cl_a_make">
	           <label for="claimant_c_make">Make:</label>
                <select name="claimant_c_make"> 
                    <option value="Select a Make">Select a Make</option>
                {assign var="claimant_c_make" value=$active_ticket->get_ticket_accident_data('claimant_c_make')}
                {foreach from=$accident_makes item=car_make}
                    <option value="{$car_make}" {if $car_make == $claimant_c_make}selected="selected"{/if}>{$car_make}</option>
                {/foreach}
	           </select>
            </div>
        	<label for="claimant_c_model">Model: </label>
            <input name="claimant_c_model" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_model')}" />
        	<label for="claimant_c_color">Color: </label>
            <input name="claimant_c_color" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_color')}" />
            <label for="claimant_c_owner_name">Owner's Name</label>
            <input name="claimant_c_owner_name" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_owner_name')}" />
            <label for="claimant_c_owner_type">Owner Type</label>
            <input name="claimant_c_owner_type" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_owner_type')}" />
        	<label for="claimant_c_vin">VIN: </label>
            <input name="claimant_c_vin" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_vin')}" />
        	<label for="claimant_c_plate">Plate Number: </label>
            <input name="claimant_c_plate" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_plate')}" />
        	<label for="claimant_c_aftermarket">Modifications/Aftermarket: </label>
            <input name="claimant_c_aftermarket" type="text" value="{$active_ticket->get_ticket_accident_data('claimant_c_aftermarket')}" />
        	<label for="claimant_c_additional">Additional Information: </label>
            <textarea name="claimant_c_additional">{$active_ticket->get_ticket_accident_data('claimant_c_additional')}</textarea>            
        </div>
    <div class="job_specific_forms_a">
        {if $active_ticket->get_ticket_accident_data('job_type') == 'Vehicle Theft Analysis' || $active_ticket->isNew()}
        <div class="vehicle_theft_form">
            <h3>Vehicle Theft</h3>
            <label for="vehicle_theft_security-system">Is the vehicle equipped with a factory perimeter security system?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_yes" type="radio" value="yes" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system') == 'yes'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_no" type="radio" value="no" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system') == 'no'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_no">No</label>
                <br />
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_optional" type="radio" value="optional" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system') == 'optional'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_optional">Optional</label>
                <br />
        		<input name="vehicle_theft_security_system" id="vehicle_theft_security_system_unknown" type="radio" value="unknown" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system') == 'unknown'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_unknown">Unknown</label>
            </div>
            <br class="clear" />
            <label for="vehicle_theft_security_system_after">Is the vehicle equipped with an aftermarket security system?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_yes" type="radio" value="yes" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system_after') == 'yes'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_after_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_no" type="radio" value="no" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system_after') == 'no'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_after_no">No</label>
                <br />
        		<input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_unknown" type="radio" value="unknown" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_security_system_after') == 'unknown'}checked="checked"{/if} />
                <label for="vehicle_theft_security_system_after_unknown">Unknown</label>
            </div>
            <br class="clear" />
            <label for="vehicle_theft_remote">Is the vehicle equipped with a remote start system?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_yes" type="radio" value="yes" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_remote') == 'yes'}checked="checked"{/if} />
                <label for="vehicle_theft_remote_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_no" type="radio" value="no" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_remote') == 'no'}checked="checked"{/if} />
                <label for="vehicle_theft_remote_no">No</label>
                <br />
        		<input name="vehicle_theft_remote" id="vehicle_theft_remote_unknown" type="radio" value="unknown" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_remote') == 'unknown'}checked="checked"{/if} />
                <label for="vehicle_theft_remote_unknown">Unknown</label>
            </div>
            <br class="clear" />
            <label for="vehicle_theft_remote_after">Is the remote start system factory or aftermarket?</label>
            <div class="inline buttongroup">
        		<input name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_yes" type="radio" value="yes" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_remote_after') == 'yes'}checked="checked"{/if} />
                <label for="vehicle_theft_remote_after_yes">Yes</label>
                <br />
        		<input name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_no" type="radio" value="no" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_remote_after') == 'no'}checked="checked"{/if} />
                <label for="vehicle_theft_remote_after_no">No</label>
                <br />
        		<input name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_unknown" type="radio" value="unknown" 
                    {if $active_ticket->get_ticket_accident_data('vehicle_theft_remote_after') == 'unknown'}checked="checked"{/if} />
                <label for="vehicle_theft_remote_after_unknown">Unknown</label>
            </div>
        </div>
        {/if}
    </div>
    <div id="responsible_client_user_block">
        <h3>Responsible Client User</h3>
        <ul>
        {foreach from=$accident_client_users item=client_user}
            <li>
                <input type="radio" name="responsible_client_user" value="{$client_user.id}" id="responsible_client_user_{$client_user.id}" />
                <label for="responsible_client_user_{$client_user.id}">{$client_user.first_name} {$client_user.last_name}</label>
            </li>
        {/foreach}
        </ul>
    </div>

    {literal}
    <script>
        $(document).ready(function(){
            if (!$("input[name='responsible_client_user']:checked").val()) {
                $("input[name=responsible_client_user]:first").attr('checked', true);
            }
        });
    </script>
    {/literal}
</div>
</div>
  {/wrap}
  {/if}
    
  {wrap field=assignees}
    {label for=ticketAssignees}Assignees{/label}
    {select_assignees_inline name='ticket[assignees]' value=$ticket_data.assignees object=$active_ticket project=$active_project choose_responsible=true}
  {/wrap}
</div>

<div class="form_right_col">
  {wrap field=parent_id}
    {label for=ticketParent}Category{/label}
    {select_category name='ticket[parent_id]' value=$ticket_data.parent_id id=ticketParent module=tickets controller=tickets project=$active_project user=$logged_user}
  {/wrap}

{if $logged_user->canSeeMilestones($active_project)}
  {wrap field=milestone_id}
    {label for=ticketMilestone}Milestone{/label}
    {select_milestone name='ticket[milestone_id]' value=$ticket_data.milestone_id project=$active_project id=ticketMilestone}
  {/wrap}
{/if}

  {wrap field=priority}
    {label for=ticketPriority}Priority{/label}
    {select_priority name='ticket[priority]' value=$ticket_data.priority id=ticketPriority}
  {/wrap}
  
  {wrap field=tags}
    {label for=ticketTags}Tags{/label}
    {select_tags name='ticket[tags]' value=$ticket_data.tags project=$active_project id=ticketTags}
  {/wrap}
  
  {wrap field=due_on}
    {label for=ticketDueOn}Due on{/label}
    {select_date name='ticket[due_on]' value=$ticket_data.due_on id=ticketDueOn}
  {/wrap}
  
  {if $logged_user->canSeePrivate()}
    {wrap field=visibility}
      {label for=ticketVisibility}Visibility{/label}
      {select_visibility name=ticket[visibility] value=$ticket_data.visibility project=$active_project short_description=true}
    {/wrap}
  {else}
    <input type="hidden" name="ticket[visibility]" value="1" />
  {/if}
</div>

<div class="clear"></div>