<?php

	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	require('../model/users.model.php');
	require('../model/saloons.model.php');
	require('../view/dashboard/notifications.php');



	$names = htmlspecialchars($_POST['logins']);
	$names = explode(',', $names);

	$saloon = htmlspecialchars( $_GET['s'] );

	$url_code = null;

	foreach( $names as $name ){

		if( !empty($name) ){

			$result = addMember( $name, $saloon );

			if( $result == 'NOT_REGISTERED' ){

				if($url_code == null){
					$url_code = urlencode($name) . ':2';
				}else{
					$url_code = $url_code . ';' . urlencode($name) . ':2';
				}

			}else if( $result == 'ALREADY_MEMBER' ){

				if($url_code == null){
					$url_code = urlencode($name) . ':1';
				}else{
					$url_code = $url_code . ';' . urlencode($name) . ':1';
				}

			}else{

				if($url_code == null){
					$url_code = urlencode($name) . ':0';
				}else{
					$url_code = $url_code . ';' . urlencode($name) . ':0';
				}

			}

		}

	}

	//notif
	$key = 'key'.$saloon;
	sendMessageTag($key, 'Il y a un nouveau PELO dans ton saloon!');

	header('Location: ../view/dashboard/?s=' . $saloon . '&c=' . $url_code);

?>
