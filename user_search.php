<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])) {
		header('location:index.php');
	}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Search</title>  
		<link rel="stylesheet" href="./css/search.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
	    
    </head>
    <body>
	<div id="outContainer">
        	<a href="user_home.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to User Center</a><br/><br/>
        	<input type="search" length="50" name="content" id="content" autofocus="autofocus" autocomplete="off" required="required"/>
        	</br><input class="btn" type="button" value="Search!" id="searchButton"/>
       		 <div id="suggestionMenu"></div>
        	<div id="searchResult" style="margin-left:30%"></div>
	</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="./js/cookie.js"></script>
	<script src="./js/search.js"></script>
    </body>
</html>