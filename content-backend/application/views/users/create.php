<h2>Account Details</h2>
<?php echo form_open('users/create') ?>
	<div class="field c2">
		<?php echo form_label('First Name:','first_name') ?>
		<?php echo form_input(array(
			'id'=>'first_name',
			'name'=>'first_name',
			'value'=>set_value('first_name'),
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Last Name:','last_name') ?>
		<?php echo form_input(array(
			'id'=>'last_name',
			'name'=>'last_name',
			'value'=>set_value('last_name'),
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Insurance Company:','company_name') ?>
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
			'value'=>set_value('email'),
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Password:','password') ?>
		<?php echo form_password(array(
			'id'=>'password',
			'name'=>'password',
		)) ?>
	</div>
	<div class="field c2">
		<?php echo form_label('Confirm Password:','confirm_password') ?>
		<?php echo form_password(array(
			'id'=>'confirm_password',
			'name'=>'confirm_password',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Phone:','phone') ?>
		<?php echo form_input(array(
			'id'=>'phone',
			'name'=>'phone',
			'value'=>set_value('phone'),
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Mobile:','mobile') ?>
		<?php echo form_input(array(
			'id'=>'mobile',
			'name'=>'mobile',
			'value'=>set_value('mobile'),
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Fax:','fax') ?>
		<?php echo form_input(array(
			'id'=>'fax',
			'name'=>'fax',
			'value'=>set_value('fax'),
			'class'=>'phone',
		)) ?>
	</div>
	<div class="field c1">
		<?php echo form_label('Street Address:','street_address') ?>
		<?php echo form_input(array(
			'id'=>'street_address',
			'name'=>'street_address',
			'value'=>set_value('street_address'),
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('City:','city') ?>
		<?php echo form_input(array(
			'id'=>'city',
			'name'=>'city',
			'value'=>set_value('city'),
		)) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('State:','state') ?>
		<?php echo form_dropdown('state',$state_options,set_value('state')) ?>
	</div>
	<div class="field c3">
		<?php echo form_label('Zip Code:','zip') ?>
		<?php echo form_input(array(
			'id'=>'zip',
			'name'=>'zip',
			'value'=>set_value('zip'),
		)) ?>
	</div>
	<h2>Role</h2>
	<div class="checkbox field">
		<?php echo form_radio(array(
			'id'=>'role_client',
			'name'=>'role',
			'value'=>'client',
			'checked'=>(set_value('role')=='client'||set_value('role')==''),
		)) ?>
		<?php echo form_label('This user is a client','role_client') ?>
	</div>
	<div class="checkbox field">
		<?php echo form_radio(array(
			'id'=>'role_tech',
			'name'=>'role',
			'value'=>'tech',
			'checked'=>set_value('role')=='tech',
		)) ?>
		<?php echo form_label('This user is a tech','role_tech') ?>
	</div>
	<div class="checkbox field">
		<?php echo form_radio(array(
			'id'=>'role_admin',
			'name'=>'role',
			'value'=>'admin',
			'checked'=>set_value('role')=='admin',
		)) ?>
		<?php echo form_label('This user is an administrator','role_admin') ?>
	</div>
	<div class="buttons">
		<?php echo form_submit('save_user','Save User') ?>
	</div>
</form>