<?php

	require('../model/rewards_detail.model.php');
	require('functions.controller.php');
	
	$reward_id = htmlspecialchars($_POST['reward_id']);
	$reward_detail = getRewardDetail( $reward_id );
	echo getRewardQuantity( $reward_detail ) . '|' . printRewardDetail( $reward_detail );

?>