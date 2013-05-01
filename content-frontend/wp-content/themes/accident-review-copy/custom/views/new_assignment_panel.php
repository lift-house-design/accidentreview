<script src="/wp-content/themes/accident-review/js/jquery-ui-1.10.2.min.js"></script>
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-buttonset.css" />
<form id="new-assignment">
	<fieldset>
		<legend>General Information</legend>
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
			<input type="text" name="date_of_loss" placeholder="Enter date of loss" />
		</div>
		<div class="field">
			<label>Date of Recovery</label>
			<input type="text" name="date_of_recovery" placeholder="Enter date of recovery" />
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
			<label>Location of Loss</label>
			<textarea name="describe_location" placeholder="Enter description of the location of loss"></textarea>
		</div>
		<div class="field">
			<label>Describe Loss in Chronological Order</label>
			<textarea name="describe_loss" placeholder="Enter description of loss in chronological order"></textarea>
		</div>
		<div class="field">
			<label>Services Requested</label>
			<textarea name="services_requested" placeholder="Enter services you are requesting"></textarea>
		</div>
		<div class="field">
			<label>Is the vehicle equipped with a factory perimeter security system?</label>
			<div class="ui-radios">
				<input type="radio" name="factory_perimeter_security_system" id="factory_perimeter_security_system-yes" value="Yes" /><label for="factory_perimeter_security_system-yes">Yes</label>
				<input type="radio" name="factory_perimeter_security_system" id="factory_perimeter_security_system-no" value="No" /><label for="factory_perimeter_security_system-no">No</label>
				<input type="radio" name="factory_perimeter_security_system" id="factory_perimeter_security_system-optional" value="Optional" /><label for="factory_perimeter_security_system-optional">Optional</label>
				<input type="radio" name="factory_perimeter_security_system" id="factory_perimeter_security_system-unknown" value="Unknown" checked="checked" /><label for="factory_perimeter_security_system-unknown">Unknown</label>
			</div>
		</div>
		<div class="field">
			<label>Is the vehicle equipped with an aftermarket security system?</label>
			<div class="ui-radios">
				<input type="radio" name="aftermarket_security_system" id="aftermarket_security_system-yes" value="Yes" /><label for="aftermarket_security_system-yes">Yes</label>
				<input type="radio" name="aftermarket_security_system" id="aftermarket_security_system-no" value="No" /><label for="aftermarket_security_system-no">No</label>
				<input type="radio" name="aftermarket_security_system" id="aftermarket_security_system-unknown" value="Unknown" checked="checked" /><label for="aftermarket_security_system-unknown">Unknown</label>
			</div>
		</div>
		<div class="field">
			<label>Is the vehicle equipped with a remote start system?</label>
			<div class="ui-radios">
				<input type="radio" name="remote_start_system" id="remote_start_system-yes" value="Yes" /><label for="remote_start_system-yes">Yes</label>
				<input type="radio" name="remote_start_system" id="remote_start_system-no" value="No" /><label for="remote_start_system-no">No</label>
				<input type="radio" name="remote_start_system" id="remote_start_system-unknown" value="Unknown" checked="checked" /><label for="remote_start_system-unknown">Unknown</label>
			</div>
		</div>
		<div class="field">
			<label>Is the remote start system factory or aftermarket?</label>
			<div class="ui-radios">
				<input type="radio" name="remote_start_system_type" id="remote_start_system_type-factory" value="Factory" /><label for="remote_start_system_type-factory">Factory</label>
				<input type="radio" name="remote_start_system_type" id="remote_start_system_type-aftermarket" value="Aftermarket" /><label for="remote_start_system_type-aftermarket">Aftermarket</label>
				<input type="radio" name="remote_start_system_type" id="remote_start_system_type-unknown" value="Unknown" checked="checked" /><label for="remote_start_system_type-unknown">Unknown</label>
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend>Vehicle Information</legend>
		<div class="field">
			<label>If the VIN number is available, enter it below and click "Lookup VIN"</label>
			<input type="text" name="vin_number" placeholder="Enter the VIN number" />
			<input type="button" value="Lookup VIN" id="lookup-vin" />
		</div>
		<div class="field">
			<label>Vehicle Description</label>
			<div class="field-row">
				<select name="vehicle_year">
					<option value="">Year:</option>
				</select>
				<select name="vehicle_make" disabled="disabled">
					<option value="">(select a year)</option>
				</select>
				<select name="vehicle_model" disabled="disabled">
					<option value="">(select a year)</option>
				</select>
			</div>
			<div class="field-row">
				<input type="text" name="vehicle_owner_name" placeholder="Enter owner's full name" />
				<select name="vehicle_belongs_to">
					<option name="">Vehicle belongs to:</option>
				</select>
			</div>
			<div class="field-row">
				<input type="text" name="vehicle_color" placeholder="Enter vehicle's color" />
				<input type="text" name="vehicle_registration_number" placeholder="Enter vehicle's registration number" />
			</div>
		</div>
		<div class="field">
			<label>Modifications/Aftermarket</label>
			<textarea name="modifications_aftermarket" placeholder="List any modifications"></textarea>
		</div>
		<div class="field">
			<label>Additional Information</label>
			<textarea name="additional_information" placeholder="Provide any additional information that will help us analyze your request"></textarea>
		</div>
		<div class="field">
			<label>Are the keys available?</label>
			<div id="keys-available" class="ui-radios">
				<input type="radio" name="keys_available" id="keys_available-yes" value="Yes" /><label for="keys_available-yes">Yes</label>
				<input type="radio" name="keys_available" id="keys_available-no" value="No" /><label for="keys_available-no">No</label>
				<input type="radio" name="keys_available" id="keys_available-unknown" value="Unknown" checked="checked" /><label for="keys_available-unknown">Unknown</label>
			</div>
			<input type="text" name="keys_available_where" placeholder="Let us know where we can find the keys" style="display: none" />
		</div>
		<div class="field">
			<label>Add another vehicle</label>
			<input type="button" value="Add Vehicle" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Submit Assignment</legend>
		<div class="field"> <!-- @TODO: change the url to the terms and conditions -->
			<label>Before submitting, you must read and agree to the terms of service</label>
			<input type="checkbox" name="terms_of_service_agreement" id="terms-of-service-agreement" /><label for="terms-of-service-agreement" class="checkbox-label">I have read and agree to the <a href="/dev/terms-conditions">terms of service</a>.</label>
		</div>
	</fieldset>
</form>
<script>
	$(function(){
		// Radio buttons
		$('.ui-radios').buttonset();
		
		// Keys available
		$('#keys-available input[type="radio"]').change(function(){
			var where=$(this)
				.parents('.field')
				.find('input[name="keys_available_where"]');
			
			if($(this).val()=='Yes')
				where.show().focus(); // Show where input
			else
				where.hide(); // Hide where input
		});
		
		// VIN lookup
		$('#lookup-vin').click(function(){
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
							.find('select[name="vehicle_year"]')
							.val(data.data.year);
						
						// Set make
						vehicle_description
							.find('select[name="vehicle_make"]')
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
							.find('select[name="vehicle_model"]')
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
							.find('input[name="vehicle_owner_name"]')
							.focus();
							
						// Show a message
						var msg=$('<div>')
							.css({
								'text-align': 'center',
								'font-size': '11px',
								'font-style': 'italic',
								'margin-top': '10px',
							})
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
			
		});
		
		// Populate vehicle description fields
		$.ajax({
		     url: '/wp-admin/admin-ajax.php',
		     type: 'post',
		     data: {
		         action: 'vehicle-year-list'
		     },
		     success: function(data,textStatus,jqXHR){
			 	if(data.success)
				{
					var select=$('select[name="vehicle_year"]');
					
					for(var val in data.result)
					{
						var opt=$('<option>')
							.val(val)
							.html(data.result[val]);
						
						select.append(opt);
					}
				}
		     },
		});
		
		$('select[name="vehicle_year"]').change(function(){
			var make=$('select[name="vehicle_make"]')
				.empty()
				.attr('disabled','disabled');
			var opt=$('<option>')
				.val('')
				.html('Loading...');	
			make.append(opt);
			
			var model=$('select[name="vehicle_model"]')
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
		});
		
		$('select[name="vehicle_make"]').change(function(){
			var model=$('select[name="vehicle_model"]')
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
					 year: $('select[name="vehicle_year"]').val(),
					 make: $(this).val()
			     },
			     success: function(data,textStatus,jqXHR){
				 	if(data.success)
					{
						var model=$('select[name="vehicle_model"]')
							.empty()
							.removeAttr('disabled');
						
						var opt=$('<option>')
								.val('')
								.html('Model:');
							
						model.append(opt);
						
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
		});
	});
</script>