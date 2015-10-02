<?php
	session_start();
	require_once('../models/partners.php');
	require_once('../helpers/connect.php');
	require_once('../helpers/partners_image.php');
		if (isset($_POST['action'])){
			$action = $_POST['action'];
		}
		else{
			header('Location:../views/login.php');
		}
		switch ($action) {
			case 'insert':
				if($_FILES['image']!=""&& $_POST['address']!=""){
					if(is_uploaded_file($_FILES['image']['tmp_name'])){
						$_POST['image']=resizer($_FILES['image']);
					}	
					$partners = new partners($_POST);
					try{
						if($partners-> insert ($connect)){
							$_SESSION['msg'] = 'A inserção foi um sucesso';
							header('Location:../views/partners.php');
						}
					}
					catch(PDOException $e){
						$_SESSION['msg'] = 'A inserção falhou';
						header('Location:../views/partners.php');
					}
				}
				else{
					$_SESSION['msg'] = 'A inserção falhou';
					header('Location:../views/partners.php');
				}
			break;
			case'update':
				if ($_POST["address"]!="") {
					if($_FILES['image']['tmp_name']!=''){
						if(is_uploaded_file($_FILES['image']['tmp_name'])){		
								$_POST['image'] = resizer($_FILES['image']);
						}
					}
					else{
						$_POST['image'] = Partners::selectImage($_POST['id'],$connect);
					}		
					$partners = new Partners($_POST);
					try {
						$partners -> update($_POST['id'], $connect);
							$_SESSION['msg'] = "Sua edição foi realizada com sucesso!";	
							header('Location:../views/partners.php');
					}
					catch (PDOException $e) {
						$_SESSION['msg'] = "Sua edição falhou!";
						header('Location:../views/partners.php');
					}
				}
		break;
		case 'delete':
			if (isset($_POST['id'])){
				if(Partners::delete($_POST['id'], $connect)){
					$_SESSION['msg'] = "Parceiro deletado.";
					header('Location:../views/partners.php');
				}
			}
			else {
			$_SESSION['msg'] = "Houve falha ao excluir esse Parceiro.";
			header('Location:../views/partners.php');
			}
		break;
		default:
		header('Location:logout.php');
		break;
	}	
?>
