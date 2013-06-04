<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-datepicker.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-button.css" />
<script src="/wp-content/themes/accident-review/js/jquery.ajaxfileupload.js"></script>
<link rel="stylesheet" href="/wp-content/themes/accident-review/js/fancybox/jquery.fancybox.css" />
<script src="/wp-content/themes/accident-review/js/fancybox/jquery.fancybox.js"></script>
<script src="/wp-content/themes/accident-review/js/assignment-panel.js"></script>
<form id="new-assignment">
	
	<fieldset>
		<legend>General Information</legend>
		<input type="hidden" name="id" value="<?php echo $job_id ?>" />
		<input type="hidden" name="type" value="<?php echo $assignment_type ?>" />
		<div class="field">
			<label>File Number</label>
			<input type="text" name="file_number" placeholder="Enter file number"<?php echo empty($job_data['file_number']) ? '' : ' value="'.$job_data['file_number'].'"' ?> />
		</div>
		<div class="field">
			<label>Insured Name</label>
			<input type="text" name="insured_name" placeholder="Enter insured name"<?php echo empty($job_data['insured_name']) ? '' : ' value="'.$job_data['insured_name'].'"' ?> />
		</div>
		<div class="field">
			<label>Claimant Name</label>
			<input type="text" name="claimant_name" placeholder="Enter claimant name"<?php echo empty($job_data['claimant_name']) ? '' : ' value="'.$job_data['claimant_name'].'"' ?> />
		</div>
		<div class="field">
			<label>Date of Loss</label>
			<input type="text" class="date" name="date_of_loss" placeholder="Enter date of loss"<?php echo empty($job_data['date_of_loss']) ? '' : ' value="'.date('Y-m-d',strtotime($job_data['date_of_loss'])).'"' ?> />
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
			<?php foreach($assignment_attachments as $attachment): ?>
				<?php $fileType=ar_get_file_class($attachment['name']); ?>
				<div id="img-<?php echo $i++ ?>" class="<?php echo $fileType ?> file" data-attachment-id="<?php echo $attachment['id'] ?>">
					<a class="icon" href="<?php echo $fileType=='img' ? '#' : AR_ATTACHMENT_URL.$attachment['url'] ?>">
						&nbsp;
						<?php if($fileType=='img'): ?>
							<img src="<?php echo AR_ATTACHMENT_URL.$attachment['url'] ?>" />
						<?php endif; ?>
					</a>
					<a class="description" href="#"><?php echo $attachment['description'] ?></a>
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
		</div>
		<div class="field">
			<label>Describe Loss in Chronological Order</label>
			<textarea name="loss_description" placeholder="Enter description of loss in chronological order"><?php echo empty($job_data['loss_description']) ? '' : $job_data['loss_description'] ?></textarea>
		</div>
		<div class="field">
			<label>Services Requested</label>
			<textarea name="services_requested" placeholder="Enter services you are requesting"><?php echo empty($job_data['services_requested']) ? '' : $job_data['services_requested'] ?></textarea>
		</div>
		<?php foreach($job_questions as $question_key=>$question): ?>
		<div class="<?php echo $question_key ?> field">
			<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
			<?php ar_display_question_field($question_key,$question, ( empty($job_data[$question_key]) ? false : $job_data[$question_key] ) ) ?>
		</div>
		<?php endforeach; ?>
	</fieldset>
	<?php if(!empty($job_data['vehicles'])): ?>
		<?php $vehicleNum=0; ?>
		<?php $vehicleCount=count($job_data['vehicles']) ?>
		<?php foreach($job_data['vehicles'] as $vehicle_data): ?>
			<fieldset>
				<legend>Vehicle<?php echo ( $multiple_vehicles ? ' #'.++$vehicleNum : '' ) ?> Information</legend>
				<div class="vin_number field">
					<label>If the VIN number is available, enter it below and click "Lookup VIN"</label>
					<input type="text" name="vin_number" placeholder="Enter the VIN number"<?php echo empty($vehicle_data['vin_number']) ? '' : ' value="'.$vehicle_data['vin_number'].'"' ?> />
					<input type="button" value="Lookup VIN" />
				</div>
				<div class="field">
					<label>Vehicle Description</label>
					<div class="field-row">
						<select name="year">
							<option value="">Year:</option>
							<?php if(!empty($vehicle_data['year'])): ?>
								<option value="<?php echo $vehicle_data['year'] ?>" selected="selected"><?php echo $vehicle_data['year'] ?></option>
							<?php endif; ?>
						</select>
						<select name="make" disabled="disabled">
							<option value="">(select a year)</option>
							<?php if(!empty($vehicle_data['make'])): ?>
								<option value="<?php echo ar_get_make_id($vehicle_data['year'],$vehicle_data['make']) ?>" selected="selected"><?php echo $vehicle_data['make'] ?></option>
							<?php endif; ?>
						</select>
						<select name="model" disabled="disabled">
							<option value="">(select a year)</option>
							<?php if(!empty($vehicle_data['model'])): ?>
								<option value="<?php echo $vehicle_data['model'] ?>" selected="selected"><?php echo $vehicle_data['model'] ?></option>
							<?php endif; ?>
						</select>
					</div>
					<div class="field-row">
						<input type="text" name="owners_name" placeholder="Enter owner's full name"<?php echo empty($vehicle_data['owners_name']) ? '' : ' value="'.$vehicle_data['owners_name'].'"' ?> />
						<select name="belongs_to">
							<option value="">Vehicle belongs to:</option>
							<?php foreach(array('Plaintiff','Defendant') as $val): ?>
								<?php if(empty($vehicle_data['belongs_to'])): ?>
									<option><?php echo $val ?></option>
								<?php else: ?>
									<option<?php echo $vehicle_data['belongs_to']==$val ? ' selected="selected"' : '' ?>><?php echo $val ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="field-row">
						<input type="text" name="color" placeholder="Enter vehicle's color"<?php echo empty($vehicle_data['color']) ? '' : ' value="'.$vehicle_data['color'].'"' ?> />
						<input type="text" name="registration_number" placeholder="Enter vehicle's registration number"<?php echo empty($vehicle_data['registration_number']) ? '' : ' value="'.$vehicle_data['registration_number'].'"' ?> />
					</div>
				</div>
				<div class="field">
					<label>Modifications/Aftermarket</label>
					<textarea name="modifications" placeholder="List any modifications"><?php echo empty($vehicle_data['modifications']) ? '' : $vehicle_data['modifications'] ?></textarea>
				</div>
				<div class="field">
					<label>Additional Information</label>
					<textarea name="additional_info" placeholder="Provide any additional information that will help us analyze your request"><?php echo empty($vehicle_data['additional_info']) ? '' : $vehicle_data['additional_info'] ?></textarea>
				</div>
				<?php foreach($vehicle_questions as $question_key=>$question): ?>
				<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
					<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
					<?php ar_display_question_field($question_key,$question, ( empty($vehicle_data[$question_key]) ? false : $vehicle_data[$question_key] ),$vehicleNum ) ?>
				</div>
				<?php endforeach; ?>
				<?php if($multiple_vehicles): ?>
					<?php if($vehicleNum==$vehicleCount): ?>
					<div class="field">
						<label>Add another vehicle</label>
						<input type="button" id="add-vehicle" value="Add Vehicle" />
					</div>
					<?php else: ?>
					<div class="field">
						<label>Remove this vehicle</label>
						<input type="button" id="remove-vehicle" value="Remove Vehicle" />
					</div>
					<?php endif; ?>
				<?php endif; ?>
			</fieldset>
		<?php endforeach; ?>
	<?php else: ?>
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
						<?php foreach(array('Claimant','Insured','Other') as $val): ?>
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
				<?php ar_display_question_field($question_key,$question,false,1) ?>
			</div>
			<?php endforeach; ?>
			<?php if($multiple_vehicles): ?>
			<div class="field">
				<label>Add another vehicle</label>
				<input type="button" id="add-vehicle" value="Add Vehicle" />
			</div>
			<?php endif; ?>
		</fieldset>
	<?php endif; ?>
	<?php if(!empty($job_data)): ?>
		<fieldset class="correspondence-fieldset">
			<legend>Correspondence</legend>
			<div class="correspondence-container field">
				<label>Messages</label>
				<?php $user_data=ar_user_data() ?>
				<div class="assignment-owner correspondence" style="display: none;">
					<div class="user-details">
						<div class="from">From:</div>
						<div class="name"><?php echo $user_data['first_name'].' '.$user_data['last_name'] ?></div>
						<div class="email"><?php echo $user_data['email'] ?></div>
						<div class="role"><?php echo 'Client' ?></div>
					</div>
					<div class="message"></div>
				</div>
				<?php if(empty($correspondence)): ?>
					<p>There is no correspondence to display.</p>
				<?php else: ?>
					<?php foreach($correspondence as $c): ?>
						<?php
							$c_user=ar_user_data($c['from_user_id']);
							$c_user['role']='Client';
							if($c_user['is_tech'])
								$c_user['role']='Tech';
							if($c_user['is_admin'])
								$c_user['role']='Admin';
						?>
						<div class="<?php echo $c['from_user_id']==$user_data['id'] ? 'assignment-owner ' : '' ?>correspondence">
							<div class="user-details">
								<div class="from">From:</div>
								<div class="name"><?php echo $c_user['first_name'].' '.$c_user['last_name'] ?></div>
								<div class="email"><?php echo $c_user['email'] ?></div>
								<div class="role"><?php echo $c_user['role'] ?></div>
							</div>
							<div class="message">
								<?php echo nl2br($c['message']) ?>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="field">
				<label>Create Message</label>
				<textarea name="create_message" placeholder="Enter your message to the tech here"></textarea>
			</div>
			<div class="field">
				<input type="button" id="create-message" value="Create Message" />
			</div>
		</fieldset>
	<?php endif; ?>
	<fieldset>
		<legend><?php echo empty($job_data) ? 'Create' : 'Save' ?> Assignment</legend>
		<?php if(empty($job_data)): ?>
		<div class="field"> <!-- @TODO: change the url to the terms and conditions -->
			<label>Before submitting, you must read and agree to the terms of service</label>
			<input type="checkbox" name="tos_agreement" id="tos-agreement" value="1" /><label for="tos-agreement" class="checkbox-label">I have read and agree to the <a href="/terms-conditions">terms of service</a>.</label>
		</div>
		<div class="field">
		<?php else: ?>
		<div class="field" style="padding-top: 10px;">
		<?php endif; ?>
			<input type="submit" value="Save Assignment" />
		</div>
	</fieldset>
</form>
<script>
	$(function(){
		isNewAssignment=<?php echo empty($job_data) ? 'true' : 'false'; ?>;
		if(!isNewAssignment)
		{
			/*$('#assignments .assignment-panel fieldset:not(:last) .field')
				.slideUp(0)
				.parents('fieldset')
				.data('collapsed',true);*/
		}
	});
	
</script>