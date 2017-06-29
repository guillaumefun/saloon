<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../model/users.model.php'); 

$email = htmlspecialchars( $_POST['login']);
$password = htmlspecialchars( $_POST['password']);
$rememberme = htmlspecialchars($_POST['rememberme']);

if( isset($email) && isset($password) ){

	// Si les identifiants ne correspondent pas
	if( !login( $email, $password )){
		if(isset($_GET['key']) && isset($_GET['s'])){ 
			header('Location: ../view/?msg=error1&key=' . htmlspecialchars($_GET['key']) . '&s=' . htmlspecialchars($_GET['s'])); 
		}else{
			header('Location: ../view/?msg=error1');
		}
		exit;

	}else{
		if($rememberme = 'on'){
				$valide = 20; // nombre de jour de validité du cookie
		
				setcookie("login", $email, time() + $valide *24*3600, '/', 'www.licorne.life');
				setcookie("pass", $password, time() + $valide *24*3600,  '/', 'www.licorne.life');
				setcookie("login", $email, time() + $valide *24*3600, '/', 'licorne.life');
				setcookie("pass", $password, time() + $valide *24*3600,  '/', 'licorne.life');
		}

		if(isset($_GET['key']) && isset($_GET['s'])){ 
			header('Location: ../s/?key=' . htmlspecialchars($_GET['key']) . '&s=' . htmlspecialchars($_GET['s'])); 
		}else{
			header('Location: ../view/dashboard/');
		}
		exit;

	}
}else{

	header('Location: ../view/?msg=error2:');
	exit;
}


?>