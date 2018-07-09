<?php
	//Check login
	session_start();
	if(!isset($_SESSION['user_login'])) {
		header('location:index.php');
	}

	//Connect the database to get the email of current user
	include 'dbConnection.php';
	$user_id=$_SESSION["user_id"];
	$sql="SELECT email FROM user WHERE user_id='$user_id'";
	$result=mysql_query($sql) or die(mysql_error());
	$rws= mysql_fetch_array($result);
	$email=$rws[0];
	
	//Connect to the database to get the email of the destination user
	$to=$_GET["to"];
	$sql="SELECT email FROM user WHERE user_id='$to'";
	$result=mysql_query($sql) or die(mysql_error());
	$rws= mysql_fetch_array($result);
	$toemail=$rws[0];
?>
<html>
<head></head>
<link rel="stylesheet" href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<?php
  if (isset($_REQUEST['subject']))  {

  //Email information
  //$email = $_REQUEST['email'];
  $subject = $_REQUEST['subject']." From User ".$_SESSION['username'];
  $comment = "Message from your friend on BOOK CROSSING ".$_REQUEST['comment'];
  
  //send email
  mail($toemail, "$subject", $comment, "From:" . $email);
  

  //Email response
  echo "<div id='outContainer'><a href='javascript:window.history.back()'><i class='fa fa-arrow-circle-left'></i>&nbsp;Back</a><br/></br>
	<h2 class='titleBar' style='background-color:tomato;'><i class='fa fa-envelope'></i>&nbsp;Sent email succesfully!</h2></div>";
  }
  
  
  else  {
?>
<div id="outContainer" style="height:70%;">
<a href="javascript:window.history.back()"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a><br/></br>
<div class="inContainer" style="height:80%;margin-bottom:20%;width:50%;">
	<h2 class="titleBar"><i class="fa fa-envelope"></i>&nbsp;Send email</h2>
 	<form method="post" style="color:Maroon;font-weight:bold;">

  	Your Email: <input name="email" type="text" <?php print("value='".$email."'");  ?> disabled="disabled" />

  	Subject: <select name="subject">
		<option value="Shipment Information">Shipment Information</option>
		<option value="Comment">Comment</option>
		<option value="Others">Others</option>
		</select>
		</br>
  	</br>Detailed Information:</br>
 	 <textarea name="comment" cols="50" rows="10" style="width:300px; height:100px; resize:none"></textarea></br>

  	<input class="btn" type="submit" value="Submit" /></br>
  	</form>

</div>
</div>
<?php
  }
?>
</body>
</html>