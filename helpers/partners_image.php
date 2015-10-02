<?php
	function resizer($image){
		$name = md5(sha1(date('d-m-y H:i:s').$image['tmp_name']));
		$type = $image['type'];
		switch ($type) {
			case "image/jpeg":
				$img = imagecreatefromjpeg($image['tmp_name']);
			break;
			case "image/png":
				$img = imagecreatefrompng($image['tmp_name']);
			break;
		}
		$x = imagesx($img);
		$y = imagesy($img);
		$height = (150 * $y)/$x;
		$new = imagecreatetruecolor(150, $height);
		imagecopyresampled($new, $img, 0, 0, 0, 0, 150, $height, $x, $y);
		switch ($type){
			case "image/jpeg":
				$local="../assets/img/crudpartners/$name".".jpg";
				imagejpeg($new, $local);
			break;
			case "image/png":
				$local="../assets/img/crudpartners/$name".".png";
				imagejpeg($new, $local);
			break;
		}
		imagedestroy($img);
		imagedestroy($new);
		return $local;
	} 
?>
