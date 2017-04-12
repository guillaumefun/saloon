<?php

	session_start();
	if(!isset($_SESSION['id'])){
		header('Location: /');
	}

 ?>
<!DOCTYPE html>

<html>
	<head>
		<?php include('header/head.header.php'); ?>
	</head>

	<body class="fullR">

		<?php include('../header/navbar.header.php'); ?>

		<div class="container-fluid">

			<form action="../controller/rewards.controller.php?<?php echo "bet_id=" . $_GET['bet_id'] . "&s=" . $_GET['s'] . "&user_id=" . $_GET['user_id']; ?>" method="post">

			<div class="row form-group">

				<div class="col-md-4 col-md-offset-4 input">
						<label>Récompense</label>
						<input type="text" name="name" class="form-control" placeholder="Génépi" >
						<input type="submit" class="btn btn-primary btnGo">

				</div>

			</div>

			</form>

		</div>

	</body>
