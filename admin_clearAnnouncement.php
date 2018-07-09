<?php
        //Check login
    	session_start();
        if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
            header('location:admin_login.php');   
        
        //Connect database to clear announcements
        include 'dbConnection.php';
        $sql="DELETE from announcement where 1=1";
		mysql_query($sql);

        //Go back to the previous page
         header("location:admin_announcement.php");
         
        print("<h2>This page is temporarily unavailable.</h2>");
?>