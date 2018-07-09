<?php 
	session_start();
	//Check login	
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') {
		header('location:index.php');
	}
	
	//Get the current info of this user
	$user_id=$_SESSION['user_id'];
	include 'dbConnection.php';
	$sql="SELECT * FROM user WHERE user_id='$user_id'";
	$result=mysql_query($sql) or die(mysql_error());
	$rws= mysql_fetch_array($result);
	$email=$rws[6];
	$birthday=strtok($rws[3]," ");
	$gender=$rws[4];

	//Check the password (there is checking password before process)
	if(isset($_REQUEST['passwordBtn'])){
		$password=mysql_real_escape_string($_REQUEST['newPassword']);
		$previous=mysql_real_escape_string($_REQUEST['previousPassword']);
		$sql="SELECT password FROM user WHERE user_id='$user_id'";
		$result=mysql_query($sql) or die(mysql_error());
		$rws= mysql_fetch_array($result);
		if($rws[0]==$previous){
			$sql="UPDATE user SET password='$password' WHERE user_id='$user_id'";
			mysql_query($sql) or die("An error occurs.");
			header('location:index.php?updateSuccess=');
		}
		else {
			echo "<script>alert('Your password is incorrect.');window.history.back();</script>";
			// header('location:user_error.php?err=password');
			// echo "Your password is incorrect";
			// echo "<a href='user_updateInfo.php'><i class='fa fa-chevron-circle-left'></i>Back</a><br/><br/>";
		}

	}
	//Change the email
	if(isset($_REQUEST['emailBtn'])){
		$email=mysql_real_escape_string($_REQUEST['email']);
		$sql="UPDATE user SET email='$email' WHERE user_id='$user_id'";
		mysql_query($sql) or die("An error occurs.");

		header('location:index.php?updateSuccess=');
	}
	//Change the gender
	if(isset($_REQUEST['genderBtn'])){
		$gender=mysql_real_escape_string($_REQUEST['gender']);
		$sql="UPDATE user SET gender='$gender' WHERE user_id='$user_id'";
		mysql_query($sql) or die("An error occurs.");

		header('location:index.php?updateSuccess=');
	}
	//Change the birthday
	if(isset($_REQUEST['birthdayBtn'])){
		$birthday=mysql_real_escape_string($_REQUEST['birthday']);
		$sql="UPDATE user SET birthday='$birthday' WHERE user_id='$user_id'";
		mysql_query($sql) or die("An error occurs.");

		header('location:index.php?updateSuccess=');
	}
	//Change the city
	if(isset($_REQUEST['cityBtn'])){
		$city=mysql_real_escape_string($_REQUEST['coordinate']);
		$sql="UPDATE user SET city='$city' WHERE user_id='$user_id'";
		mysql_query($sql) or die("An error occurs.");

		header('location:index.php?updateSuccess=');
	}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Update Information</title>
	<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDrZKefG18zkB7_EgVgGng25SwyzK1ZXgA"></script>
<style>
	#nullAddress{display:none;}
</style>
<link rel="stylesheet" href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div id="outContainer">
	<a href="user_home.php"><i class="fa fa-chevron-circle-left"></i>Back to User Center</a><br/><br/>
    <h2 class="titleBar"><i class="fa fa-user-circle"></i>&nbsp;Update Information</h2>
    <p class="titleForm"><b>Dear &nbsp;<?php echo $_SESSION['username']  ?></br></p>
	<div class="inContainer">
    
    <h4 class="titleBar"><i class="fa fa-key"></i>&nbsp;Change password</h4>
    <form onsubmit="return checkPassword()" class="titleForm">
        Previous password:<input type="password" name="previousPassword" id="previousPassword" size="30" required="required"/><br/><br/>
        New password:<input type="password" name="newPassword" id="password" size="30" required="required" /><br/><br/>
        Confirm password:<input type="password" id="confirm" size="30" required="required"/><br/><br/>
        <input class="btn" type="submit" value="Change" name="passwordBtn"/></br></br>
    </form>
	</div></br>
	<div class="inContainer">
    <h4 class="titleBar"><i class="fa fa-envelope"></i>&nbsp;Change Email</h4>
    <form method="POST" class="titleForm">
        New email:<input type="email" name="email" <?php print("value='".$email."'"); ?> size="30" required="required"/></br>
        <input class="btn" type="submit" value="Change" name="emailBtn"/></br></br>
    </form>
	</div></br>
	<div class="inContainer">
    <h4 class="titleBar" class="titleForm"><i class="fa fa-transgender"></i>&nbsp;Change Gender</h4>
    <form class="titleForm">
        New gender:<select name="gender">
                <option value="-" <?php if($gender=="-") print("selected='selected'"); ?>>--</option>
                <option value="m" <?php if($gender=="m") print("selected='selected'"); ?>>Male</option>
                <option value="f" <?php if($gender=="f") print("selected='selected'"); ?>>Female</option>
            </select><br/>
        <input class="btn" type="submit" value="Change" name="genderBtn"/></br></br>
    </form>
	</div></br>
	<div class="inContainer">
    <h4 class="titleBar"><i class="fa fa-calendar"></i>&nbsp;Change Birthday</h4>
    <form class="titleForm">
        New Birthday:<input type="date" <?php print("value='".$birthday."'"); ?> name="birthday"/></br>
        <input class="btn" type="submit" value="Change" name="birthdayBtn"/></br></br>
    </form>
	</div></br>
	<div class="inContainer">
    <h4 class="titleBar"><i class="fa fa-map"></i>&nbsp;Change Address</h4>
	<form class="titleForm">
		<p  class="titleForm"><i class="fa fa-map-marker"></i>&nbsp;New Address:<input id='address' type="text" value=""></p>
		
		<input class="btn" type="button" value="Search on Map" id="coderBtn" /></br></br>
		<p id='nullAddress' style="color:tomato;font-weight:bold display: none" >
		<i class="fa fa-bell"></i>&nbsp;Please input a valid address or select the marker fitting your location on the map</p>
		<div id='map' style=" height: 200px;margin: 0 auto 0 auto; border: 2px solid Maroon;"></div>
      		 <p id='finalAddress'class="titleForm" style="display:hidden;"><i class="fa fa-check-circle"></i>&nbsp;Confirmed Address? *</p>
	    <input type="text" name="coordinate" id='submit_adr' required="required" oninvalid="setCustomValidity('Please input your address!')" oninput="setCustomValidity('')" style="display:none"/>
		<input class="btn" type="submit" value="Change" name="cityBtn" onclick="getCoordinate()"/></br></br>
	</form>
	</div>
</div>
	<script type='text/javascript' src='./js/geocode.js'></script>
    <script>
    function checkPassword(){
        var password=document.getElementById("password").value;
        var confirm=document.getElementById("confirm").value;
        if(password!=confirm)
        {
            document.getElementById("password").value="";
            document.getElementById("confirm").value="";
            document.getElementById("previousPassword").value="";
            window.alert("The passwords you have entered are different!");
            
            return false;
        }
        return true;
    }
    </script>

</body>
</html>