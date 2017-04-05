<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


if(!isset($_SESSION['id'])){
	header('Location: ../');
}

  ?>
<!DOCTYPE html>

<html>
	<head>
		<title>Saloon</title>
		<?php include('../header/head.header.php'); ?>
	</head>

	<body>

		<?php include('../header/navbar.header.php'); ?>

		<div class="container-fluid">

			<div class="row">

				<div class="col-md-3">

					<?php include('all_saloons.php'); ?>

				</div>

				<div class="col-md-9">
					<?php include('messages.php'); ?>
					<?php include('saloon.php'); ?>
				</div>

			</div>

		</div>

	</body>