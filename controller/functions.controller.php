<?php


function getRewardQuantity( $reward_detail ){

	$count = 0;

	foreach ($reward_detail as $detail) {
		$count += $detail['quantity'];
	}

	return $count;

}

function printRewardDetail( $reward_detail ){

	$print = '';

	foreach ($reward_detail as $detail) {
		if($print == ''){
			$print = $detail['user_login'] . "  " . $detail['quantity'];
		}else{
			$print = $print . "<br />" . $detail['user_login'] . "  " . $detail['quantity'];
		}
	}

	return $print;

}

?>