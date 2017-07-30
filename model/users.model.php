<?php

/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table users
 *
 */

// Fonction qui connecte un utilisateur
function login( $login, $password){

	$password = hash('sha256', 'Du4' . $password);
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM users WHERE login = :login AND password = :password');
	$req -> execute(array(
		'login' => $login,
		'password' => $password
		));

	$results = $req -> fetch();


	// S'il n'y a pas de champs dans la bd correspondant au mail et au password
	if( empty($results) ){
		return false;
	}else{
		session_start();

		$_SESSION['id'] = $results['id'];
		$_SESSION['login'] = $results['login'];
		$_SESSION['email'] = $results['email'];

		return true;

	}

}

function getUser($id){
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM users WHERE id = :id');
	$req -> execute(array(
		'id' => $id
		));

	$results = $req -> fetch();
	return $results;
}

function getUserByLogin( $login ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM users WHERE login = :login');
	$req -> execute(array(
		'login' => $login
		));

	$results = $req -> fetch();
	return $results;

}

function createNewUser( $login, $email, $password ){

	$password = hash('sha256', 'Du4' . $password);
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare(' INSERT INTO users( login, email, password, creation_date, modification_date) VALUES (:login, :email, :password, NOW(), NOW()) ');
	$req -> execute( array(
		'login' => $login,
		'email' => $email,
		'password' => $password
		) );

	return $req -> errorCode();

}

?>