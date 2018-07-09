<?php 
	session_start();
	$_SESSION["user_login"]='0';	
	if(!isset($_SESSION['user_login'])) 
		header('location:index.php');   

	else {
		include 'dbConnection.php';
		session_destroy();
		header('location:index.php');
	}
?>