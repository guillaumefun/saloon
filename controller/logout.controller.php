<?php

		// Suppression des variables de session et de la session
		session_start();
		$_SESSION = array();
		session_destroy();

		header('Location: ../view/?msg=loggedout');

?>