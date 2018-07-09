<?php

    //Check login
	session_start();
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
        header('location:admin_login.php');
    
    //Connect to the database and clear the inbox
    include 'dbConnection.php';
    $sql="DELETE from feedback where 1=1";
	mysql_query($sql);

    //Return to the previous page
    header("location:admin_getFeedback.php");
?>