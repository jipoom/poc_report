@extends("layout")
@section('title')
Stand Alone
@stop
@section("content")
      <!--Divs for our charts -->
        <div id="Chart"></div>

		<div id="Chart2"></div>
		
 
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
            function outsideChart(){
            	var jsonData = $.ajax({
		          url: "{{URL::to('report/getData')}}"+"/"+"1/2/2/2",
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
                var chart = new google.visualization.ColumnChart (document.getElementById('Chart2'));
             
                var options = {width: 1100, height: 600, is3D: true, title: 'การจู่โจมตรวจค้นประจำวันที่ 9 กันยายน 2557'};
 	
                //draw our chart
                chart.draw(data, options);
            }
            function insideChart(){
            	var jsonData = $.ajax({
		          url: "{{URL::to('report/getData')}}"+"/"+"1/2/2/1",
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
             
                var options = {width: 1100, height: 600, is3D: true, title: 'การจู่โจมตรวจค้นประจำวันที่ 9 กันยายน 2557'};
 	
                //draw our chart
                chart.draw(data, options);
            }
            function createChart() {
 				
 				outsideChart();
 				insideChart();

 
            }
        </script>
@stop 
@stop