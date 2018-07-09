<?php 
//check admin and user login
	session_start();
		
	if(!isset($_SESSION['admin_login'])||$_SESSION["admin_login"]=='0') {
        if(!isset($_SESSION['user_login'])||$_SESSION["user_login"]=='0'){
            header('location:user_login.php');;
        }
    }   
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Search a User</title>
		<link rel="stylesheet" href="./css/userhome.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
	 <div id="outContainer">

        <a href="javascript:window.history.back()"><i class="fa fa-arrow-circle-left"></i>&nbsp;Back</a><br/></br>
        <input type="search" size="30" id="username"/><br/><br/>
        <input class="btn" type="button" value="Search user" onclick="showResult()"/><br/><br/>
      <div class="inContainer" style="width:60%;">
        <h2 class="titleBar">Results</h2>
		
			<table id="result" align="center">
				<tr>
					<th>User Name</th>
					<th>Birthday</th>
					<th>Gender</th>
					<th>Email</th>
					<th></th>
				</tr>
			</table>
		</div>
		</div>
        <script>
            //Use ajax to show the search result
            function showResult(){
                var user=document.getElementById("username").value;
                if(user==""){
                    document.getElementById("result").innerHTML="<tr><th>User Name</th><th>Birthday</th><th>Gender</th><th>Email</th><th></th></tr>";
                    return;
                }
                var xhttp=new XMLHttpRequest();
                xhttp.onreadystatechange=function(){
                    if(xhttp.readyState==4 && xhttp.status==200){
                        document.getElementById("result").innerHTML="<tr><th>User Name</th><th>Birthday</th><th>Gender</th><th>Email</th><th></th></tr>"+xhttp.responseText;
                    }
                }
                xhttp.open("GET","searchUserResult.php?username="+user,true);
                xhttp.send();
            }
        </script>
    </body>
</html>