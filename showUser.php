<?php 
	session_start();
	
	//Check login and check whether admin or user
    $admin=TRUE;
	include 'dbConnection.php';
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') {
        $admin=FALSE;
        if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0'){
            header('location:user_login.php');;
        }
    }
    
    if(!isset($_GET["username"])){
        header('location:searchUser.php');
	}
	
	//Connect to the database and fetch the result
	$username=$_GET["username"];
	$sql="SELECT * from user WHERE username='$username'";
	$result=mysql_query($sql) or die("An error occurs.");
	$rws= mysql_fetch_array($result);

	$birthday=$rws[3];
	$gender=$rws[4];
	$city=$rws[5];
	if(isset($_REQUEST['delete'])){
		$username=$_GET["username"];
		$sql="DELETE FROM user WHERE username='$username'";
		mysql_query($sql) or die("An error occurs.");
		$sql="DELETE FROM ownership WHERE owner_name='$username'";
		mysql_query($sql) or die("An error occurs.");

		header('location:admin_home.php');
	}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php print($username); ?>'s Homepage</title>
<style>
	#map-convas{height: 200px}
</style>
		<link rel="stylesheet" href="./css/userhome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDrZKefG18zkB7_EgVgGng25SwyzK1ZXgA"></script>
    </head>
    <body>
	<div id="outContainer">
       	 	<h2 class="titleBar"><i class="fa fa-archive"></i>&nbsp;Profile of &nbsp;<?php print($username) ?></h2>
			 <a href="javascript:window.history.back()"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a><br/></br>
        	<?php if($admin) print("<form method='POST'><input class='btn' type='submit' value='Remove ".$username." from BOOKCROSSING' name='delete'></form>") ?>
		<br><br>
	<div class="inContainer">
       	 <h3 class="titleBar">Public Information</h3>
       	 <p style="color:Maroon;font-weight:bold">
            Gender:<?php if($gender=='-') print("(Unknown)"); else print($gender); ?>
        </p>
         <p style="color:Maroon;font-weight:bold">
            Birthday:<?php if($birthday{0}=='0') print("(Private)"); else print(strtok($birthday," ")); ?>
        </p>
        <p style="color:Maroon;font-weight:bold">
            Location:<?php echo "<script> var city='".$city."'; var name='".$username."';</script>" ?>
		<div id="map-convas"></div>
		<span id="noLoc" style="visibility: hidden">User has no location record yet!</span>
        </p>
	</div></br>
	<div class="inContainer">
        <h3 class='titleBar'>Books available</h3>
		<table class="bookshell" align="center">
				<tr>
					<th>ISBN</th>
					<th>Book Name</th>
				</tr>
				<?php
					include 'dbConnection.php';
					$username=$_GET["username"];
					$sql="SELECT * FROM ownership where owner_name='$username'";
					$result=mysql_query($sql) or die(mysql_error());
					
					while($rws= mysql_fetch_array($result)){
						echo "<tr><td>".$rws[3]."</td>";
						echo "<td>".$rws[4]."</td></tr>";
					}
				?>
			<tr><td colspan="5"><img src="./img/mybook.gif" alt="book_pic" style="width:80%;height:200px;"/></td></tr>
			</table>
	</div>
	</div>
	<script src="./js/locationMap.js"></script>
    </body>
</html>