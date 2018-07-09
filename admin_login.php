<?php
	session_start();
	//Redirect to home if already logged in
	if(isset($_SESSION["admin_login"])){
		if($_SESSION["admin_login"]=='1')
			header("location:admin_home.php");
	}
	//Check username and password
	if(isset($_REQUEST['signinBtn'])){
		include 'dbConnection.php';
		$adminname=$_REQUEST['adminname'];
		$password= $_REQUEST['password'];
		$sql="SELECT admin_id,adminname,password FROM admin WHERE adminname='$adminname' AND password='$password'";
		$result=mysql_query($sql) or die(mysql_error());
		$rws=mysql_fetch_array($result) or die(header('location:index.php?loginerr=1'));
	
		$id=$rws[0];
		$anm=$rws[1];
		$pwd=$rws[2];
		if($anm==$adminname && $pwd==$password){
			$_SESSION['admin_login']=1;
			$_SESSION['admin_id']=$id;
			header('location:admin_home.php'); 
		}
		else{
			header('location:index.php?loginerr=1');  
		}
	}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Admin Sign in</title>
	<link rel="stylesheet" href="./css/userhome.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
	<?php
		include "header.php";
	?>
<div id="outContainer">
	
        <h3 class="titleBar">Admin Sign in</h3>
	<div class="inContainer" >
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p class="titleForm"><i class="fa fa-user-circle"></i>
                Admin name:<input type="text" name="adminname" id="adminname" required="required" oninvalid="setCustomValidity('Please input your admin name!')" oninput="setCustomValidity('')"/>
            </p>
            <p class="titleForm"><i class="fa fa-key"></i>
                Password:<input type="password" name="password" id="password" required="required" oninvalid="setCustomValidity('Please input your password!')" oninput="setCustomValidity('')"/>
            </p>
            <input class="btn" type="submit" value="Sign in!" name="signinBtn"/></br></br>
        </form>
	</div>
</div>
    </body>
</html>