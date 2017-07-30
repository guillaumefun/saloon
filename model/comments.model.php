<?php

/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table comments
 *
 */

function getCommentsByBetID( $bet_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM comments WHERE bet_id = :bet_id');
	$req -> execute(array(
		'bet_id' => $bet_id
		));

	$results = $req -> fetchAll();
	return $results;

}

function addComment( $content, $bet_id, $saloon_id, $user_id, $user_name ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare(' INSERT INTO comments( content, bet_id, saloon_id, user_id, user_name, creation_date, modification_date) VALUES ( :content, :bet_id, :saloon_id, :user_id, :user_name, NOW(), NOW()) ');
	$req -> execute( array(	
		'content' => $content, 
		'bet_id' => $bet_id, 
		'saloon_id' => $saloon_id, 
		'user_id' => $user_id, 
		'user_name' => $user_name,
		) );


}

?>