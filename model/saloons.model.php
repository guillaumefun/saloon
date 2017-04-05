<?php


/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table saloons
 *
 */


function getAllSaloons(){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM saloons');
	$req -> execute();

	$results = $req -> fetchAll();
	$i = 0;

	foreach ($results as $result) {
		$members = explode('|', $result['members']);
		$is_member = false;
		foreach ($members as $member ) {
			if($member == $_SESSION['id']) $is_member = true;
		}

		if($is_member){
			$saloons[$i]['id'] = $result['id'];
			$saloons[$i]['name'] = $result['name'];
			$saloons[$i]['members'] = $result['members'];
			$saloons[$i]['modification_date'] = $result['modification_date'];
			$saloons[$i]['creation_date'] = $result['creation_date'];

			$i ++;
		}
		
	}

	return $saloons;

}

function getSaloon( $id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM saloons WHERE id = :id');
	$req -> execute(array(
		'id' => $id
		));

	$results = $req -> fetch();
	return $results;

}

function createNewSaloon( $name, $members){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare(' INSERT INTO saloons( name, members, creation_date, modification_date) VALUES ( :name, :members, NOW(), NOW()) ');
	$req -> execute( array(	
		'name' => $name,
		'members' => $members
		) );

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare('SELECT * FROM saloons WHERE name = :name AND members = :members');
	$req -> execute(array(
		'name' => $name,
		'members' => $members
		));

	$results = $req -> fetch();
	return $results['id'];

}

function addMember( $name, $saloon_id ){

	$user = getUserByLogin( $name );

	if(empty($user)){
		return 'NOT_REGISTERED';
	}

	$saloon = getSaloon( $saloon_id );

	$members = explode('|', $saloon['members']);

	foreach($members as $member){
		if($member == $user['id']){
			return 'ALREADY_MEMBER';
		}
	}

	$m = $saloon['members'] . '|' . $user['id'];

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root');
	$req = $db -> prepare(' UPDATE saloons SET members = :members WHERE id = :id');
	$req -> execute( array(	
		'members' => $m,
		'id' => $saloon_id
		) );

	return 'DONE';

}