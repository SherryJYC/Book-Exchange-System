<?php
	session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>BOOKCROSSING</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/homeStyle.css">
<link rel="stylesheet" href="./css/userhome.css">
<body>
<?php
	include "header.php";
	if(isset($_GET["loginerr"])){
		print("<h2 class='titleBar' style='background-color:tomato;'>Login Failed!</h2>");
	}
	if(isset($_GET["regerr"])){
		print("<h2 class='titleBar' style='background-color:tomato;'>Failed to create the account, please try another username!</h2>");
  }
  if(isset($_GET["updateSuccess"])){
		print("<h2 class='titleBar' style='background-color:tomato;'>Your information is updated successfully!</h2>");
	}
?>
<div id="main">
	<img src="./img/biglogo.PNG" alt="homepage" width="60%" height="30%"/>
</div>

<div class="slideshow-container">

<div class="mySlides">
  <q><b>Swap books and explore this world together!</b></q>
  <p class="author">- The team of BOOK CROSSING</p>
</div>

<div class="mySlides">
  <q><b>A reader lives a thousand lives before he dies, said Jojen. The man who never reads lives only one.</b></q>
  <p class="author">-  George R.R. Martin, A Dance with Dragons</p>
</div>

<div class="mySlides">
  <q><b>The books that the world calls immoral are books that show the world its own shame.</b></q>
  <p class="author">- Oscar Wilde, The Picture of Dorian Gray</p>
</div>

<a class="prev" onclick="plusSlides(-1)"><i class="fa fa-arrow-left"></i></a>
<a class="next" onclick="plusSlides(1)"><i class="fa fa-arrow-right"></i></a>

</div>

<div class="dot-container">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>




</body>
</html>