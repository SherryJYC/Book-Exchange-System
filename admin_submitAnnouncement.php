<?php
//Check admin login
session_start();
		
if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
    header('location:admin_login.php');

//Connect the database and insert announcement
if(isset($_POST["announcement"])){
	include 'dbConnection.php';
	if(isset($_SESSION["admin_login"]) && $_SESSION["admin_login"]=='1'){
		$admin_id=$_SESSION['admin_id'];
		$date =  date("Y-m-d h:i:sa");
		$content=$_REQUEST['announcement'];
		$sql="INSERT into announcement values('','$admin_id','$date','$content')";
		mysql_query($sql);
		print("<h2 class='titleBar' style='background-color:tomato;'>Announcement published.</h2>");
		header('location:admin_announcement.php?announcement=');
	}
}
?>