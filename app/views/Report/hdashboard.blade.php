@extends("layout")
@section('title')
Stand Alone
@stop
@section('styles')
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
@stop
@section("content")
      <!--Divs for our charts -->
		
		 <form action="{{URL::to('report/hdashboard')}}" method="get">
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
       
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
		<script src="{{asset('assets/js/highcharts.js')}}"></script>
        <script>
        	$( document ).ready(
        	function initChart()
			{
				dashBoardChart();
				//cpuChart();
				//temperatureChart();
				//interfaceChart();
	
		});
		function dashBoardChart(){
			var options = {
				chart: {
					renderTo: 'Khet1',
					type: 'pie'
				},
				credits: {
					enabled: false
				},
				title: {
					text: 'เขต 1',
					x: -20
				},
				xAxis: {
					categories: [{}],
					labels:
					{
					  enabled: false
					},
				},
				yAxis: {
					title: {
		                text: 'Percentage'
		            }
				},
				tooltip: {
		            formatter: function() {
		                var s = '<b>'+ this.x +'</b>';
		                
		                $.each(this.points, function(i, point) {
		                    s += '<br/>'+point.series.name+': '+point.y;
		                });
		                
		                return s;
		            },
		            shared: true
		        },
				series: [{}]
			};
			
			$.ajax({
				url: "{{URL::to('report/getHDashBoardData')}}",
				data: 'show=impression&date={{$date}}&khetId=1',
				type:'get',
				dataType: "json",
				success: function(data){
					options.xAxis.categories = data.categories;
					options.series[0].name = 'Memory used';
					options.series[0].data = data.impression;

					var chart = new Highcharts.Chart(options);			
				}
			});
		}
        </script>
         <script>
		  $(function() {
		    $("#datepicker").datepicker({ dateFormat: 'dd-M-yy' });;
		  });
		  </script>
@stop 
@stop