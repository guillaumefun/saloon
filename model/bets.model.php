<?php

/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table saloons
 *
 */

require('saloons.model.php');
require('users.model.php');


// Fonction qui renvoie les paris de  chaque salons ordonnés par utilisateur
function getBetsBySaloonID( $saloon_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM bets WHERE saloon_id = :saloon_id');
	$req -> execute(array(
		'saloon_id' => $saloon_id
		));

	$results = $req -> fetchAll();

	$saloon = getSaloon($saloon_id);
	$members = explode('|', $saloon['members']);
	$i = 0;

	foreach ($members as $member) {
		
		$member_bets = getBets($saloon_id, $member);
		$user = getUser($member);
		$bets[$i]['bets'] = $member_bets;
		$bets[$i]['user'] = $user;
		$i++;

	}

	return $bets;
}

function getBets($saloon_id, $user_id){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM bets WHERE saloon_id = :saloon_id AND user = :user ORDER BY id DESC');
	$req -> execute(array(
		'saloon_id' => $saloon_id,
		'user' => $user_id
		));
	$results = $req -> fetchAll();
	return $results;


}

function getBetsByUserID($user_id){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM bets WHERE user = :user ORDER BY id DESC');
	$req -> execute(array(
		'user' => $user_id
		));
	$results = $req -> fetchAll();
	return $results;

}

function getDoneBetsCount($user_id){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM bets WHERE user = :user AND accomplished = true ORDER BY id DESC');
	$req -> execute(array(
		'user' => $user_id
		));
	$results = $req -> fetchAll();
	return count($results);

}

function createNewBet($name, $description, $deadline, $saloon_id){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare(' INSERT INTO bets( name, description, user, saloon_id, deadline, creation_date, modification_date) VALUES ( :name, :description, :user, :saloon_id, :deadline, NOW(), NOW()) ');
	$req -> execute( array(	
		'name' => $name,
		'description' => $description,
		'user' => $_SESSION['id'],
		'saloon_id' => $saloon_id,
		'deadline' => $deadline
		) );

}

?>