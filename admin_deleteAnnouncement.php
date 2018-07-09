<?php
        //Check admin login
    	session_start();
        if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
            header('location:admin_login.php');   
        if(!isset($_GET["time"]))
            header("location:admin_showAnnouncement.php");
        
        //Connect to the database to delete message
        $time=$_GET["time"];
        include 'dbConnection.php';
        $sql="delete FROM announcement WHERE date='".$time."'";
        mysql_query($sql); 
        //Return to the previous page 
        header("location:admin_announcement.php");
?>