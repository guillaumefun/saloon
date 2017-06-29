<?php

		// Suppression des variables de session et de la session
		session_start();
		$_SESSION = array();
		session_destroy();

		if(isset($_COOKIE['login'])){
			$valide = 0;
			setcookie("login", $email, time() + $valide *24*3600, '/', 'www.licorne.life');
			setcookie("pass", $password, time() + $valide *24*3600,  '/', 'www.licorne.life');
			setcookie("login", $email, time() + $valide *24*3600, '/', 'licorne.life');
			setcookie("pass", $password, time() + $valide *24*3600,  '/', 'licorne.life');
		}

		header('Location: ../view/?msg=loggedout');

?>