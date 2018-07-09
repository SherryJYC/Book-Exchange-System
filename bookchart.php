<?php
	include 'dbConnection.php';
	$sql = "SELECT ISBN FROM ownership";
	$result = mysql_query($sql) or die(mysql_error());
	$ISBNs = array();
	while($rws = mysql_fetch_array($result)){
		array_push($ISBNs,$rws[0]);
	}
	echo "<div id='outContainer' style='height:80%;text-align:center;'>";
	echo "<h2 class='titleBar'>Popular Books Ranking</h2>"
?>
<html>
<head>
<link rel="stylesheet" href="./css/userhome.css">
</head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div id="chart" style='align:center;'></div>
<?php echo "<p display= none><script>var users=".json_encode($ISBNs).";</script></p>" ?>;
<script type="text/javascript">
//var users = <?php echo json_encode($ISBNs) ?>;

var times =[];
var ISBNs =[];
//document.getElementById("isbn").innerHTML = users;
count();
//document.write("times "+times+"; ISBN: "+ISBNs);


google.charts.load('current', {'packages':['corechart']});

      
google.charts.setOnLoadCallback(drawChart);

      
      function drawChart() {
		  var dataTable = new google.visualization.DataTable();
			var data=[];
			 var Header= ['ISBN', 'Times'];
			 data.push(Header);
			for (var i = 0; i < ISBNs.length; i++) {
				  var temp=[];
				  temp.push(ISBNs[i][0]);
				  temp.push(ISBNs[i][1]);

				  data.push(temp);
			
			var chartdata = new google.visualization.arrayToDataTable(data);

		  
			var options = {'title':'Popular books',
						 'width':400,
						 'height':300};

		  
			var chart = new google.visualization.PieChart(document.getElementById('chart'));
			chart.draw(chartdata, options);
			}
    }

	
	function count(){
		users.sort();
		var current = null;
		var cnt = 0;
		for (var i = 0; i < users.length; i++) {
			if (users[i] != current) {
				if (cnt > 0) {
					times.push(cnt);
					ISBNs.push([current,cnt]);
					//document.write(current + ' comes ' + cnt+" "+times[i] + ' times<br>');	
				}
				current = users[i];
				cnt = 1;
			} else {
				cnt+=1;
				//times.push(cnt);
			}
		}
		if (cnt > 0) {
			times.push(cnt);
			ISBNs.push([current,cnt]);
			//document.write(current + ' comes  ' + times[i] + ' times');
			
		}
		
	
	}

</script>
<?php
	echo "</div>";
?>
</html>