<?php 

	session_start();
	if(isset($_SESSION['id'])){
		header('Location: dashboard/');
	}

 ?>
<!DOCTYPE html>

<html>
	<head>
		<?php include('header/head.header.php'); ?>
	</head>

	<body>

		<div class="container-fluid">

			<form action="../controller/login.controller.php" method="post">

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
					
						<input type="text" name="login" class="form-control" placeholder="Login" >
					
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">

						<input type="password" name="password" class="form-control" >
					
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
					
						<input type="submit" class="btn btn-primary">

					
				</div>

			</div>

			</form>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
						
						<a href="register.view.php"><button class="btn btn-default">Pas encore inscris ?</button></a>
					
				</div>

			</div>

		</div>

	</body>

