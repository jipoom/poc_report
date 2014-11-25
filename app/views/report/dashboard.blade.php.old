@extends("layout")
@section('title')
Stand Alone
@stop
@section('styles')
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")
      <!--Divs for our charts -->
		
		 <form action="{{URL::to('report/dashboard')}}" method="get">
		 <p>เลือกวันที่: <input type="text" id="datepicker" name="date" value="{{isset($date) ? $date : date('d-M-Y')}}">
		 <button type="submit">Submit</button></p>
		 </form>
		 <h3>รายงานสรุปผลประจำวันที่: {{$date}}</h3>
		 <div>
		 	<p>มีการตรวจค้นทั้งสิ้น {{$totalPrisonInspected}}</p>
		 	<p>พบยาเสพติด {{$totalDrugs}}</p>
		 	<p>พบสิ่งของต้องห้าม {{$totalItems}}</p>
		 </div>  
		 <div id="Khet1"></div>
		 <div id="Khet2"></div>
		 <div id="Khet3"></div>
		 <div id="Khet4"></div>
		 <div id="Khet5"></div>
		 <div id="Khet6"></div>

@section('scripts')
 <!-- load Google AJAX API -->

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
		          url: "{{URL::to('report/getDashBoardData')}}"+"/"+"{{$date}}"+"/"+"1",
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
                var chart1 = new google.visualization.PieChart (document.getElementById('Khet1'));
                var chart2 = new google.visualization.PieChart (document.getElementById('Khet2'));
                var chart3 = new google.visualization.PieChart (document.getElementById('Khet3'));
                var chart4 = new google.visualization.PieChart (document.getElementById('Khet4'));
                var chart5 = new google.visualization.PieChart (document.getElementById('Khet5'));
                var chart6 = new google.visualization.PieChart (document.getElementById('Khet6'));
                //define options for visualization
                var options = {width: 600, height: 400, is3D: true, title: 'เขต 1',colors: ['orange', 'red', 'green']};
 	
                //draw our chart
                chart1.draw(data, options);
                chart2.draw(data, options);
                chart3.draw(data, options);
                chart4.draw(data, options);
                chart5.draw(data, options);
                chart6.draw(data, options);

 
            }
        </script>
         <script>
		  $(function() {
		    $("#datepicker").datepicker({ dateFormat: 'dd-M-yy' });;
		  });
		  </script>
@stop 
@stop