<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['id'])){
	header('Location: ../');
}
$idSession = $_SESSION['id'];
?>


<!DOCTYPE html>
<html class="theSaloon">
<head>
	<title>Saloon</title>
	<?php include('../header/head.header.php'); ?>
	<?php include('randomBack.php'); ?>
	<link rel="stylesheet" type="text/css" href="../css/chatbox.css">
</head>

<body class="theSaloon">
	<?php include('notificationsScript.php'); ?>
	<?php include('notifications.php'); ?>
	<div id="wrapper">
			<!--FUCKING SIDEBAR-->
			<div id="sidebar-wrapper">
				<div class="barre"></div><!--barre verticale (border fait chier)-->
				<ul class="sidebar-nav">
					<div class="col-xs-5 pp">
						<img class="img-responsive img-circle" src="../../img/profiles/<?php if(is_file('../../img/profiles/' . $_SESSION['id'] . '/profile.png')) echo $_SESSION['id'] . '/profile.png?' . rand(99,9999); else echo 'profile.jpg'; ?>">
					</div>
					<div class="col-xs-6 ppName">
						<a href="../profile/?id=<?php echo $_SESSION['id']; ?>"><h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Mon profil</h3></a>
					</div>
					<div class="lol"></div><!--passage à la ligne-->
					<?php include('all_saloons.php'); ?>
				</ul>
				<div class="logBtn">
					<?php
					if( isset($default_saloon)){ ?>
						<a onclick="HelpBox('creerProjet')" class="">Crée toi un projet!</a>
						<a onclick="HelpBox('ajoutMembre')" class="">Ajoute des membres<3</a>
					<?php } ?>
					<a href="/controller/logout.controller.php" class="">Déconnexion</a>
				</div>
			</div><!--end sidebar-wrapper-->

			<!--RIDEAU-->
			<div id="rideau" style="display:none; cursor: pointer;"></div> <!--Fond noir quand pop up-->

			<!--BANNER-->
			<header class="fucking-banner">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h1 class="tagline">Licorne.life</h1>
							<h3 class="tagline">Ultimate way to become a fucking Licorne!</h3>
						</div>
					</div>
				</div>
			</header>
			<div class="searchBar">
				<iframe src="https://duckduckgo.com/search.html?width=370&prefill=Rechercher sur le internet.&focus=yes" style="overflow:hidden;margin:0;padding:0;width:400px;height:40px;" frameborder="0"></iframe>
			</div>
			<!--
			<div class="links">
			<a href="https://youtube.com"><img src="../resources/img/youtube-black.svg" alt=""></a>
			<a href="https://facebook.com"><img src="../resources/img/Facebook-black.svg" alt=""></a>
			<a href="https://google.com"><img src="../resources/img/Google-black.svg" alt=""></a>
			<a href="https://drive.google.com"><img src="../resources/img/drive-black.svg" alt=""></a>
			<a href="https://dribbble.com"><img src="../resources/img/dribbble-black.svg" alt=""></a>
			<a href="https://bitly.com"><img src="../resources/img/bitly-black.svg" alt=""></a>
			<a href="https://github.com"><img src="../resources/img/Github-black.svg" alt=""></a>
		</div>
	-->

	<!--FUCKING PAGE CONTENT-->
	<div id="page-content-wrapper">
		<div class="container-fluid">

			<div class="row">
				<div class="btnTog">
					<a href="#menu-toggle" class="" id="menu-toggle">Menu</a>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
					<?php include('messages.php'); ?>
					<?php
					if( isset($default_saloon)){
						include('saloon.php');
					}else{
						include('no_saloon.php');
					}
					?>
				</div>
			</div>

			<!-- Chatbox -->
			<?php include('chatbox.php'); ?>

		</div>
	</div><!--end page content-->

</div><!-- endwrapper-->

<?php include('../resources/photoswipe/photoswipe.php'); ?>

</body>

<script src="../javascript/rewards.js"></script>

<script src="../javascript/animation.js"></script>

<script src="../javascript/gallery.js"></script>

<script src="../javascript/comments.js"></script>
<script src="../javascript/saloon.js"></script>

<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({html: true});
});

$('#date').datepicker({
	format: "dd/mm/yyyy",
	startDate: "today",
	maxViewMode: 2,
	language: "fr",
	multidate: false,
	autoclose: true,
	todayHighlight: true
});



</script>
</html>
