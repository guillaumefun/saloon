<?php 
session_start();

require('../model/bets.model.php');

$name = htmlspecialchars($_POST['name']);
$description = htmlspecialchars($_POST['description']);
$deadline = htmlspecialchars($_POST['deadline']);
$saloon_id = htmlspecialchars($_GET['id']);

if(!empty($name) && !empty($description) && !empty($deadline)){

	createNewBet($name, $description, $deadline, $saloon_id);
	header('Location: ../view/dashboard/?s=' . $saloon_id);

}else{
	header('Location: ../view/dashboard');
}

?>