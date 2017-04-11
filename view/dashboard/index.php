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
	<link rel="stylesheet" type="text/css" href="/Saloon/view/css/structure.css">
	<link rel="stylesheet" type="text/css" href="/Saloon/view/css/styleDashboard.css">
</head>

<body>


	<div id="wrapper">
		<!--FUCKING SIDEBAR-->
		<div id="sidebar-wrapper">
			<?php include('all_saloons.php'); ?>
			<div class="logBtn">
				<a href="/Saloon/controller/logout.controller.php" class=""><button class="btn btn-primary">Déconnection</button></a>
			</div>
		</div><!--end sidebar-wrapper-->

		<!--FUCKING PAGE CONTENT-->
		<div id="page-content-wrapper">
			<div class="container-fluid">
				<div id="rideau" style="display:none; cursor: pointer;"></div> <!--Fond noir quand pop up-->
				<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<a onclick="HelpBox('creerProjet')" class="btn btn-default">Porte tes couilles et crée un new project!</a>
						<a onclick="HelpBox('ajoutMembre')" class="btn btn-default">Ajoute des membres à ton Saloon <3</a>
					</div>
				</div>

				<div class="row">

					<div class="col-md-8 col-md-offset-2">
						<?php include('messages.php'); ?>
						<?php include('saloon.php'); ?>
					</div>

				</div>

			</div>
		</div>
	</div><!-- endwrapper-->


	<script> /*FUCKING POP UP SCRIPT*/
	function HelpBox(id){
		if(document.getElementById(id).style.display!='block'){
			document.getElementById(id).style.display = 'block';
		}else{document.getElementById(id).style.display = 'none'}
		if(document.getElementById("rideau").style.display!='block'){
			document.getElementById("rideau").style.display = 'block';
		}else{document.getElementById("rideau").style.display = 'none'}
		ReHelpBox(id);
	}
	function ReHelpBox(id){
		rideau.addEventListener('click', function(){
			HelpBox(id);
		}) ;
	}
	</script>



	<script>  /*MENU TOGGLE SCRIPT*/
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
	</script>

</body>

<script src="../javascript/rewards.js"></script>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({html: true});
});
</script>
</html>
