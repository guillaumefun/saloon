<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['id'])){
	header('Location: ../');
}else if(!isset($_GET['id']) || htmlspecialchars($_GET['id']) != $_SESSION['id']){ // Pour le moment on ne peut voir que son profil
	header('Location: ../dashboard/');
}
?>
<!DOCTYPE html>

<html>
<head>
	<title>Saloon</title>
	<?php include('../header/head.header.php'); ?>
	<link rel="stylesheet" type="text/css" href="../css/crop.css">
</head>

<body>

	<?php

		require('../../model/bets.model.php');
		require('../../model/rewards.model.php');
		require('../../model/comments.model.php');
		require('../../model/rewards_detail.model.php');
		require('../../controller/functions.controller.php');

		$id = htmlspecialchars($_GET['id']);
		$user = getUser($id);

		$bets = getBetsByUserID($id);

	?>

	<div id="wrapper">

		<!--FUCKING PAGE CONTENT-->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div id="rideau" style="display:none; cursor: pointer;"></div> <!--Fond noir quand pop up-->

				<!-- POPUP pour changer la photo de profil -->
				<div class="row">
					<div class="col-md-10">
						<div id="profilePicture" style="display: none">
								<div id="profilePictureB">
									<form action="../../controller/save_profile_picture.controller.php?s=<?php  echo $saloon_id; ?>" method="post" enctype="multipart/form-data" onsubmit="return save()">
										<div class="image-editor">
									      <input type="file" class="cropit-image-input">
									      <input type="hidden" id="dataURL" name="dataURL">
									      <div class="cropit-preview">
									      	<p>Fais glisser et dépose l'image ici</p>
									      </div>
									      <div class="image-size-label">
									        Resize image
									      </div>
									      <input type="range" class="cropit-image-zoom-input">
									      <button type="button" class="rotate-ccw btn btn-default">Rotate counterclockwise</button>
									      <button type="button" class="rotate-cw btn btn-default">Rotate clockwise</button>

									    </div>
										<div class="row form-group">
											<div class="col-md-4">
												<input type="submit" class="btn btn-primary" value="Enregistrer">
											</div>
										</div>
									</form>
								</div>
							</div>
					</div>
				</div>
				<!--  -->


				<div class="row">
					<div class="col-md-2 mywellimg">
						<img class="img-responsive img-circle" src="../../img/profiles/<?php if(is_file('../../img/profiles/' . $_SESSION['id'] . '/profile.png')) echo $_SESSION['id'] . '/profile.png?' . rand(99,9999); else echo 'profile.jpg'; ?>">
					</div>

					<div class="col-md-4">

						<h3><?php echo strtoupper($user['login']); ?></h3>
						<h4><?php 

						$done = getDoneBetsCount($id);

						if($done > 1){
							echo "Ce gaillard a porté ses couilles pour " . $done . " projets !";
						}else if($done == 0){
							echo "Tu n'as pas encore porté tes couilles !";
						}else{
							echo "Déjà un portage de couille ! Continue";
						}
						?></h4>
						<a onclick="HelpBox('profilePicture')"><button class="btn btn-default">Changer de photo de profil</button></a>

					</div>

				</div>

				<div class="row">

					<div class="col-md-3">
						<h2>Projets en cours</h2>
					</div>

				</div>

				<div class="row">
					<?php

						$count = 0;
						foreach($bets as $bet){

							if(!$bet['accomplished']){
								include('print_bet.php');
								$count++;
							}

						}
						if($count == 0){
							?>
							<div class="row">

								<div class="col-md-5">
									<p>Vous n'avez pas de projet en cours</p>
								</div>

							</div>

							<?php
						}

					?>

				</div>

				<div class="row">

					<div class="col-md-3">
						<h2>Projets finis</h2>
					</div>

				</div>

				<div class="row">

					<?php

						$count = 0;
						foreach($bets as $bet){

							if($bet['accomplished']){
								include('print_bet.php');
								$count++;
							}

						}
						if($count == 0){

							?>
							<div class="row">

								<div class="col-md-5">
									<p>Vous n'avez pas de projets finis</p>
								</div>

							</div>

							<?php
						}

					?>



				</div>



			</div>
		</div>


	</div>


</body>

<script>
$(function() {
        $('.image-editor').cropit({
          exportZoom: 1.25,
          imageBackground: true,
          imageBackgroundBorderWidth: 10,
          imageState: {
            src: '',
          },
        });

        $('.rotate-cw').click(function() {
          $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
          $('.image-editor').cropit('rotateCCW');
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
        });
      });

function save(){
	var imageData = $('.image-editor').cropit('export');
	$("#dataURL").val(imageData);
	return true;
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({html: true});
});


</script>
<script src="../javascript/rewards.js"></script>
<script src="../javascript/popup.js"></script>

</html>
