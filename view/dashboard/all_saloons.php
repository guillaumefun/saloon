<ul class="sidebar-nav">
	<?php

	require('../../model/bets.model.php');
	require('../../model/rewards.model.php');
	require('../../model/comments.model.php');
	require('../../model/rewards_detail.model.php');
	require('../../controller/functions.controller.php');

	$saloons = getAllSaloons();
	$count = 0;

	foreach( $saloons as $saloon ){
		if($count == 0){
			$default_saloon = $saloon['id'];
			$count++;
		}

		?>
		<li>
			<a href="?s=<?php echo $saloon['id']; ?>"><button class="btn btn-info"><?php echo $saloon['name']; ?></button></a>
		</li>
		<?php

	}

	?>

	<li>
		<a href="../new_saloon.view.php"><button class="btn btn-info">Créer un nouveau salon</button></a>
	</li>


</ul>
