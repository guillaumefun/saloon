<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../model/users.model.php'); 

$email = htmlspecialchars( $_POST['login']);
$password = htmlspecialchars( $_POST['password']);

if( isset($email) && isset($password) ){

	// Si les identifiants ne correspondent pas
	if( !login( $email, $password )){

		header('Location: ../view/?msg=error1');
		exit;

	}else{

		header('Location: ../view/dashboard/');
		exit;

	}
}else{

	header('Location: ../view/?msg=error2:');
	exit;
}


?>