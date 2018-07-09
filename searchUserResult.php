<?php 
	session_start();
	
	//This code is only fetched by ajax
	//Check login
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') {
        if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0'){
            die(0);
        }
    }
       
    if(!isset($_GET["username"])) 
        die(0);

	//Connect to the database and show the result
    $username=$_GET["username"];
    include 'dbConnection.php';
	$sql = "SELECT * FROM user WHERE username LIKE '%".$username."%'";
	$result=mysql_query($sql) or die(mysql_error());
	while($rws= mysql_fetch_array($result)){
		echo "<tr><td>".$rws[1]."</td>";
		if($rws[3]{0}=="0") print ("<td>(Private)</td>");
		else echo "<td>".strtok($rws[3]," ")."</td>";
		if($rws[4]=="-") print("<td>(Unknown)</td>");
		else echo "<td>".$rws[4]."</td>";
		
		echo "<td><input type='button' class='btn' value='Send Email' onclick='window.location=\"send_email.php?to=".$rws[0]."\"'></td>";
		echo "<td><input type='button' class='btn' value='Show' onclick='window.location=\"showUser.php?username=".$rws[1]."\"'></td></tr>";
	}
?>