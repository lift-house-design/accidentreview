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
	<div class="field c1">
		<?php echo form_label('E-mail Address:','email') ?>
		<?php echo form_input(array(
			'id'=>'email',
			'name'=>'email',
			'value'=>set_value('email'),
		)) ?>
	</div>
	<div class="field c1">
		<?php echo form_label('Password:','password') ?>
		<?php echo form_password(array(
			'id'=>'password',
			'name'=>'password',
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
	<h2>Roles</h2>
	<div class="checkbox field">
		<?php echo form_checkbox(array(
			'id'=>'is_tech',
			'name'=>'is_tech',
			'value'=>1,
			'checked'=>set_value('is_tech')==1,
		)) ?>
		<?php echo form_label('This user is a tech','is_tech') ?>
	</div>
	<div class="checkbox field">
		<?php echo form_checkbox(array(
			'id'=>'is_admin',
			'name'=>'is_admin',
			'value'=>1,
			'checked'=>set_value('is_admin')==1,
		)) ?>
		<?php echo form_label('This user is an administrator','is_admin') ?>
	</div>
	<div class="buttons">
		<?php echo form_submit('save_user','Save User') ?>
	</div>
</form>