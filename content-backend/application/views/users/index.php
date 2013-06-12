<div id="create-container"><a class="create button" href="/users/create">Create</a></div>
<table id="assignments" class="admin">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>E-mail</th>
			<th>Role</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($users as $usr): ?>
		<tr data-user-id="<?php echo $usr['id'] ?>">
			<td><?php echo $usr['first_name'] ?></td>
			<td><?php echo $usr['last_name'] ?></td>
			<td><?php echo $usr['email'] ?></td>
			<td><?php echo ucfirst($usr['role']) ?></td>
			<td>
				<a class="edit button">Edit</a>
				<a class="delete button">Delete</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>