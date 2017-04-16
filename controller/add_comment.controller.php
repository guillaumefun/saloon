<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require('../model/comments.model.php');

$com = htmlspecialchars($_POST['comment']);
$bet_id = htmlspecialchars($_POST['bet_id']);
$saloon_id = htmlspecialchars($_POST['saloon_id']);

if(!empty($com) && !empty($bet_id) && !empty($saloon_id)){

	addComment( $com, $bet_id, $saloon_id, $_SESSION['id'], $_SESSION['login'] );

	$comments = getCommentsByBetID($bet_id);

	foreach($comments as $comment){

		?>
		<div class="row">

			<div class="col-md-12 comment">
				<p><span><?php echo $comment['user_name']; ?>:</span> <?php echo $comment['content']; ?></p>
			</div>

		</div>
		<?php
	}

	if( count($comments) == 0 ){
		?>

			<p style="font-size:0.8em;margin">Il n'y a pas encore de commentaires</p>

		<?php
	}
		
	echo "|" . count($comments);
}

?>