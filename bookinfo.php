<?php
session_start();
//Check user login
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
		header('location:user_login.php'); 
if(!isset($_GET['isbn'])){
	header("location:googleBooks.html");
}
$isbn = $_GET['isbn'];
$title = $_GET['title'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="./css/userhome.css">
    <title>Book information</title>
    <script type="text/javascript" src="https://www.google.com/books/jsapi.js"></script>
	<script type="text/javascript" src="https://books.google.com/books/previewlib.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    
	<?php 
		include 'header.php';
	?>
	 	
	<?php
		echo '<div id="outContainer" style="height: 100%"> <a style="color:Maroon;" href="javascript:window.history.back()"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a><br/></br>
<div class="inContainer" style="height: 90%;text-align:center;"><h2 class="titleBar">Book information</h2>';
		echo '<table align="center" id="infoTable"><tr><th>Title</th></tr>';
		echo '<tr><td>'.$title.'</td></tr><tr id="bookInfo"></tr></table>';
		echo '<script type="text/javascript">var isbn='.$isbn.';var title="'.$title.'";</script>';
	?>
	<script>
	
	$('#infoTable').append("<form method='POST'><table id='resultTable' class='bookshell' align='center'>"
		+"<input type='button' class='btn' value='borrow' onclick='window.location=\"user_searchOwner.php?isbn="+isbn+"\"'>"
		+" <input type='button' class='btn' value='lend' name='lendBtn' onclick='window.location=\"user_addBook.php?isbn="+isbn+"&name="+title+"\"'/></br></br></td></tr></table></form>");

//Get the book info from API
			$.get("https://www.googleapis.com/books/v1/volumes?q=isbn:" + isbn,function(response){
				console.log(response);
				if(response.items.length>0){
					var info = response.items[0].volumeInfo;
					var list ={
					//"title" : info.title,
					"subtitle" : info.subtitle,
					 "authors": info.authors,
					 "publisher" : info.publisher,
					 "publishedDate" : info.publishedDate,
					 "description" : info.description,
					 "imageLinks" : info.imageLinks.thumbnail,
					  "previewLink" : info.previewLink
					};
					for (var key in list){checkLength(list[key],key);}
				}else{
					$('#infoTable').append('<p>Preview for the book is not supported now.</p>')
				}
			});	
						
			function checkLength(message,key){
				if(message!=null){
					if(key=='imageLinks'){
						$('#bookInfo').append("<tr id="+key+"><td>"+key.toUpperCase()+"</td><td><p><img src ='"+message+"' alt='book thumbnail'/></p></td>");
					}else if(key=='previewLink'){
						$('#bookInfo').append("<tr id="+key+"><td>"+key.toUpperCase()+"</td><td><a href='"+message+"'>More information</a></td>")
					}else{
						$('#bookInfo').append("<tr id="+key+"><td>"+key.toUpperCase()+"</td><td><p>"+message+"</p></td>");	
					}
				}	
			} 
			 google.books.load();
			  function initialize() {
				var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
				viewer.load('ISBN:'+isbn+'');
			  }
			google.books.setOnLoadCallback(initialize);
	</script>
	
	<?php 
		echo "</div></br></br><div class='inContainer' style='width:55%'><h2 class='titleBar'>Preview of this Book</h2>";
	?>
	<div id="viewerCanvas" style="align:center; width: 90%; height: 700px;"></div>
	<?php 
		echo "</div></div>";
	?>
	
  </body>
</html>