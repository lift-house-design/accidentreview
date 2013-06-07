<div class="row">
	<div class="column span4">
		<img id="logo" src="http://accidentreview.com/wp-content/themes/accident-review/images/arlogo.png" />
	</div>
</div>
<div class="row">
	<div class="column span4">
		<label class="no-width">AccidentReview.com File Number</label> <?php echo $assignment['id'] ?><br />
		<label class="no-width">Date</label> <?php echo date('m/d/Y',strtotime($assignment['created_at'])) ?>
		<label>Time</label> <?php echo date('H:i',strtotime($assignment['created_at'])) ?>
		<label>By</label> <?php echo $tech['first_name'].' '.$tech['last_name'] ?>
	</div>
</div>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Client Information</legend>
			<div class="row">
				<div class="column span2">
					<label>To</label> <?php echo $assignment['rep']['first_name'].' '.$assignment['rep']['last_name'] ?><br />
					<label>Attn</label> Joe Dohn<br />
					<label style="float:left">Address</label>
					<div style="display: inline-block">
					<?php echo $assignment['rep']['street_address'] ?><br />
					<?php echo $assignment['rep']['city'].', '.$assignment['rep']['state'].' '.$assignment['rep']['zip'] ?><br />
					</div>
				</div>
				<div class="column span2">
					<label>Client File #</label> <?php echo $assignment['file_number'] ?><br />
					<label>Date of Loss</label> <?php echo date('m/d/Y',strtotime($assignment['date_of_loss'])) ?>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Vehicle Information</legend>
			<?php foreach($assignment['vehicles'] as $vehicle): ?>
			<div class="row">
				<div class="column span4">
					<label><?php echo $vehicle['belongs_to'] ?>/Owner</label> <?php echo $vehicle['owners_name'] ?><br />
					<label>Year</label> <?php echo $vehicle['year'] ?>
					<label>Make</label> <?php echo $this->assignment->get_make($vehicle['make']) ?>
					<label>Model</label> <?php echo $vehicle['model'] ?><br />
					<label>VIN</label> <?php echo $vehicle['vin_number'] ?>
				</div>
			</div>
			<?php endforeach; ?>
		</fieldset>
	</div>
</div>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Loss Information</legend>
			<div class="row">
				<div class="column span4 wide-labels">
					<div class="multi-line">
						<label>Description</label>
						<div class="value"><?php echo $assignment['loss_description'] ?></div>
					</div>
					<div class="multi-line">
						<label>Services Requested</label>
						<div class="value"><?php echo $assignment['services_requested'] ?></div>
					</div>
					<?php foreach($assignment['answers'] as $answer): ?>
						<div class="multi-line">
							<label><?php echo $answer['question'] ?></label>
							<div class="value"><?php echo $answer['answer'] ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Report Findings</legend>
			<div class="row">
				<div class="column span4">
					<?php echo $assignment['final_report'] ?>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
	<div class="column span4">
		<p class="disclaimer">Accident Review reserves the right to review any additional information, evidence, etc., if such becomes available, and to amend this report and its findings, should it be neccesary.</p>
	</div>
</div>