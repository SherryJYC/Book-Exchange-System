<?php 
	session_start();
		
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') 
		header('location:admin_login.php');   
?>




<!DOCTYPE HTML>
<html>
<head>
<title>Announcements</title>
<link rel="stylesheet" href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="outContainer">
<a href="admin_home.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to Admin Control Panel</a><br/><br/>

<div id="currentAnnouncement" class="inContainer">
<?php
	if(isset($_GET["announcement"])){
		print("<h2 class='titleBar' style='background-color:tomato;'>Announcement published</h2>");
	}
?>
<h2 class="titleBar">Current Announcement</h2>
<a href="javascript:refresh()"><i class="fa fa-repeat"></i>&nbsp;Refresh</a>
<p align="center" id="announcementResult"></p>
<input class="btn" type="button" onclick="clearAnnouncement()" value="Delete all announcements"/></br></br>
</div></br></br>
<div id="AnnouncementPanel" class="inContainer" style="color:Maroon;">

	<h2 class="titleBar">Add an announcement</h2>
	<form id='announcementForm' method='POST' action="admin_submitAnnouncement.php">
		<textarea name='announcement' required="required" style="width:300px; height:100px; resize:none"></textarea><br/>
		<input class="btn" type='submit' value='Submit!'/></br></br>
	</form>
</div>
</div>
<script>

setTimeout(refresh,1000);

//Use ajax to fetch the current announcements from the database
function refresh(){
	document.getElementById("announcementResult").innerHTML="Trying to get the announcements...";
	var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
		if(xhttp.readyState==4 && xhttp.status==200){
			document.getElementById("announcementResult").innerHTML=xhttp.responseText;
		}
	}
	xhttp.open("GET","admin_showAnnouncement.php",true);
	xhttp.send();
}

//Let the admin confirm to delete all announcement before deleting.
function clearAnnouncement(){
	if(confirm("You are going to delete all the announcements, this cannot be undone. Click OK to continue...")){
		window.location="admin_clearAnnouncement.php";
	}
}
</script>
</body>
</html>