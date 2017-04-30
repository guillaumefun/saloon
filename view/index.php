<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

		<form action="../controller/login.controller.php<?php if(isset($_GET['key']) && isset($_GET['s'])){ echo '?key=' . htmlspecialchars($_GET['key']) . '&s=' . htmlspecialchars($_GET['s']); } ?>" method="post">

			<div class="row gif">
				<div class="col-md-4 col-md-offset-4">
					<img class="img-responsive img-circle" src="https://j.gifs.com/98zQDJ.gif">
				</div>
			</div>

			<div class="row form-group">

				<div class="col-md-5"></div>
				<div class="col-md-2">

					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="login" class="form-control" placeholder="Login" >
					</div>

				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-2 col-md-offset-5">

					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="password" class="form-control" >
					</div>
				</div>

			</div>

			<div class="row form-group">

				<div class="col-md-2 col-md-offset-5">

					<input type="submit" class="btn btn-primary">

				</div>

			</div>

		</form>

		<div class="row form-group">


			<div class="col-md-2 col-md-offset-5">

				<a href="register.view.php<?php if(isset($_GET['key']) && isset($_GET['s'])){ echo '?key=' . htmlspecialchars($_GET['key']) . '&s=' . htmlspecialchars($_GET['s']); } ?>"><button class="btn btn-default">Pas encore inscris ?</button></a>

			</div>

		</div>


	</div>

</body>
