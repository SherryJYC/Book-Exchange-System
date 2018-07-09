<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Contact us</title>
<link rel="stylesheet" href="./css/userhome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php
	if(isset($_GET["feedback"])){
		print("<h2 class='titleBar' style='background-color:tomato;'>Thank you for your feedback!</h2>");
	}
?>
<div id="outContainer">
	<a href="user_home.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back</a><br/>
	<div  class="inContainer" id="feedbackPanel" style="border:2px solid Maroon;border-radius:10px;width:40%;">
		<a name="feedback"></a>
		<h3 class="titleBar"><i class="fa fa-book"></i>&nbsp;Require Unavailable Book</h3>
		<form id='feedbackForm' method='POST' action="submitBookRequire.php" style="color:Maroon;font-weight:bold;">
		<i class="fa fa-book"></i>&nbsp;Book Name:<input type="text" name='book' required="required"/><br/></br>
		<i class="fa fa-address-book"></i>&nbsp;Author Name:<input type="text" name='author' required="required"/><br/>
		<input class="btn" type='submit' value='Send!'/></br></br>
		</form>

	</div>
</div>


</body>
</html>
