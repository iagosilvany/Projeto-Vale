<?php
	session_start();
	if(isset($_POST['email'])) {
		$email_to = "daviramos@infojr.com.br";
		function died($error) {
			$_SESSION['msg']="Desculpa, sua mensagem não pôde ser enviada. <br>".$error;
			die();
		}
		if(!isset($_POST['name']) ||
			!isset($_POST['email']) ||
			!isset($_POST['subject']) ||
			!isset($_POST['message'])) {
			died('Por gentileza, preencha todos os campos.');
		}
		$name = $_POST['name']; // required
		$email = $_POST['email']; // required
		$subject = $_POST['subject']; // required
		$message = $_POST['message']; // required
		$error_message = "";
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		if(!preg_match($email_exp,$email)) {
			$error_message .= 'O e-mail inserido não é válido.';
		}
		$string_exp = "/^[A-Za-z .'-]+$/";
		if(!preg_match($string_exp,$name)) {
			$error_message .= 'Nome inserdo não é válido.';
		}
		if(strlen($message) < 2) {
		 	$error_message .= 'Mensagem muito curta.';
		}
		if(strlen($error_message) > 0) {
			died($error_message);
		}
		$email_message = "Detalhes do email abaixo:\n\n";
		function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
		}
		$email_message .= "Name: ".clean_string($name)."\n";
		$email_message .= "Email: ".clean_string($email)."\n";
		$email_message .= "Subject: ".clean_string($subject)."\n";
		$email_message .= "Message: ".clean_string($message)."\n";
		// create email headers
		$headers = 'De: '.$email."\r\n".
		'Responder-Para: '.$email."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		mail($email_to, $subject, $email_message, $headers);
		$_SESSION['msg'] = "Obrigado por ter nos contatado. Por gentileza, aguarde nossa resposta.";
	}
	header('Location:../views/index.php#contact');
?>
