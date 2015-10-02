<?php
require_once '../helpers/connect.php';
class Login {
	public $username;
	public $password;
	public function __construct($attributes) {
			if (!empty($attributes)){
					$this->username = $attributes['username'];
					$this->password = $attributes['password'];
			}
	}
	public function logon($connect) {
		$stm = $connect->prepare("SELECT id, username, password FROM users WHERE username=:username AND password=:password");
		$stm->BindValue(":username", $this->username, PDO::PARAM_STR);
		$stm->BindValue(":password", $this->password, PDO::PARAM_STR);
		$stm->execute();
		return $stm->fetch(PDO::FETCH_ASSOC);
	}
}
?>
