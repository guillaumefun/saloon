<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require('../model/messages.model.php');
require('../model/saloons.model.php');

$convers_id = htmlspecialchars($_POST['convers_id']);

if(!empty($convers_id) && allowedSaloon($convers_id)){

	$nb_msg_total = countMessages( $convers_id );

	if( $_SESSION['nb_msg'][$convers_id] != $nb_msg_total ){ // s'il y a du neuf dans la bdd

		$nb_msg_previous = $_SESSION['nb_msg'][$convers_id];
		$_SESSION['nb_msg'][$convers_id] = $nb_msg_total;
		$messages = getMessageByConversID($convers_id, 10);
		$messages = array_reverse($messages);
		$messages = array_slice($messages, $nb_msg_previous);
		$nb_msg = count($messages); // nombre de msg affiché
		

		foreach ($messages as $msg){
			?>

				<div class="msg <?php if($msg['user_id'] == $_SESSION['id']){ echo "self"; }else{ echo "other";} ?>">
					<div class="user-photo"><img src="../../img/profiles/<?php if(is_file('../img/profiles/' . $msg['user_id'] . '/profile.png')) echo $msg['user_id'] . '/profile.png?' . rand(99,9999); else echo 'profile.jpg'; ?>"></div>
					<p class="msg-content"><?php echo $msg['content']; ?></p>
				</div>

			<?php
		}

		if( count($messages) == 0 ){
			?>

				<p style="font-size:0.8em;margin">Envoie un premier message !</p>

			<?php
		}

		echo "<|aaa|>" . ($nb_msg_total - $nb_msg_previous);
	}else{ // s'il n'y a pas de nouveau msg
		echo "-1";
	}

}

?>