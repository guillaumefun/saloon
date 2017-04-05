<?php

	if(isset($_GET['c'])){

		$add_member_fb = htmlspecialchars($_GET['c']);

		if(!empty($add_member_fb)){

			$members = explode(';', $add_member_fb);

			?>

			<div class="row">
				<div class="col-md-6 alert alert-info">

			<?php

			foreach( $members as $member ){

				$member = explode(':', $member);

				if($member[1] == 0 ){

					echo '<p>L\'utilisateur "' . urldecode($member[0]) . '" fait maintenant partie du salon</p>'; 

				}elseif ($member[1] == 1) {
					echo '<p>L\'utilisateur "' . urldecode($member[0]) . '" fait déjà partie du salon</p>';
				}elseif ($member[1] == 2) {
					echo '<p>L\'utilisateur "' . urldecode($member[0]) . '" n\'est pas inscris</p>';
				}

			}

			?>
				</div>
			</div>

			<?php

		}

	}

?>