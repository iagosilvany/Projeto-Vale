<?php
require_once('../helpers/connect.php');
class partners{
	public $image;
	public $address;
	public function __construct($attributes) {
			if (!empty($attributes)){
					$this->image = $attributes['image'];
					$this->address = $attributes['address'];
			}
	}
	public function insert($connect) {
			$stm = $connect->prepare("INSERT INTO partners(image,address) VALUES (:image,:address)");
			$stm->BindValue(":image", $this->image, PDO::PARAM_STR);
			$stm->BindValue(":address", $this->address, PDO::PARAM_STR);
			return $stm->execute();
	}
	public static function select($id, $connect) {
		$stm = $connect->prepare("SELECT id, image, address FROM partners WHERE id=:id");
		$stm->BindValue(":id", $id, PDO::PARAM_INT);
		$stm->execute();
		return $stm->fetch(PDO::FETCH_ASSOC);
	}
	public static function selectImage($id, $connect) {
		$sth = $connect->prepare("SELECT image FROM partners WHERE id=:id");
		$sth->BindValue(":id", $id, PDO::PARAM_INT);
		$sth->execute();
		$array = $sth -> fetch(PDO::FETCH_ASSOC);
		return $array['image'];
	}
	public static function selectAll($connect) {
			$stm = $connect->prepare("SELECT id, address, image FROM partners");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_ASSOC);
	}
	public function update($id, $connect) {
		$stm = $connect->prepare("UPDATE partners SET image=:image,address=:address WHERE id=:id");
		$stm->BindValue(":image", $this->image, PDO::PARAM_STR);
		$stm->BindValue(":address", $this->address, PDO::PARAM_STR);
		$stm->BindValue(":id", $id, PDO::PARAM_INT);
		return $stm->execute();
	}
	public static function delete($id, $connect) {
			$stm = $connect->prepare("DELETE FROM partners WHERE id=:id");
			$stm->BindValue(":id", $id, PDO::PARAM_INT);
			return $stm->execute();
	}
}
?>
