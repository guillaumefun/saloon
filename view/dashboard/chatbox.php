
<div class="row">

	<div class="chatbar">
		<p><?php echo strtoupper($saloon_info['name']); ?><span class="glyphicon glyphicon-chevron-up"></span></p>
	</div>

	<div class="chatbox" hidden>
		<div class="chatbox-header">
			<p><?php echo strtoupper($saloon_info['name']); ?><span class="glyphicon glyphicon-remove"></span></p>

		</div>
		<div class="chatbox-logs">
			<?php

				$messages_arr = getMessageByConversID($saloon_id, 10);
				$_SESSION['nb_msg'][$saloon_id] = countMessages( $saloon_id );
				$messages_arr = array_reverse($messages_arr);
				$nb_msg = count($messages_arr); // nombre de msg affiché
				$nb_msg_total = countMessages($saloon_id);

				?>

					<div class="more_msg" id="<?php echo $nb_msg; ?>" hidden>
					</div>

				<?php



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
			<div class="send-btn"><img src="../resources/img/send.png"></div>
		</div>
	</div>

</div>

<!-- framework pour remplacer les liens dans un texte par des liens html -->
<script src="../resources/linkifyjs/linkify.min.js"></script>
<script src="../resources/linkifyjs/linkify-jquery.min.js"></script>
<script src="../resources/linkifyjs/linkify-html.js"></script>


<script src="../javascript/chatbox.js"></script>
