<?php
session_start();
require_once('../helpers/connect.php');
require_once('../models/services.php');
require_once('../helpers/resizer.php');
	if (isset($_POST['action'])) {
		$action = $_POST['action'];
	}
	else {
		header('Location:../views/login.php');
	}
	switch ($action) {
		case 'insert':
			if ($_FILES['image']['tmp_name']!="" && $_POST['title']!="" && $_POST['description']!="") {
				if(is_uploaded_file($_FILES['image']['tmp_name']))
					$_POST['image']=resizer($_FILES['image']);
					$services = new Service($_POST);
				try {
					if ($services -> insert ($connect)){
						$_SESSION['msg'] = "Novo serviço adicionado.";
						header('Location:../views/services.php');
					}
				}
				catch (PDOException $e) {
					$_SESSION['msg'] = "A adição desse serviço falhou.";
				}
			}
			else{
				$_SESSION['msg'] = "A adição desse serviço falhou.";
				header('Location:../views/services.php');
			}
		break;
		case 'update':
			if ($_POST['title']!="" && $_POST['description']!="") {
				if ($_FILES['image']['tmp_name']!=""){
					if(is_uploaded_file($_FILES['image']['tmp_name'])){
						$_POST['image'] = resizer($_FILES['image']);
					}
				}
				else{
					$_POST['image'] = Service::selectImage($_POST['id'],$connect);
				}
				$service = new Service ($_POST);
				try {
					$service -> update($_POST['id'], $connect);
					$_SESSION['msg'] = "Serviço editado com sucesso.";
					}
				catch (PDOException $e) {
					$_SESSION['msg'] = "A edição desse serviço falhou.";
					}
					header('Location:../views/services.php');
				}
		break;
		case 'delete':
			if (isset($_POST['id'])){
				if(Service::delete($_POST['id'], $connect)){
					$_SESSION['msg'] = "Serviço deletado.";
					header('Location:../views/services.php');
				}
			}
			else {
			$_SESSION['msg'] = "Houve falha ao excluir esse serviço.";
			header('Location:../views/services.php');
			}
		break;
	default:
		header('Location:logout.php');
	}
?>
