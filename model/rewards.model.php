<?php

function getRewardsByBetID( $bet_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM rewards WHERE bet_id = :bet_id');
	$req -> execute(array(
		'bet_id' => $bet_id
		));

	$results = $req -> fetchAll();
	return $results;

}

function createNewReward( $name, $bet_id, $saloon_id, $user_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare(' INSERT INTO rewards( name, bet_id, user_id, saloon_id, creation_date, modification_date) VALUES ( :name, :bet_id, :user_id, :saloon_id, NOW(), NOW()) ');
	$req -> execute( array(	
		'name' => $name,
		'bet_id' => $bet_id,
		'user_id' => $user_id,
		'saloon_id' => $saloon_id
		) );

}

?>