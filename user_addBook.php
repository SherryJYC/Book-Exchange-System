<?php
session_start();
		
if(!isset($_SESSION['user_login'])) 
    header('location:index.php');

if(!isset($_GET["isbn"])){
    header("location:user_search.php");
}
include 'dbConnection.php';
$isbn=$_GET["isbn"];
$bookname=$_GET["name"];
/*
 * Code reserved to add book to inventory
 * 
 * header("location:user_inventory.php")
 */

$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
$adddate =  date("Y-m-d h:i:sa");
$sql="INSERT into ownership values('','$user_id','$username','$isbn','$bookname','$adddate','')";
mysql_query($sql);
header("location:user_inventory.php")
?>