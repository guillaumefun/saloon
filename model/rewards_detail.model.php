<?php

/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table rewards_detail
 *
 */

function addReward( $reward_id, $user_id, $user_login ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM rewards_detail WHERE reward_id = :reward_id AND user_id = :user_id');
	$req -> execute(array(
		'reward_id' => $reward_id,
		'user_id' => $user_id
		));

	$results = $req -> fetch();
	
	if(empty($results)){

		createNewRewardDetail( $reward_id, $user_id, $user_login );

	}else{

		$quantity = $results['quantity'] + 1;

		$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
		$req = $db -> prepare(' UPDATE rewards_detail SET quantity = :quantity WHERE reward_id = :reward_id AND user_id = :user_id');
		$req -> execute( array(
			'quantity' => $quantity,	
			'reward_id' => $reward_id, 
			'user_id' => $user_id
			) );

	}

}

function removeReward( $reward_id, $user_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM rewards_detail WHERE reward_id = :reward_id AND user_id = :user_id');
	$req -> execute(array(
		'reward_id' => $reward_id,
		'user_id' => $user_id
		));

	$results = $req -> fetch();
	
	if(!empty($results) && $results['quantity'] > 0){

		$quantity = $results['quantity'] - 1;

		$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
		$req = $db -> prepare(' UPDATE rewards_detail SET quantity = :quantity WHERE reward_id = :reward_id AND user_id = :user_id');
		$req -> execute( array(
			'quantity' => $quantity,	
			'reward_id' => $reward_id, 
			'user_id' => $user_id
			) );

	}

}


function createNewRewardDetail( $reward_id, $user_id, $user_login ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare(' INSERT INTO rewards_detail( reward_id, user_id, user_login, quantity, creation_date, modification_date) VALUES ( :reward_id, :user_id, :user_login, 1, NOW(), NOW()) ');
	$req -> execute( array(	
		'reward_id' => $reward_id, 
		'user_id' => $user_id,
		'user_login' => $user_login
		) );

}

function getRewardDetail( $reward_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM rewards_detail WHERE reward_id = :reward_id ');
	$req -> execute(array(
		'reward_id' => $reward_id
		));

	$results = $req -> fetchAll();

	return $results;

}

?>