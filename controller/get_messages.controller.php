<?php

session_start();

require('../model/messages.model.php');

$convers_id = htmlspecialchars($_POST['convers_id']);

if(!empty($convers_id)){

	$messages = getMessageByConversID($convers_id, 10);

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