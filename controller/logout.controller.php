<?php

		// Suppression des variables de session et de la session
		session_start();
		$_SESSION = array();
		session_destroy();

		if(isset($_COOKIE['login'])){
			setcookie("login", $email, time(), null, null, false, true);
			setcookie("pass", $password, time(), null, null, false, true);
		}

		header('Location: ../view/?msg=loggedout');

?>