<?php 
	session_start();
	include 'dbConnection.php';
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
        header('location:index.php');
    if(!isset($_GET["recordID"]))
        header('location:index.php');
	$record_id=$_GET["recordID"];
	$date=date("Y-m-d h:i:sa");
	$sql="UPDATE record SET endDate='$date' WHERE record_id=$record_id";
	mysql_query($sql) or die(mysql_error());
	$sql="SELECT owner_id,ISBN FROM record WHERE record_id=$record_id";
	$result=mysql_query($sql) or die(mysql_error());
	$rws=mysql_fetch_array($result);
	$sql="UPDATE ownership SET loanDate='' WHERE owner_id=$rws[0] AND ISBN=$rws[1]";
	mysql_query($sql) or die(mysql_error());
	header('location:user_home.php');
?>