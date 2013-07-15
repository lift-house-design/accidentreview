<h2>Account Details</h2>
<?php echo form_open('account') ?>
	<div class="field c2">
		<?php echo form_label('First Name:','first_name') ?>
		<?php echo form_input(array(
			'id'=>'first_name',
			'name'=>'first_name',
			'value'=>$user['first_name'],
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Last Name:','last_name') ?>
		<?php echo form_input(array(
			'id'=>'last_name',
			'name'=>'last_name',
			'value'=>$user['last_name'],
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Insurance Company:','company_name') ?>
		<?php echo form_input(array(
			'id'=>'company_name',
			'name'=>'company_name',
			'value'=>$user['company_name'],
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Title/Signature:','signature') ?>
		<?php echo form_input(array(
			'id'=>'signature',
			'name'=>'signature',
			'value'=>$user['signature'],
		)) ?>
	</div>
	<div class="field c1">
		<?php echo form_label('E-mail Address:','email') ?>
		<?php echo form_input(array(
			'id'=>'email',
			'name'=>'email',
			'value'=>$user['email'],
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Phone:','phone') ?>
		<?php echo form_input(array(
			'id'=>'phone',
			'name'=>'phone',
			'value'=>$user['phone'],
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Mobile:','mobile') ?>
		<?php echo form_input(array(
			'id'=>'mobile',
			'name'=>'mobile',
			'value'=>$user['mobile'],
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Fax:','fax') ?>
		<?php echo form_input(array(
			'id'=>'fax',
			'name'=>'fax',
			'value'=>$user['fax'],
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c1">
		<?php echo form_label('Street Address:','street_address') ?>
		<?php echo form_input(array(
			'id'=>'street_address',
			'name'=>'street_address',
			'value'=>$user['street_address'],
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('City:','city') ?>
		<?php echo form_input(array(
			'id'=>'city',
			'name'=>'city',
			'value'=>$user['city'],
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('State:','state') ?>
		<?php echo form_dropdown('state',$state_options,$user['state']) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Zip Code:','zip') ?>
		<?php echo form_input(array(
			'id'=>'zip',
			'name'=>'zip',
			'value'=>$user['zip'],
		)) ?>
	</div>
	<h2>Change Password</h2>
	<div class="field c3">
		<?php echo form_label('Current Password:','current_password') ?>
		<?php echo form_password(array(
			'id'=>'current_password',
			'name'=>'current_password',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('New Password:','new_password') ?>
		<?php echo form_password(array(
			'id'=>'new_password',
			'name'=>'new_password',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Confirm Password:','confirm_new_password') ?>
		<?php echo form_password(array(
			'id'=>'confirm_new_password',
			'name'=>'confirm_new_password',
		)) ?>
	</div>
	<div class="buttons">
		<?php echo form_submit('update_account','Update Account') ?>
	</div>
</form>