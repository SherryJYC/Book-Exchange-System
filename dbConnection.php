<?php
	$serverName="mysql.comp.polyu.edu.hk";
	$dbusername="14110113d";
	$dbpassword="iruxmads";
	$dbname="14110113d";
	mysql_connect($serverName,$dbusername,$dbpassword) or die("Could not connect the database");
	mysql_select_db($dbname) or die(mysql_error());
?>