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

	<body class="full">

		<div class="container-fluid">

			<form action="../controller/saloon.controller.php" method="post">

			<div class="row form-group">

				<div class="col-md-4 col-md-offset-4 input">

						<input type="text" name="name" class="form-control" placeholder="Nom du salon" >
						<input type="submit" class="btn btn-primary btnGo">

				</div>

			</div>

			</form>

		</div>

	</body>
</html>
