<?php session_start(); ?>
<?php require_once('../models/login.php');?>
<?php unset($_SESSION['logon']); ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<title>LOGIN</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="../assets/css/login.css"/>
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<section class="login">
			<div class="content-form">
				<h1>Login</h1>
				<form action="../controllers/login.php" method="post">
					<input autofocus required type="text" name="username" title="Digite o usuário" placeholder="Usuário">
					<input required type="password" name="password" title="Digite a senha" placeholder="Senha">
					<button name="action" title="Clique pra fazer login" value="login">Entrar</button>
				</form>
				<?php if(isset($_SESSION['msg'])){ ?>
					<p><?php echo $_SESSION['msg']; ?></p>
					<?php unset($_SESSION['msg']); ?>
				<?php } ?>
			</div>
			<img src="../assets/img/infologo.png">
		</section>
	</body>
</html>
