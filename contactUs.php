<?php
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Contact us</title>
<link rel="stylesheet" href="./css/userhome.css">
<style>
	#map-convas{
		height:200px;
	}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDrZKefG18zkB7_EgVgGng25SwyzK1ZXgA"></script>
<script type="text/javascript" src='./js/polyuMap.js'></script>
</head>

<body>
<?php
	include "header.php";
?>
<?php
	if(isset($_GET["feedback"])){
		print("<h2 class='titleBar' style='background-color:tomato;'>Thank you for your feedback!</h2>");
	}
?>
<div id="outContainer">
	<div class="inContainer" id="contactPanel" style="border:2px solid Maroon;border-radius:10px;width:40%;" >
		<h3 class="titleBar"><i class="fa fa-home"></i>&nbsp;Contact Info</h3>
    		<h4 class="titleForm"><i class="fa fa-map-marker"></i>&nbsp;Address</br>
    		<h5 style="color:Maroon;"><b>The Hong Kong Polytechnic University<br/>
			Hung Hom, Kowloon, Hong Kong</b></h5></br></h4>
		<div id='map-convas'  style=" margin: 0 auto 0 auto; border: 2px solid Maroon;"></div>
    		<h4 class="titleForm"><i class="fa fa-phone"></i>&nbsp;Tel: 66666666</h4>
   		 <h4 class="titleForm"><i class="fa fa-envelope"></i>&nbsp;E-mail: goodteam@gmail.com</h4>
	</div><br/>

	<div  class="inContainer" id="feedbackPanel" style="border:2px solid Maroon;border-radius:10px;width:40%;">
		<a name="feedback"></a>
		<h3 class="titleBar"><i class="fa fa-send"></i>&nbsp;Send feedback</h3>
		<form id='feedbackForm' method='POST' action="submitFeedback.php">
		<textarea name='feedback' required="required" style="width:200px; height:100px; resize:none"></textarea><br/>
		<input class="btn" type='submit' value='Send!'/></br></br>
		</form>

	</div>
</div>


</body>
</html>
