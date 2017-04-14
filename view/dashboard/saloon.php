<?php $saloon_id = (isset($_GET['s'])) ? $_GET['s'] : $default_saloon; ?>

<div id="creerProjet" style="display: none">
	<div id="creerProjetB">
		<form action="../../controller/bet.controller.php?id=<?php  echo $saloon_id; ?>" method="post">
			<div class="row form-group">
				<div class="col-md-4">
					<label>Nom</label>
					<input type="text" class="form-control" placeholder="Mon Projet de fou !" name="name">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-10">
					<label>Description</label>
					<input type="text" class="form-control" placeholder="La description de mon Projet de fou !" name="description">
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
				<div class="col-md-4">
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
	</div>
</div>




<?php
$saloon = getBetsFeed( $saloon_id );
foreach ($saloon as $bet) {
	$count = 0;
		?>

		<div class="projo">
			<div class="row" style="margin-right:0; margin-left:0;">
				<!--BLOCK de GAUCGE-->
				<div class="col-md-8 ombreG">
					<div class="row mywell"> <!-- pp + infos projet-->
						<div class="col-md-2 mywellimg">
							<img class="img-responsive img-circle" src="../../img/profiles/<?php if(is_file('../../img/profiles/' . $bet['user'] . '/profile.png')) echo $bet['user'] . '/profile.png?' . rand(99,9999); else echo '/profile.jpg'; ?>">
						</div>

						<div class="col-md-10">
							<h4><?php echo $bet['name']; 

							$delta_dead = getDateDelta($bet['deadline']);
							$creation_date = explode(' ', $bet['creation_date']);
							$delta_creation = getDateDelta($creation_date[0], 'US');
							if($delta_creation > -3 && $delta_creation < 1){
								?>
									<span class="label label-info">Nouveau</span>
								<?php
							}

							if($delta_dead < 4 && $delta_dead > 0 && $bet['accomplished'] == '0'){
								?>
									<span class="label label-danger">Quasi dead</span>
								<?php
							}else if($bet['accomplished'] != '0'){
								?>
									<span class="label label-success">Fait</span>
								<?php
							}


							?></h4>
							<h6>Deadline : <?php echo $bet['deadline']; ?></h6>
							<h5><?php echo $bet['description']; ?></h5>

							<?php 
								if($bet['user'] == $_SESSION['id'] && $delta_dead >= 0 && $bet['accomplished'] == '0'){

									?>
										<a href="../close_bet.view.php?bet_id=<?php echo $bet['id']; ?>"><button class="btn btn-default">J'ai porté mes couilles !</button></a>
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
										<a data-toggle="collapse" href="#comments<?php echo $bet['id']; ?>">Comments <span class="badge"><?php echo count($comments); ?></span></a>
									</h4>
								</div>
								<div id="comments<?php echo $bet['id']; ?>" class="panel-collapse collapse">
									<div class="panel-body">

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

										<form action="../../controller/add_comment.controller.php?b=<?php  echo $bet['id'] . "&s=" . $saloon_id; ?>" method="post">
											<div class="row form-group lol">
												<div class="col-md-7 nop">
													<input type="text" class="form-control" placeholder="Commentaire" name="comment">
												</div>
												<div class="col-md-5 nop2">
													<input type="submit" class="btn btn-primary" value="Publier">
												</div>
											</div>
										</form>
									</div>

								</div>

							</div>
						</div>
					</div>
				</div>  <!--END BLOC de GAUCHE-->



				<!--BLOC de DROITE-->
				<div class="col-md-4">
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
									<?php echo $reward['name'] . "  "; ?><a href="#" data-toggle="tooltip" title="<?php echo printRewardDetail( $reward_detail ); ?>" id="quantity_<?php echo $reward['id']; ?>"><?php echo $reward_quantity; ?></a>
									<button class="btn btn-default btn-xs plus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-plus"></span></button>
									<button class="btn btn-default btn-xs minus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-minus"></span></button>
								</div>


								<?php
							}
							?>

						</div>

						<div class="row">

							<div class="col-md-4">
								<a href="../rewards.view.php?bet_id=<?php echo $bet['id'] ."&s=" . $saloon_id . "&user_id=" . $bet['user']; ?>"><button class="btn btn-default">Parie un truc!</button></a>
							</div>
						</div>
					</div>
				</div> <!--END BLOC de DROITE-->


			</div>
		</div> <!--projo-->


		<?php
		$count++;
	}
	if($count == 0){
		?>
		<div class="row">

			<div class="col-md-5">
				<p>Personne n'a fait de projet encore !</p>
			</div>

		</div>

		<?php
	}

?>