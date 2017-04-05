<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require('../model/saloons.model.php');

$name = htmlspecialchars($_POST['name']);
$members = $_SESSION['id'];

if(!empty($name)){

	$id = createNewSaloon( $name, $members );
	header('Location: ../view/dashboard/?s=' . $id);
	exit();

}else{
	header('Location: ../view/dashboard/');
}

?>