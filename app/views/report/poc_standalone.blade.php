@extends("layout")
@section('title')
Stand Alone
@stop
@section("content")
      <!--Divs for our charts -->
        <div id="chart"></div>
        <div id="download"></div>
		<div id="Chart2"></div>
		<div id="download2"></div>
 
@section('scripts')
 <!-- load Google AJAX API -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <script type="text/javascript">
            //load the Google Visualization API and the chart
            //google.load('visualization', '1', {'packages':['columnchart','piechart']});
 			google.load('visualization', '1', {'packages':['corechart']});
            //set callback
            google.setOnLoadCallback (createChart);
            //callback function
            function createChart() {
 				
 				var jsonData = $.ajax({
		          url: "{{URL::to('report/getData')}}"+"/"+"1",
		          dataType:"json",
		          async: false
		          }).responseText;
 				
                //create data table object
               	var data = new google.visualization.DataTable(jsonData);
 			
 				var view = new google.visualization.DataView(data);
			    view.setColumns([0, 1
			    ,{ calc: "stringify",
		                         sourceColumn: 1,
		                         type: "string",
		                         role: "annotation" }]);
 			
                //instantiate our chart objects
                var chart = new google.visualization.ColumnChart (document.getElementById('chart'));
                // Wait for the chart to finish drawing before calling the getImageURI() method.
			      google.visualization.events.addListener(chart, 'ready', function () {
			        document.getElementById('chart').innerHTML = '<img src="' + chart.getImageURI() + '">';
			        document.getElementById('download').innerHTML = '<a href="'+chart.getImageURI()+'" download>Download</a>';
			        console.log(document.getElementById('chart').innerHTML);
			      });
                
                
                var secondChart = new google.visualization.LineChart (document.getElementById('Chart2'));
 				 // Wait for the chart to finish drawing before calling the getImageURI() method.
			      google.visualization.events.addListener(secondChart, 'ready', function () {
			        document.getElementById('Chart2').innerHTML = '<img src="' + secondChart.getImageURI() + '">';
			        document.getElementById('download2').innerHTML = '<a href="'+secondChart.getImageURI()+'" download>Download</a>';
			        console.log(document.getElementById('Chart2').innerHTML);
			      });
                //define options for visualization
                var options = {width: 400, height: 240, is3D: true, title: 'การจู่โจม กทม'};
 	
                //draw our chart
                chart.draw(view, options);
                secondChart.draw(view, options);
 
            }
        </script>
@stop 
@stop