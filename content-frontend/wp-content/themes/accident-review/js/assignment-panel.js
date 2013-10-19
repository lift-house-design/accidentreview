function get_assignment_data(check_for_errors)
{
	if(check_for_errors!==false)
	{
		// Check for terms of service agreement
		if(isNewAssignment && $('input[name="tos_agreement"]:checked').length==0)
		{
			return 'You must accept the terms and conditions to continue.';
		}

		// Check for required fields
		var required_error=$([]);
		$('input:text.required, textarea.required, select.required').each(function(){
			if($.trim($(this).val().toString())=='')
			{
				required_error=required_error.add(this);
			}
		});

		if(required_error.length>0)
		{
			// Add error class to inputs, remove it when value is changed
			required_error
				.addClass('error')
				.change(function(){
					$(this)
						.removeClass('error');
					$(document).off('change',this);
				});

			return 'You have not filled out some required fields. Fields marked with * are required, please try again.';
		}
	}

	var input_selector='input[type="text"], textarea, select, input[type="radio"]:checked, input[type="checkbox"]:checked, input[type="hidden"]';

	// Sort the data into the different entities
	var job_data={};
	var vehicle_data=[];
	var claimant_data=[];

	// This function will create an array of values if the same key is used
	function add_data(obj,key,val)
	{
		if(typeof obj[key] != 'undefined')
		{
			if(obj[key] instanceof Array)
			{
				obj[key].push(val);
			}
			else
			{
				var old_val=obj[key];
				obj[key]=[old_val,val];
			}
		}
		else
		{
			obj[key]=val;
		}
	}

	// Get job data
	$('form#new-assignment > fieldset:first-child, form#new-assignment > fieldset:last-child')
		.find(input_selector)
		.each(function(){
			if($(this).parents('#vehicles-container, #claimants-container, .file-upload.field').length==0)
				add_data(job_data,$(this).attr('name'),$(this).val());
				//job_data[ $(this).attr('name') ]=$(this).val();
		});

	// Get each vehicle's data
	$('#vehicles-container > .vehicle')
		.each(function(){
			// Get data for this vehicle
			var data={};
			$(this)
				.find(input_selector)
				.each(function(){
					// If element's name ends in _{int}, remove it
					var name=$(this).attr('name');
					if(name.match(/_\d+$/))
						name=name.replace(/_\d+$/,'');

					// Add data to the object
					//data[name]=$(this).val();
					add_data(data,name,$(this).val());
				});
			// Add object to the array
			vehicle_data.push(data);
		});

	// Get each claimant's data
	$('#claimants-container > .claimant')
		.each(function(){
			// Get data for this claimant
			var data={};
			$(this)
				.find(input_selector)
				.each(function(){
					// If element's name ends in _{int}, remove it
					var name=$(this).attr('name');
					if(name.match(/_\d+$/))
						name=name.replace(/_\d+$/,'');

					// Add data to the object
					//data[name]=$(this).val();
					add_data(data,name,$(this).val());
				});
			// Add object to the array
			claimant_data.push(data);
		});
	//console.log("Job ID? "+job_data.id);
	return {
		'job': job_data,
		'vehicles': vehicle_data,
		'claimants': claimant_data
	};
}
/*
|--------------------------------------------------------------------------
| Autosave
|--------------------------------------------------------------------------
*/
function start_autosave()
{
	autosave_timer=setInterval(function(){
		// Get assignment data
		var assignment_data=get_assignment_data(false);
		assignment_data.action='save-new-assignment';
		assignment_data.new_assignment=0;
		assignment_data.job.autosave=1;

		// Save the assignment
		$.ajax({
		     url: '/wp-admin/admin-ajax.php',
		     type: 'post',
		     data: assignment_data,
			 dataType: 'json',
		     success: function(data,textStatus,jqXHR){
				/*console.log('<autosave>');
				console.log('data received:');
				console.log(data);
				console.log('job data sent:');
				console.log(assignment_data);
				console.log('</autosave>');*/
			},
			error: function(jqXHR,textStatus,errorThrown){
				console.log('autosave error:');
				console.log(textStatus);
			},
		});
	},10000);
}

$(function(){
	// Date fields
	$('input[type="text"].date').datepicker({
		dateFormat: 'yy-mm-dd'
	});

	// Remove events set by a previous assignment panel load
	$(document)
		.off('change','.keys_available.field input[type="radio"]')
		.off('change','.questionable_loss.field input[type="radio"]')
		.off('click','input[type="button"].vin-lookup')
		.off('change','select[name="year"]')
		.off('change','select[name="make"]')
		.off('click','#addvehicle')
		.off('click','#vehicles-container fieldset.vehicle legend a.remove.button')
		.off('click','#addclaimant')
		.off('click','#claimants-container fieldset.claimant legend a.remove.button')
		.off('submit','form#new-assignment')
		.off('load','.file-preview .img.file a.icon img')
		.off('click','#image-preview #image-preview-next')
		.off('click','#image-preview #image-preview-prev')
		.off('click','#image-preview #image-preview-close')
		.off('click','#image-preview a.description')
		.off('click','#attachment-edit-close')
		.off('click','#attachment-edit-save')
		.off('click','#attachment-edit-delete')
		.off('click','#create-message');

	$(document)
		// Flag used to prompt user to confirm leaving
		.on('change','input:text, textarea, select, input:radio, input:checkbox, :hidden',function(){
			confirmLeave=true;
		})
		/*
		|--------------------------------------------------------------------------
		| Keys Available (vehicle theft only)
		|--------------------------------------------------------------------------
		*/
		.on('change','.keys_available.field input[type="radio"]',function(){
			var where=$(this).parents('fieldset').find('.keys_available_where.field');
			if($(this).val()=='Yes')
				where.show().find('input[type="text"]').focus(); // Show where input
			else
				where.hide(); // Hide where input
		})
		/*
		|--------------------------------------------------------------------------
		| Questionable Loss (collision analysis/reconstruction only)
		|--------------------------------------------------------------------------
		*/
		.on('change','.questionable_loss.field input[type="radio"]',function(){
			if($(this).val()=='Yes')
			{
				$('.questionable_loss_yes.field').show();
				$('.questionable_loss_no.field').hide();
			}
			else if($(this).val()=='No')
			{
				$('.questionable_loss_yes.field').hide();
				$('.questionable_loss_no.field').show();
			}
		})
		/*
		|--------------------------------------------------------------------------
		| VIN Submit
		|--------------------------------------------------------------------------
		*/
		.on('click','input[type="button"].vin-lookup',function(){
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
				error:function(xhr, status, errorThrown) { 
	            	alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
	        	}, 
			     success: function(data,textStatus,jqXHR){
			     	function show_vin_msg(err,fadeOut)
			     	{
			     		$(vin_lookup)
							.parents('.field-row')
							.find('.msg')
							.remove();
							
						var msg=$('<div>')
							.addClass('msg')
							.html(err);
						
						$(vin_lookup).after(msg);

						if(fadeOut !== false)
						{
							setTimeout(function(){
								msg.fadeOut(1000);
							},4000);
						}
			     	}

			         if(data.status=='success')
					 {
					 	var vehicle_description=$(vin_lookup)
							.parents('.field-row')
							.next('.field-row');
						
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
						
						// Move focus to the operator field
						vehicle_description
							.parents('.field')
							.find('input[name="operator"]')
							.focus();
							
						// Show a message
						show_vin_msg('Your VIN has been found. Please fill out the remaining fields below.',false);
					 }
					else
					{
						show_vin_msg(data.error);
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
		/*
		|--------------------------------------------------------------------------
		| Vehicle Year Change
		|--------------------------------------------------------------------------
		*/
		.on('change','select[name="year"]',function(){
			var make=$(this)
				.parents('.field')
				.find('select[name="make"]');
			var makeVal=make.val();
			make
				.empty()
				.attr('disabled','disabled');
			var opt=$('<option>')
				.val('')
				.html('Loading...');	
			make.append(opt);
			
			var model=$(this)
				.parents('.field')
				.find('select[name="model"]');
			var modelVal=model.val();
			model
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
				error:function(xhr, status, errorThrown) { 
	            	alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
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
						
						make.val(makeVal);
						
						var opt=$('<option>')
								.val('')
								.html('Model:');
							
						model
							.empty()
							.append(opt);
						
						if(modelVal != '')
						{
							var opt=$('<option>')
								.val(modelVal)
								.html(modelVal);
							
							model
								.append(opt)
								.val(modelVal);
						}
						
						if(makeVal!='')
						{
							make.change();
						}
					}
			     },
			});
		})
		/*
		|--------------------------------------------------------------------------
		| Vehicle Make Change
		|--------------------------------------------------------------------------
		*/
		.on('change','select[name="make"]',function(){
			var model=$(this)
				.parents('.field')
				.find('select[name="model"]');
			var modelVal=model.val();
			model
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
				error:function(xhr, status, errorThrown) { 
	            	alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
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
						
						model.val(modelVal);
					}
			     },
			});
		})
		/*
		|--------------------------------------------------------------------------
		| Add Vehicle
		|--------------------------------------------------------------------------
		*/
		.on('click','#addvehicle',function(){
			var numVehicles=$('#vehicles-container > fieldset.vehicle:visible').length;
			var vehicle=vehicleTemplate.clone();

			// Change the radio buttons element names to keep them unique to that group
			vehicle
				.find('.ui-radios input[type="radio"]')
				.each(function(){
					var current_name=$(this).attr('name').toString();
					var new_name=current_name.replace(/_\d+$/,'_'+(numVehicles+1));
					$(this).attr('name',new_name);
					var current_id=$(this).attr('id').toString();
					var new_id=current_id.replace(current_name,new_name);
					$(this).attr('id',new_id);
					$(this).next('label').attr('for',new_id);
				});

			// Apply the buttonset widget
			vehicle
				.find('.ui-radios')
				.buttonset();

			// Add the new vehicle
			$('#vehicles-container').append(vehicle);

			$('#vehicles-container > .vehicle').each(function(i){
				$(this)
					.find('legend')
					.html('Insured Vehicle #'+(i+1))
					.append(
						$('<a>')
							.addClass('remove')
							.addClass('button')
							.html('Remove Vehicle')
					);
			});

			// Scroll the browser window to the new vehicle fields
			$('html, body').animate({
				scrollTop: vehicle.offset().top
			}, {
				duration: 500,
				complete: function(){
					vehicle.find('input[name="vin_number"]').focus();
				}
			});
		})
		/*
		|--------------------------------------------------------------------------
		| Remove Vehicle
		|--------------------------------------------------------------------------
		*/
		.on('click','#vehicles-container fieldset.vehicle legend a.remove.button',function(){
			// Remove the vehicle
			$(this)
				.parents('fieldset.vehicle')
				.remove();

			$('#vehicles-container > .vehicle').each(function(i){
				$(this)
					.find('legend')
					.html('Insured Vehicle #'+(i+1))
					.append(
						$('<a>')
							.addClass('remove')
							.addClass('button')
							.html('Remove Vehicle')
					);
			});

			// Scroll the browser window to the top of the vehicle fields
			$('html, body').animate({
				scrollTop: $('#vehicles-container').prev().offset().top
			}, {
				duration: 500
			});
		})
		/*
		|--------------------------------------------------------------------------
		| Add Claimant
		|--------------------------------------------------------------------------
		*/
		.on('click','#addclaimant',function(){
			var numClaimants=$('#claimants-container > fieldset.claimant:visible').length;
			var claimant=claimantTemplate.clone();

			// Change the radio buttons element names to keep them unique to that group
			claimant
				.find('.ui-radios input[type="radio"]')
				.each(function(){
					var current_name=$(this).attr('name').toString();
					var new_name=current_name.replace(/_\d+$/,'_'+(numClaimants+1));
					$(this).attr('name',new_name);
					var current_id=$(this).attr('id').toString();
					var new_id=current_id.replace(current_name,new_name);
					$(this).attr('id',new_id);
					$(this).next('label').attr('for',new_id);
				});

			// Apply the buttonset widget
			claimant
				.find('.ui-radios')
				.buttonset();

			// Add the new vehicle
			$('#claimants-container').append(claimant);

			$('#claimants-container > .claimant').each(function(i){
				$(this)
					.find('legend')
					.html('Claimant #'+(i+1))
					.append(
						$('<a>')
							.addClass('remove')
							.addClass('button')
							.html('Remove Claimant')
					);
			});

			// Scroll the browser window to the new vehicle fields
			$('html, body').animate({
				scrollTop: claimant.offset().top
			}, {
				duration: 500,
				complete: function(){
					claimant.find('input[name="claimant_name"]').focus();
				}
			});
		})
		/*
		|--------------------------------------------------------------------------
		| Remove Claimant
		|--------------------------------------------------------------------------
		*/
		.on('click','#claimants-container fieldset.claimant legend a.remove.button',function(){
			// Remove the claimant
			$(this)
				.parents('fieldset.claimant')
				.remove();

			$('#claimants-container > .claimant').each(function(i){
				$(this)
					.find('legend')
					.html('Claimant #'+(i+1))
					.append(
						$('<a>')
							.addClass('remove')
							.addClass('button')
							.html('Remove Claimant')
					);
			});

			// Scroll the browser window to the top of the vehicle fields
			$('html, body').animate({
				scrollTop: $('#claimants-container').prev().offset().top
			}, {
				duration: 500
			});
		})
		/*
		|--------------------------------------------------------------------------
		| Create Message
		|--------------------------------------------------------------------------
		*/
		.on('click','#create-message',function(){
			var self=this;
			var assignment_id=$('input[type="hidden"][name="id"]').val();
			var message=$(this).parents('fieldset').find('textarea[name="create_message"]').val();
			
			$.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: 'post',
				dataType: 'json',
				data: {
					action: 'create-message',
					assignment_id: assignment_id,
					message: message
				},
				error:function(xhr, status, errorThrown) { 
	            	alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
	        	}, 
				success: function(data,textStatus,jqXHR){
					alert('yippee');
					console.log('#create-message response:');
					console.log(data);

					if(data.status=='success')
					{
						var correspondence_container=$(self).parents('fieldset').find('.correspondence-container');
						var msg=$(self).parents('fieldset').find('.correspondence:eq(0)').clone();

						// Remove 'no correspondence' message
						var test=correspondence_container.children('p').remove();

						// Add message to list
						msg.css('display','block');
						msg.find('.message').html(message);
						msg.find('.timestamp').html(data.timestamp);
						msg.appendTo(correspondence_container);
						
						$('#create-message-box').val('');
					}
				},
				complete: function(){
					alert('amagmaga');
				}
			});
		});
	
	/*
	|--------------------------------------------------------------------------
	| Upload Attachment Handler
	|--------------------------------------------------------------------------
	*/
	

		
	$(document)
		.on('click','#fileupload-button',function(){
			console.log($('#fileupload').attr('type'));
			$('#fileupload').click();
		});
	
	/*
	|--------------------------------------------------------------------------
	| Attachment Edit/Delete Handlers
	|--------------------------------------------------------------------------
	*/
	var image_preview_prev_offset=$('#image-preview #image-preview-next').width()+40;
	$('#image-preview #image-preview-prev').css('right',image_preview_prev_offset+'px');
	
	$('.file-preview .file .description')
		.fancybox({
			padding: 20,
			closeBtn: true,
			href: '#attachment-edit',
			beforeShow: function(){
				var description_anchor=$(this.element[0]);
				var description=description_anchor.html();
				var attachmentId=description_anchor.parents('.file').data('attachment-id');
				
				$('#attachment-edit')
					.attr('data-attachment-id',attachmentId)
					.data('attachment-id',attachmentId)
					.find('textarea')
					.val(description);
			}
		});
	
	$('.file-preview .img.file a.icon')
		.fancybox({
			padding: 20,
			href: '#image-preview',
			closeBtn: true,
			beforeShow: function(){
				// Get properties of this image
				var icon=$(this.element[0]);
				var description=icon
					.siblings('a.description')
					.html();
				var src=icon
					.children('img')
					.attr('src');
				var attachmentId=icon.parents('.file').data('attachment-id');
					
				$('#image-preview')
					.attr('data-attachment-id',attachmentId)
					.data('attachment-id',attachmentId)
					.children('.image')
					.empty()
					.append(
						$('<a>')
							.attr({
								'href': src,
								'target': '_blank'
							})
							.append(
								$('<img>')
									.attr('src', src)
							)
					)
					.append(
						$('<a>')
							.addClass('description')
							.html(description)
					);
				
				var file=icon.parents('.file');
				if(file.nextAll('.img.file').length==0)
					$('#image-preview #image-preview-next').hide();
				else
					$('#image-preview #image-preview-next').show();
				if(file.prevAll('.img.file').length==0)
					$('#image-preview #image-preview-prev').hide();
				else
					$('#image-preview #image-preview-prev').show();
			}
		});
	
	$(document)
		.on('click','#image-preview #image-preview-next',function(){
			var attachmentId=$(this).parents('#image-preview').data('attachment-id');
			var nextImg=$('.file-preview')
				.find('.file[data-attachment-id="'+attachmentId+'"]')
				.nextAll('.img.file:first')
				.find('a.icon')
				.click()
				.parents('.img.file');
			
			if(nextImg.nextAll('.img.file').length==0)
				$(this).hide();
			if(nextImg.prevAll('.img.file').length>0)
				$('#image-preview #image-preview-prev').show();
			
			var image_preview_prev_offset=$('#image-preview #image-preview-next').width()+40;
			$('#image-preview #image-preview-prev').css('right',image_preview_prev_offset+'px');
		})
		.on('click','#image-preview #image-preview-prev',function(){
			var attachmentId=$(this).parents('#image-preview').data('attachment-id');
			var prevImg=$('.file-preview')
				.find('.file[data-attachment-id="'+attachmentId+'"]')
				.prevAll('.img.file:first')
				.find('a.icon')
				.click()
				.parents('.img.file');
				
			if(prevImg.prevAll('.img.file').length==0)
				$(this).hide();
			if(prevImg.nextAll('.img.file').length>0)
				$('#image-preview #image-preview-next').show();
				
			var image_preview_prev_offset=$('#image-preview #image-preview-next').width()+40;
			$('#image-preview #image-preview-prev').css('right',image_preview_prev_offset+'px');
		})
		.on('click','#image-preview #image-preview-close',function(){
			$.fancybox.close();
		})
		.on('click','#image-preview a.description',function(){
			var attachmentId=$(this).parents('#image-preview').data('attachment-id');
			
			var description_anchor=$('.file-preview')
				.find('.file[data-attachment-id="'+attachmentId+'"] a.description');
			var description=description_anchor.html();
			console.log(description_anchor.length);
			$('#attachment-edit')
				.attr('data-attachment-id',attachmentId)
				.data('attachment-id',attachmentId)
				.find('textarea')
				.html(description);
			
			description_anchor.click();
		})
		.on('click','#attachment-edit-close',function(){
			$.fancybox.close();
		})
		.on('click','#attachment-edit-save',function(){
			var attachmentId=$(this).parents('#attachment-edit').data('attachment-id');
			var newDescription=$(this)
				.siblings('textarea')
				.val();
			
			$('#attachment-edit #attachment-edit-save')
				.html('Saving...')
				.attr('disabled','disabled');
			$('#attachment-edit #attachment-edit-delete')
				.html('Saving...')
				.attr('disabled','disabled');
			
			$.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: 'post',
				data: {
					action: 'save-attachment-description',
					attachment_id: attachmentId,
					description: newDescription
				},
				error:function(xhr, status, errorThrown) { 
            		alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
        		}, 
				success: function(data,textStatus,jqXHR){
					console.log(data);
					data=$.parseJSON(data);
					
					if(data.status=='success')
					{
						$('.file-preview')
							.find('.file[data-attachment-id="'+attachmentId+'"] .description')
							.html(newDescription);
					}
				},
				complete: function(){
					$('#attachment-edit #attachment-edit-save')
						.html('Save Description')
						.removeAttr('disabled');
					$('#attachment-edit #attachment-edit-delete')
						.html('Delete Attachment')
						.removeAttr('disabled');
					
					$.fancybox.close();
				},
			});
		})
		.on('click','#attachment-edit #attachment-edit-delete',function(){
			var attachmentId=$(this).parents('#attachment-edit').data('attachment-id');
			
			$('#attachment-edit #attachment-edit-save')
				.html('Deleting...')
				.attr('disabled','disabled');
			$('#attachment-edit #attachment-edit-delete')
				.html('Deleting...')
				.attr('disabled','disabled');
			
			$.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: 'post',
				data: {
					action: 'delete-attachment',
					attachment_id: attachmentId
				},
				success: function(data,textStatus,jqXHR){
					
					if(data.status=='success')
					{
						$('.file-preview')
							.find('.file[data-attachment-id="'+attachmentId+'"]')
							.remove();
					}
					$('#attachment-edit-save').html('Save Description');
					$('#attachment-edit-save').removeAttr('disabled');
					$('#attachment-edit-delete').html('Delete Attachment');
					$('#attachment-edit-delete').removeAttr('disabled');
					
					$.fancybox.close();
				},
				complete: function(){
					if(data.status=='success')
					{
						$('.file-preview')
							.find('.file[data-attachment-id="'+attachmentId+'"]')
							.remove();
					}
					$('#attachment-edit #attachment-edit-save')
						.html('Save Description')
						.removeAttr('disabled');
					$('#attachment-edit #attachment-edit-delete')
						.html('Delete Attachment')
						.removeAttr('disabled');
					
					$.fancybox.close();
				},
				error: function(){
					alert('error');
				}
			});
		});

	/*
	|--------------------------------------------------------------------------
	| Assignment Submit Handler
	|--------------------------------------------------------------------------
	*/
	$('form#new-assignment').submit(function(e){
		e.preventDefault();

		function show_msg(msg)
		{
			clear_msg();

			$('form#new-assignment input[type="submit"]')
				.after(
					$('<div>')
						.addClass('msg')
						.html(msg)
				);
		}

		function clear_msg()
		{
			// Clear previous message
			$('form#new-assignment input[type="submit"]')
				.siblings('.msg')
				.remove();
		}

		// Get the assignment data
		var assignment_data=get_assignment_data();
		
		// If there was an error
		if(typeof assignment_data == 'string')
		{
			// Display it and return
			show_msg(assignment_data);
			return;
		}
		else
			clear_msg();

		// Add required data for the ajax request
		assignment_data.action='save-new-assignment';
		assignment_data.new_assignment=isNewAssignment ? 1 : 0;

		// Stop autosaving so that it does not overwrite the assignment after it is saved
		if(typeof autosave_timer=='number')
			clearInterval(autosave_timer);

		// Save the assignment
		$.ajax({
		     url: '/wp-admin/admin-ajax.php',
		     type: 'post',
		     data: assignment_data,
			 dataType: 'json',
		     success: function(data,textStatus,jqXHR){
		     	//console.log(data); return;
				if(data.status=='success')
				{
					show_msg('Your assignment has been saved! Please wait...');
					
					confirmLeave=false;
					setTimeout(function(){
						close_new_assignments();
						window.location.href='/dashboard/assignments';
					},2000);
				}
				else
				{
					show_msg('An error has occured fsdf: '+data.error);
				}
			},
			error: function(jqXHR,textStatus,errorThrown){
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
				show_msg('An error occurred huhu: '+errorThrown);
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
				$('form#new-assignment fieldset.vehicle, form#new-assignment fieldset.claimant')
					.each(function(){
						var select=$(this).find('select[name="year"]');
						var selectVal=select.val();
						
						select
							.empty()
							.append(
								$('<option>')
									.val('')
									.html('Year:')
							);
						
				 		for(var val in data.result)
						{
							if(val!='')
							{
								var opt=$('<option>')
									//.val(val)
									.html(data.result[val]);
								
								select.append(opt);
							}
						}
						select.val(selectVal);
						
						if(selectVal != '')
						{
							select.change();
						}
					});
			}
			
			vehicleTemplate=$('#vehicles-container #vehicle-template').clone();
			vehicleTemplate.removeAttr('id');
			$('#vehicles-container #vehicle-template').remove();
			claimantTemplate=$('#claimants-container #claimant-template').clone();
			claimantTemplate.removeAttr('id');
			$('#claimants-container #claimant-template').remove();

			$('.ui-radios').buttonset();
	     },
	});
	
	// Store a template for adding new vehicles and claimants
	var vehicleTemplate;
	var claimantTemplate;
});