<?php
	//Check admin login
	session_start();
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
		header('location:admin_login.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Admin Inbox</title>
	<link rel="stylesheet" href="./css/userhome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
	<div id="outContainer">
        <a href="admin_home.php"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a></br>
    
	<div class="inContainer">
	<h2 class="titleBar"><i class="fa fa-envelope-square"></i>&nbsp;Feedback from users</h2>
	<a class='btn' href="javascript:clearFeedback()">Clear all messages</a><br/><br/><br/>
	<?php
		include 'dbConnection.php';
		$sql="SELECT * FROM feedback";
		$result=mysql_query($sql) or die(mysql_error());
		while($rws= mysql_fetch_array($result)){
			echo "<h3 class='titleForm'>At ".$rws[3]." from ".$rws[2]."</h3>";
			echo "<p class='titleForm'>email: ".$rws[4]."</p>";
			echo "<p class='titleForm'>Feedback:".$rws[5]."</p>";
			print("<p ><a class='btn' href='admin_deleteFeedback.php?time=".$rws[3]."'>Delete this message</a></p><br/>");
		}
	?>
	</div>
	</div>
	<script>
		//Let the admin confirm to delete all messages before processing
		function clearFeedback(){
			if(confirm("You are going to clear all messages, this cannot be recovered. Click OK to continue...")){
				window.location="admin_clearFeedback.php";
			}
		}
	</script>
</body>
</html>