<?php
	session_start();
	if (!isset($_SESSION['user'])) {
		header("Location: ../sign-in.php");
	} else if(isset($_SESSION['user']) != "") {
		header("Location: ../index.php");
	}
	 
	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: ../index.php?logout=success");
		exit;
	}
	
	if (isset($_GET['logoutbacktodigital'])) {
		unset($_SESSION['user']);
		session_unset();
		session_destroy();
		header("Location: http://digital.nic.in/");
		exit;
	}

?>	