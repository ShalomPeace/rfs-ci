<table>
	<tbody>
		<tr>
			<td>First Name: </td>
			<td><?php echo $user->first_name; ?></td>
		</tr>
		<tr>
			<td>Last Name: </td>
			<td><?php echo $user->last_name; ?></td>
		</tr>
		<tr>
			<td>Email Address: </td>
			<td><?php echo $user->email_address; ?></td>
		</tr>
		<tr>
			<td>Department: </td>
			<td><?php echo $user->department->name; ?></td>
		</tr>
		<tr>
			<td>Date Added: </td>
			<td><?php echo $user->createdAt(); ?></td>
		</tr>
		<tr>
			<td>Added By: </td>
			<td><?php echo $user->addedby->first_name ?: '-'; ?></td>
		</tr>
	</tbody>
</table>
<br><br>
<a href="<?php echo route("users/{$user->user_id}/edit"); ?>">Edit</a>
<a href="<?php echo route("users/{$user->user_id}/delete"); ?>">Delete</a>