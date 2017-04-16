<?php 
session_start();

if(isset($_SESSION['id']) && isset($_POST['dataURL'])){

	$img = $_POST['dataURL'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);

	if(!is_dir('../img/profiles/' . $_SESSION['id'])){ // crée un nouveau dossier pour l'utilisateur si nécessaire
		mkdir('../img/profiles/' . $_SESSION['id']);
	}

	$fileName = '../img/profiles/' . $_SESSION['id'] . '/profile.png';
	if(is_file($fileName)){
		unlink($fileName);
	}

	file_put_contents($fileName, $fileData);

	header('Location: ../view/profile/?id=' . $_SESSION['id'] . '&"'. rand(99,9999));

}

?>