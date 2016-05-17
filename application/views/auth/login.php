<?php flash('error'); ?>

<form action="<?php echo route('login'); ?>" method="POST">
	<?php csrf_field(); ?>
	<div>
		<input type="email" name="email" placeholder="Email Address">
		<?php errors('email'); ?>
	</div>
	<div>
		<input type="password" name="password" placeholder="Password">
		<?php errors('password'); ?>
	</div>
	<div>
		<input type="submit" value="Login">
	</div>
</form>