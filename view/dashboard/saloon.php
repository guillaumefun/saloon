
<?php $saloon_id = (isset($_GET['s'])) ? $_GET['s'] : $default_saloon; ?>

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
			<input type="text" class="form-control" placeholder="25/03/2100" name="deadline">
		</div>
	</div>
	<div class="row form-group">
		<div class="col-md-4">
			<input type="submit" class="btn btn-primary" value="Créer un nouveau projet">
		</div>
	</div>
</form>

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

<?php

$saloon = getBetsBySaloonID( $saloon_id );

foreach ($saloon as $member) {
	?>

	<div class="row">

		<div class="col-md-2">
			<h3><?php echo $member['user']['login']; ?></h3>
		</div>

	</div>

	<?php
	$count = 0;
	foreach ($member['bets'] as $bet ) {
		?>

			<div class="well">
				<div class="row">

					<div class="col-md-12">
						<h4><?php echo $bet['name']; ?></h4>
					</div>

				</div>
				<div class="row">

					<div class="col-md-12">
						<h6>Deadline <?php echo $bet['deadline']; ?></h6>
					</div>

				</div>

				<div class="row">

					<div class="col-md-12">
						<h5><?php echo $bet['description']; ?></h5>
					</div>

				</div>
			</div>

			<!-- Récompenses -->

			<div class="row">
			<?php

				$rewards = getRewardsByBetID( $bet['id'] );
				$count_rewards = 0;
				foreach( $rewards as $reward ){
					$count_rewards++;

					$reward_detail = getRewardDetail( $reward['id'] );
					$reward_quantity = getRewardQuantity( $reward_detail );
					?>

						<div class="col-md-2">
							<?php echo $reward['name'] . "  "; ?><a href="#" data-toggle="tooltip" title="<?php echo printRewardDetail( $reward_detail ); ?>" id="quantity_<?php echo $reward['id']; ?>"><?php echo $reward_quantity; ?></a>
							<button class="btn btn-default plus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-plus"></span></button>
							<button class="btn btn-default minus" value="<?php echo $reward['id']; ?>"><span class="glyphicon glyphicon-minus"></span></button>
						</div>

					<?php

				}
				?>

			</div>

			<div class="row">

				<div class="col-md-4">
						<a href="../rewards.view.php?bet_id=<?php echo $bet['id'] ."&s=" . $saloon_id . "&user_id=" . $bet['user']; ?>"><button class="btn btn-default">Ajouter une récompense</button></a>
				</div>
			</div>



			<!-- Commentaires -->

			<?php 

				$comments = getCommentsByBetID( $bet['id'] );

			?>

			<div class="panel-group">
			  <div class="panel panel-default">
			    <div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#comments<?php echo $bet['id']; ?>">Commentaires <span class="badge"><?php echo count($comments); ?></span></a>
					</h4>
				</div>
				<div id="comments<?php echo $bet['id']; ?>" class="panel-collapse collapse">
      				<div class="panel-body">

			<?php

				foreach ($comments as $comment) {
					
					?>

					<div class="row">

						<div class="col-md-8">
							<h5><?php echo $comment['user_name']; ?></h5>
							<p><?php echo $comment['content']; ?></p>
						</div>

					</div>

					<?php

				}

				if( count($comments) == 0 ){
					?>

						<p>Il n'y a pas encore de commentaires</p>

					<?php
				}

			?>
					</div>
				</div>
			  </div>
			</div>


			<form action="../../controller/add_comment.controller.php?b=<?php  echo $bet['id'] . "&s=" . $saloon_id; ?>" method="post">
				<div class="row form-group">
					<div class="col-md-4">
						<input type="text" class="form-control" placeholder="Commentaire" name="comment">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-4">
						<input type="submit" class="btn btn-primary" value="Publier">
					</div>
				</div>
			</form>

		<?php
		$count++;
	}
	if($count == 0){
		?>
			<div class="row">

				<div class="col-md-5">
					<p>Cet utilisateur n'a encore rien parié !!</p>
				</div>

			</div>

		<?php
	}
}


?>