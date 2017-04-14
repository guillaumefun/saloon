<?php


function getRewardQuantity( $reward_detail ){

	$count = 0;

	foreach ($reward_detail as $detail) {
		$count += $detail['quantity'];
	}

	return $count;

}

function printRewardDetail( $reward_detail ){

	$print = '';

	foreach ($reward_detail as $detail) {
		if($print == ''){
			$print = $detail['user_login'] . "  " . $detail['quantity'];
		}else{
			$print = $print . "<br />" . $detail['user_login'] . "  " . $detail['quantity'];
		}
	}

	return $print;

}

// Fonction qui redimensionne une image
function resize($img, $height, $i){

	// extension autorisée
	$ext_array = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png' );
	$ext_array_IE = array('jpg' => 'image/pjpg', 'jpeg' => 'image/pjpeg');

	// extraction de l'extension
	$file_ext_array = explode('.', $img['name'][$i]);
	$file_ext = strtolower($file_ext_array[count($file_ext_array) - 1]);

	// vérification de l'extension
	if($file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'pjpg' || $file_ext == 'pjpeg' || $file_ext == 'png'){
		$img_info = getimagesize($img['tmp_name'][$i]);

		if($img_info['mime'] == $ext_array[$file_ext] || $img_info['mime'] == $ext_array_IE[$file_ext]){
			if($file_ext == 'png'){
				$img_to_resize = imagecreatefrompng($img['tmp_name'][$i]);
			}else{
				$img_to_resize = imagecreatefromjpeg($img['tmp_name'][$i]);
			}

			// calcul des proportions
			$original_size = getimagesize($img['tmp_name'][$i]);
			$reduction_factor = (($height * 100) / $original_size[1]);
			$width = (($original_size[0] * $reduction_factor ) /100);

			$new_img = imagecreatetruecolor($width, $height) or die("Error.");
			imagecopyresampled($new_img, $img_to_resize, 0, 0, 0, 0, $width, $height, $original_size[0], $original_size[1]);

			imagedestroy($img_to_resize);

			return $new_img;

		}
	}

}
?>