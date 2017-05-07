
	<?php

	require('../../model/bets.model.php');
	require('../../model/rewards.model.php');
	require('../../model/comments.model.php');
	require('../../model/rewards_detail.model.php');
	require('../../controller/functions.controller.php');

	$saloons = getAllSaloons();
	$count = 0;

	if(count($saloons) > 0){
		foreach( $saloons as $saloon ){
			if($count == 0){
				$default_saloon = $saloon['id'];
				$count++;
			}

			?>
			<li>
				<a href="?s=<?php echo $saloon['id']; ?>"><p class=""><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><?php echo $saloon['name']; ?></p></a>
			</li>
			<?php

		}
	}

	?>

	<div class="addSal">
		<a href="../new_saloon.view.php"><h3><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Créer un nouveau salon</h3></a>
	</div>
