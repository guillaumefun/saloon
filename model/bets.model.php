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

function getBetsFeed( $saloon_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM bets WHERE saloon_id = :saloon_id');
	$req -> execute(array(
		'saloon_id' => $saloon_id
		));

	$results = $req -> fetchAll();

	$order = array();
	$i = 0;

	foreach($results as $bet){

		$delta_dead = getDateDelta($bet['deadline']);
		$creation_date = explode(' ', $bet['creation_date']);
		$delta_creation = getDateDelta($creation_date[0], 'US');
		if($bet['accomplished'] != 0){
			$delta_finished = getDateDelta($bet['accomplished']);
		}else{
			$delta_finished = '1/01/1970';
		}

		$order[$i] = min(abs($delta_dead), abs($delta_creation), abs($delta_finished));
		$i++;

	}

	array_multisort($order, $results); // Trie le tableau results en fonction du réarrangement par ordre croissant du tableau order
	return $results;

}

function getDateDelta( $date, $date_format = 'EU' ){ //  EU = sous la forme dd/mm/yyyy, US = yyyy-mm-dd

	if($date_format == 'EU'){
		$date = explode('/', $date);

		if(count($date) != 3) return 'ERROR';

		$time = strtotime($date[0] . "-" . $date[1] . "-" . $date[2]);
	}else if($date_format == 'US'){
		$date = explode('-', $date);

		if(count($date) != 3) return 'ERROR';

		$time = strtotime($date[2] . "-" . $date[1] . "-" . $date[0]);
	}

	$now = time();

	$datediff = $time - $now;
	return floor(($datediff / (60 * 60 * 24))+1); 

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


function getBet($id){
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM bets WHERE id = :id');
	$req -> execute(array(
		'id' => $id
		));

	$results = $req -> fetch();
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

function setAccomplished( $id, $nb_img ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('UPDATE bets SET accomplished = :accomplished, nb_img = :nb_img WHERE id = :id');
	$req -> execute(array(
		'accomplished' => date("j/m/Y"),
		'nb_img' => $nb_img,
		'id' => $id
		));

}

?>