<?php echo form_open('account') ?>
	<div class="field">
		<?php echo form_label('First Name:','first_name') ?>
		<?php echo form_input(array(
			'id'=>'first_name',
			'name'=>'first_name',
			'value'=>set_value('first_name'),
		)) ?>
	</div>
	<div class="field">
		<?php echo form_label('Last Name:','last_name') ?>
		<?php echo form_input(array(
			'id'=>'last_name',
			'name'=>'last_name',
			'value'=>set_value('last_name'),
		)) ?>
	</div>
	<div class="field">
		<?php echo form_label('Street Address:','street_address') ?>
		<?php echo form_input(array(
			'id'=>'street_address',
			'name'=>'street_address',
			'value'=>set_value('street_address'),
		)) ?>
	</div>
	<div class="field">
		<?php echo form_label('City:','city') ?>
		<?php echo form_input(array(
			'id'=>'city',
			'name'=>'city',
			'value'=>set_value('city'),
		)) ?>
	</div>
	<div class="field">
		<?php echo form_label('State:','state') ?>
		<?php echo form_dropdown('state',$state_options,set_value('state')) ?>
	</div>
	<div class="field">
		<?php echo form_label('Zip Code:','zip') ?>
		<?php echo form_input(array(
			'id'=>'zip',
			'name'=>'zip',
			'value'=>set_value('zip'),
		)) ?>
	</div>
	<div class="buttons">
		<?php echo form_submit('save','Save') ?>
	</div>
</form>