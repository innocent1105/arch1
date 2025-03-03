<?php
	session_start();

	if(isset($_SESSION['user_id'])){
		unset($_SESSION['user_id']);
		setcookie("xr", $user_data['user_id'], 1, "/");
		header("Location: login.php");
	}else{
		header("Location: home.php");
	}
	die;