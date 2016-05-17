<form action="<?php echo route('users/add/save'); ?>">
	<?php csrf_field(); ?>
	<table>
		<tbody>
			<tr>
				<td>First Name: </td>
				<td>
					<input type="text" name="first_name">
				</td>
			</tr>
			<tr>
				<td>Last Name: </td>
				<td>
					<input type="text" name="last_name">
				</td>
			</tr>
			<tr>
				<td>Department: </td>
				<td>
					<select name="department">
						<option value="" selected>-- Select Department --</option>
						<?php foreach ($departments as $department): ?>
							<option value="<?php c($department->department_id); ?>"></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Email Address: </td>
				<td>
					<input type="email" name="email_address">
				</td>
			</tr>  
		</tbody>
	</table>
	<br><br>
</form>