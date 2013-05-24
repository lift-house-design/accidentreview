<?php echo form_open('login') ?>
	<div class="field">
		<?php echo form_label('E-mail Address:','email') ?>
		<?php echo form_input(array(
			'id'=>'email',
			'name'=>'email',
			'value'=>set_value('email'),
		)) ?>
	</div>
	<div class="field">
		<?php echo form_label('Password:','password') ?>
		<?php echo form_password(array(
			'id'=>'password',
			'name'=>'password',
		)) ?>
	</div>
	<div class="buttons">
		<?php echo form_submit('login','Login') ?>
	</div>
</form>