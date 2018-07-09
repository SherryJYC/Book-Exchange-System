<!DOCTYPE HTML>
<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
        header('location:index.php');
    if(!isset($_GET["key"])||$_GET["key"]!="DELETE")
        header('location:index.php');
?>
<html>
    <body>
        <?php
			$user_id=$_SESSION['user_id'];
			include 'dbConnection.php';
			$sql="delete FROM user WHERE user_id='$user_id'";
			mysql_query($sql);
            print("<h2>Your Account has been deleted successfully.</h2>");
			print("<a href='user_logout.php'><i class='fa fa-chevron-circle-left'></i>&nbsp;Back to Homepage</a><br/>");
        // Reserved for deleting the account

        ?>
    </body>
</html>