<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if(isset($_SESSION['id']) && isset($_GET['key']) && isset($_GET['s'])){

	require('../model/saloons.model.php');

	$key = htmlspecialchars($_GET['key']);
	$saloon_id = htmlspecialchars($_GET['s']);
	$saloon = getSaloon( $saloon_id );
	$expected_key = substr(sha1(md5($saloon_id . "%" . $saloon['creation_date'])), 1, 16);

	if($expected_key == $key){

		addMemberByID($_SESSION['id'] ,$saloon_id);
		header('Location: ../view/dashboard/?s=' . $saloon_id);

	}

}

?>