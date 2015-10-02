<?php session_start(); ?>
<?php require_once '../models/services.php'; ?>
<?php if ($_SESSION['logon'] != true): ?>
	<?php header('Location: ../controllers/logout.php'); ?>
<?php endif ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>CRUD de Serviços</title>
		<link type="text/css" rel="stylesheet" href="../assets/css/services.css"/>
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<link type="text/css" rel="stylesheet" href="../assets/css/sidebar.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php require '../includes/sidebar.php'; ?>
		<section class="crud-services">
			<div class="content-form">
				<h1>Adicionar novo serviço</h1>
				<?php if(isset($_SESSION['msg'])){ ?>
					<h3>
						<?php echo $_SESSION['msg']; ?>
					</h3>
					<?php unset($_SESSION['msg']); ?>
				<?php } ?>
				<form action="../controllers/services.php" method="post" enctype="multipart/form-data">
					<input id="image" type="file" name="image" placeholder="Imagem">
					<input class="fields" type="text" name="title" placeholder="Nome do serviço">
					<textarea class="fields" type="text" name="description" placeholder="Descrição do serviço"></textarea>
					<button name="action" value="insert">INSERIR</button>
				</form>
				<?php if (isset($_GET['id'])): ?>
					<h2>Atualizar serviço existente</h2>
					<form action="../controllers/services.php" method="post" enctype="multipart/form-data">
							<input id="image" name="image" type="file" value="<?php echo $escolhido['image'];?>">
							<?php $escolhido= Service::select($_GET['id'], $connect); ?>
							<input class="fields" name="title" type="text" value="<?php echo $escolhido['title']; ?>">
							<textarea class="fields" name="description" type="text"><?php echo $escolhido['description']; ?></textarea>
							<input name="id" type="hidden" value="<?php echo $escolhido['id']; ?>">
							<button name="action" value="update">EDITAR</button>
					</form>
				<?php endif ?>
			</div>
			<div class="content-table">
				<h2>Serviços adicionados:</h2>
				<table>
					<?php $services = Service::selectAll($connect); ?>
					<thead>
						<tr>
							<td><h2>Imagem</h2></td>
							<td><h2>Título</h2></td>
							<td><h2>Descrição</h2></td>
							<td><h2>Ação:</h2></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($services as $service):?>
						<tr>
						<td><img src="<?php echo $service['image']; ?>"></td>
						<td><h3><?php echo $service['title'];?></h3></td>
						<td><h3><?php echo $service['description'];?></h3></td>
						<td>
							<form action="../controllers/services.php" method="post">
								<input type="hidden" name="id" value="<?php echo $service['id']; ?>">
								<div id="update"><a href="services.php?id=<?php echo $service['id']; ?>"><i class="fa fa-refresh fa-lg"></i> Atualizar</a></div>
								<button id="delete" title="Deletar Serviço" name="action" value="delete" type="submit" onclick="return confirm('Você deseja apagar esse serviço?')">X</button>
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
