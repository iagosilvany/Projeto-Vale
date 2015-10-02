<?php session_start(); ?>
<?php if ($_SESSION['logon'] != true): ?>
	<?php header('Location: ../controllers/logout.php'); ?>
<?php endif ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<title>Admin</title>
		<meta charset="UTF-8">
		<link type="text/css" rel="stylesheet" href="../assets/css/admin.css"/>
		<link type="text/css" rel="stylesheet" href="../assets/css/sidebar.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<?php require '../includes/sidebar.php'; ?>
		<section class="admin">
			<p>Olá meu caro, como está?</p>
		</section>
	</body>
</html>
