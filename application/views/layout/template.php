<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?: 'RFS'; ?></title>
</head>
<body>
	<?php if (auth()->check()): ?>
		<?php include 'navigation.php'; ?>
	<?php endif; ?>			
	<?php echo $content; ?>
</body>
</html>