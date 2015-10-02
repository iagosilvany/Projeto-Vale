<?php
	session_start();
	require_once('../helpers/connect.php');
	require_once('../models/login.php');
	if ($_POST['username']!="" && $_POST['password']!="") {
		$login = new Login($_POST);
		$got = $login -> logon($connect);
		if ($got) {
			$_SESSION['logon'] = true;
			$_SESSION['user'] = $got['id'];
			header('Location:../views/admin.php');
		}
		else {
			$_SESSION['msg'] = "Seu login falhou!";
			header('Location: ../views/login.php');
		}
	}
	else {
		$_SESSION['msg'] = "Erro! Tente novamente!";
		header('Location:../views/login.php');
	}
?>
