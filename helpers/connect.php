<?php
	try {
			$connect = new \PDO("mysql:host=localhost; dbname=schema;", "root", '');
			// set the PDO error mode to exception
			$connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
			echo "Falha ao conectar: " . $e->getMessage();
	}
?>
