<?php
session_start();
		
if(!isset($_SESSION['user_login'])) 
    header('location:index.php');

if(!isset($_GET["isbn"])){
    header("location:user_search.php");
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Search</title>
		<link rel="stylesheet" href="./css/userhome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <a href="user_search.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to Book Search Page</a><br/>
	<div id="outContainer">
        <h2 class="titleBar">Here are the owners of the book!</h2>
		<div class="inContainer" style="width:60%;">
			<table class="bookshell" align="center">
				<tr>
					<th>Owner Name</th>
					<th>Time Added</th>
					<th></th>
				</tr>
				<!-- search a list of users who own this selected book-->
				<?php
					include 'dbConnection.php';
					$isbn=$_GET["isbn"];
					$sql="SELECT * from ownership where ISBN=$isbn and loanDate=''";
					$result=mysql_query($sql) or die(mysql_error());
					while($rws= mysql_fetch_array($result)){
						if($rws[1]!=$_SESSION['user_id']){
							echo "<tr><td>".$rws[2]."</td>";
							echo "<td>".$rws[5]."</td>";
							$ownerid=$rws[1];
							$isbn=$rws[3];
							echo "<td><input type='button' class='btn' value='Send Request' onclick='window.location=\"user_sendRequest.php?ownerid=".$ownerid."&isbn=".$isbn."\"'/></td></tr>";
						}
					}
				?>
			<tr><td colspan="5"><img src="./img/mybook.gif" alt="book_pic" style="width:80%;height:200px;"/></td></tr>
			</table>
		</div>
	</div>
    </body>
</html>
