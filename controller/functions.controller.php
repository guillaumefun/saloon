<?php


function getRewardQuantity( $reward_detail ){

	$count = 0;

	foreach ($reward_detail as $detail) {
		$count += $detail['quantity'];
	}

	return $count;

}

?>