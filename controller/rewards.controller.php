<?php

require('../model/rewards.model.php');

$name = htmlspecialchars($_POST['name']);
$saloon_id = htmlspecialchars($_GET['s']);
$bet_id = htmlspecialchars($_GET['bet_id']);
$user_id = htmlspecialchars($_GET['user_id']);

if(!empty($name) && !empty($saloon_id) && !empty($bet_id) ){

	createNewReward( $name, $bet_id, $saloon_id, $user_id );
	header('Location: ../view/dashboard/?s=' . $saloon_id);
	exit();

}else{
	header('Location: ../view/dashboard/');
}

?>