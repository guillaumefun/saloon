<?php $saloon_id = (isset($_GET['s'])) ? $_GET['s'] : $default_saloon;
	$saloon_info = getSaloon( $saloon_id );
?>

<div id="creerProjet" style="display: none">
	<div id="creerProjetB">
		<form action="../../controller/bet.controller.php?id=<?php  echo $saloon_id; ?>" method="post">
			<div class="row form-group">
				<div class="col-md-10">
					<label>Nom</label>
					<input type="text" class="form-control" placeholder="Mon Projet de fou !" name="name" id="project_name">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-10">
					<label>Description</label>
					<textarea class="form-control" placeholder="La description de mon Projet de fou !" name="description"></textarea>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4">
					<label>Deadline</label>
					<input type="text" class="form-control" placeholder="25/03/2100" name="deadline" id="date">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4">
					<input type="submit" class="btn btn-primary" value="Créer un nouveau projet">
				</div>
			</div>
		</form>
	</div>
</div>

<div id="ajoutMembre" style="display: none">
	<div id="ajoutMembreB">
		<form action="../../controller/add_member.controller.php?s=<?php  echo $saloon_id; ?>" method="post">
			<div class="row form-group">
				<div class="col-md-6">
					<label>Ajouter des nouveaux membres</label>
					<h6>Séparez leur nom d'utilisateur par une virgule</h6>
					<input type="text" class="form-control" placeholder="dupont365,maxlamenace" name="logins">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-4">
					<input type="submit" class="btn btn-primary" value="Ajouter des nouveaux membres">
				</div>
			</div>

		</form>

		<div class="row form-group">
			<div class="col-md-10">
				<label>Envoie ce lien à tes potes pour qu'ils aient accès à ce salon !</label>
				<div class="input-group">
					<input type="text" id="saloon_link" class="form-control" value="<?php echo "https://www.licorne.life/s/?key=" . substr(sha1(md5($saloon_id . "%" . $saloon_info['creation_date'])), 1, 16) . "&s=" . $saloon_id; ?>" ><div class="input-group-btn"><button type="button" id="saloon_link_btn" class="btn btn-primary">Copier le lien</button></div>
				</div>
			</div>
		</div>

	</div>
</div>

<div id="link_copied" style="display: none">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6 alert alert-info">
			<p>Lien copié dans le presse-papiers.</p>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
			<p class="titresaloon"><?php $saloon_info = getSaloon($saloon_id);
				echo strtoupper($saloon_info['name']) . ' ';
				$saloon_members = explode('|', $saloon_info['members']);
			 ?><a class="membreslink"href="#" data-toggle="tooltip" title="<?php echo printSaloonMembers( $saloon_info['members'] ); ?>"><?php echo '(' . count($saloon_members); if( count($saloon_members) > 1 ){ echo " membres)"; }else{ echo " membre)"; } ?></a>
		 </p>
	</div>
</div>
<div class="row balance">
	<div class="col-md-8">
		<input class="form-control" placeholder="Balance ton projet !" onfocus="startProject();">
	</div>
</div>


</br>


<?php
$saloon = getBetsFeed( $saloon_id );
if(count($saloon) == 0){
	?>
		<div class="row">

			<div class="col-md-6 col-md-offset-3">
				<h3 class="text-center">Bienvenue !</h3>
				<h5 class="text-center">Personne n'a fait de projet encore...</h5>
				<p class="text-center"><a onclick="HelpBox('creerProjet')"><button class="btn btn-default">Crée toi un projet!</button></a></p>
			</div>

		</div>

		<?php
}
foreach ($saloon as $bet) {
	$count = 0;
	$author = getUser($bet['user']);
		?>

		<div class="projo">
			<div class="row noMarg">
				<!--BLOCK de GAUCGE-->
				<div class="col-md-8 ombreG">
					<div class="row mywell"> <!-- pp + infos projet-->
						<div class="col-sm-2 mywellimg">
							<a href="../profile/?id=<?php echo $author['id'] . "&s=" . $saloon_id; ?>" ><img class="img-responsive img-circle" src="../../img/profiles/<?php if(is_file('../../img/profiles/' . $bet['user'] . '/profile.png')) echo $bet['user'] . '/profile.png?' . rand(99,9999); else echo '/profile.jpg'; ?>"></a>
							<h5 class="text-center pseudo"><?php echo $author['login']; ?></h5>
						</div>

						<div class="col-sm-10">
							<h4><?php echo $bet['name']; ?></h4>
							<?php
							$delta_dead = getDateDelta($bet['deadline']);
							$creation_date = explode(' ', $bet['creation_date']);
							$delta_creation = getDateDelta($creation_date[0], 'US');
							if($delta_creation > -3 && $delta_creation < 1){
								?><h4 class='labou'>
									<span class="label label-info">Nouveau</span>
									</h4>
								<?php
							}
							if($delta_dead < 4 && $delta_dead >= 0 && $bet['accomplished'] == '0'){
								?>
									<h4 class='labou'>
									<span class="label label-danger">Quasi dead</span>
									</h4>
								<?php
							}else if($bet['accomplished'] != '0'){
								?>
									<h4 class='labou'>
									<span class="label label-success">Fait!</span>
									</h4>
								<?php
							}
							if($delta_dead < 0 && $bet['accomplished'] == '0'){
								?><h4 class='labou'>
									<span class="label label-danger">DEAD</span>
									</h4>
								<?php
							}
							?>
							<h6>Deadline : <?php echo $bet['deadline']; ?></h6>
							<h5 class='descri'><?php echo $bet['description']; ?></h5>

							<?php
								if($bet['user'] == $_SESSION['id'] && $delta_dead >= 0 && $bet['accomplished'] == '0'){
									?>
										<a href="../close_bet.view.php?bet_id=<?php echo $bet['id']; ?>"><button class="btn btn-default btncouilles">J'ai porté mes couilles !</button></a>
									<?php
								}
							?>
						</div>

						<?php if($bet['nb_img'] > 0) include('show_proof.php'); ?>
					</div>

					<div class="row"> <!-- Commentaires -->

						<?php
						$comments = getCommentsByBetID( $bet['id'] );
						?>

						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title comm">
										<a data-toggle="collapse" href="#comments<?php echo $bet['id']; ?>">Comments <span class="badge" id="<?php echo 'badge_'  . $bet['id'] . '_' . $saloon_id; ?>"><?php echo count($comments); ?></span></a>
									</h4>
								</div>
								<div id="comments<?php echo $bet['id']; ?>" class="panel-collapse collapse">
									<div class="panel-body" >
										<div class="comments" id="<?php echo $bet['id'] . '_' . $saloon_id; ?>">

										<?php
										foreach ($comments as $comment) {
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
										?>
										</div>

											<div class="row form-group lol">
												<div class="col-md-7 nop">
													<input type="text" autocomplete="off" class="form-control comment_input" id="<?php echo 'comment_'  . $bet['id'] . '_' . $saloon_id; ?>" placeholder="Commentaire" name="comment">
												</div>
												<div class="col-md-5 nop2">
													<button class="btn btn-primary comment_form" id="<?php echo 'cf_'  . $bet['id'] . '_' . $saloon_id; ?>">Publier</button>
												</div>
											</div>
									</div>

								</div>

							</div>
						</div>
					</div>
				</div>  <!--END BLOC de GAUCHE-->



				<!--BLOC de DROITE-->
				<div class="col-md-4 bd">
					<div class="mywell2">
						<div class="row">
							<?php
							$rewards = getRewardsByBetID( $bet['id'] );
							$count_rewards = 0;
							foreach( $rewards as $reward ){
								$count_rewards++;
								$reward_detail = getRewardDetail( $reward['id'] );
								$reward_quantity = getRewardQuantity( $reward_detail );
								?>
								<div class="col-md-12 rewa">
									<?php echo $reward['name'] . "  "; ?><a href="#" data-toggle="tooltip" title="<?php echo printRewardDetail( $reward_detail ); ?>" id="quantity_<?php echo $reward['id']; ?>" class="rewards"><?php echo $reward_quantity; ?></a>
									<?php
									if($bet['accomplished'] == '0'){
										?>
									<button class="btn btn-default btn-xs plus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-plus"></span></button>
									<button class="btn btn-default btn-xs minus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-minus"></span></button>
									<?php
										}
									?>
								</div>


								<?php
							}
							if($count_rewards == 0){
								?>
								<div class="col-md-12 rewa">
									<p>Il n'y a pas de récompense</p>
								</div>
								<?php
							}
							?>

						</div>

						<?php
						if($bet['accomplished'] == '0'){
										?>

						<div class="row">

							<div class="col-md-4">
								<a href="../rewards.view.php?bet_id=<?php echo $bet['id'] ."&s=" . $saloon_id . "&user_id=" . $bet['user']; ?>"><button class="btn btn-default">Parie un truc!</button></a>
							</div>
						</div>
						<?php } ?>
					</div>
				</div> <!--END BLOC de DROITE-->


			</div>
		</div> <!--projo-->


		<?php
		$count++;
	}
?>
