
<div class="row">

	<div class="chatbar">
		<p><?php echo strtoupper($saloon_info['name']); ?></p>
	</div>

	<div class="chatbox" hidden>
		<div class="chatbox-header">
			<p><?php echo strtoupper($saloon_info['name']); ?></p>
		</div>
		<div class="chatbox-logs">
			<?php 
				require('../../model/messages.model.php');

				$messages_arr = getMessageByConversID($saloon_id, 10);
				$messages_arr = array_reverse($messages_arr);

				foreach ($messages_arr as $msg){
					?>

						<div class="msg <?php if($msg['user_id'] == $_SESSION['id']){ echo "self"; }else{ echo "other";} ?>">
							<div class="user-photo"><img src="../../img/profiles/<?php if(is_file('../../img/profiles/' . $msg['user_id'] . '/profile.png')) echo $msg['user_id'] . '/profile.png?' . rand(99,9999); else echo 'profile.jpg'; ?>"></div>
							<p class="msg-content"><?php echo $msg['content']; ?></p>
						</div>

					<?php
				}

				if( count($messages_arr) == 0 ){
					?>

						<p style="font-size:0.8em;margin">Envoie un premier message !</p>

					<?php
				}

			?>
		</div>
		<div class="chatbox-form">
			<textarea class="msg_input" id="<?php echo $saloon_id; ?>"></textarea>
		</div>
	</div>

</div>

<script src="../javascript/chatbox.js"></script>
