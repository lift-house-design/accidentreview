$(function(){
	// Radio buttons
	//$('.ui-radios').buttonset();
	
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
			var where=$(this).parents('fieldset').find('.keys_available_where.field');
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
								.html('(select a make)');
							
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
		// Populate vehicle model dropdown on vehicle make change
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
		// Add vehicle clicked
		.on('click','#add-vehicle',function(){
			var numVehicles=$(this).parents('form#new-assignment').children('fieldset').length - 3;
			var fieldset=vehicleTemplate.clone();
			
			// Change the radio buttons element names to keep them unique to that group
			fieldset
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
			fieldset
				.find('.ui-radios')
				.buttonset();
			
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
		})
		.on('change','select[name="belongs_to"]',function(){
			var owners_name=$(this)
				.parents('.field')
				.find('input[name="owners_name"]');
			var name='';
			
			if($(this).val()=='Claimant')
			{
				name=$('input[name="claimant_name"]').val();
			}
			else if($(this).val()=='Insured')
			{
				name=$('input[name="insured_name"]').val();				
			}
			
			if(name!='')
				owners_name.val(name);
		});
	
	var uploading=false;
	function ajax_upload()
	{
		uploading=true;
		$('.file-upload.field input[type="button"]').val('Uploading...');
		
		$.ajaxFileUpload({
			url: '/wp-admin/admin-ajax.php', 
			secureuri: false,
			fileElementId: 'upload-field',
			dataType: 'JSON',
			data: {
				action: 'save-attachment',
			},
			success: function(data) {
				console.log(data);
				data=$.parseJSON(data);
				
				if(data.status != 'error')
				{
					var file=$('<div>')
						.attr('data-attachment-id',data.attachment_id)
						.data('attachment-id',data.attachment_id)
						.addClass('file')
						.addClass(data.type)
						.append(
							$('<a>')
								.addClass('icon')
								.html('&nbsp;')
						)
						.append(
							$('<a>')
								.addClass('description')
								.html(data.description)
						)
						.appendTo('.file-upload.field .file-preview');
						
					if(data.type=='img')
					{
						$('<img>')
							.load(function(){
								file
									.children('a.icon')
									.append(this);
								$(this)
									.css({
										'margin-left': -($(this).width()/2)+'px',
										'margin-top': -($(this).height()/2)+'px',
									});
								
							})
							.attr('src',data.url);
					}
					else
					{
						file
							.children('a.icon')
							.attr({
								href: data.url,
								target: '_blank',
							})
					}
				}
				
				$('.file-upload.field input[type="file"]').change(ajax_upload);
				uploading=false;
				$('.file-upload.field input[type="button"]').val('Upload File');
			}
		});
	}
		
	$(document)
		.on('click','.file-upload.field input[type="button"]',function(){
			$(this)
				.siblings('input[type="file"]')
				.click();
		})
		.on('change','.file-upload.field input[type="file"]',ajax_upload);
	
	// Form submission handler
	$('form#new-assignment').submit(function(e){
		e.preventDefault();
		
		// Clear previous message
		$('form#new-assignment input[type="submit"]').siblings('.msg').remove();
		
		// Check for tos_agreement
		if(isNewAssignment && $('input[name="tos_agreement"]:checked').length==0)
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
				var current_name=$(this).attr('name');
				if(typeof current_name == 'string')
				{
					if(current_name.match(/_\d+$/))
					{
						var new_name=current_name.replace(/_\d+$/,'');
					}
					else
						var new_name=current_name;
					
					data[ new_name ]=$(this).val();
				}
			});
			vehicle_data.push(data);
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
			 dataType: 'json',
		     success: function(data,textStatus,jqXHR){
				if(data.status=='success')
				{
					var msg=$('<div>')
						.addClass('msg')
						.html('Your assignment has been saved! Please wait...');
					$('form#new-assignment input[type="submit"]').after(msg);
					
					setTimeout(function(){
						close_new_assignments();
						window.location.href='/reps#assignments';
						/*$('#assignments').dataTable().fnAddData([
							
						]);
						$('#dashboard').accordion('option','active',1);*/
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
				var vehicles=$('form#new-assignment')
					.children('fieldset')
					.filter(':gt(1)')
					.filter(':lt(-1)')
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
							var opt=$('<option>')
								.val(val)
								.html(data.result[val]);
							
							select.append(opt);
						}
						
						select.val(selectVal);
						
						if(selectVal != '')
						{
							select.change();
						}
					});
			}
			
			vehicleTemplate=$('#new-assignment fieldset').eq(2).clone();
			vehicleTemplate
				.find(':input:not(:button,:radio,:checkbox)')
				.val('');
			vehicleTemplate
				.find('.field:last')
				.replaceWith(
					$('<div>')
						.addClass('field')
						.append(
							$('<label>')
								.html('Add another vehicle')
						)
						.append(
							$('<input>')
								.attr({
									type: 'button',
									id: 'add-vehicle'
								})
								.val('Add Vehicle')
						)
				);
			$('.ui-radios').buttonset();
	     },
	});
	
	// Store a template for adding new vehicles
	var vehicleTemplate;
	
	// Current assignments accordion
	$('#assignments .assignment-panel fieldset:not(:last) > legend')
		.css('cursor','pointer')
		.click(function(){
			var collapsed=$(this).parents('fieldset').data('collapsed');
			
			if(collapsed)
			{
				$(this)
					.parents('fieldset')
					.children('.field')
					.slideDown(500);
				$(this)
					.parents('fieldset')
					.data('collapsed',false);
			}
			else
			{
				$(this)
					.parents('fieldset')
					.children('.field')
					.slideUp(500);
				$(this)
					.parents('fieldset')
					.data('collapsed',true);
			}
		});

	
	//////////////////////////////////////
	// IMAGE UPLOADS
	//////////////////////////////////////
	
	var image_preview_prev_offset=$('#image-preview #image-preview-next').width()+40;
	$('#image-preview #image-preview-prev').css('right',image_preview_prev_offset+'px');
	
	// Center images in thumbnails
	$('.file-upload.field .file-preview .img.file a.icon img')
		.load(function(){
			var width=$(this).width();
			var height=$(this).height();
			
			$(this)
				.css({
					'margin-left': -(width/2)+'px',
					'margin-top': -(height/2)+'px',
				});
		});
	
	$('.file-upload.field .file-preview .file .description')
		.fancybox({
			padding: 20,
			closeBtn: false,
			href: '#attachment-edit',
			beforeShow: function(){
				var description_anchor=$(this.element[0]);
				var description=description_anchor.html();
				var attachmentId=description_anchor.parents('.file').data('attachment-id');
				console.log(description);
				console.log(description_anchor.parents('.file'));
				$('#attachment-edit')
					.attr('data-attachment-id',attachmentId)
					.data('attachment-id',attachmentId)
					.find('textarea')
					.val(description);
			}
		});
	
	$('.file-upload.field .file-preview .img.file a.icon')
		.fancybox({
			padding: 20,
			href: '#image-preview',
			closeBtn: false,
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
			var nextImg=$('.file-upload.field .file-preview')
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
			var prevImg=$('.file-upload.field .file-preview')
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
			
			var description_anchor=$('.file-upload.field .file-preview')
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
		.on('click','#attachment-edit #attachment-edit-close',function(){
			$.fancybox.close();
		})
		.on('click','#attachment-edit #attachment-edit-save',function(){
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
				success: function(data,textStatus,jqXHR){
					console.log(data);
					data=$.parseJSON(data);
					
					if(data.status=='success')
					{
						$('.file-upload.field .file-preview')
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
					console.log(data);
					data=$.parseJSON(data);
					
					if(data.status=='success')
					{
						$('.file-upload.field .file-preview')
							.find('.file[data-attachment-id="'+attachmentId+'"]')
							.remove();
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
				}
			});
		});
});