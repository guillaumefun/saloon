<?php
/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table saloons et... pour gérer les notifications.
 */

//(NOT USED)
function getSaloonBis( $id ){
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM saloons WHERE id = :id');
	$req -> execute(array(
		'id' => $id
		));
	$results = $req -> fetch();
	return $results;
}

//(NOT USED)renvoie tt les users (id) d'un saloon
function getUsers($saloon_id){
	$saloon = getSaloonBis( $saloon_id );

	$members = explode('|', $saloon['members']);

	foreach($members as $member){
		echo $member;
	}
}

//(NOT USED)Renvoie tt les soloons (id) dans lesquels est un user ($user) spécifique
function getSaloonsUser($user){
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT id FROM saloons WHERE members = ?
		            OR members like ? OR members like ? OR members like ?');
	$req -> execute(array($user, '%|'.$user.'|%', $user.'|%', '%|'.$user));
	//on veut tous les cas => 2 - 2|3|4 - 3|2|4 - 4|3|2

	/*while($results = $req -> fetch()){
		echo $results['id'];
	}*/
	$results = $req -> fetch();
	return $results;
}

//(NOT USED)echo le nombre de saloons ds lesquels est un user (plus simple à faire ici qu'en javascript...)
function getSaloonsNbrUser($user){
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT id FROM saloons WHERE members = ?
		            OR members like ? OR members like ? OR members like ?');
	$req -> execute(array($user, '%|'.$user.'|%', $user.'|%', '%|'.$user));
	//on veut tous les cas => 2 - 2|3|4 - 3|2|4 - 4|3|2
	$i = 0;
	while($results = $req -> fetch()){
		echo $results['id'];
	}
	//echo $i;  //nombre de saloons dans lequel $user se trouve.
}

//echo les saloons dans lesquels sont un user ($user) et ce dans le bon format (le format nécéssaire pour créer des tags pour les notfis)
function getSaloonsTagFormatUser($user){
	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT id FROM saloons WHERE members = ?
		            OR members like ? OR members like ? OR members like ?');
	$req -> execute(array($user, '%|'.$user.'|%', $user.'|%', '%|'.$user));
	//on veut tous les cas => 2 - 2|3|4 - 3|2|4 - 4|3|2
	$i = 0;
	while($results = $req -> fetch()){
		echo "key".$results['id'].": 'lol',";  //on s'en bat de la valeur de la key, on la met à lol.
		echo "\n";
		$i++;
	}
}


?>
