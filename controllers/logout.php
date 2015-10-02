<?php
	session_start();
	unset($_SESSION['logon']);
	session_destroy();
	header('Location: ../views/login.php');
?>
