<?php session_start(); ?>
<?php require_once'../models/partners.php'; ?>
<?php if ($_SESSION['logon'] != true): ?>
	<?php header('Location: ../controllers/logout.php'); ?>
<?php endif ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/partners_crud.css">
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link type="text/css" rel="stylesheet" href="../assets/css/sidebar.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php require '../includes/sidebar.php'; ?>
		<section class="crud-parceiros">
			<div class="content-form">
				<h1>Inserção de novos parceiros</h1>
				<?php if(isset($_SESSION['msg'])):?>
				<h3>
					<?php echo $_SESSION['msg']; ?>	
				</h3>
				<?php unset($_SESSION['msg']); ?> 			
				<?php endif; ?>
			<form action="../controllers/partners.php" enctype="multipart/form-data" method="post">
					<input  type="text" name="address" placeholder="link" class="image">
					<input  type="file" name="image" placeholder="imagem" class="fields">
					<button name="action" value="insert">INSERIR</button>
				</form>
				<?php if(isset($_GET['id'])):?>
				<form action="../controllers/partners.php" method="post" enctype="multipart/form-data">
					<h2>Atualização dos Parceiros</h2>
					<?php $two = Partners::select($_GET['id'], $connect);?>
					<input name="image" type="file" value="<?php echo $one['image'];?>">
					<?php $one = Partners::select($_GET['id'], $connect);?> 
					<input name="address" type="text" value="<?php echo $one['address'];?>">
					<input name="id" type="hidden" value="<?php echo $one['id']; ?>">
					<button name="action" value="update">EDITAR</button>	
					<?php endif; ?>
			</form>	
		</div>
			<div class="content-table">		
				<h2>Parceiros adicionados</h2>
				<table>
					<?php $partners = Partners::selectAll($connect); ?>
					<thead>
						<tr>
							<td><h2>ID</h2></td>
							<td><h2>Imagem</h2></td>
							<td><h2>Link</h2></td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($partners as $partner): ?>
						<tr>
						<td><h3><a href="partners.php?id=<?php echo $partner['id']; ?>"><?php echo $partner['id'];?></a></h3></td>
						<td><img src="<?php echo $partner['image']; ?>"></td>
						<td><h3><?php echo $partner['address'];?></h3></td>
						<td>
							<form action="../controllers/partners.php" method="post">
								<input type="hidden" name="id" value="<?php echo $partner['id']; ?>">
								<div id="update"><a href="partners.php?id=<?php echo $partner['id']; ?>"><i class="fa fa-refresh fa-lg"></i> Atualizar</a></div>
								<button id="delete" title="deletar" name="action" value="delete" type="submit" onclick="return confirm('Você deseja apagar esse parceiro?')">X</button>
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
