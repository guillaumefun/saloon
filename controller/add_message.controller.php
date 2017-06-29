<?php

session_start();

require('../model/messages.model.php');

$content = htmlspecialchars($_POST['content']);
$convers_id = htmlspecialchars($_POST['convers_id']);

if(!empty($content) && !empty($convers_id)){

	addMessage($content, $convers_id, $_SESSION['id'], $_SESSION['login']);

	$messages = getMessageByConversID($convers_id, 10);

	$_SESSION['last_msg'][$convers_id] = $messages[0]['id'];

	$messages = array_reverse($messages);

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

}

?>