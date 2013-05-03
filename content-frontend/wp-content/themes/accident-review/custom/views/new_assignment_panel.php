<?php
	function ar_display_question_field($question_key,$question,$array_fields=false)
	{
		if($question['question_type']=='textarea')
		{
			echo '<textarea name="'.$question_key.( $array_fields ? '[]' : '' ).'" '.( !empty($question['placeholder']) ? ' placeholder="'.$question['placeholder'].'"' : '').'></textarea>';
		}
		elseif($question['question_type']=='date')
		{
			echo '<input type="text" class="date" name="'.$question_key.( $array_fields ? '[]' : '' ).'"'.( !empty($question['placeholder']) ? ' placeholder="'.$question['placeholder'].'"' : '').' />';
		}
		elseif($question['question_type']=='radio')
		{
			$question['possible_answers']=json_decode($question['possible_answers'],true) ;
			
			if(count($question['possible_answers']) > 0)
			{
				echo '<div class="ui-radios">';
				foreach($question['possible_answers'] as $answer)
				{
					$answer_slug=str_replace(' ','_',strtolower($answer));
					echo '<input type="radio" name="'.$question_key.( $array_fields ? '[]' : '' ).'" id="'.$question_key.'-'.$answer_slug.'" value="'.$answer.'"'.( $question['default_answer']==$answer ? ' checked="checked"' : '' ).' />';
					echo '<label for="'.$question_key.'-'.$answer_slug.'">'.$answer.'</label> ';
				}
				echo '</div>';
			}
		}
		else
		{
			echo '<input type="text" name="'.$question_key.( $array_fields ? '[]' : '' ).'"'.( !empty($question['placeholder']) ? ' placeholder="'.$question['placeholder'].'"' : '').' />';
		}
	}
?>
<!--script src="/wp-content/themes/accident-review/js/jquery-ui-1.10.2.min.js"></script-->
<!--link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-base.css" /-->
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-datepicker.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-button.css" />
<form id="new-assignment">
	
	<fieldset>
		<legend>General Information</legend>
		<input type="hidden" name="id" value="<?php echo $job_id ?>" />
		<input type="hidden" name="type" value="<?php echo $assignment_type ?>" />
		<div class="field">
			<label>File Number</label>
			<input type="text" name="file_number" placeholder="Enter file number" />
		</div>
		<div class="field">
			<label>Insured Name</label>
			<input type="text" name="insured_name" placeholder="Enter insured name" />
		</div>
		<div class="field">
			<label>Date of Loss</label>
			<input type="text" class="date" name="date_of_loss" placeholder="Enter date of loss" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Describe Loss</legend>
		<div class="odd file-upload field">
			<label>Upload Files</label>
			<div class="file-types">
				<p>Allowed file types: </p>
				<ul>
					<li><strong>Images</strong> (jpg, gif, png)</li>
					<li><strong>Documents</strong> (txt, rtf, doc, docx, pdf)</li>
				</ul>
			</div>
			<input type="button" value="Upload File" />
			<input id="upload-field" type="file" name="file" />
			<div class="file-preview">
				<div class="file">
					<a class="icon">
						
					</a>
					<a class="description">Add Description</a>
				</div>
				<div class="word file">
					<a class="icon">
						
					</a>
					<a class="description">Add Description</a>
				</div>
				<div class="pdf file">
					<a class="icon">
						
					</a>
					<a class="description">Add Description</a>
				</div>
			</div>
		</div>
		<div class="field">
			<label>Describe Loss in Chronological Order</label>
			<textarea name="loss_description" placeholder="Enter description of loss in chronological order"></textarea>
		</div>
		<div class="field">
			<label>Services Requested</label>
			<textarea name="services_requested" placeholder="Enter services you are requesting"></textarea>
		</div>
		<?php foreach($job_questions as $question_key=>$question): ?>
		<div class="<?php echo $question_key ?> field">
			<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
			<?php ar_display_question_field($question_key,$question) ?>
		</div>
		<?php endforeach; ?>
	</fieldset>
	<fieldset>
		<legend>Vehicle<?php echo ( $multiple_vehicles ?' #1' : '' ) ?> Information</legend>
		<div class="vin_number field">
			<label>If the VIN number is available, enter it below and click "Lookup VIN"</label>
			<input type="text" name="vin_number" placeholder="Enter the VIN number" />
			<input type="button" value="Lookup VIN" />
		</div>
		<div class="field">
			<label>Vehicle Description</label>
			<div class="field-row">
				<select name="year">
					<option value="">Year:</option>
				</select>
				<select name="make" disabled="disabled">
					<option value="">(select a year)</option>
				</select>
				<select name="model" disabled="disabled">
					<option value="">(select a year)</option>
				</select>
			</div>
			<div class="field-row">
				<input type="text" name="owners_name" placeholder="Enter owner's full name" />
				<select name="belongs_to">
					<option value="">Vehicle belongs to:</option>
					<?php foreach(array('Plaintiff','Defendant') as $val): ?>
					<option><?php echo $val ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="field-row">
				<input type="text" name="color" placeholder="Enter vehicle's color" />
				<input type="text" name="registration_number" placeholder="Enter vehicle's registration number" />
			</div>
		</div>
		<div class="field">
			<label>Modifications/Aftermarket</label>
			<textarea name="modifications" placeholder="List any modifications"></textarea>
		</div>
		<div class="field">
			<label>Additional Information</label>
			<textarea name="additional_info" placeholder="Provide any additional information that will help us analyze your request"></textarea>
		</div>
		<?php foreach($vehicle_questions as $question_key=>$question): ?>
		<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
			<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
			<?php ar_display_question_field($question_key,$question) ?>
		</div>
		<?php endforeach; ?>
		<?php if($multiple_vehicles): ?>
		<div class="field">
			<label>Add another vehicle</label>
			<input type="button" id="add-vehicle" value="Add Vehicle" />
		</div>
		<?php endif; ?>
	</fieldset>
	<fieldset>
		<legend>Submit Assignment</legend>
		<div class="field"> <!-- @TODO: change the url to the terms and conditions -->
			<label>Before submitting, you must read and agree to the terms of service</label>
			<input type="checkbox" name="tos_agreement" id="tos-agreement" value="1" /><label for="tos-agreement" class="checkbox-label">I have read and agree to the <a href="/terms-conditions">terms of service</a>.</label>
		</div>
		<div class="field">
			<input type="submit" value="Save Assignment" />
		</div>
	</fieldset>
</form>
<script>
	$(function(){
		// Radio buttons
		$('.ui-radios').buttonset();
		
		// Date fields
		$('input[type="text"].date').datepicker({
			dateFormat: 'yy-mm-dd'
		});
		
		$(document)
			// Remove these same events that were possibly passed by previous page loads
			.off('change','.keys_available.field input[type="radio"]')
			.off('click','.vin_number.field input[type="button"]')
			.off('change','select[name="year"]')
			.off('change','select[name="make"]')
			.off('click','#add-vehicle')
			.off('click','#remove-vehicle')
			// Keys available change (vehicle-theft)
			.on('change','.keys_available.field input[type="radio"]',function(){
				var where=$('.keys_available_where.field');
				
				if($(this).val()=='Yes')
					where.show().find('input[type="text"]').focus(); // Show where input
				else
					where.hide(); // Hide where input
			})
			// VIN lookup
			.on('click','.vin_number.field input[type="button"]',function(){
				var vin_lookup=this;
				var vin=$(this).siblings('input[type="text"]').val();
				
				// Show loading state
				$(this)
					.siblings('input[type="text"]')
					.attr('disabled','disabled');
				$(this)
					.attr('disabled','disabled')
					.val('Checking...');
				
				$.ajax({
				     url: '/wp-admin/admin-ajax.php',
				     type: 'post',
				     data: {
				         action: 'get-vin-data',
						 vin: vin
				     },
				     success: function(data,textStatus,jqXHR){
				         if(data.status=='success')
						 {
						 	var vehicle_description=$(vin_lookup)
								.parents('.field')
								.next('.field');
							
							// Set year
							vehicle_description
								.find('select[name="year"]')
								.val(data.data.year);
							
							// Set make
							vehicle_description
								.find('select[name="make"]')
								.empty()
								.append(
									$('<option>')
										.attr('selected','selected')
										.val(data.data.make)
										.html(data.data.make)
								)
								.removeAttr('disabled');
							
							// Set model
							vehicle_description
								.find('select[name="model"]')
								.empty()
								.append(
									$('<option>')
										.attr('selected','selected')
										.val(data.data.model)
										.html(data.data.model)
								)
								.removeAttr('disabled');
							
							// Move focus to the owner name field
							vehicle_description
								.find('input[name="owners_name"]')
								.focus();
								
							// Show a message
							$(vin_lookup)
								.parents('.field')
								.find('.msg')
								.remove();
								
							var msg=$('<div>')
								.addClass('msg')
								.html('Your VIN has been found. Please fill out the remaining fields below.');
							
							$(vin_lookup).after(msg);
						 }
						 
						 // Remove loading state
						$(vin_lookup)
							.siblings('input[type="text"]')
							.removeAttr('disabled');
						$(vin_lookup)
							.removeAttr('disabled')
							.val('Lookup VIN');
				     },
				});
			})
			// Populate vehicle makes dropdown on vehicle year change
			.on('change','select[name="year"]',function(){
				var make=$(this)
					.parents('.field')
					.find('select[name="make"]')
					.empty()
					.attr('disabled','disabled');
				var opt=$('<option>')
					.val('')
					.html('Loading...');	
				make.append(opt);
				
				var model=$(this)
					.parents('.field')
					.find('select[name="model"]')
					.empty()
					.attr('disabled','disabled');
				var opt=$('<option>')
					.val('')
					.html('Loading...');
				model.append(opt);
				
				$.ajax({
				     url: '/wp-admin/admin-ajax.php',
				     type: 'post',
				     data: {
				         action: 'vehicle-make-list',
						 year: $(this).val()
				     },
				     success: function(data,textStatus,jqXHR){
					 	if(data.success)
						{
							var opt=$('<option>')
									.val('')
									.html('Make:');
								
							make
								.empty()
								.append(opt)
								.removeAttr('disabled');
							
							for(var val in data.result)
							{
								var opt=$('<option>')
									.val(val)
									.html(data.result[val]);
								
								make.append(opt);
							}
							
							var opt=$('<option>')
									.val('')
									.html('(select a make)');
								
							model
								.empty()
								.append(opt);
						}
				     },
				});
			})
			// Populate vehicle model dropdown on vehicle make change
			.on('change','select[name="make"]',function(){
				var model=$(this)
					.parents('.field')
					.find('select[name="model"]')
					.empty()
					.attr('disabled','disabled');
				var opt=$('<option>')
					.val('')
					.html('Loading...');
				model.append(opt);
				
				$.ajax({
				     url: '/wp-admin/admin-ajax.php',
				     type: 'post',
				     data: {
				         action: 'vehicle-model-list',
						 year: $(this).parents('.field').find('select[name="year"]').val(),
						 make: $(this).val()
				     },
				     success: function(data,textStatus,jqXHR){
					 	if(data.success)
						{
							var opt=$('<option>')
									.val('')
									.html('Model:');
								
							model
								.empty()
								.append(opt)
								.removeAttr('disabled');
							
							for(var val in data.result)
							{
								var opt=$('<option>')
									.val(val)
									.html(data.result[val]);
								
								model.append(opt);
							}
						}
				     },
				});
			})
			// Add vehicle clicked
			.on('click','#add-vehicle',function(){
				var numVehicles=$(this).parents('form#new-assignment').children('fieldset').length - 3;
				var fieldset=vehicleTemplate.clone();
				
				// Update fieldset legend with vehicle #
				fieldset
					.find('legend')
					.html('Vehicle #'+(numVehicles+1)+' Information');
				
				// Insert the new vehicle fields
				$(this)
					.parents('fieldset')
					.after(fieldset);
					
				// Change the add vehicle button to a remove vehicle button
				$(this)
					.parents('.field')
					.find('label')
					.html('Remove this vehicle');
				$(this)
					.attr({
						id: 'remove-vehicle'
					})
					.val('Remove Vehicle');
				
				// Scroll the browser window to the new vehicle fields
				$('html, body').animate({
					scrollTop: fieldset.offset().top
				}, {
					duration: 500,
					complete: function(){
						fieldset.find('input[name="vin_number"]').focus();
					}
				});
			})
			// Remove vehicle clicked
			.on('click','#remove-vehicle',function(){
				// Get a reference to the form
				var form=$(this).parents('form#new-assignment');
				
				// Remove the fields from the form
				$(this)
					.parents('fieldset')
					.remove();
				
				// Relabel them
				form
					.children('fieldset')
					.filter(':gt(1)')
					.filter(':lt(-1)')
					.each(function(i,e){
						$(this)
							.find('legend')
							.html('Vehicle #'+(i+1)+' Information');
					});
			});
		
		// Form submission handler
		$('form#new-assignment').submit(function(e){
			e.preventDefault();
			
			// Clear previous message
			$('form#new-assignment input[type="submit"]').siblings('.msg').remove();
			
			// Check for tos_agreement
			if($('input[name="tos_agreement"]:checked').length==0)
			{
				var msg=$('<div>')
					.addClass('msg')
					.html('You must accept the terms and conditions to continue.');
				$('form#new-assignment input[type="submit"]').after(msg);
				
				return;
			}
			
			// Collect the data
			var job_fields=$(this)
				.children('fieldset')
				.filter(':lt(2)')
				.add(
					$(this)
						.children('fieldset')
						.filter(':gt(-2)')
				);
			var vehicle_fields=$(this).children('fieldset').filter(':gt(1)').filter(':lt(-1)');
			
			// Now build the data objects
			var job_data={};
			// Simply add all the fields in these fieldsets to the data object
			job_fields.find('input:text, textarea, select, input:radio:checked, input:checkbox:checked, :hidden').each(function(){
				job_data[ $(this).attr('name') ]=$(this).val();
			});
			
			
			var vehicle_data=[];
			// Iterate over each vehicle
			vehicle_fields.each(function(){
				var data={};
				// Add all the data in each fieldset as a seperate array item
				$(this).find('input:text, textarea, select, input:radio:checked, input:checkbox:checked, :hidden').each(function(){
					data[ $(this).attr('name') ]=$(this).val();
				});
				vehicle_data.push(data);
			});
			
			console.log({
				 	job: job_data,
					vehicles: vehicle_data,
					action: 'save-new-assignment',
				 });
			
			function formError(err)
			{
				var msg=$('<div>')
					.addClass('msg')
					.html('An error has occurred'+( err ? ': '+err : '' )+'. Please try again.');
				$('form#new-assignment input[type="submit"]').after(msg);
			}
			
			// Save the assignment
			$.ajax({
			     url: '/wp-admin/admin-ajax.php',
			     type: 'post',
			     data: {
				 	job: job_data,
					vehicles: vehicle_data,
					action: 'save-new-assignment',
				 },
				 //dataType: 'json',
			     success: function(data,textStatus,jqXHR){
				 	console.log(data);
					data=$.parseJSON(data);
					if(data.status=='success')
					{
						var msg=$('<div>')
							.addClass('msg')
							.html('Your assignment has been saved! Please wait...');
						$('form#new-assignment input[type="submit"]').after(msg);
						
						setTimeout(function(){
							close_new_assignments();
							$('#dashboard').accordion('option','active',1);
						},2000);
					}
					else
						formError(data.error);
				},
				error: function(jqXHR,textStatus,errorThrown){
					formError(errorThrown);
				},
			});
		});
		
		// Populate vehicle year dropdown
		$.ajax({
		     url: '/wp-admin/admin-ajax.php',
		     type: 'post',
		     data: {
		         action: 'vehicle-year-list'
		     },
		     success: function(data,textStatus,jqXHR){
			 	if(data.success)
				{
					var select=$('select[name="year"]');
					
			 		for(var val in data.result)
					{
						var opt=$('<option>')
							.val(val)
							.html(data.result[val]);
						
						select.append(opt);
					}
				}
				
				vehicleTemplate=$('#new-assignment fieldset:eq(2)').clone();
		     },
		});
		
		// Store a template for adding new vehicles
		var vehicleTemplate;
		
	});
</script>