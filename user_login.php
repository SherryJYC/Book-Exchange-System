<?php
	session_start();
	if(isset($_SESSION['user_login'])){
		if($_SESSION['user_login']=='1'){
			header("location:user_home.php");
		}
	}
	if(isset($_REQUEST['signinBtn'])){
		include 'dbConnection.php';
		$username=$_REQUEST['username'];
		$password= $_REQUEST['password'];
		$sql="SELECT user_id,username,password FROM user WHERE username='$username' AND password='$password'";
		$result=mysql_query($sql) or die(mysql_error());
		$rws=mysql_fetch_array($result) or die(header('location:index.php?loginerr=1'));
	
		$id=$rws[0];
		$unm=$rws[1];
		$pwd=$rws[2];
		if($unm==$username && $pwd==$password){
			
			$_SESSION['user_login']=1;
			$_SESSION['user_id']=$id;
			header('location:user_home.php'); 
		}
		else{
			header('location:index.php?loginerr=1');  
		}
	}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Sign in</title>
	<link rel="stylesheet" href="./css/userhome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
<?php
	include "header.php";
?>


<div id="outContainer">
        <h3 class="titleBar">Sign in</h3>
	<div class="inContainer" >
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <p class="titleForm"><i class="fa fa-user-circle"></i>
                Username:<input type="text" name="username" id="username" required="required" oninvalid="setCustomValidity('Please input your username!')" oninput="setCustomValidity('')"/>
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