<?php 
	//Check admin login
	session_start();
		
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
		header('location:admin_login.php');   

	$admin_id=$_SESSION['admin_id'];
	include 'dbConnection.php';
	$sql="SELECT * FROM admin WHERE admin_id='$admin_id'";
	$result=  mysql_query($sql) or die(mysql_error());
	$rws=  mysql_fetch_array($result);
	
	
	$adminname = $rws[1];
	
	$_SESSION['adminname']  = $adminname;
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Home Page</title>
<link rel='stylesheet' href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<p style="color:Maroon;font-weight:bold;">
Welcome,
<?php
    echo $_SESSION["adminname"];
?>
</p>
<div id="outContainer"> 

<div class='inContainer'>
	<h2 class="titleBar"><i class="fa fa-drivers-license"></i>&nbsp;Admin Control Panel</h2>
	<a href="admin_addRecord.php">Add a record</a></br>
	<a href="admin_deleteRecord.php">Delete a record</a></br>
	<a href="admin_bookMgr.php">Manage books (in local database)</a><br/>
	<a href="searchUser.php">Search a user</a></br>
	<a href="admin_announcement.php">Manage Announcements</a></br>
	<a href="admin_getFeedback.php">Check Inbox</a></br>
	<a href="admin_logout.php">Log Out</a></br></br>
	
</div>
</div>
</body>
</html>