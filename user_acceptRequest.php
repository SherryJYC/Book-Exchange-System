<?php
session_start();
		
if(!isset($_SESSION['user_login'])) 
    header('location:index.php');

if(!isset($_GET["requestid"])){
    header("location:user_home.php");
}
include 'dbConnection.php';
$request_id=$_GET["requestid"];


$sender_id=$_SESSION['user_id'];
$sender_name=$_SESSION['username'];

$sql="SELECT * FROM request where request_id=$request_id";
$result=mysql_query($sql) or die(mysql_error());
$rws= mysql_fetch_array($result);
$owner_id=$rws[1];
$sender_id=$rws[2];
$ISBN=$rws[4];

$date =  date("Y-m-d h:i:sa");
$sql="UPDATE ownership SET loanDate='$date' WHERE owner_id=$owner_id and ISBN=$ISBN";
mysql_query($sql);

$sql="DELETE FROM record where owner_id='$owner_id' AND sender_id='$sender_id' AND ISBN='$ISBN'";
mysql_query($sql);

$sql="INSERT into record values('','$owner_id','$sender_id','$ISBN','$date','')";
mysql_query($sql);

$sql="delete from request where request_id=$request_id";
mysql_query($sql);
header("location:user_home.php")
?>