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
        $height = (1200 * $y)/$x;
        $new = imagecreatetruecolor(1200, $height);
        imagecopyresampled($new, $img, 0, 0, 0, 0, 1200, $height, $x, $y);
        switch ($type){
            case "image/jpeg":
                $local="../assets/img/Portfolioimg/$name".".jpg";
                imagejpeg($new, $local);
            break;
            case "image/png":
                $local="../assets/img/Portfolioimg/$name".".png";
                imagejpeg($new, $local);
            break;
        }
        return $local;
    }
?>
