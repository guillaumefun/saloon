<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_SESSION['id'])){
	header('Location: dashboard/');
}

if(isset($_COOKIE['login'])){
	header('Location: ../controller/login_cookie.controller.php');
}

?>
<!DOCTYPE html>

<html>
<head>
	<?php include('header/head.header.php'); ?>
	<link rel="stylesheet" href="/Saloon/view/css/form-elements.css">
	<link rel="stylesheet" href="/Saloon/view/css/style.css">
</head>

<body class="bg">

	<!-- Top content -->
	<div class="top-content">

			<div class="inner-bg">
					<div class="container">

							<div class="row">
									<div class="col-sm-8 col-sm-offset-2 text">
											<img class="licorne" src="resources/img/licorne.png">
											<h1><strong>Licorne.life</strong></h1>
											<div class="description">
												<p>
													Toi aussi t'as envie de devenir aussi <strong>Badass</strong> qu'une
													<strong>Licorne</strong> mais ta flemme t'empêche d'atteindre tes
													objectifs et de tenir tes résolutions?
													Licorne.life te permet de créer des "Saloon" avec tes potes pour que vous
													vous poussiez mutuellement à atteindre vos fucking objectifs de vie!

													</details>
												</p>
											</div>
									</div>
							</div>

							<div class="row">
									<div class="col-sm-6 col-sm-offset-3">

										<div class="form-box">
											<div class="form-top">
												<div class="form-top-left">
													<h3>Se connecter</h3>
														<p>Entre ton Login et ton mdp pour te connecter:</p>
												</div>
												<div class="form-top-right">
													<i class="fa fa-key"></i>
												</div>
												</div>
												<div class="form-bottom">
											<form action="../controller/login.controller.php<?php if(isset($_GET['key']) && isset($_GET['s'])){ echo '?key=' . htmlspecialchars($_GET['key']) . '&s=' . htmlspecialchars($_GET['s']); } ?>" method="post" class="login-form">
												<div class="form-group">
													<label class="sr-only" for="form-username">Username</label>
														<input type="text" name="login" class="form-control" placeholder="Login" >
													</div>
													<div class="form-group">
														<label class="sr-only" for="form-password">Password</label>
														<input type="password" name="password" class="form-control" placeholder="Mot de passe" >
													</div>
													<div class="form-group">
														<div class="checkbox">
															<label><input type="checkbox" name="rememberme" >Se souvenir de moi</label>
														</div>
													</div>
													<button type="submit" class="btn">Sign in!</button>

											</form>
										</div>
									</div>

								<div class="social-login">
											<a href="register.view.php<?php if(isset($_GET['key']) && isset($_GET['s'])){ echo '?key=' . htmlspecialchars($_GET['key']) . '&s=' . htmlspecialchars($_GET['s']); } ?>"><h3>Pas encore inscrit?</h3></a>
											<!--<div class="social-login-buttons">
												<a class="btn btn-link-1 btn-link-1-facebook" href="#">
													<i class="fa fa-facebook"></i> Facebook
												</a>
												<a class="btn btn-link-1 btn-link-1-twitter" href="#">
													<i class="fa fa-twitter"></i> Twitter
												</a>
												<a class="btn btn-link-1 btn-link-1-google-plus" href="#">
													<i class="fa fa-google-plus"></i> Google Plus
												</a>
											</div>
										</div>

									</div>-->


									</div>
							</div>


					</div>
			</div>

	</div>

	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">

				<div class="col-sm-8 col-sm-offset-2">
					<div class="footer-border"></div>
					<p>Made with love by two unicorns 💙
						(En anglais ça claque plus) <i class="fa fa-smile-o"></i></p>
				</div>

			</div>
		</div>
	</footer>

	<!-- Javascript -->
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.backstretch.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!--[if lt IE 10]>
			<script src="assets/js/placeholder.js"></script>
	<![endif]-->

</body>

</body>
