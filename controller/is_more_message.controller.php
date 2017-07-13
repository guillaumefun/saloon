<?php

require('../model/messages.model.php');
require('../model/saloons.model.php');
session_start();


$convers_id = htmlspecialchars($_POST['convers_id']);

if(!empty($convers_id) && allowedSaloon($convers_id)){

	$nb_msg_total = countMessages( $convers_id );

	if( $_SESSION['nb_msg'][$convers_id] != $nb_msg_total ){ // s'il y a du neuf dans la bdd

		$nb_msg_previous = $_SESSION['nb_msg'][$convers_id];
		//$_SESSION['nb_msg'][$convers_id] = $nb_msg_total;

		echo ($nb_msg_total - $nb_msg_previous);

	}

}

?>