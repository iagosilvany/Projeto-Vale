<?php
require_once '../helpers/connect.php';
class Projects {
	public $address;
	public $title;
	public $image;
    public function __construct($attributes) {
    		if (!empty($attributes)){
        			$this->address = $attributes['address'];
        			$this->title = $attributes['title'];
                    $this->image = $attributes['image'];
    		}
	}
	public function insert($connect) {
    		$stm = $connect->prepare("INSERT INTO projects(address, title, image) VALUES (:address, :title, :image)");
    		$stm->BindValue(":address", $this->address, PDO::PARAM_STR);
    		$stm->BindValue(":title", $this->title, PDO::PARAM_STR);
    		$stm->BindValue(":image", $this->image, PDO::PARAM_STR);
            return $stm->execute();
	}
    public static function selectImage($id, $connect){
        $sth = $connect->prepare("SELECT image FROM projects WHERE id=:id LIMIT 1");
        $sth->BindValue(':id',$id,PDO::PARAM_INT);
        $sth->execute();
        $array = $sth->fetch(PDO::FETCH_ASSOC);
        return $array['image'];
    }
    public static function select($id, $connect) {
        $stm = $connect->prepare("SELECT id, image, address, title FROM projects WHERE id=:id");
        $stm->BindValue(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
    public static function selectAll($connect) {
    		$stm = $connect->prepare("SELECT id, address, title, image FROM projects");
    		$stm->execute();
    		return $stm->fetchAll(PDO::FETCH_ASSOC);
	}
    public function update($id, $connect) {
    	$stm = $connect->prepare("UPDATE projects SET address=:address, title=:title, image=:image WHERE id=:id");
    		$stm->BindValue(":address", $this->address, PDO::PARAM_STR);
            $stm->BindValue(":title", $this->title, PDO::PARAM_STR);
            $stm->BindValue(":image", $this->image, PDO::PARAM_STR);
            $stm->BindValue(":id", $id, PDO::PARAM_INT);
    	return $stm->execute();
	}
	public static function delete($id, $connect) {
			$stm = $connect->prepare("DELETE FROM projects WHERE id=:id");
			$stm->BindValue(":id", $id, PDO::PARAM_INT);
			return $stm->execute();
	}
}
?>
