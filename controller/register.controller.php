<?php

require('../model/users.model.php'); 

$login = htmlspecialchars( $_POST['login']);
$email = htmlspecialchars( $_POST['email']);
$password = htmlspecialchars($_POST['password']);

// vérifie que le formulaire est rempli
if ( !empty($login) && !empty($email) && !empty($password)) {

	$error_code = createNewUser( $login, $email, $password );

	// vérifie que le login et email ne sont pas déjà utilisés
	if( $error_code == 23000 ){
		header('Location: ../view/register.view.php?msg=error1');
		exit;
	}

	login($login, $password);

	header('Location: ../view/dashboard');
	
}else{
	// si le formulaire est vide
	header('Location: ../view/register.view.php');
	exit;
}



?>