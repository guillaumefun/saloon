<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../model/users.model.php'); 

$email = htmlspecialchars( $_COOKIE['login']);
$password = htmlspecialchars( $_COOKIE['pass']);

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
		
		// MàJ de la date d'expiration
		setcookie("login", $email, time() + $valide *24*3600, '/', '.licorne.life', false, true);
		setcookie("pass", $password, time() + $valide *24*3600, '/', '.licorne.life', false, true);


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