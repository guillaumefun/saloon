<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require('functions.controller.php');
require('../model/bets.model.php');

$bet_id = htmlspecialchars($_GET['bet_id']);
$comment = htmlspecialchars($_POST['comment']);
$bet = getBet($bet_id);

if($bet['user'] != $_SESSION['id']){ 
	header('Location: ../view/dashboard/');
	exit;
}

if(!empty($_FILES) && count($_FILES['img']['name']) > 0 && count($_FILES['img']['name']) <= 3 ){


	if(!is_dir('../img/proofs/' . $bet_id)){ // crée un nouveau dossier pour l'utilisateur si nécessaire
		mkdir('../img/proofs/' . $bet_id);
	}

	$i = 0;

	while(!empty($_FILES['img']['name'][$i])){
				
		$file_name = $i;

		$resized_img = resize($_FILES['img'], 470, $i);
		$thumbnail = createThumbnail($_FILES['img'], $i);

		$result = imagejpeg($resized_img, '../img/proofs/' . $bet_id .'/' . $file_name .'.jpeg' , 100);
		$result2 = imagejpeg($thumbnail, '../img/proofs/' . $bet_id .'/' . $file_name . '_thumb.jpeg' , 100);			
				
		$i++;

	}

	$nb_img = $i;

	setAccomplished($bet_id, $nb_img, $comment);
	header('Location: ../view/dashboard/');
}else{
	header('Location: ../view/dashboard/');
}

?>