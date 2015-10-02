<?php
session_start();
require_once('../helpers/connect.php');
require_once('../models/projects.php');
require_once('../helpers/projects_image.php');
	if (isset($_POST['action'])) {
		$action = $_POST['action'];
	}
	else {
		header('Location:../views/login.php');
	}
	switch ($action) {
		case 'insert':
			if ($_POST['address']!=""  && $_POST['title']!="" && $_FILES['image']!="") {
				if(is_uploaded_file($_FILES['image']['tmp_name'])){
					 $_POST['image']=resizer($_FILES['image']);
				}
				$projects = new Projects($_POST);
				try {
					if($projects->insert ($connect)){
					$_SESSION['msg'] = "Sua inserção foi realizada com sucesso!";
					header('Location:../views/projects.php');
					}
				}
				catch (PDOException $e) {
					$_SESSION['msg'] = "Sua inserção falhou!";
					header('Location:../views/projects.php');
				}
			}
			else{
				$_SESSION['msg'] = "Sua inserção falhou!";
				header('Location:../views/projects.php');
			}
		break;
		case 'update':
			if ($_POST['address']!='' && $_POST['title']!='') {
				if ($_FILES['image']['tmp_name']!=''){
					if(is_uploaded_file($_FILES['image']['tmp_name'])){
						$_POST['image'] = resizer($_FILES['image']);
					}
				}
				else{
					$_POST['image'] = Projects::selectImage($_POST['id'],$connect);
				}
				$projects = new Projects ($_POST);
				try {
					$projects -> update($_POST['id'], $connect);
						$_SESSION['msg'] = "Sua edição foi realizada com sucesso!";
						header('Location:../views/projects.php');
				}
				catch (PDOException $e) {
					$_SESSION['msg'] = "Sua edição falhou!";
					header('Location:../views/projects.php');
				}
			}
		break;
		case 'delete':
			if (isset($_POST['id'])){
				if(Projects::delete($_POST['id'], $connect)){
					$_SESSION['msg'] = "Serviço deletado.";
					header('Location:../views/projects.php');
				}
			}
			else {
			$_SESSION['msg'] = "Houve falha ao excluir esse serviço.";
			header('Location:../views/projects.php');
			}
		break;

	default:
		header('Location:projects_logout.php');
	break;
	}
?>
