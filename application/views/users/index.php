<table>
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email Address</th>
			<th>Department</th>
			<th>Date Added</th>
			<th>Added By</th>
			<th colspan="3">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user->first_name; ?></td>
				<td><?php echo $user->last_name; ?></td>
				<td><?php echo $user->email_address; ?></td>
				<td><?php echo $user->department->name; ?></td>
				<td><?php echo $user->createdAt(); ?></td>
				<td><?php echo isset($user->addedby) ? $user->addedby->first_name : '-'; ?></td>
				<td>
					<a href="<?php echo route('users', [$user->user_id]); ?>">View</a>
				</td>
				<td>
					<a href="<?php echo route("users/{$user->user_id}/edit"); ?>">Edit</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<br><br>
<a href="<?php echo route('users/add'); ?>">Add User</a>