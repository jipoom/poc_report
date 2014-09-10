@extends("layout")
@section('title')
Stand Alone
@stop
@section("content")
      <!--Divs for our charts -->
        <div id="Chart"></div>
        <div id="download"></div>
        <div id="stackedChart"></div>
		<div id="Chart2"></div>
		<div id="download2"></div>
		<div id="Chart3"></div>
		<div id="download3"></div>
		<div id="Chart4"></div>
		<div id="stackedChart4"></div>
 
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
                var chart = new google.visualization.ColumnChart (document.getElementById('Chart'));
                var stackedchart = new google.visualization.ColumnChart (document.getElementById('stackedChart'));
                // Wait for the chart to finish drawing before calling the getImageURI() method.
			      /*google.visualization.events.addListener(chart, 'ready', function () {
			        document.getElementById('chart').innerHTML = '<img src="' + chart.getImageURI() + '">';
			        document.getElementById('download').innerHTML = '<a href="'+chart.getImageURI()+'" download>Download</a>';
			        console.log(document.getElementById('chart').innerHTML);
			      });*/
                
                
                var secondChart = new google.visualization.LineChart (document.getElementById('Chart2'));
 				 // Wait for the chart to finish drawing before calling the getImageURI() method.
			     /* google.visualization.events.addListener(secondChart, 'ready', function () {
			        document.getElementById('Chart2').innerHTML = '<img src="' + secondChart.getImageURI() + '">';
			        document.getElementById('download2').innerHTML = '<a href="'+secondChart.getImageURI()+'" download>Download</a>';
			        console.log(document.getElementById('Chart2').innerHTML);
			      });*/
			      
			    var thirdChart = new google.visualization.AreaChart (document.getElementById('Chart3'));
 				 // Wait for the chart to finish drawing before calling the getImageURI() method.
			      /*google.visualization.events.addListener(thirdChart, 'ready', function () {
			        document.getElementById('Chart3').innerHTML = '<img src="' + thirdChart.getImageURI() + '">';
			        document.getElementById('download3').innerHTML = '<a href="'+thirdChart.getImageURI()+'" download>Download</a>';
			        console.log(document.getElementById('Chart3').innerHTML);
			      });*/
			     
			    var fourthChart = new google.visualization.BarChart (document.getElementById('Chart4')); 
			    var stackedfourthChart = new google.visualization.BarChart (document.getElementById('stackedChart4')); 
			    var options4 = {width: 1100, height: 600, is3D: true, isStacked: true, title: 'การจู่โจมตรวจค้นประจำวันที่ 9 กันยายน 2557'};
                //define options for visualization
                var options = {width: 1100, height: 600, is3D: true, title: 'การจู่โจมตรวจค้นประจำวันที่ 9 กันยายน 2557'};
 	
                //draw our chart
                chart.draw(data, options);
                stackedchart.draw(data, options4);
                
                secondChart.draw(data, options);
                thirdChart.draw(data, options);
                fourthChart.draw(data,options);
                stackedfourthChart.draw(data,options4);
 
            }
        </script>
@stop 
@stop