<!--div class="row">
	<div class="column span1">
		Column
	</div>
	<div class="column span1">
		Column
	</div>
	<div class="column span1">
		Column
	</div>
	<div class="column span1">
		Column
	</div>
</div>
<div class="row">
	<div class="column span2">
		Column
	</div>
	<div class="column span2">
		Column
	</div>
</div>
<div class="row">
	<div class="column span3">
		Column
	</div>
	<div class="column span1">
		Column
	</div>
</div-->
<div class="row">
	<div class="column span3">
		<label>AccidentReview.com File Number</label> <?php echo $assignment['id'] ?><br />
		<div class="spacer">
			<label>Date</label> <?php echo date('m/d/Y',strtotime($assignment['created_at'])); ?>
		</div>
		<div class="spacer">
			<label>Time</label> <?php echo date('H:i',strtotime($assignment['created_at'])); ?>
		</div>
		<div class="spacer">
			<label>By</label> <?php echo $tech['first_name'].' '.$tech['last_name'] ?>
		</div>
		
	</div>
	<div class="column span1">
		<img src="http://accidentreview.com/wp-content/themes/accident-review/images/arlogo.png" />
	</div>
</div>