<?php
session_start();
		
if(!isset($_SESSION['user_login'])) 
    header('location:index.php');

if(!isset($_GET["ownerid"])||!isset($_GET["recordID"])){
    header("location:user_search.php");
}
include 'dbConnection.php';
if(isset($_GET["ownerid"])){
	$isbn=$_GET["isbn"];
	$ownerid=$_GET["ownerid"];

	$sender_id=$_SESSION['user_id'];
	$sender_name=$_SESSION['username'];
	$date =  date("Y-m-d h:i:sa");
	$sql="INSERT into request values('','$ownerid','$sender_id','$sender_name','$isbn','$date','0')";
	mysql_query($sql);
}
// apply for extension
if(isset($_GET["recordID"])){
	$record_id=$_GET["recordID"];
	$date=date("Y-m-d h:i:sa");
	$sql="SELECT * FROM record WHERE record_id=$record_id";
	$result=mysql_query($sql) or die(mysql_error());
	$rws1=mysql_fetch_array($result);
	$ownerid = $rws1[1];
	$sender_id = $rws1[2];
	$sender_name = mysql_fetch_array(mysql_query("SELECT username FROM user WHERE user_id='$sender_id'"))[0];
	$isbn = $rws1[3];
	$sql="INSERT INTO request values('','$ownerid','$sender_id','$sender_name','$isbn','$date','1')";
	mysql_query($sql) or die(mysql_error());
}
header("location:user_home.php");
?>