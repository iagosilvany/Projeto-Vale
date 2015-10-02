<?php session_start(); ?>
<?php require_once '../models/projects.php';?>
<?php if ($_SESSION['logon'] != true): ?>
	<?php header('Location: ../controllers/logout.php'); ?>
<?php endif ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>CRUD de Portfolio</title>
		<link type="text/css" rel="stylesheet" href="../assets/css/projects.css"/>
		<link type="text/css" rel="stylesheet" href="../assets/css/sidebar.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php require '../includes/sidebar.php'; ?>
		<section class="crud-portfolio">
			<div class="content-form">
				<h1>Inserção de novos Dados</h1>
				<?php if(isset($_SESSION['msg'])):?>
					<h3>
						<?php echo $_SESSION['msg']; ?>
					</h3>
					<?php unset($_SESSION['msg']); ?>
				<?php endif; ?>
				<form action="../controllers/projects.php" enctype="multipart/form-data" method="post">
					<input type="file" name="image" placeholder="imagem" class="image">
					<input type="text" name="title" placeholder="titulo" class="fields">
					<input type="text" name="address" placeholder="link" class="fields">
					<button name="action" value="insert">INSERIR</button>
				</form>
				<form action="../controllers/projects.php" method="post" enctype="multipart/form-data">
					<h2>Atualização dos Dados</h2>
					<?php if(isset($_GET['id'])):?>
						<input name="image" type="file" value="<?php echo $escolhido['image'];?>" class="image">
						<?php $escolhido = Projects::select($_GET['id'], $connect);?>
						<input name="title" type="text" value="<?php echo $escolhido['title'];?>" class="fields">
						<input name="address" type="text" value="<?php echo $escolhido['address'];?>" class="fields">
						<input name="id" type="hidden" value="<?php echo $escolhido['id']; ?>">
						<button name="action" value="update">EDITAR</button>
					<?php endif; ?>
				</form>
			</div>
			<div class="content-table">
				<h2>Dados Servidor</h2>
				<table>
					<?php $projects = Projects::selectAll($connect); ?>
					<thead>
						<tr>
							<td><h2>Imagem</h2></td>
							<td><h2>Título</h2></td>
							<td><h2>Link</h2></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($projects as $project):?>
						<tr>
						<td><img src="<?php echo $project['image']; ?>"></td>
						<td><h3><?php echo $project['title'];?></h3></td>
						<td><h3><?php echo $project['address'];?></h3></td>
						<td>
							<form action="../controllers/projects.php" method="post">
								<input type="hidden" name="id" value="<?php echo $project['id']; ?>">
								<div id="update"><a href="projects.php?id=<?php echo $project['id']; ?>"><i class="fa fa-refresh fa-lg"></i> Atualizar</a></div>
								<button id="delete" name="action" title="Deletar" value="delete" type="submit" onclick="return confirm('Você deseja apagar esse item do Portfólio?')">X</button>
							</form>
						</td>
						<?php endforeach; ?>
						</tr>
					</tbody>
				</table>
			</div>
		</section>
	</body>
</html>
