<?php session_start(); ?>
<?php require_once '../models/services.php'; ?>
<?php require_once '../models/projects.php'; ?>
<?php require_once '../models/partners.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<title>Home</title>
		<link type="text/css" rel="stylesheet" href="../assets/css/stylesheet.css"/>
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	</head>
	<body>
		<input type="checkbox" id="menuToggle">
		<a name="home"></a>
		<section class="landing">
			<div class="container">
				<h1>Projeto Trainee</h1>
				<p id="font">Equipe 02 - Vale do Silício</p>
				<img src="../assets/img/infologo.png">
			</div>
		</section>
		<header>
			<figure>
				<a href="#home">
					<img src="../assets/img/infologo.png">
				</a>
			</figure>
			<label for="menuToggle" id="menu-icon">&#9776;</label>
			<nav class="menu">
				<ul>
					<li>
						<a href="#home">
							<h1>Home</h1>
						</a>
					</li>
					<li>
						<a href="#services">
							<h1>Serviços</h1>
						</a>
					</li>
					<li>
						<a href="#projects">
							<h1>Portfólio</h1>
						</a>
					</li>
					<li>
						<a href="#partners">
							<h1>Parceiros</h1>
						</a>
					</li>
					<li>
						<a href="#contact">
							<h1>Contato</h1>
						</a>
					</li>
					<li>
						<a href="#">
							<h1>Notícias</h1>
						</a>
					</li>
				</ul>
			</nav>
		</header>
		<section class="services">
			<p id="go-down"><a href="#contact"><i class="fa fa-angle-double-down"></i></a></p>
			<h1 id="services">Serviços</h1>
			<?php $services = Service::selectAll($connect); ?>
			<div  class="wrap">
				<?php foreach ($services as $key => $service):?>
					<a href="#openModal<?php echo $key; ?>">
						<figure>
							<img src="<?php echo $service['image']; ?>">
							<h2><?php maxchar($service['title'], 23); ?></h2>
							<p><?php maxchar($service['description'], 28); ?></p>
						</figure>
					</a>
				<div id="openModal<?php echo $key; ?>" class="modalDialog">
					<div class="modalContent">
						<a href="#closeDialog" class="closeButton" title="Fechar">X</a>
						<img src="<?php echo $service['image']; ?>">
						<h2><?php echo $service['title']; ?></h2>
						<p><?php echo $service['description']; ?></p>
					</div>
				</div>
				<?php endforeach;?>
			</div>
		</section>
		<section class="portfolio">
			<h1 id="projects">Portfólio</h1>
			<?php $projects = Projects::selectAll($connect); ?>
			<div class="wrap">
				<?php foreach ($projects as $project):?>
					<a href="<?php echo $project['address']; ?>">
						<figure>
							<h1><?php echo $project['title'] ?></h1>
							<img id="img1" src="<?php echo $project['image']; ?>">
						</figure>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
		<section class="partners">
			<?php $partners = Partners::selectAll($connect); ?>
			<a name="partners"></a>
			<div class="wrap">
			<h1>Parceiros</h1>
				<?php foreach ($partners as $partners):?>
					<a href="<?php echo $partners['address']; ?>">
					 	<figure>
							<img id="img1" src="<?php echo $partners['image']; ?>">
						</figure>
					</a>
				<?php endforeach; ?>
			</div>
		</section>
		<footer>
			<div class="content-form">
				<h1 id="contact">Contato</h1>
				<?php if(isset($_SESSION['msg'])):?>
					<h3>
						<?php echo $_SESSION['msg']; ?>
					</h3>
					<?php unset($_SESSION['msg']); ?>
				<?php endif; ?>
				<form action="../controllers/contact.php" method="POST">
					<fieldset>
						<input class="fields" title="Digite o seu nome" type="text" name="name" placeholder="Nome" required>
						<input class="fields" title="Digite seu email" type="email" name="email" placeholder="email@provedor.com">
						<input class="fields" title="Digite o assunto da mensagem" type="text" name="subject" placeholder="Assunto">
						<textarea class="fields" title="Sua mensagem a ser enviada nesse contato" name="message" placeholder="Mensagem" required rows="2" cols="10"></textarea>
						<input class="fields" type="submit" value="Enviar mensagem">
					</fieldset>
				</form>
			</div>
		</footer>
		<script src="../assets/js/fixedmenu.js"></script>
		<script src="../assets/js/parallax.js"></script>
		<script src="../assets/js/scrolldown.js"></script>
	</body>
</html>
