<div class="row">
	<div class="column span3">
		<label>AccidentReview.com File Number</label> <?php echo $assignment['id'] ?><br />
		<label>Date</label> <?php echo date('m/d/Y',strtotime($assignment['created_at'])) ?><br />
		<label>Time</label> <?php echo date('H:i',strtotime($assignment['created_at'])) ?><br />
		<label>By</label> <?php echo $tech['first_name'].' '.$tech['last_name'] ?>
	</div>
	<div class="column span1">
		<img src="http://accidentreview.com/wp-content/themes/accident-review/images/arlogo.png" />
	</div>
</div>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Client Information</legend>
			<label style="float:left">Customer</label>
			<div style="display: inline-block">
			<?php echo $assignment['rep']['first_name'].' '.$assignment['rep']['last_name'] ?><br />
			<?php echo $assignment['rep']['street_address'] ?><br />
			<?php echo $assignment['rep']['city'].', '.$assignment['rep']['state'].' '.$assignment['rep']['zip'] ?><br />
			</div><br />
			<label>Client File #</label> <?php echo $assignment['file_number'] ?><br />
			<label>Type of Loss</label> <?php echo $this->assignment->get_type($assignment['type']) ?><br />
			<label>Date of Loss</label> <?php echo date('m/d/Y',strtotime($assignment['date_of_loss'])) ?><br />
		</fieldset>
	</div>
</div>
