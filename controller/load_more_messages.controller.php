<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require('../model/messages.model.php');

$convers_id = htmlspecialchars($_POST['convers_id']);
$nb_msg_init = htmlspecialchars($_POST['nb_msg']);

if(!empty($convers_id)){
	$nb_msg_total = countMessages($convers_id);
	if($nb_msg_init < $nb_msg_total){

		$messages = getMessageByConversID($convers_id, $nb_msg_init + 20); // prend 20 msg en plus que ce qui est affiché
		$nb_msg = count($messages); // nombre de msg qui seront affiché
		$messages = array_slice($messages, $nb_msg_init); // prend uniquement les messages qui ne sont pas encore affichés

		$messages = array_reverse($messages);
	
		?>

			<div class="more_msg" id="<?php echo $nb_msg; ?>" hidden>
			</div>

		<?php
		

		foreach ($messages as $msg){
			?>

				<div class="msg <?php if($msg['user_id'] == $_SESSION['id']){ echo "self"; }else{ echo "other";} ?>">
					<div class="user-photo"><img src="../../img/profiles/<?php if(is_file('../img/profiles/' . $msg['user_id'] . '/profile.png')) echo $msg['user_id'] . '/profile.png?' . rand(99,9999); else echo 'profile.jpg'; ?>"></div>
					<p class="msg-content"><?php echo $msg['content']; ?></p>
				</div>

			<?php
		}

	}

}

?>