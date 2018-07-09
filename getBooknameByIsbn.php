<?php
    $ISBN=$_GET["ISBN"];

    require "dbConnection.php";
    $sql="SELECT bookname FROM ownership WHERE ISBN = '".$ISBN."'";
    $result=mysql_query($sql) or die(0);
    $rws=mysql_fetch_array($result);
    print($rws[0]);
?>