<table id="assignments" class="admin">
	<thead>
		<tr>
			<th>File #</th>
			<th>Status</th>
			<th>Insured</th>
			<th>Date of Loss</th>
			<th>AR #</th>
			<th>Submitted</th>
			<th>Loss Type</th>
			<th>Rep. Name</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($assignments as $assignment): ?>
		<tr data-assignment-id="<?php echo $assignment['id'] ?>">
			<td><?php echo $assignment['file_number'] ?></td>
			<td><?php echo $assignment['status'] ?></td>
			<td><?php echo $assignment['insured_name'] ?></td>
			<td><?php echo $assignment['date_of_loss_displayed'] ?></td>
			<td><?php echo $assignment['id'] ?></td>
			<td><?php echo $assignment['created_at_displayed'] ?></td>
			<td><?php echo $assignment['type_displayed'] ?></td>
			<td><?php
				if(empty($assignment['tech_user_id']))
					echo 'Unassigned';
				else
				{
					$tech=$this->user->get($assignment['tech_user_id']);
					echo $tech['first_name'].' '.$tech['last_name'];
				}
			?></td>
			<td>
				<a class="view button">View</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>