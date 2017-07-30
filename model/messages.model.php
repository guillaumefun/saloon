<?php

/*
 * Ce fichier regroupe toutes les fonctions qui permettent de communiquer
 * avec la table messages
 *
 */

function getMessageByConversID( $convers_id, $nb_msg ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM messages WHERE convers_id = :convers_id ORDER BY id DESC LIMIT ' . $nb_msg);
	$req -> execute(array(
		'convers_id' => $convers_id
		));

	$results = $req -> fetchAll();
	return $results;

}

// retourne le nombre de message dans une conversation
function countMessages( $convers_id ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare('SELECT * FROM messages WHERE convers_id = :convers_id');
	$req -> execute(array(
		'convers_id' => $convers_id
		));

	$results = $req -> fetchAll();
	return count($results);

}

function addMessage( $content, $convers_id, $user_id, $user_name ){

	$db = new PDO('mysql:host=localhost;dbname=saloon;charset=utf8', 'root' , 'root'   );
	$req = $db -> prepare(' INSERT INTO messages( content, convers_id, user_id, user_name, creation_date, modification_date) VALUES ( :content, :convers_id, :user_id, :user_name, NOW(), NOW()) ');
	$req -> execute( array(	
		'content' => $content, 
		'convers_id' => $convers_id, 
		'user_id' => $user_id, 
		'user_name' => $user_name,
		) );

	return $req -> errorCode();

}

?>