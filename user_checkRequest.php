<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
		header('location:user_login.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Requests Inbox</title>
	<link rel="stylesheet" href="./css/userhome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <a href="user_home.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to User Center</a><br/>
	<div id="outContainer">
        <h2 class="titleBar">Requests Inbox</h2>
	<div class="inContainer" style="width:60%;">
        <table class="bookshell" align="center">
            <tr>
                <th>Requester Name</th>
				<th>ISBN</th>
                <th>Time Sent</th>
				<th></th>
            </tr>
			<!--check the request sent to this user -->
            <?php
                include 'dbConnection.php';
				$user_id=$_SESSION['user_id'];
				$sql="SELECT * FROM request where owner_id=$user_id";
				$result=mysql_query($sql) or die(mysql_error());
				
				while($rws= mysql_fetch_array($result)){
					echo "<tr><td>".$rws[3]."</td>";
					echo "<td>".$rws[4]."</td>";
					echo "<td>".$rws[5]."</td>";
					$request_id=$rws[0];
					if($rws[6]==0)echo "<td><input type='button' class='btn' value='Accept Borrow Request' onclick='window.location=\"user_acceptRequest.php?requestid=".$request_id."\"'/></td></tr>";
					else echo "<td><input type='button' class='btn' value='Accept Extension Request' onclick='window.location=\"user_acceptRequest.php?requestid=".$request_id."\"'/></td></tr>";
				}
            ?>
		<tr><td colspan="5"><img src="./img/mybook.gif" alt="book_pic" style="width:80%;height:200px;"/></td></tr>
        </table>
	</div>
	</div>
    </body>
</html>