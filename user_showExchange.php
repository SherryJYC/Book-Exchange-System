<?php 
	session_start();
		
	if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0') 
		header('location:user_login.php');   
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My Exchanges</title>
    <link rel="stylesheet" href="./css/userhome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <a href="user_home.php"><i class="fa fa-chevron-circle-left"></i>&nbsp;Back to User Center</a><br/>
	<div id="outContainer">
        <h2 class="titleBar">Lend Out</h2>
        <div class="inContainer" style="width:60%;">
        <table class="bookshell" align="center">
            <tr>
                <th>Requestor Name</th>
                <th>ISBN</th>
                <th>Start Time</th>
				<th>End Time</th>
            </tr>
			<!-- display the books lend out by this user -->
             <?php
                include 'dbConnection.php';
				$user_id=$_SESSION['user_id'];
				$sql="SELECT * FROM record where owner_id=$user_id";
				$result=mysql_query($sql) or die(mysql_error());
				
				while($rws= mysql_fetch_array($result)){
					$sender_id=$rws[2];
					$sql1 = "SELECT username FROM user where user_id=$sender_id";
					$result1=mysql_query($sql1) or die(mysql_error());
					$rws1= mysql_fetch_array($result1);
					if($rws1[0]!=''){
						echo "<tr><td>".$rws1[0]."</td>";					
						echo "<td>".$rws[3]."</td>";
						echo "<td>".$rws[4]."</td>";
						$return_date = date('Y-m-d', strtotime($rws[4] . ' +14 day'));
						print ("<td>".($rws[5]==null?"Due: $return_date":"Returned at $rws[5]")."</td></tr>");
					}
				}
            ?>
		<tr><td colspan="5"><img src="./img/mybook.gif" alt="book_pic" style="width:80%;height:200px;"/></td></tr>
        </table>
		</div>
		
		<h2 class="titleBar">Borrow In</h2>
        <div class="inContainer" style="width:60%;">
        <table class="bookshell" align="center">
            <tr>
                <th>Owner Name</th>
                <th>ISBN</th>
                <th>Start Time</th>
				<th>Expected Return Date</th>
				<th>Remarks</th>
            </tr>
			<!-- display the books borrowed in by this user -->
             <?php
                include 'dbConnection.php';
				$user_id=$_SESSION['user_id'];
				$sql="SELECT * FROM record where sender_id=$user_id";
				$result=mysql_query($sql) or die(mysql_error());
				
				while($rws= mysql_fetch_array($result)){					
					$owner_id=$rws[1];
					$sql1 = "SELECT username FROM user where user_id=$owner_id";
					$result1=mysql_query($sql1) or die(mysql_error());
					$rws1= mysql_fetch_array($result1);
					  if($rws1[0]!=''){
						echo "<tr><td>".$rws1[0]."</td>";					
						echo "<td>".$rws[3]."</td>";
						echo "<td>".$rws[4]."</td>";
						$return_date = date('Y-m-d', strtotime($rws[4] . ' +14 day'));
						echo "<td>".$return_date."</td>";
						if($rws[5]=='') echo "<td><input type='button' class='btn' value='Return' onclick='window.location=\"user_return.php?recordID=".$rws[0]."\"'><input type='button' class='btn' value='Apply for Extension to book owner' onclick='window.location=\"user_sendRequest.php?recordID=".$rws[0]."\"'></td></tr>";
						else echo "<td>Returned at ".$rws[5]."</td></th>";
					}
				}
            ?>
		<tr><td colspan="5"><img src="./img/mybook.gif" alt="book_pic" style="width:80%;height:200px;"/></td></tr>
        </table>
	</div>
	</div>
    </body>
</html>