<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location:./index.html");
}
?>

<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var chartData = [['Name', 'Amount']];
        fetchAPI().then(results => {
			console.log("data",chartData)
          $.each(results, function (key, val) {
            if(val.amount != null){
              // val.amount = 0
    chartData.push([val.name, val.amount]);}
   
  });
		
        var data = google.visualization.arrayToDataTable(
          chartData);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
     }) }

      async function fetchAPI(){
				const response = await fetch('http://localhost/expensisTracker/Controllers/api/selectchart.php?id=1');
				if(!response.ok){
					const message = "An Error has occured";
					throw new Error(message);
				}
				
				const results = await response.json();
				return results; 
			}

// function getData(){
// 			fetchAPI().then(results => {
// 				console.log(results);
// 			}).catch(error => {
// 				console.log(error.message);
// 			})
// 		}
    </script>

<body>  
           <br /><br />  
           <div style="width:900px;">  
                <h3 align="center">Make Simple Pie Chart by Google Chart API with PHP Mysql</h3>  
                <br />  
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
           </div>  
      </body>  

</html>