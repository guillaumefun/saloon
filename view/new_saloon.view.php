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

	<body>

		<?php include('../header/navbar.header.php'); ?>

		<div class="container-fluid">

			<form action="../controller/saloon.controller.php" method="post">

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
					
						<input type="text" name="name" class="form-control" placeholder="Nom du salon" >
					
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
					
						<input type="submit" class="btn btn-primary">

					
				</div>

			</div>

			</form>

		</div>

	</body>

