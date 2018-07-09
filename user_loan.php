<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
		header('location:user_login.php');   
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Loan a book</title>
</head>
<body>
<div>
	<ul>
	<li><a href="user_home.php">&lt;&lt;Back to Account Homepage</a></li>
	</ul>
</div>
<h2>This page is temporarily unavailable.</h2>