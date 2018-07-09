<?php
    //Check admin login
	session_start();
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
        header('location:admin_login.php');
    if(!isset($_GET["time"]))
        header('location:admin_getFeedback.php');

    //Connect to the database to delete a message
    $time=$_GET["time"];
    include 'dbConnection.php';
    $sql="DELETE from feedback where date='".$time."'";
    mysql_query($sql);
     
    //Return to the previous page
    header("location:admin_getFeedback.php");
?>