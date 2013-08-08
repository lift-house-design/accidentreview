<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-datepicker.css" />
<link rel="stylesheet" href="/wp-content/themes/accident-review/jquery-ui-button.css" />
<script src="/wp-content/themes/accident-review/js/jquery.ajaxfileupload.js"></script>
<script src="/wp-content/themes/accident-review/js/assignment-panel.js"></script>
<?php
	$is_new_assignment=(empty($job_data) || $job_data['autosave']==1); //  ( !empty($job_data) && $job_data['autosave']==0 );
?>
<form id="new-assignment">
	<fieldset>
		<legend>Insured</legend>
		<input type="hidden" name="id" value="<?php echo $job_id ?>" />
		<input type="hidden" name="type" value="<?php echo $assignment_type ?>" />
		<div class="field">
			<label class="required">File Number</label>
			<input type="text" class="required" name="file_number" placeholder="Enter file number"<?php echo empty($job_data['file_number']) ? '' : ' value="'.$job_data['file_number'].'"' ?> />
		</div>
		<div class="required field">
			<label class="required">Date of Loss</label>
			<input type="text" class="date required" name="date_of_loss" placeholder="Enter date of loss"<?php echo empty($job_data['date_of_loss']) || $job_data['date_of_loss']=='0000-00-00' ? '' : ' value="'.date('Y-m-d',strtotime($job_data['date_of_loss'])).'"' ?> />
		</div>
		<div class="field">
			<label class="required">Insured Name</label>
			<input type="text" class="required" name="insured_name" placeholder="Enter insured name"<?php echo empty($job_data['insured_name']) ? '' : ' value="'.$job_data['insured_name'].'"' ?> />
		</div>
		<div class="field">
			<label>Insured Vehicle(s)</label>
			<input type="button" id="addvehicle" value="Add Vehicle" />
		</div>
		<div id="vehicles-container">
			<fieldset id="vehicle-template" class="vehicle">
				<input type="hidden" name="type" value="vehicle" />
				<legend>Insured Vehicle <a class="remove button">Remove Vehicle</a></legend>
				<div class="field">
					<label class="required">Vehicle Description</label>
					<div class="field-row">
						<span>If the VIN number is available, enter it below and click "Submit"</span>
						<input type="text" name="vin_number" placeholder="Enter the full VIN number" />
						<input type="button" class="vin-lookup" value="Submit" />
					</div>
					<div class="field-row">
						<select name="year" class="required">
							<option value="">Year:</option>
						</select>
						<select name="make" disabled="disabled" class="required">
							<option value="">Make:</option>
						</select>
						<select name="model" disabled="disabled" class="required">
							<option value="">Model:</option>
						</select>
					</div>
					<div class="field-row">
						<input type="text" name="operator" placeholder="Enter vehicle operator's name" />
						<input type="text" name="color" placeholder="Enter vehicle's color" />
						<input type="text" name="registration_number" placeholder="Enter vehicle's registration number" />
					</div>
				</div>
				<?php foreach($vehicle_questions as $question_key=>$question): ?>
				<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
					<?php if( !empty($question['label']) || !empty($question['question']) ): ?>
						<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
					<?php endif; ?>
					<?php ar_display_question_field($question_key,$question,false,1) ?>
				</div>
				<?php endforeach; ?>
				<div class="field">
					<label>Additional Vehicle Information</label>
					<textarea name="additional_info" placeholder="Provide any additional information that will help us analyze your request"></textarea>
				</div>
			</fieldset>
			<?php if(!empty($job_data['vehicles'])): ?>
				<?php $i=0 ?>
				<?php foreach($job_data['vehicles'] as $vehicle_data): ?>
					<?php $i++ ?>
					<fieldset class="vehicle">
						<input type="hidden" name="type" value="vehicle" />
						<legend>Insured Vehicle #<?php echo $i ?> <a class="remove button">Remove Vehicle</a></legend>
						<div class="field">
							<label class="required">Vehicle Description</label>
							<div class="field-row">
								<span>If the VIN number is available, enter it below and click "Submit"</span>
								<input type="text" name="vin_number" placeholder="Enter the full VIN number"<?php echo empty($vehicle_data['vin_number']) ? '' : ' value="'.$vehicle_data['vin_number'].'"' ?> />
								<input type="button" class="vin-lookup" value="Submit" />
							</div>
							<div class="field-row">
								<select name="year" class="required">
									<option value="">Year:</option>
									<?php if(!empty($vehicle_data['year'])): ?>
										<option value="<?php echo $vehicle_data['year'] ?>" selected="selected"><?php echo $vehicle_data['year'] ?></option>
									<?php endif; ?>
								</select>
								<select name="make" disabled="disabled" class="required">
									<option value="">Make:</option>
									<?php if(!empty($vehicle_data['make'])): ?>
										<option value="<?php echo ar_get_make_id($vehicle_data['year'],$vehicle_data['make']) ?>" selected="selected"><?php echo $vehicle_data['make'] ?></option>
									<?php endif; ?>
								</select>
								<select name="model" disabled="disabled" class="required">
									<option value="">Model:</option>
									<?php if(!empty($vehicle_data['model'])): ?>
										<option value="<?php echo $vehicle_data['model'] ?>" selected="selected"><?php echo $vehicle_data['model'] ?></option>
									<?php endif; ?>
								</select>
							</div>
							<div class="field-row">
								<input type="text" name="operator" placeholder="Enter vehicle operator's name"<?php echo empty($vehicle_data['operator']) ? '' : ' value="'.$vehicle_data['operator'].'"' ?> />
								<input type="text" name="color" placeholder="Enter vehicle's color"<?php echo empty($vehicle_data['color']) ? '' : ' value="'.$vehicle_data['color'].'"' ?> />
								<input type="text" name="registration_number" placeholder="Enter vehicle's registration number"<?php echo empty($vehicle_data['registration_number']) ? '' : ' value="'.$vehicle_data['registration_number'].'"' ?> />
							</div>
						</div>
						<?php foreach($vehicle_questions as $question_key=>$question): ?>
						<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
							<?php if( !empty($question['label']) || !empty($question['question']) ): ?>
								<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
							<?php endif; ?>
							<?php ar_display_question_field($question_key,$question,( empty($vehicle_data[$question_key]) ? false : $vehicle_data[$question_key] ),$i) ?>
						</div>
						<?php endforeach; ?>
						<div class="field">
							<label>Additional Vehicle Information</label>
							<textarea name="additional_info" placeholder="Provide any additional information that will help us analyze your request"><?php echo empty($vehicle_data['additional_info']) ? '' : $vehicle_data['additional_info'] ?></textarea>
						</div>
					</fieldset>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="field">
			<label>Claimants</label>
			<input type="button" id="addclaimant" value="Add Claimant" />
		</div>
		<div id="claimants-container">
			<fieldset id="claimant-template" class="claimant">
				<input type="hidden" name="type" value="claimant" />
				<legend>Claimant <a class="remove button">Remove Claimant</a></legend>
				<div class="field">
					<label class="required">Claimant Name</label>
					<input type="text" class="required" name="claimant_name" placeholder="Enter claimant name" />
				</div>
				<div class="field">
					<label>Vehicle Description</label>
					<div class="field-row">
						<span>If the VIN number is available, enter it below and click "Submit"</span>
						<input type="text" name="vin_number" placeholder="Enter the full VIN number" />
						<input type="button" class="vin-lookup" value="Submit" />
					</div>
					<div class="field-row">
						<select name="year">
							<option value="">Year:</option>
						</select>
						<select name="make" disabled="disabled">
							<option value="">Make:</option>
						</select>
						<select name="model" disabled="disabled">
							<option value="">Model:</option>
						</select>
					</div>
					<div class="field-row">
						<input type="text" name="operator" placeholder="Enter vehicle operator's name" />
						<input type="text" name="color" placeholder="Enter vehicle's color" />
						<input type="text" name="registration_number" placeholder="Enter vehicle's registration number" />
					</div>
				</div>
				<?php foreach($claimant_questions as $question_key=>$question): ?>
				<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
					<?php if( !empty($question['label']) || !empty($question['question']) ): ?>
						<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
					<?php endif; ?>
					<?php ar_display_question_field($question_key,$question,false,1) ?>
				</div>
				<?php endforeach; ?>
				<div class="field">
					<label>Additional Vehicle Information</label>
					<textarea name="additional_info" placeholder="Provide any additional information that will help us analyze your request"></textarea>
				</div>
			</fieldset>
			<?php if(!empty($job_data['claimants'])): ?>
				<?php $i=0 ?>
				<?php foreach($job_data['claimants'] as $claimant_data): ?>
					<?php $i++ ?>
					<fieldset class="claimant">
						<input type="hidden" name="type" value="claimant" />
						<legend>Claimant #<?php echo $i ?><a class="remove button">Remove Claimant</a></legend>
						<div class="field">
							<label class="required">Claimant Name</label>
							<input type="text" class="required" name="claimant_name" placeholder="Enter claimant name"<?php echo empty($claimant_data['claimant_name']) ? '' : ' value="'.$claimant_data['claimant_name'].'"' ?> />
						</div>
						<div class="field">
							<label>Vehicle Description</label>
							<div class="field-row">
								<span>If the VIN number is available, enter it below and click "Submit"</span>
								<input type="text" name="vin_number" placeholder="Enter the full VIN number"<?php echo empty($claimant_data['vin_number']) ? '' : ' value="'.$claimant_data['vin_number'].'"' ?> />
								<input type="button" class="vin-lookup" value="Submit" />
							</div>
							<div class="field-row">
								<select name="year">
									<option value="">Year:</option>
									<?php if(!empty($vehicle_data['year'])): ?>
										<option value="<?php echo $vehicle_data['year'] ?>" selected="selected"><?php echo $vehicle_data['year'] ?></option>
									<?php endif; ?>
								</select>
								<select name="make" disabled="disabled">
									<option value="">Make:</option>
									<?php if(!empty($vehicle_data['make'])): ?>
										<option value="<?php echo ar_get_make_id($vehicle_data['year'],$vehicle_data['make']) ?>" selected="selected"><?php echo $vehicle_data['make'] ?></option>
									<?php endif; ?>
								</select>
								<select name="model" disabled="disabled">
									<option value="">Model:</option>
									<?php if(!empty($vehicle_data['model'])): ?>
										<option value="<?php echo $vehicle_data['model'] ?>" selected="selected"><?php echo $vehicle_data['model'] ?></option>
									<?php endif; ?>
								</select>
							</div>
							<div class="field-row">
								<input type="text" name="operator" placeholder="Enter vehicle operator's name"<?php echo empty($claimant_data['operator']) ? '' : ' value="'.$claimant_data['operator'].'"' ?> />
								<input type="text" name="color" placeholder="Enter vehicle's color"<?php echo empty($claimant_data['color']) ? '' : ' value="'.$claimant_data['color'].'"' ?> />
								<input type="text" name="registration_number" placeholder="Enter vehicle's registration number"<?php echo empty($claimant_data['registration_number']) ? '' : ' value="'.$claimant_data['registration_number'].'"' ?> />
							</div>
						</div>
						<?php foreach($claimant_questions as $question_key=>$question): ?>
						<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
							<?php if( !empty($question['label']) || !empty($question['question']) ): ?>
								<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
							<?php endif; ?>
							<?php ar_display_question_field($question_key,$question,( empty($claimant_data[$question_key]) ? false : $claimant_data[$question_key] ),$i) ?>
						</div>
						<?php endforeach; ?>
						<div class="field">
							<label>Additional Vehicle Information</label>
							<textarea name="additional_info" placeholder="Provide any additional information that will help us analyze your request"><?php echo empty($vehicle_data['additional_info']) ? '' : $vehicle_data['additional_info'] ?></textarea>
						</div>
					</fieldset>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="field">
			<label class="required">Describe Loss</label>
			<textarea name="loss_description" class="required" placeholder="Enter description of loss"><?php echo empty($job_data['loss_description']) ? '' : $job_data['loss_description'] ?></textarea>
		</div>
		<div class="required field">
			<label class="required">Services Requested</label>
			<textarea name="services_requested" class="required" placeholder="Enter services you are requesting"><?php echo empty($job_data['services_requested']) ? '' : $job_data['services_requested'] ?></textarea>
		</div>
		<div class="field">
			<label>Location of Loss</label>
			<textarea name="loss_location" placeholder="Enter the location of loss"><?php echo empty($job_data['loss_location']) ? '' : $job_data['loss_location'] ?></textarea>
		</div>
		<?php foreach($job_questions as $question_key=>$question): ?>
		<div class="<?php echo $question_key ?> field"<?php echo ( !empty($question['hidden']) ? ' style="display: none;"' : '' ) ?>>
			<?php if( !empty($question['label']) || !empty($question['question']) ): ?>
				<label><?php echo ( empty($question['label']) ? $question['question'] : $question['label'] ) ?></label>
			<?php endif; ?>
			<?php ar_display_question_field($question_key,$question, ( empty($job_data[$question_key]) ? false : $job_data[$question_key] ) ) ?>
		</div>
		<?php endforeach; ?>
	</fieldset>
	<fieldset>
		<legend>Attachments</legend>
		<div class="odd file-upload field">
			<label>Upload Files</label>
			<div class="file-types">
				<p>Allowed file types: </p>
				<ul>
					<li><strong>Images</strong> (jpg, gif, png, tif)</li>
					<li><strong>Documents</strong> (txt, rtf, doc, docx, pdf)</li>
				</ul>
			</div>
			<div class="file-uploading-indicator">
				<img src="/wp-content/themes/accident-review/images/ajax-loading.gif" /><br />
				<strong>Your upload is in progress.</strong> Files larger than 2MB in size may take substantially longer to upload dependent on your bandwidth.
			</div>
			<div id="file-uploading-popup"></div>
			<input type="button" value="Upload File" />
			<input id="upload-field" type="file" name="file[]" multiple="multiple" />
			<div class="file-preview">
			<?php $i=0 ?>
			<?php foreach($assignment_attachments as $attachment): ?>
				<?php $fileType=ar_get_file_class($attachment['name']); ?>
				<div id="img-<?php echo $i++ ?>" class="<?php echo $fileType ?> file" data-attachment-id="<?php echo $attachment['id'] ?>">
					<a class="icon" href="<?php echo $fileType=='img' ? '#' : AR_ATTACHMENT_URL.$attachment['url'] ?>">
						<?php if($fileType=='img'): ?>
							<img src="<?php echo AR_ATTACHMENT_URL.$attachment['url'] ?>" />
						<?php else: ?>
							&nbsp;
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
	</fieldset>
	<?php if(!empty($job_data)&&$job_data['autosave']==0): ?>
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
						<div class="timestamp"></div>
					</div>
					<div class="message"></div>
				</div>
				<?php if(empty($correspondence)): ?>
					<p>There is no correspondence to display.</p>
				<?php else: ?>
					<?php foreach($correspondence as $c): ?>
						<?php
							$c_user=ar_user_data($c['from_user_id']);
						?>
						<div class="<?php echo $c['from_user_id']==$user_data['id'] ? 'assignment-owner ' : '' ?>correspondence">
							<div class="user-details">
								<div class="from">From:</div>
								<div class="name"><?php echo $c_user['first_name'].' '.$c_user['last_name'] ?></div>
								<div class="email"><?php echo $c_user['email'] ?></div>
								<div class="role"><?php echo ucfirst($c_user['role']) ?></div>
								<div class="timestamp"><?php echo date('m/d/Y h:ia',strtotime($c['created_at'])) ?></div>
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
	<?php if(!empty($job_data) && $job_data['autosave']==0 && $job_data['status']=='Complete'): ?>
		<fieldset class="final-review-fieldset">
			<legend>Final Review</legend>
			<div class="field">
				<label>Findings</label>
				<a class="button" target="_blank" href="/reports/<?php echo $job_data['id'] ?>">View Report</a>
			</div>
		</fieldset>
	<?php endif; ?>
	<fieldset>
		<legend><?php echo empty($job_data)||$job_data['autosave']==1 ? 'Create' : 'Save' ?> Assignment</legend>
		<?php if(empty($job_data)||$job_data['autosave']==1): ?>
		<div class="field"> <!-- @TODO: change the url to the terms and conditions -->
			<label>Before submitting, you must read and agree to the terms of service</label>
			<input type="checkbox" name="tos_agreement" id="tos-agreement" value="1" /><label for="tos-agreement" class="checkbox-label">I have read and agree to the <a href="/terms-conditions" target="_blank">terms of service</a>.</label>
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
	isNewAssignment=<?php echo empty($job_data)||$job_data['autosave']==1 ? 'true' : 'false'; ?>;
	$(function(){
		if(isNewAssignment)
			start_autosave();
	});
	
</script>