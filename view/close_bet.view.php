<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header('Location: /');
	}

	if(!isset($_GET['bet_id'])){
		header('Location: dashboard/');
	}
 ?>
<!DOCTYPE html>

<html>
	<head>
		<?php include('header/head.header.php'); ?>
	</head>

	<body class="fullR">

		<div class="container-fluid">

			<form action="../controller/close_bet.controller.php?<?php echo "bet_id=" . $_GET['bet_id']; ?>" method="post" enctype="multipart/form-data">

			<div class="row form-group">

				<div class="col-md-4 col-md-offset-4 input">
						<label>Pièces à convictions</label>
						<p><textarea class="form-control" maxlength="1000" placeholder="Alors voilà, aujourd'hui je suis devenu une licorne..." name="comment"></textarea></p>
						<p>Choisissez une ou plusieurs images (max 3) au format jpeg ou png</p>
						<input type="file" name="img[]" multiple accept=".jpeg, .jpg, .png, .PNG, .JPG, .JPEG">
						<input type="submit" class="btn btn-primary btnGo">

				</div>

			</div>


			</form>

		</div>
</body>