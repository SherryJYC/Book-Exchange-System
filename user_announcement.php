<?php 
	include 'dbConnection.php';
	$sql="SELECT * FROM announcement";
	$result=mysql_query($sql) or die(mysql_error());
	while($rws= mysql_fetch_array($result)){
		echo "<h5>At ".$rws[2]." from administrator</h5>";
		echo "<p>".$rws[3]."</p>";
	}
?>