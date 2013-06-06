<h2>Assignment</h2>
<div id="assignment-options" data-assignment-id="<?php echo $assignment['id'] ?>">
	<h3>Status</h3>
	<select name="status">
	<?php foreach(array('Pending','Client Review','Complete') as $status): ?>
		<option<?php echo ($status==$assignment['status'] ? ' selected="selected"' : '') ?>><?php echo $status ?></option>
	<?php endforeach; ?>
	</select>
	<br /><br />
	<a class="change_status button">Change Status</a>
	
	<h3>Tech Assigned</h3>
	<?php if($this->user->has_role('admin')): ?>
		<?php foreach($techs as $tech): ?>
		<input type="radio" name="tech_assigned" value="<?php echo $tech['id'] ?>"<?php echo ($assignment['tech_user_id']==$tech['id'] ? ' checked="checked"' : '') ?> /><label for="tech_<?php echo $tech['id'] ?>"><?php echo trim($tech['first_name'].' '.$tech['last_name']) ?></label><br />
		<?php endforeach; ?>
		<br />
		<a class="assign_tech button">Assign Tech</a>
	<?php elseif($this->user->has_role('tech')): ?>
		<?php $assigned_tech=$this->user->get($assignment['tech_user_id']) ?>
		<?php echo $assigned_tech['first_name'].' '.$assigned_tech['last_name'] ?>
	<?php endif; ?>
</div>
<div id="tabs">
	<ul>
		<li><a href="#details">Details</a></li>
		<li><a href="#vehicles">Vehicles</a></li>
		<li><a href="#correspondence">Correspondence</a></li>
		<li><a href="#final-report">Final Report</a></li>
	</ul>
	<div id="details">
		<h2>Assignment Details</h2>
		<div class="readonly horizontal field">
			<?php echo form_label('Claim Type:') ?>
			<?php echo $this->assignment->get_type($assignment['type']) ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('File Number:') ?>
			<?php echo $assignment['file_number'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Insured Name:') ?>
			<?php echo $assignment['insured_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Claimant Name:') ?>
			<?php echo $assignment['claimant_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Date of Loss:') ?>
			<?php echo $assignment['date_of_loss_displayed'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Loss Description:') ?>
			<?php echo $assignment['loss_description'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Services Requested:') ?>
			<?php echo $assignment['services_requested'] ?>
		</div>
		<?php foreach($assignment['answers'] as $answer): ?>
			<div class="readonly horizontal field">
				<?php echo form_label($answer['question'].':') ?>
				<?php echo $answer['answer'] ?>
			</div>
		<?php endforeach; ?>
		<h2>Representative Information</h2>
		<div class="readonly horizontal field">
			<?php echo form_label('Name:') ?>
			<?php echo $assignment['rep']['first_name'].' '.$assignment['rep']['last_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('E-mail:') ?>
			<?php echo $assignment['rep']['email'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Address:') ?>
			<?php echo $assignment['rep']['street_address'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('City:') ?>
			<?php echo $assignment['rep']['city'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('State:') ?>
			<?php echo $assignment['rep']['state'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Zip:') ?>
			<?php echo $assignment['rep']['zip'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Phone:') ?>
			<?php echo $assignment['rep']['phone'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Mobile:') ?>
			<?php echo $assignment['rep']['mobile'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Fax:') ?>
			<?php echo $assignment['rep']['fax'] ?>
		</div>
	</div>
	<div id="vehicles">
	<?php $i=1 ?>
	<?php foreach($assignment['vehicles'] as $vehicle): ?>
		<h2>Vehicle #<?php echo $i++ ?></h2>
		<div class="readonly horizontal field">
			<?php echo form_label('VIN Number:') ?>
			<?php echo $vehicle['vin_number'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Year:') ?>
			<?php echo $vehicle['year'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Make:') ?>
			<?php echo $vehicle['make'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Model:') ?>
			<?php echo $vehicle['model'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Owner\'s Name:') ?>
			<?php echo $vehicle['owners_name'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Belongs To:') ?>
			<?php echo $vehicle['belongs_to'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Color:') ?>
			<?php echo $vehicle['color'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Registration Number:') ?>
			<?php echo $vehicle['registration_number'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Modifications:') ?>
			<?php echo $vehicle['modifications'] ?>
		</div>
		<div class="readonly horizontal field">
			<?php echo form_label('Additional Info:') ?>
			<?php echo $vehicle['additional_info'] ?>
		</div>
		<?php $vehicle_answers=$this->vehicle_answer->get_many_by('vehicle_id',$vehicle['id']) ?>
		<?php foreach($vehicle_answers as $answer): ?>
			<div class="readonly horizontal field">
				<?php echo form_label($answer['question'].':') ?>
				<?php echo $answer['answer'] ?>
			</div>
		<?php endforeach; ?>
	<?php endforeach; ?>
	</div>
	<div id="correspondence">
	<?php if(empty($assignment['correspondence'])): ?>
		<p>There is no correspondence to show.</p>
	<?php else: ?>
		<?php foreach($assignment['correspondence'] as $message): ?>
			<?php $message['from_user']=$this->user->get($message['from_user_id']) ?>
			<div class="<?php echo $message['from_user_id']==$assignment['client_user_id'] ? 'assignment-owner ' : '' ?>correspondence">
				<div class="user-details">
					<div class="from">From:</div>
					<div class="name"><?php echo $message['from_user']['first_name'].' '.$message['from_user']['last_name'] ?></div>
					<div class="email"><?php echo $message['from_user']['email'] ?></div>
					<div class="role"><?php echo $message['from_user']['role'] ?></div>
				</div>
				<div class="message"><?php echo nl2br($message['message']) ?></div>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
		<h2>Create New Message</h2>
		<?php echo form_open('assignments/create_message','',array(
			'assignment_id'=>$assignment['id'],
		)) ?>
			<div class="readonly field">
				<?php echo form_label('From:') ?>
				Nick Niebaum
			</div>
			<div class="readonly field c1">
				<?php echo form_label('Message:','message') ?>
				<?php echo form_textarea(array(
					'id'=>'message',
					'name'=>'message',
					'value'=>set_value('message'),
					'style'=>'width:610px',
				)) ?>
			</div>
			<div class="checkbox field">
				<?php echo form_checkbox(array(
					'id'=>'change_status',
					'name'=>'change_status',
					'value'=>1,
					'checked'=>set_value('change_status')==1,
				)) ?>
				<?php echo form_label('Change the status of the assignment to "Client Review"','change_status') ?>
			</div>
			<div class="buttons">
				<?php echo form_submit('create_message','Create Message') ?>
			</div>
		</form>
	</div>
	<div id="final-report">
		final report
	</div>
</div>

