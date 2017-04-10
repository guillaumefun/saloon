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

			<form action="../controller/register.controller.php" method="post">

			<div class="row form-group top">

				<div class="col-md-4"></div>
				<div class="col-md-4">
						<label>Login</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" name="login" class="form-control" placeholder="Login" >
						</div>
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
						<label>Email</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-send"></i></span>
							<input type="email" name="email" class="form-control" placeholder="dupont@mail.com" >
						</div>
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">
						<label>Password</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" name="password" class="form-control" >
						</div>
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-4"></div>
				<div class="col-md-4">

						<input type="submit" class="btn btn-primary">


				</div>

			</div>

			</form>

			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<img class="papyGif" src="resources/img/papy.gif">
				</div>
			</div>

		</div>

	</body>
