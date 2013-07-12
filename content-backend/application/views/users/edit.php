<h2>Account Details</h2>
<?php echo form_open('users/'.$usr['id']) ?>
	<div class="field c2">
		<?php echo form_label('First Name:','first_name') ?>
		<?php echo form_input(array(
			'id'=>'first_name',
			'name'=>'first_name',
			'value'=>$usr['first_name'],
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Last Name:','last_name') ?>
		<?php echo form_input(array(
			'id'=>'last_name',
			'name'=>'last_name',
			'value'=>$usr['last_name'],
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Company Name:','company_name') ?>
		<?php echo form_input(array(
			'id'=>'company_name',
			'name'=>'company_name',
			'value'=>set_value('company_name'),
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Title/Signature:','signature') ?>
		<?php echo form_input(array(
			'id'=>'signature',
			'name'=>'signature',
			'value'=>set_value('signature'),
		)) ?>
	</div>
	<div class="field c1">
		<?php echo form_label('E-mail Address:','email') ?>
		<?php echo form_input(array(
			'id'=>'email',
			'name'=>'email',
			'value'=>$usr['email'],
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Phone:','phone') ?>
		<?php echo form_input(array(
			'id'=>'phone',
			'name'=>'phone',
			'value'=>$usr['phone'],
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Mobile:','mobile') ?>
		<?php echo form_input(array(
			'id'=>'mobile',
			'name'=>'mobile',
			'value'=>$usr['mobile'],
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Fax:','fax') ?>
		<?php echo form_input(array(
			'id'=>'fax',
			'name'=>'fax',
			'value'=>$usr['fax'],
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c1">
		<?php echo form_label('Street Address:','street_address') ?>
		<?php echo form_input(array(
			'id'=>'street_address',
			'name'=>'street_address',
			'value'=>$usr['street_address'],
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('City:','city') ?>
		<?php echo form_input(array(
			'id'=>'city',
			'name'=>'city',
			'value'=>$usr['city'],
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('State:','state') ?>
		<?php echo form_dropdown('state',$state_options,$usr['state']) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Zip Code:','zip') ?>
		<?php echo form_input(array(
			'id'=>'zip',
			'name'=>'zip',
			'value'=>$usr['zip'],
		)) ?>
	</div>
	<h2>Change Password</h2>
	<div class="field c2">
		<?php echo form_label('New Password:','new_password') ?>
		<?php echo form_password(array(
			'id'=>'new_password',
			'name'=>'new_password',
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Confirm Password:','confirm_new_password') ?>
		<?php echo form_password(array(
			'id'=>'confirm_new_password',
			'name'=>'confirm_new_password',
		)) ?>
	</div>
	<h2>Role</h2>
	<div class="checkbox field">
		<?php echo form_radio(array(
			'id'=>'role_client',
			'name'=>'role',
			'value'=>'client',
			'checked'=>($usr['role']=='client'||$usr['role']==''),
		)) ?>
		<?php echo form_label('This user is a client','role_client') ?>
	</div>
	<div class="checkbox field">
		<?php echo form_radio(array(
			'id'=>'role_tech',
			'name'=>'role',
			'value'=>'tech',
			'checked'=>$usr['role']=='tech',
		)) ?>
		<?php echo form_label('This user is a tech','role_tech') ?>
	</div>
	<div class="checkbox field">
		<?php echo form_radio(array(
			'id'=>'role_admin',
			'name'=>'role',
			'value'=>'admin',
			'checked'=>$usr['role']=='admin',
		)) ?>
		<?php echo form_label('This user is a admin','role_admin') ?>
	</div>
	<div class="buttons">
		<?php echo form_submit('save_user','Save User') ?>
	</div>
</form>