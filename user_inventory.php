<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
		header('location:user_login.php');   
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My Books</title>
		<link rel="stylesheet" href="./css/userhome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <a href="user_home.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to User Center</a><br/>
		<div id="outContainer">
        <h2 class="titleBar">My Books</h2>
		<div class="inContainer" style="width:60%;">
        <table class="bookshell" align="center">
            <tr>
                <th>Book Name</th>
                <th>ISBN</th>
                <th>Time Added</th>
                <th>Time loaded out</th>
            </tr>
			<!-- display a list of the user's books-->
            <?php
                include 'dbConnection.php';
				$user_id=$_SESSION['user_id'];
				$sql="SELECT * FROM ownership where owner_id=$user_id";
				$result=mysql_query($sql) or die(mysql_error());
				
				while($rws= mysql_fetch_array($result)){
					echo "<tr><td><a href='bookinfo.php?isbn=".$rws[3]."&title=".$rws[4]."'>".$rws[4]."</td>";
					echo "<td>".$rws[3]."</td>";
					echo "<td>".$rws[5]."</td>";
					print ("<td>".($rws[6]==null?"Still Available":$rws[6])."</td></tr>");
				}
            ?>
		<tr><td colspan="5"><img src="./img/mybook.gif" alt="book_pic" style="width:80%;height:200px;"/></td></tr>
        </table>
	</div>
	</div>
    </body>
</html>