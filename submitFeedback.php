<?php
    session_start();
    include 'dbConnection.php';
		if(isset($_SESSION["user_login"]) && $_SESSION["user_login"]=='1'){
			$user_id=$_SESSION['user_id'];
			$username=$_SESSION['username'];
			$date =  date("Y-m-d h:i:sa");
			$sql1="SELECT email FROM user WHERE user_id='$user_id'";	
			$result=mysql_query($sql1) or die(mysql_error());
			$rws=mysql_fetch_array($result) or die(header('location:index.php?err=1'));
			$email=$rws[0];
		}
		else {
			$user_id="N/A";
			$username="N/A";
			$date =  date("Y-m-d h:i:sa");
			$email="N/A";
		}
		$content=$_REQUEST['feedback'];
		$sql2="INSERT into feedback values('','$user_id','$username','$date','$email','$content')";
        mysql_query($sql2);
        header('location:contactUs.php?feedback=');
?>