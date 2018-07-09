<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
		header('location:user_login.php');   
?>


<?php
	$user_id=$_SESSION['user_id'];
	include 'dbConnection.php';
	$sql="SELECT * FROM user WHERE user_id='$user_id'";
	$result=  mysql_query($sql) or die(mysql_error());
	$rws=  mysql_fetch_array($result);
	
	
	$username = $rws[1];
	
	$_SESSION['username']  = $username;
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src='./js/cookie.js'></script>
<script src='./js/userhome_recomList.js'></script>
</head>
<body>
<div id="welcome">Welcome, 
<?php
    echo $_SESSION["username"];
?>
!
<a class="btn"href="FAQ.php" target="_blank"><i class="fa fa-exclamation-circle"></i>&nbsp;FAQ</a><br/></br>
<div id="outContainer">
	<a href="index.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to Homepage</a><br/>
	<div class="inContainer" style="height:20%">
		<h2 class="titleBar"><i class="fa fa-book"></i>&nbsp;Book</h2>
			<a href="user_search.php">Borrow / Lend a Book</a><br/>
			<a href="user_inventory">My Books</a><br/>
			<a href="user_checkRequest">Check Requests</a><br/>
			<a href="user_showExchange.php">My Exchanges</a><br/>
			<a href="user_requirebook.php">Require Unavailable Book</a></br>
			<a href="bookchart.php">Current popular books</a><br/><br/>
		
	</div>
	<div class="inContainer" style="height:20%">
		<h2 class="titleBar"><i class="fa fa-user-circle"></i>&nbsp;Account</h2>
			<a href="user_logout.php">Log Out</a><br/>
			<a href="searchUser.php">Search a user</a><br/>
			<a href="user_updateInfo.php">Account Information Update</a><br/>
			<a href="javascript:destroy()">Destroy my account</a><br/>
			<a href="contactUs.php#feedback">Send Feedback</a></br></br>
		
	</div>

	<div class="inContainer" style="margin-left:0px;margin-right:10px">
		<h2 class="titleBar"><i class="fa fa-volume-up"></i>&nbsp;Announcement<a href="javascript:refresh()">&nbsp;<i style="color:OldLace;"class="fa fa-repeat"></i>&nbsp;</a></br></h2>
		
			
			<span id="announcementContent"/>
			<br/>
	</div>	

	<div class="inContainer" style="display:block;margin-left:30%;">
		<h2 class="titleBar"><i class="fa fa-thumbs-up"></i>&nbsp;Recommendations</h2>
			<table  cellspacing="0" cellpadding="0" id='recommendationList'></table>
		
	</div>
	</br></br>
	<a href="#welcome" id="top"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
	
</div>
	
</div>

<script>
	refresh();
	function refresh(){
		document.getElementById("announcementContent").innerHTML="Trying to get the announcements...";
		var xhttp=new XMLHttpRequest();
		xhttp.onreadystatechange=function(){
			if(xhttp.readyState==4 && xhttp.status==200){
				document.getElementById("announcementContent").innerHTML=xhttp.responseText;
			}
		}
		xhttp.open("GET","user_announcement.php",true);
		xhttp.send();
	}
	
	function destroy(){
		if(confirm("**Attention** You are going to delete your account permanently, this cannot be undone. Do you still want to delete your account?")){
			window.location="user_deleteAccount.php?key=DELETE";
		}
	}
</script>

</body>
</html>