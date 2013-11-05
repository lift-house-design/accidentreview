<div class="row">
	<div class="column span4">
		<img id="logo" src="//accidentreview.com/wp-content/themes/accident-review/images/arlogo.png" />
	</div>
</div>
<div class="row">
	<div class="column span4">
		<label class="no-width">AccidentReview.com File Number</label>
		<?php echo $assignment['id'] ?><br />
		<label class="no-width">Date</label>
		<?php echo date('m/d/Y',strtotime($assignment['created_at'])) ?>
		<label>Time</label>
		<?php echo date('h:ia',strtotime($assignment['created_at'])) ?>
		<table style="width:300px;background-color:#def">
			<tr>
				<td>
					<label>By</label> 
				</td>
				<td>
					<?= $tech['first_name'].' '.$tech['last_name'] ?>
					<?=( empty($tech['signature']) ? '' : ', '.$tech['signature'] ) ?>
				</td>
			<tr/>
		</table>
	</div>
</div>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Client Information</legend>
			<div class="row">
				<div class="column span2">
					<label>To</label> <?php echo $assignment['rep']['company_name'] ?><br />
					<label>Attn</label> <?php echo $assignment['rep']['first_name'].' '.$assignment['rep']['last_name'] ?><br />
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
<?php if(count($vehicles)>0): ?>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Vehicle Information</legend>
			<?php $i=1 ?>
			<?php foreach($vehicles as $vehicle): ?>
			<div class="row">
				<div class="column span4">
					<div class="heading">Vehicle #<?php echo $i++ ?></div>
					<label>Operator</label> <?php echo $vehicle['operator'] ?><br />
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
<?php endif; ?>
<?php if(count($claimants)>0): ?>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Claimant Information</legend>
			<?php $i=1 ?>
			<?php foreach($claimants as $vehicle): ?>
			<div class="row">
				<div class="column span4">
					<div class="heading">Claimant #<?php echo $i++ ?></div>
					<label>Operator</label> <?php echo $vehicle['operator'] ?><br />
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
<?php endif; ?>
<div class="row">
	<div class="column span4">
		<fieldset>
			<legend>Loss Information</legend>
			<div class="row">
				<div class="column span4">
					<div class="multi-line">
						<label>Description</label>
						<div class="value"><?php echo $assignment['loss_description'] ?></div>
					</div>
					<div class="multi-line">
						<label>Services Requested</label>
						<div class="value"><?php echo $assignment['services_requested'] ?></div>
					</div>
					<div class="multi-line">
						<label>Location of Loss</label>
						<div class="value"><?php echo $assignment['loss_location'] ?></div>
					</div>
					<?php foreach($assignment['answers'] as $answer): ?>
						<div class="multi-line">
							<label>Type</label>
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

<? /*if(!empty($_SERVER['HTTP_REFERER'])){*/ ?>
<script>
function show_print(){
	$("#button-container").css('display','none');
	window.print();
	$("#button-container").css('display','block');
}
setTimeout(function(){
	$("#button-container").css('display','block');
},10);
</script>
<div id="button-container" style="display:none">
	<a href="http://do.convertapi.com/web2pdf/?ApiKey=617643486&OutputFileName=Assignment_<?=$assignment['id']?>_<?=date('Y-m-d')?>&scripts=false&curl=http://<?=$_SERVER['HTTP_HOST']?>/reports/<?=$assignment['id']?>">Save to PDF</a>
	<a href="javascript:show_print()">Print</a>
</div>
<? /*}*/ ?>