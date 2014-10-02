@extends("layout")
@section('title')
Stand Alone
@stop
@section("content")
      <!--Divs for our charts -->
        <div id="Chart"></div>
 
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
		          url: "{{URL::to('report/getDashBoardData')}}",
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
                var chart = new google.visualization.PieChart (document.getElementById('Chart'));
                //define options for visualization
                var options = {width: 900, height: 600, is3D: true, title: 'เขค 1'};
 	
                //draw our chart
                chart.draw(data, options);

 
            }
        </script>
@stop 
@stop