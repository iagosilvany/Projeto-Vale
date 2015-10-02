<?php
	require_once '../helpers/connect.php';
	class Service {
		public $image;
		public $title;
		public $description;
		public function __construct($attributes) {
				if (!empty($attributes)){
						$this->image = $attributes['image'];
						$this->title = $attributes['title'];
						$this->description = $attributes['description'];
				}
		}
		public function insert($connect) {
			$stm = $connect->prepare("INSERT INTO services(image, title, description) VALUES (:image, :title, :description)");
			$stm->BindValue(":image", $this->image, PDO::PARAM_STR);
			$stm->BindValue(":title", $this->title, PDO::PARAM_STR);
			$stm->BindValue(":description", $this->description, PDO::PARAM_STR);
			return $stm->execute();
		}
		public static function selectImage($id, $connect){
			$sth = $connect->prepare("SELECT image FROM services WHERE id=:id LIMIT 1");
			$sth->BindValue(':id',$id,PDO::PARAM_INT);
			$sth->execute();
			$array = $sth->fetch(PDO::FETCH_ASSOC);
			return $array['image'];
		}
		public static function selectAll($connect) {
			$stm = $connect->prepare("SELECT id, image, title, description FROM services");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_ASSOC);
		}
		 public static function select($id, $connect) {
			$stm = $connect->prepare("SELECT id, image, title, description FROM services WHERE id=:id");
			$stm->BindValue(":id", $id, PDO::PARAM_INT);
			$stm->execute();
			return $stm->fetch(PDO::FETCH_ASSOC);
		}
		public function update($id, $connect) {
			$stm = $connect -> prepare("UPDATE services SET image=:image, title=:title, description=:description WHERE id=:id");
			$stm->BindValue(":image", $this->image, PDO::PARAM_STR);
			$stm->BindValue(":title", $this->title, PDO::PARAM_STR);
			$stm->BindValue(":description", $this->description, PDO::PARAM_STR);
			$stm->BindValue(":id", $id, PDO::PARAM_INT);
			return $stm->execute();
		}
		public static function delete($id, $connect) {
			$stm = $connect->prepare("DELETE FROM services WHERE id=:id");
			$stm->BindValue(":id", $id, PDO::PARAM_INT);
			return $stm->execute();
		}
	}
	function maxchar($text, $length){
		if(strlen($text)<=$length){
			echo $text;
		}
		else{
			$smalltext=substr($text,0,$length) . '...';
			echo $smalltext;
		}
	} // Thanks [Edi]Carla Silva Conceição <3
?>
