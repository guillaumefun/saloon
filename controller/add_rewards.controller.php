<?php

session_start();

require('../model/rewards_detail.model.php');
require('functions.controller.php');
$reward_id = htmlspecialchars($_POST['reward_id']);

if($_POST['action'] == 'plus'){
	addReward( $reward_id, $_SESSION['id'], $_SESSION['login'] );
}else{
	removeReward( $reward_id, $_SESSION['id'] );
}

$reward_detail = getRewardDetail( $reward_id );
echo getRewardQuantity( $reward_detail ) . '|' . printRewardDetail( $reward_detail );

?>