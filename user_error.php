<?php
session_start();
		
if(!isset($_SESSION['user_login'])) 
    header('location:index.php');

include 'dbConnection.php';
$err=$_GET["err"];
if($err=='password'){
	echo "Your password is incorrect";
	echo "<a href='user_updateInfo.php'><i class='fa fa-chevron-circle-left'></i>Back</a><br/><br/>";
}

?>