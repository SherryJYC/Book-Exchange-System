<?php 
	session_start();
	$_SESSION["admin_login"]='0';	
	if(!isset($_SESSION['admin_login'])) 
		header('location:index.php');   

	else {
		include 'dbConnection.php';
		session_destroy();
		header('location:index.php');
	}
?>