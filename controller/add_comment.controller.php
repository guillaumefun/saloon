<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require('../model/comments.model.php');

$comment = htmlspecialchars($_POST['comment']);
$bet_id = htmlspecialchars($_GET['b']);
$saloon_id = htmlspecialchars($_GET['s']);

if(!empty($comment) && !empty($bet_id) && !empty($saloon_id)){

	addComment( $comment, $bet_id, $saloon_id, $_SESSION['id'], $_SESSION['login'] );
	header('Location: ../view/dashboard/?s=' . $saloon_id);
	exit();

}else{
	header('Location: ../view/dashboard/');
}

?>