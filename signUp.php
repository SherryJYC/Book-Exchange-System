<?php
if(isset($_REQUEST['signupBtn'])){
	include 'dbConnection.php';
	$username=mysql_real_escape_string($_REQUEST['username']);
	$count=mysql_query("SELECT * FROM user WHERE username='$username'");
	if (mysql_num_rows($count)>0) {
		header('location:index.php?regerr=');
		die(0);
	}
	else {
		$password=mysql_real_escape_string($_REQUEST['password']);
		$birthday=mysql_real_escape_string($_REQUEST['birthday']);
		$gender=mysql_real_escape_string($_REQUEST['gender']);
		$city=mysql_real_escape_string($_REQUEST['coordinate']);
		$email=mysql_real_escape_string($_REQUEST['email']);
		$sql="INSERT into user values('','$username','$password','$birthday','$gender','$city','$email')";
		mysql_query($sql) or die("Account already exists.");
	}

	header('location:index.php');
}
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Register</title>
<style>
        #map{
            height: 400px;
            width: 400px;
        }
		#nullAddress{display:none;}
		#hidden_coord{display:none;}
</style>
<link rel="stylesheet" href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type='text/javascript' src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDrZKefG18zkB7_EgVgGng25SwyzK1ZXgA"></script>
</head>
<body>
<?php
	include "header.php";
?>

<?php
    $name=$password=$birthday=$gender="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=$_POST["username"];
        $password=$_POST["password"];
        $birthday=$_POST["birthday"];
        $gender=$_POST["gender"];
    }
?>
<div id="outContainer">
<h3 class="titleBar">Sign Up</h3>
<form method="POST" onsubmit="return checkForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="inContainer" style="width:40%;">
   <p class="titleForm"><i class="fa fa-user-circle"></i>
        Username:<input type="text" name="username" id="username" required="required" oninvalid="setCustomValidity('Please create your username!')" oninput="setCustomValidity('')"/>
    <span style="color:tomato">*</span></p>
   <p class="titleForm"><i class="fa fa-key"></i>
        Password:<input type="password" name="password" id="password" required="required" oninvalid="setCustomValidity('Please create your password!')" oninput="setCustomValidity('')"/>
     <span style="color:tomato">*</span></p>
   <p class="titleForm"><i class="fa fa-check-circle"></i>
        Confirm password:<input type="password" name="confirm" id="confirm" required="required" oninvalid="setCustomValidity('Please re-enter your password!')" oninput="setCustomValidity('')"/>
    <span style="color:tomato">*</span></p>
       
    <p class="titleForm"><i class="fa fa-envelope"></i>
        Email:<input type="email" name="email" id="email" required="required" oninvalid="setCustomValidity('Please create your email!')" oninput="setCustomValidity('')" />
     <span style="color:tomato">*</span></p>
    <p class="titleForm"><i class="fa fa-calendar"></i>
        Birthday:<input type="date" name="birthday"/>
    </p>
    <p class="titleForm"><i class="fa fa-transgender"></i>
        Gender:<select name="gender">
            <option value="-" selected>--</option>
            <option value="m">Male</option>
            <option value="f">Female</option>
        </select>
    </p>
    <p class="titleForm">
		<p  class="titleForm"><i class="fa fa-map-marker"></i>&nbsp;Address:<input id='address' type="text" value=""><span style="color:tomato">*</span></p>
		
		<input class="btn" type="button" value="Search on Map" id="coderBtn" onclick="showGeocoder()"/></br></br>
		<p id='nullAddress' style="color:tomato;font-weight:bold" display='none' >
		<i class="fa fa-bell"></i>&nbsp;Please input a valid address or select the marker fitting your location on the map</p>
		<div id='map' style=" margin: 0 auto 0 auto; border: 2px solid Maroon;"></div>
      		 <p id='finalAddress'class="titleForm" style="display:hidden;"><i class="fa fa-check-circle"></i>&nbsp;Click marker to confirm address <span style="color:tomato">*</span></p>
	  <input type="text" name="coordinate" id='submit_adr' style="display:none"/>
    		

	<br/>
    <input class="btn" type="submit" value="Sign up!" name="signupBtn" onclick="getCoordinate()"/></br></br>

</div>
</form>
<br>
<script type='text/javascript' src='./js/geocode.js'></script>
</div>
<script>
    function checkForm(){
        //var username=document.getElementById("username").value;
        var password=document.getElementById("password").value;
        var confirm=document.getElementById("confirm").value;
        /*
        if(username==""){
            alert("Please create your own username!");
            return false;
        }
        if(password==""){
            alert("Please create your password!");
            return false;
        }
        if(confirm==""){
            alert("Please key in your password again!");
            return false;
        }
        */
        if(password!=confirm){
            alert("The passwords you have entered are different!");
            document.getElementById("password").value="";
            document.getElementById("confirm").value="";
            return false;
        }
        if(document.getElementById("submit_adr").value==""){
            alert("Please set your location!");
            document.getElementById("address").focus();
            return false;
        }
        return true;
    }
</script>
<?php
    echo $name."<br/>".$password."<br/>".$birthday."<br/>".$gender;
?>

</body>
</html>