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
<script src="/wp-content/themes/accident-review/js/jquery.ajaxfileupload.js"></script>
<link rel="stylesheet" href="/wp-content/themes/accident-review/js/fancybox/jquery.fancybox.css" />
<script src="/wp-content/themes/accident-review/js/fancybox/jquery.fancybox.js"></script>
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
			<?php $i=0 ?>
			<?php foreach($new_assignment_attachments as $new_attachment): ?>
				<?php $fileType=ar_get_file_class($new_attachment['name']); ?>
				<div id="img-<?php echo $i++ ?>" class="<?php echo $fileType ?> file" data-attachment-id="<?php echo $new_attachment['id'] ?>">
					<a class="icon" href="<?php echo $fileType=='img' ? '#' : 'http://backend.accidentreview.com/uploads/'.$new_attachment['location'] ?>">
						&nbsp;
						<?php if($fileType=='img'): ?>
							<img src="http://backend.accidentreview.com/uploads/<?php echo $new_attachment['location'] ?>" />
						<?php endif; ?>
					</a>
					<a class="description" href="#"><?php echo $new_attachment['description'] ?></a>
				</div>
			<?php endforeach; ?>
			</div>
			<div id="image-preview">
				<div class="image">
					<img src="http://backend.accidentreview.com/uploads/beecddcb0a4cf4bbc5326d51e45a0f365edc9ab0" />
					<a class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean fringilla commodo ipsum, at lobortis lorem molestie euismod. Nulla dolor felis, tristique nec luctus vel, pulvinar ut nibh. Nam vulputate tincidunt tempor. </a>
				</div>
				<a id="image-preview-next" class="button">Next</a>
				<a id="image-preview-prev" class="button">Previous</a>
				<a id="image-preview-close" class="button">Close</a>
			</div>
			<div id="attachment-edit">
				<h3>Edit Attachment</h3>
				<textarea name="description"></textarea>
				<a id="attachment-edit-save" class="button">Save Description</a>
				<a id="attachment-edit-delete" class="button">Delete Attachment</a>
				<a id="attachment-edit-close" class="button">Cancel</a>
			</div>
			<script>
				$(function(){
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
						/*.on('click','#image-preview a.description',function(){
							
							function restoreDescription(value)
							{
								var a=$('<a>')
									.addClass('description')
									.html(value);
								
								$('#image-preview div.description')
									.replaceWith(a);
							}
							
							var height=$(this).height()+5;
							var description=$(this).html();
							
							var textarea=$('<textarea>')
								.css('height',height+'px')
								.html(description);
							var saveButton=$('<a>')
								.addClass('button')
								.html('Save')
								.click(function(){
									var newDescription=$(this)
										.siblings('textarea')
										.val();
									var attachment_id=$('#image-preview').data('attachment-id');
									
									$.ajax({
									     url: '/wp-admin/admin-ajax.php',
									     type: 'post',
									     data: {
									     	action: 'save-attachment-description',
											attachment_id: attachment_id,
											description: newDescription
									     },
									     success: function(data,textStatus,jqXHR){
										 	console.log(data);
									         data=$.parseJSON(data);
											 
											 if(data.status=='success')
											 {
											 	restoreDescription(newDescription);
									
												var attachmentId=$('#image-preview').data('attachment-id');
												$('.file-upload.field .file-preview')
													.find('.file[data-attachment-id="'+attachmentId+'"] .description')
													.html(newDescription);
											 }
											 else
											 	restoreDescription(description);
									     },
									     error: function(jqXHR,textStatus,errorThrown){
									         restoreDescription(description);
									     },
									});
								});
							var cancelButton=$('<a>')
								.addClass('button')
								.html('Cancel')
								.click(function(){
									restoreDescription(description);
								});
								
							$(this)
								.replaceWith(
									$('<div>')
										.addClass('description')
										.append(textarea)
										.append(saveButton)
										.append(cancelButton)
								);
							
							textarea.focus();
						});*/
				});
			</script>
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
					data=$.parseJSON(data);
					console.log(data);
					
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
									console.log($(this).width());
									console.log($(this).height());
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